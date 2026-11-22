@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <h2>Edit Data Anggota</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code">Kode Anggota:</label>
            <input type="text" id="code" name="code" value="{{ old('code', $member->code) }}" required>
        </div>
        <div class="mb-3">
            <label for="name">Nama Lengkap:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="phone">No. Telepon:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" required>
        </div>
        <div class="mb-3">
            <label for="address">Alamat:</label>
            <textarea id="address" name="address" rows="3" required>{{ old('address', $member->address) }}</textarea>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection