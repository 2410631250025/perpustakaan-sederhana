<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Peminjaman Perpustakaan</h2>
    <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }} WIB</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Buku yang Dipinjam</th>
                <th>Tgl Pinjam</th>
                <th>Tenggat</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->member->name ?? '-' }}</td>
                <td>
                    <ul style="margin: 0; padding-left: 15px;">
                        @foreach($item->details as $detail)
                            <li>{{ $detail->book->title ?? 'Buku dihapus' }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $item->borrow_date }}</td>
                <td>{{ $item->due_date }}</td>
                <td>{{ $item->return_date ?? '-' }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>