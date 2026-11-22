@extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
    <h2>Dashboard Utama</h2>
    <p style="margin-bottom: 24px; color: var(--text-muted); font-size: 15px;">
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>!
    </p>

    {{-- Pola Warna Konsisten: Pink - Cream - Pink - Cream --}}
    <div class="stats-grid">
        <div class="stat-card pink">
            <h3>Jumlah Judul Buku</h3>
            <p class="stat-number">{{ $totalBookTitles }}</p>
        </div>

        <div class="stat-card cream">
            <h3>Total Stok Buku</h3>
            <p class="stat-number">{{ $totalBookStock }}</p>
        </div>

        <div class="stat-card pink">
            <h3>Jumlah Anggota</h3>
            <p class="stat-number">{{ $totalMembers }}</p>
        </div>

        <div class="stat-card cream">
            <h3>Sedang Dipinjam</h3>
            <p class="stat-number">{{ $totalBorrowed }}</p>
        </div>
    </div>

    <div style="background-color: #FFFDF9; padding: 22px; border-radius: 14px; border: 1.5px solid var(--soft-blush);">
        <h3 style="font-size: 16px; margin-bottom: 14px;">Akses Cepat Menu:</h3>
        {{-- Pola Tombol Konsisten: Pink - Cream - Pink - Cream --}}
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <a href="{{ route('books.index') }}" class="btn btn-pink">Kelola Buku</a>
            <a href="{{ route('categories.index') }}" class="btn btn-cream">Kelola Kategori</a>
            <a href="{{ route('members.index') }}" class="btn btn-pink">Kelola Anggota</a>
            <a href="{{ route('borrowings.index') }}" class="btn btn-cream">Data Peminjaman</a>
        </div>
    </div>
@endsection