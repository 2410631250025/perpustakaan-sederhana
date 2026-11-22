@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <h2>Tambah Anggota Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code">Kode Anggota:</label>
            <input type="text" id="code" name="code" value="{{ old('code') }}" required placeholder="Contoh: AGT-001">
        </div>
        <div class="mb-3">
            <label for="name">Nama Lengkap:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap...">
        </div>
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="contoh@email.com">
        </div>
        <div class="mb-3">
            <label for="phone">No. Telepon:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx">
        </div>
        <div class="mb-3">
            <label for="address">Alamat:</label>
            <textarea id="address" name="address" rows="3" required placeholder="Masukkan alamat lengkap...">{{ old('address') }}</textarea>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection