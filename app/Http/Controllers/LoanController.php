<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'book'])
            ->latest()
            ->get();

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $books = Book::where('stock', '>', 0)
            ->orderBy('title')
            ->get();

        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'book_id' => 'Stok buku sudah habis.'
                ]);
        }

        Loan::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'Dipinjam',
        ]);

        $book->decrement('stock');

        return redirect()
            ->route('loans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);

        $members = Member::orderBy('name')->get();
        $books = Book::orderBy('title')->get();

        return view('loans.edit', compact('loan', 'members', 'books'));
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'status' => 'required|in:Dipinjam,Dikembalikan',
        ]);

        $loan->update([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('loans.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);

        $loan->delete();

        return redirect()
            ->route('loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}