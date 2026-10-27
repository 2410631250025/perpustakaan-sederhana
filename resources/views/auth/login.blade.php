@extends('layouts.app')

@section('title', 'Login Perpustakaan')

@section('content')
    <h2>Login Sistem Perpustakaan</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <br>
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
@endsection