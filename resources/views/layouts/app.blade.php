<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Sistem Perpustakaan</title>
</head>
<body>
    <nav>
        <a href="/books">Buku</a> | 
        <a href="/categories">Kategori</a> | 
        <a href="/members">Anggota</a>
    </nav>
    <hr>
    <main>@yield('content')</main>
</body>
</html>