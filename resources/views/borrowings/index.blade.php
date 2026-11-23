@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Peminjaman Buku</h2>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary mb-3">+ Catat Peminjaman Baru</a>
    <a href="{{ route('borrowings.exportPdf') }}" class="btn btn-danger mb-3">Export PDF</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered" border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Buku Yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat (Due Date)</th>
                <th>Status</th>
                <th>Petugas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $index => $borrowing)
            <tr>
                <td>{{ $borrowings->firstItem() + $index }}</td>
                <td>{{ $borrowing->member->name ?? '-' }}</td>
                <td>
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach($borrowing->details as $detail)
                            <li>{{ $detail->book->title ?? '-' }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $borrowing->borrow_date }}</td>
                <td>{{ $borrowing->due_date }}</td>
                <td>
                    <span>{{ $borrowing->status }}</span>
                </td>
                <td>{{ $borrowing->user->name ?? '-' }}</td>
                <td>
                    @if($borrowing->status == 'Dipinjam')
                        <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Proses pengembalian buku ini?')">Kembalikan</button>
                        </form>
                    @else
                        <span class="text-muted">Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $borrowings->links() }}
    </div>
</div>
@endsection