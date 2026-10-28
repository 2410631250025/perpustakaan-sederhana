<!-- resources/views/borrowings/create.blade.php -->
<form action="{{ route('borrowings.store') }}" method="POST">
    @csrf
    
    <div>
        <label>Pilih Anggota:</label>
        <select name="member_id" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Pilih Buku (Tahan tombol CTRL/CMD untuk pilih lebih dari satu):</label>

        <select name="book_ids[]" multiple required>
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Simpan Peminjaman</button>
</form>