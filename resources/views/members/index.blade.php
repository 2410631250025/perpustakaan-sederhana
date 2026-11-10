<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Anggota</title>
</head>
<body>
    <h1>Daftar Anggota Perpustakaan</h1>
    
    <!-- Tombol Kembali ke Dashboard -->
    <a href="{{ route('dashboard') }}" style="display: inline-block; margin-bottom: 15px; padding: 8px 12px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">&larr; Kembali ke Dashboard</a>
    <br>
    
    <a href="{{ route('members.create') }}">Tambah Anggota Baru</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td>{{ $member->code }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}">Detail</a> |
                        <a href="{{ route('members.edit', $member->id) }}">Edit</a> |
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>