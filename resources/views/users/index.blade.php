@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
    <h2>Manajemen User</h2>

    <div style="margin-bottom: 16px;">
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; background-color: {{ $user->role === 'admin' ? 'var(--pastel-pink)' : 'var(--peach-cream)' }};">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-cream btn-sm">Edit</a>
                        @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 24px;">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection