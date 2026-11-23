<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BorrowingController;

// Route Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Auth Manual (Bisa diakses tanpa login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Route yang wajib Login (Auth)
Route::middleware(['auth'])->group(function () {
    
    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (Admin & Petugas)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modul Buku & Anggota (Admin & Petugas)
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::resource('users', UserController::class); 
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
    });

    // Modul Kategori - HANYA MELIHAT (Admin & Petugas)
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    
    Route::get('/borrowings/export-pdf', [BorrowingController::class, 'exportPdf'])->name('borrowings.exportPdf');
    // Modul Peminjaman (Admin & Petugas)
    Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update']);
    Route::put('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');

    // Khusus Admin (Dilindungi Gate 'isAdmin')
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::resource('users', UserController::class); 
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
    });
    
});