<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\ReturnBook;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReturnBookController extends Controller
{
    private const FINE_PER_DAY = 2000;

    public function index()
    {
        $returns = ReturnBook::with([
            'loan.member',
            'loan.book',
        ])
        ->latest('return_date')
        ->get();

        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        $loans = Loan::with(['member', 'book'])
            ->where('status', 'Dipinjam')
            ->whereDoesntHave('returnBook')
            ->latest()
            ->get();

        return view('returns.create', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'return_date' => 'required|date',
        ]);

        $loan = Loan::with('book')->findOrFail($request->loan_id);

        if ($loan->status === 'Dikembalikan') {
            return back()
                ->withInput()
                ->withErrors([
                    'loan_id' => 'Peminjaman ini sudah dikembalikan.'
                ]);
        }

        if ($loan->returnBook()->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'loan_id' => 'Data pengembalian untuk peminjaman ini sudah ada.'
                ]);
        }

        $returnDate = Carbon::parse($request->return_date);
        $dueDate = Carbon::parse($loan->due_date);

        $lateDays = 0;

        if ($returnDate->greaterThan($dueDate)) {
            $lateDays = $dueDate->diffInDays($returnDate);
        }

        $fine = $lateDays * self::FINE_PER_DAY;

        ReturnBook::create([
            'loan_id' => $loan->id,
            'return_date' => $returnDate,
            'late_days' => $lateDays,
            'fine' => $fine,
        ]);

        $loan->update([
            'status' => 'Dikembalikan',
        ]);

        $loan->book->increment('stock');

        return redirect()
            ->route('returns.index')
            ->with('success', 'Pengembalian berhasil diproses.');
    }

    public function destroy(string $id)
    {
        $returnBook = ReturnBook::with('loan.book')
            ->findOrFail($id);

        $loan = $returnBook->loan;

        /*
         * Jika data pengembalian dihapus,
         * status peminjaman dikembalikan menjadi Dipinjam
         * dan stok buku dikurangi kembali.
         */
        if ($loan && $loan->status === 'Dikembalikan') {
            $loan->update([
                'status' => 'Dipinjam',
            ]);

            $loan->book->decrement('stock');
        }

        $returnBook->delete();

        return redirect()
            ->route('returns.index')
            ->with('success', 'Data pengembalian berhasil dihapus.');
    }
}