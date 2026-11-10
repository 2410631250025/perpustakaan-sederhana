<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Anggota</title>
</head>
<body>
    <h1>Edit Data Anggota</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Kode Anggota:</label><br>
            <input type="text" name="code" value="{{ old('code', $member->code) }}" required>
        </div>
        <div>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="name" value="{{ old('name', $member->name) }}" required>
        </div>
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email', $member->email) }}" required>
        </div>
        <div>
            <label>No. Telepon:</label><br>
            <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" required>
        </div>
        <div>
            <label>Alamat:</label><br>
            <textarea name="address" required>{{ old('address', $member->address) }}</textarea>
        </div>
        <br>
        <button type="submit">Update</button>
        <a href="{{ route('members.index') }}">Batal</a>
    </form>
</body>
</html>