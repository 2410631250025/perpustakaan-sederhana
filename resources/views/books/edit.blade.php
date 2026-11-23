@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Buku</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $book->title) }}" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok Buku</label>
            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $book->stock) }}" min="0" required>
            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Cover Buku (Opsional)</label>
            
            @if($book->cover)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->title }}" style="width: 80px; height: 110px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd;">
                    <div class="form-text text-muted">Cover saat ini. Kosongkan input di bawah jika tidak ingin mengubah cover.</div>
                </div>
            @endif

            <input type="file" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
            <div class="form-text">Format: JPG, PNG, GIF, WEBP. Maksimal 2MB.</div>
            @error('cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection