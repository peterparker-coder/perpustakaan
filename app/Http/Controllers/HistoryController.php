<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $loans = Loan::with([
            'member',
            'book',
            'returnBook',
        ])
        ->latest()
        ->get();

        return view('history.index', compact('loans'));
    }
}