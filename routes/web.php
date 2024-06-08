<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect('/books');
});

// Book routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::post('/books/{id}/comment', [BookController::class, 'storeComment'])->name('comments.store');

// Comment routes
Route::get('/comments/{comment}', [BookController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [BookController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [BookController::class, 'destroy'])->name('comments.destroy');

// Authentication routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
