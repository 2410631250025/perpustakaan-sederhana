<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Anggota</title>
</head>
<body>
    <h1>Detail Anggota</h1>
    <p><strong>Kode:</strong> {{ $member->code }}</p>
    <p><strong>Nama:</strong> {{ $member->name }}</p>
    <p><strong>Email:</strong> {{ $member->email }}</p>
    <p><strong>Telepon:</strong> {{ $member->phone }}</p>
    <p><strong>Alamat:</strong> {{ $member->address }}</p>
    
    <a href="{{ route('members.index') }}">Kembali</a>
</body>
</html>