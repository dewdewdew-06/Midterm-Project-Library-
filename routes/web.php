<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthController;

//  Home Page
Route::get('/', function () {
    return view('home');
});

//  Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//  Protected Routes (Only accessible when logged in)
Route::middleware('auth')->group(function () {
    
    //  Books Routes
    Route::resource('books', BookController::class);

    // Author Routes
    Route::resource('authors', AuthorController::class);
});
