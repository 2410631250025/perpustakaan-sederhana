@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Peminjaman Buku</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="member_id" class="form-label">Pilih Anggota</label>
            <select name="member_id" id="member_id" class="form-control" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="borrow_date" class="form-label">Tanggal Peminjaman</label>
            <input type="date" name="borrow_date" id="borrow_date" class="form-control" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Tanggal Tenggat Pengembalian</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}" required>
        </div>

        <hr>
        <label class="form-label">
            <strong>Pilih Buku yang Dipinjam</strong>
            <small class="text-muted">(Maksimal 3 buku)</small>
        </label>
        
        <div id="book-container">
            <div class="book-row mb-2" style="display: flex; gap: 10px;">
                <select name="book_ids[]" class="form-control" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" id="add-book-btn" class="btn btn-info btn-sm mb-3">+ Tambah Buku Lain</button>
        <small id="limit-warning" class="text-danger ms-2" style="display: none;">Maksimal 3 buku per peminjaman.</small>
        <br>

        <button type="submit" class="btn btn-success">Simpan Peminjaman</button>
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    const MAX_BOOKS = 3;
    const container = document.getElementById('book-container');
    const addBtn = document.getElementById('add-book-btn');
    const limitWarning = document.getElementById('limit-warning');

    function updateAddButtonState() {
        const currentCount = container.querySelectorAll('.book-row').length;
        if (currentCount >= MAX_BOOKS) {
            addBtn.disabled = true;
            limitWarning.style.display = 'inline';
        } else {
            addBtn.disabled = false;
            limitWarning.style.display = 'none';
        }
    }

    addBtn.addEventListener('click', function() {
        const currentCount = container.querySelectorAll('.book-row').length;
        if (currentCount >= MAX_BOOKS) return;

        const firstRow = container.querySelector('.book-row');
        const newRow = firstRow.cloneNode(true);
        
        // Reset pilihan dropdown pada baris baru
        newRow.querySelector('select').value = '';
        
        // Tambahkan tombol Hapus pada baris tambahan
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-danger btn-sm';
        removeBtn.innerText = 'Hapus';
        removeBtn.onclick = function() {
            newRow.remove();
            updateAddButtonState();
        };
        
        newRow.appendChild(removeBtn);
        container.appendChild(newRow);
        updateAddButtonState();
    });
</script>
@endsection