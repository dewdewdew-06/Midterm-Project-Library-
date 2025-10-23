<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthController;

//homepage
Route::get('/', function () {
    return view('home');
});

//route for authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//must become user to access these
Route::middleware('auth')->group(function () {
    
    //book
    Route::resource('books', BookController::class);

    //author
    Route::resource('authors', AuthorController::class);
});
