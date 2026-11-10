@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Kategori Buku</h2>
    
    @can('isAdmin')
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori Baru</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                @can('isAdmin')
                    <th>Aksi</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    @can('isAdmin')
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <!-- Sesuaikan colspan, jika Admin (3 kolom), Petugas (2 kolom) -->
                    @can('isAdmin')
                        <td colspan="3" class="text-center">Belum ada data kategori.</td>
                    @else
                        <td colspan="2" class="text-center">Belum ada data kategori.</td>
                    @endcan
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection