<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class)
    ->except(['show']);

Route::get('/', function () {
    return view('welcome');
});
