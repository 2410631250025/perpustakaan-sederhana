@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
    <h2>Detail Anggota</h2>

    <div style="background-color: #FFFDF9; padding: 24px; border-radius: 12px; border: 1px solid var(--soft-blush); margin-bottom: 20px; line-height: 2;">
        <p><strong>Kode Anggota:</strong> {{ $member->code }}</p>
        <p><strong>Nama Lengkap:</strong> {{ $member->name }}</p>
        <p><strong>Email:</strong> {{ $member->email }}</p>
        <p><strong>No. Telepon:</strong> {{ $member->phone }}</p>
        <p><strong>Alamat:</strong> {{ $member->address }}</p>
    </div>

    <div style="display: flex; gap: 10px;">
        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-success">Edit Data</a>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">&larr; Kembali</a>
    </div>
@endsection