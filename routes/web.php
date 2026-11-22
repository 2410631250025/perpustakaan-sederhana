<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BorrowingController;

// Route Halaman Utama (Redirect ke Login)
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Auth Manual (Hanya untuk Tamu / Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Route Wajib Login (Auth)
Route::middleware(['auth'])->group(function () {
    
    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (Admin & Petugas)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modul Utama (Admin & Petugas)
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    
    // Modul Peminjaman (Admin & Petugas)
    Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update']);
    Route::put('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');

    // ==========================================
    // KHUSUS ADMIN (Dilindungi Gate 'isAdmin')
    // ==========================================
    // Rute admin diletakkan di atas rute 'only' agar /categories/create terbaca lebih dulu
    Route::middleware(['can:isAdmin'])->group(function () {
        
        // Mengelola User
        Route::resource('users', UserController::class); 
        
        // Mengelola Kategori (Create, Store, Edit, Update, Destroy)
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
        
    });

    // ==========================================
    // HANYA MELIHAT (Admin & Petugas)
    // ==========================================
    // Fungsi 'show' dihapus karena tidak ada halaman detail kategori
    Route::resource('categories', CategoryController::class)->only(['index']);
    
});