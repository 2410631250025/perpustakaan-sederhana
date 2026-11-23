@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h2>Daftar Buku</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 18px;">
        <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku Baru</a>

        {{-- Form Pencarian & Filter Kategori --}}
        <form action="{{ route('books.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin: 0;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku / penulis..." style="width: 230px; margin: 0;">

            <select name="category_id" style="width: 185px; margin: 0;">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-cream">Cari / Filter</button>

            @if(request('search') || request('category_id'))
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $index => $book)
                <tr>
                    <td>{{ $books->firstItem() + $index }}</td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->category->name ?? 'Tanpa Kategori' }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-cream btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger btn-sm" onclick="return confirm('Yakin hapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 24px;">
                        Tidak ada data buku yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Navigasi Pagination --}}
    @if($books->hasPages())
        <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <span style="font-size: 13px; color: var(--text-muted);">
                Menampilkan {{ $books->firstItem() }} - {{ $books->lastItem() }} dari {{ $books->total() }} buku
            </span>
            <div>
                {{ $books->links() }}
            </div>
        </div>
    @endif
@endsection