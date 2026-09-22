<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\Loan;
use App\Models\ReturnBook;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $totalCategories = Category::count();

        $totalMembers = Member::count();

        $totalLoans = Loan::where('status', 'Dipinjam')->count();

        $totalReturns = ReturnBook::count();

        $totalFines = ReturnBook::sum('fine');

        $recentLoans = Loan::with(['member', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalMembers',
            'totalLoans',
            'totalReturns',
            'totalFines',
            'recentLoans'
        ));
    }
}