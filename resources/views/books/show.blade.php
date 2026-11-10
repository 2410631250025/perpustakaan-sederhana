@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Buku</h2>
    <div class="card">
        <div class="card-body">
            <h4>{{ $book->title }}</h4>
            <p><strong>Kategori:</strong> {{ $book->category->name ?? '-' }}</p>
            <p><strong>Stok Tersedia:</strong> {{ $book->stock }} pcs</p>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection