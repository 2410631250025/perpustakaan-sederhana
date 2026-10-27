<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total Judul Buku
        $totalBuku = Book::count();

        // 2. Menghitung Total Stok Buku (diberi default 0 jika belum ada data)
        $totalStok = Book::sum('stock') ?? 0;

        // 3. Menghitung Total Member
        $totalMember = Member::count();

        // 4. Menghitung Total Buku Dipinjam 
        // (Di-set 0 dulu, nanti disambungkan ke Model Borrowing saat Azmi selesai)
        $totalDipinjam = 0; 

        return view('dashboard.index', compact('totalBuku', 'totalStok', 'totalMember', 'totalDipinjam')); //[cite: 5]
    }
}