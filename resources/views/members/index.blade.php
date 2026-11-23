@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <h2>Daftar Anggota Perpustakaan</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 18px;">
        <a href="{{ route('members.create') }}" class="btn btn-primary">+ Tambah Anggota Baru</a>

        {{-- Form Pencarian Anggota --}}
        <form action="{{ route('members.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin: 0;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode, nama, atau email..." style="width: 250px; margin: 0;">

            <button type="submit" class="btn btn-cream">Cari</button>

            @if(request('search'))
                <a href="{{ route('members.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td><strong>{{ $member->code }}</strong></td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-cream btn-sm">Edit</a>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 24px;">
                        Tidak ada data anggota yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Navigasi Pagination --}}
    @if($members->hasPages())
        <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <span style="font-size: 13px; color: var(--text-muted);">
                Menampilkan {{ $members->firstItem() }} - {{ $members->lastItem() }} dari {{ $members->total() }} anggota
            </span>
            <div>
                {{ $members->links() }}
            </div>
        </div>
    @endif
@endsection