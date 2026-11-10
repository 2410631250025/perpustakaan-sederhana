<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Anggota</title>
</head>
<body>
    <h1>Tambah Anggota Baru</h1>
    
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div>
            <label>Kode Anggota:</label><br>
            <input type="text" name="code" value="{{ old('code') }}" required>
        </div>
        <div>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>No. Telepon:</label><br>
            <input type="text" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div>
            <label>Alamat:</label><br>
            <textarea name="address" required>{{ old('address') }}</textarea>
        </div>
        <br>
        <button type="submit">Simpan</button>
        <a href="{{ route('members.index') }}">Batal</a>
    </form>
</body>
</html>