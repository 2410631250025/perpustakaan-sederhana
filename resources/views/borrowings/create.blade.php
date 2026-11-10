@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Peminjaman Buku</h2>

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="member_id" class="form-label">Pilih Anggota</label>
            <select name="member_id" id="member_id" class="form-control" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id" class="form-label">Pilih Buku (Stok Tersedia)</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->judul }} (Stok: {{ $book->stok }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Tanggal Tenggat Pengembalian</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Peminjaman</button>
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection