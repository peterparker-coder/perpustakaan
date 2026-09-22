<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnBookController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->except(['show']);

Route::resource('books', BookController::class)
    ->except(['show']);

    Route::resource('members', MemberController::class)
    ->except(['show']);

    Route::resource('loans', LoanController::class)
    ->except(['show']);

    Route::resource('returns', ReturnBookController::class)
    ->only(['index', 'create', 'store', 'destroy']);

    Route::get('/history', [HistoryController::class, 'index'])
    ->name('history.index');