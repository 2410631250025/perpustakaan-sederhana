<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Perpustakaan</title>
</head>
<body>
    <h1>Dashboard Utama</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
            <h3>Jumlah Judul Buku</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalBookTitles }}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
            <h3>Total Stok Buku</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalBookStock }}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
            <h3>Jumlah Anggota</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalMembers }}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
            <h3>Sedang Dipinjam</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $totalBorrowed }}</p>
        </div>
    </div>

    <br><br>
    <h3>Menu Navigasi:</h3>
    <ul>
        <li><a href="{{ route('books.index') }}">Kelola Buku</a></li>
        <li><a href="{{ route('categories.index') }}">Kelola Kategori</a></li>
        <li><a href="{{ route('members.index') }}">Kelola Anggota</a></li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>