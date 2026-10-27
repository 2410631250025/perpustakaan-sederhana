@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard Perpustakaan</h2>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
            <h3>Total Judul Buku</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalBuku }}</p>
        </div>

        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
            <h3>Total Stok Buku</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalStok }}</p>
        </div>

        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
            <h3>Total Anggota</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalMember }}</p>
        </div>

        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
            <h3>Sedang Dipinjam</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalDipinjam }}</p>
        </div>
    </div>
@endsection