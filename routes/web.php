<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

// routes/web.php
Route::get('/check-auth', function () {
    return response()->json(['authenticated' => Auth::check()]);
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return response()->json(['message' => 'Logged out successfully']);
});

Route::get('/books-list', [BookController::class, 'getBooks']);
Route::get('/book-info/{id}', [BookController::class, 'bookInfo']);
Route::post('/sort-books', [BookController::class, 'sortBooks'])->name('sortBooks');
Route::post('/search-book', [BookController::class, 'searchBook'])->name('searchBook');
Route::post('/add-new-book', [BookController::class, 'addNewBook']);
Route::get('/refresh-books-list/{limit?}', [BookController::class, 'refreshBookList'])->name('refreshBookList');

Route::post('/book-info/{id}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

