<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

// Route Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Auth Manual (Bisa diakses tanpa login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang wajib Login (Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('members', MemberController::class);
    Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update']);
    Route::put('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');

    // Khusus Admin
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});