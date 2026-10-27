@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('users.create') }}">+ Tambah User Baru</a>

    <ul>
        @foreach($users as $user)
            <li>
                <h3>{{ $user->name }}</h3>    
                <p>Email: {{ $user->email }}</p>    
                <p>Role: {{ strtoupper($user->role) }}</p>

                <a href="{{ route('users.edit', $user) }}">
                    <button type="button">Edit</button>
                </a>  

                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')">
                        Hapus
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection