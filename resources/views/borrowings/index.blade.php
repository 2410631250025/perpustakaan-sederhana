<!-- resources/views/borrowings/index.blade.php -->
<table>
    <thead>
        <tr>
            <th>Tanggal Pinjam</th>
            <th>Tenggat Waktu (Due Date)</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrowings as $borrowing)
        <tr>
            <td>{{ $borrowing->borrow_date }}</td>
            <td>{{ $borrowing->due_date }}</td>
            <td>{{ $borrowing->status }}</td>
            <td>
                <!-- Tombol Pengembalian hanya muncul jika status masih dipinjam -->
                @if($borrowing->status == 'borrowed')
                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Wajib pakai PUT sesuai route yang kita buat -->
                    <button type="submit">Kembalikan Buku</button>
                </form>
                @else
                    Sudah Dikembalikan ({{ $borrowing->return_date }})
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>