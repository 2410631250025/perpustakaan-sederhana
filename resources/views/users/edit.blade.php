@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <h2>Edit User</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <br>
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <br>
        <div>
            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <br>
        <button type="submit">Update</button>
        <a href="{{ route('users.index') }}">Batal</a>
    </form>
@endsection