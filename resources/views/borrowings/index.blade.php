@extends('layouts.app') {{-- Sesuaikan dengan layout utama project kalian --}}

@section('content')
<div class="container">
    <h2>Daftar Peminjaman Buku</h2>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary mb-3">+ Catat Peminjaman Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Buku Yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat (Due Date)</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $index => $borrowing)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $borrowing->member->nama ?? '-' }}</td>
                <td>
                    <ul>
                        @foreach($borrowing->details as $detail)
                            <li>{{ $detail->book->judul ?? '-' }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $borrowing->borrow_date }}</td>
                <td>{{ $borrowing->due_date }}</td>
                <td>
                    <span class="badge bg-{{ $borrowing->status == 'dipinjam' ? 'warning' : 'success' }}">
                        {{ ucfirst($borrowing->status) }}
                    </span>
                </td>
                <td>
                    @if($borrowing->status == 'dipinjam')
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
                <td colspan="7" class="text-center">Belum ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection