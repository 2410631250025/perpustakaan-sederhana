@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
    <h2>Tambah User Baru</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <br>
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <br>
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <div>
            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="petugas">Petugas</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <br>
        <button type="submit">Simpan</button>
        <a href="{{ route('users.index') }}">Batal</a>
    </form>
@endsection