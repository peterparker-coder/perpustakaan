<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;


Route::get('/', function () {
    return redirect()->route('categories.index');
});

Route::resource('categories', CategoryController::class)
    ->except(['show']);

Route::resource('books', BookController::class)
    ->except(['show']);

    Route::resource('members', MemberController::class)
    ->except(['show']);

    Route::resource('loans', LoanController::class)
    ->except(['show']);