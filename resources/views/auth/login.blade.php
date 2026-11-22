@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    /* Membuat container putih khusus halaman login lebih ramping dan pas di tengah */
    .container {
        max-width: 440px !important;
        margin: 16px auto !important;
        padding: 36px 32px !important;
    }

    .login-header {
        text-align: center;
        margin-bottom: 26px;
    }

    .login-icon {
        width: 58px;
        height: 58px;
        background-color: var(--pastel-pink);
        border: 2px solid var(--pastel-pink-border);
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 14px;
        box-shadow: 0 4px 12px rgba(255, 206, 216, 0.45);
    }

    .login-header h2 {
        display: block !important;
        width: 100% !important;
        border-bottom: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 6px !important;
        font-size: 22px !important;
    }

    .login-header p {
        color: var(--text-muted);
        font-size: 13.5px;
    }

    .btn-login-submit {
        width: 100%;
        padding: 12px 18px !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        margin-top: 8px;
        border-radius: 10px !important;
    }
</style>

<div class="login-header">
    <div class="login-icon">📚</div>
    <h2>Selamat Datang!</h2>
    <p>Silakan masuk ke Sistem Informasi Perpustakaan</p>
</div>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin: 0; padding-left: 18px;">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda...">
    </div>

    <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Masukkan password...">
    </div>

    <button type="submit" class="btn btn-pink btn-login-submit">Masuk ke Sistem</button>
</form>
@endsection