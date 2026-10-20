<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori Buku</title>
</head>
<body>
    <h1>Kategori Buku Perpustakaan</h1>

    @forelse ($categories as $category)
        <p>{{ $category->name }}</p>
    @empty
        <p>Belum ada kategori buku.</p>
    @endforelse
</body>
</html>