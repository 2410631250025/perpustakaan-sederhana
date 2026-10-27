<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Sistem Perpustakaan</title>
</head>
<body>
    <nav>
        {{-- Hanya tampil jika pengguna SUDAH LOGIN --}}
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a> |
            <a href="{{ route('books.index') }}">Buku</a> |
            <a href="{{ route('categories.index') }}">Kategori</a> |
            <a href="{{ route('members.index') }}">Anggota</a> |

            {{-- Pembatasan Hak Akses: Menu ini HANYA TAMPIL untuk Admin --}}
            @can('isAdmin')
                <a href="{{ route('users.index') }}">Manajemen User</a> |
            @endcan

            {{-- Tombol Logout --}}
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" onclick="return confirm('Yakin ingin logout?')">Logout ({{ auth()->user()->name }})</button>
            </form>
        @endauth

        {{-- Tampil jika pengguna BELUM LOGIN --}}
        @guest
            <a href="{{ route('login') }}">Login</a>
        @endguest
    </nav>
    <hr>
    <main>@yield('content')</main>
</body>
</html>