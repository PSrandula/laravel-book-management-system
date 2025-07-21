<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Redirect root (/) to books index
Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);
