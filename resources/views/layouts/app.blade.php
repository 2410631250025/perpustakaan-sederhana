<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Informasi Perpustakaan Sederhana</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --pastel-pink: #FFCED8;
            --pastel-pink-hover: #F7B8C6;
            --pastel-pink-border: #F3B0BF;
            --soft-blush: #FFDDDD;
            --warm-cream: #FFF4DE;
            --peach-cream: #FFE8C4;
            --peach-cream-hover: #FAD8A5;
            --peach-cream-border: #F2D2A2;
            --text-dark: #4A353B;
            --text-muted: #7D636A;
            --white: #FFFFFF;
            --danger: #E06C75;
            --danger-hover: #C95861;
            --neutral: #F3ECEE;
            --neutral-hover: #E5D9DC;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--warm-cream);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ================= NAVBAR ================= */
        nav {
            background-color: var(--pastel-pink);
            padding: 14px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            box-shadow: 0 4px 14px rgba(74, 53, 59, 0.08);
            border-bottom: 2px solid var(--soft-blush);
        }

        .nav-brand {
            font-size: 17px;
            font-weight: 800;
            color: var(--text-dark);
            text-decoration: none;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 14px;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-links a:hover {
            background-color: var(--warm-cream);
            transform: translateY(-1px);
        }

        .nav-right form {
            margin: 0;
        }

        .nav-right button[type="submit"] {
            background-color: var(--text-dark);
            color: var(--warm-cream);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin: 0;
            transition: all 0.2s ease;
        }

        .nav-right button[type="submit"]:hover {
            background-color: #2D1E22;
            box-shadow: 0 4px 10px rgba(74, 53, 59, 0.2);
        }

        /* ================= MAIN CONTAINER ================= */
        main {
            flex: 1;
            width: 100%;
            max-width: 1140px;
            margin: 36px auto;
            padding: 0 24px;
        }

        .container {
            background-color: var(--white);
            padding: 32px 36px;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(74, 53, 59, 0.06);
            border: 2px solid var(--soft-blush);
        }

        h1, h2, h3 {
            color: var(--text-dark);
            font-weight: 700;
        }

        .container > h1:first-child,
        .container > h2:first-child {
            display: block;
            width: fit-content;
            font-size: 23px;
            margin-bottom: 20px;
            border-bottom: 3px solid var(--pastel-pink);
            padding-bottom: 8px;
        }

        /* ================= KARTU STATISTIK DASHBOARD ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(74, 53, 59, 0.04);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card.pink {
            background-color: var(--pastel-pink);
            border: 1.5px solid var(--pastel-pink-border);
        }

        .stat-card.cream {
            background-color: var(--peach-cream);
            border: 1.5px solid var(--peach-cream-border);
        }

        .stat-card h3 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .stat-card .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
        }

        /* ================= TOMBOL SERAGAM DI SEMUA HALAMAN ================= */
        .btn,
        button:not(.nav-right button),
        input[type="submit"],
        a[href*="create"],
        a[href*="edit"],
        a[href*="show"],
        td a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            line-height: 1.2;
            transition: all 0.2s ease;
            vertical-align: middle;
        }

        .container > a[href*="create"] {
            margin-bottom: 16px;
            margin-right: 8px;
        }

        /* Varian Pink (Utama / Tambah / Simpan) */
        .btn-pink,
        .btn-primary,
        a[href*="create"],
        button[type="submit"]:not(.nav-right button):not(.btn-danger):not(.btn-cream):not(td button) {
            background-color: var(--pastel-pink);
            color: var(--text-dark);
            border: 1.5px solid var(--pastel-pink-border);
        }

        .btn-pink:hover,
        .btn-primary:hover,
        a[href*="create"]:hover,
        button[type="submit"]:not(.nav-right button):not(.btn-danger):not(.btn-cream):not(td button):hover {
            background-color: var(--pastel-pink-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(255, 206, 216, 0.55);
        }

        /* Varian Cream (Sekunder / Edit / Update) */
        .btn-cream,
        .btn-success,
        a[href*="edit"] {
            background-color: var(--peach-cream);
            color: var(--text-dark);
            border: 1.5px solid var(--peach-cream-border);
        }

        .btn-cream:hover,
        .btn-success:hover,
        a[href*="edit"]:hover {
            background-color: var(--peach-cream-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(255, 232, 196, 0.65);
        }

        /* Varian Blush (Detail / Info) */
        .btn-info,
        a[href*="show"] {
            background-color: var(--soft-blush);
            color: var(--text-dark);
            border: 1.5px solid var(--pastel-pink-border);
        }

        .btn-info:hover,
        a[href*="show"]:hover {
            background-color: var(--pastel-pink);
            transform: translateY(-1px);
        }

        /* Varian Netral (Kembali / Batal) */
        .btn-secondary,
        a[href*="index"]:not(.nav-links a):not(.btn-pink):not(.btn-cream),
        a[href*="dashboard"]:not(.nav-links a):not(.nav-brand) {
            background-color: var(--neutral);
            color: var(--text-dark);
            border: 1.5px solid #DFD2D5;
        }

        .btn-secondary:hover,
        a[href*="index"]:not(.nav-links a):not(.btn-pink):not(.btn-cream):hover,
        a[href*="dashboard"]:not(.nav-links a):not(.nav-brand):hover {
            background-color: var(--neutral-hover);
            transform: translateY(-1px);
        }

        /* Varian Hapus (Danger) */
        .btn-danger,
        td form button[type="submit"] {
            background-color: var(--danger) !important;
            color: var(--white) !important;
            border: 1.5px solid #C95861 !important;
        }

        .btn-danger:hover,
        td form button[type="submit"]:hover {
            background-color: var(--danger-hover) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(224, 108, 117, 0.35);
        }

        /* Ukuran & susunan sejajar khusus untuk tombol aksi di dalam tabel */
        .btn-sm, td a, td button {
            padding: 6px 12px !important;
            font-size: 12.5px !important;
            border-radius: 7px !important;
            margin: 0 !important;
        }

        td:last-child {
            white-space: nowrap;
        }

        td:last-child a,
        td:last-child form {
            display: inline-flex !important;
            vertical-align: middle;
            margin-right: 4px !important;
            margin-bottom: 0 !important;
        }

        /* ================= TABEL ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            border: 1.5px solid var(--soft-blush);
        }

        thead {
            background-color: var(--pastel-pink);
        }

        th {
            padding: 13px 16px;
            text-align: left;
            font-weight: 700;
            color: var(--text-dark);
            font-size: 13.5px;
            border-bottom: 2px solid var(--pastel-pink-border);
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--soft-blush);
            font-size: 13.5px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #FFFDF9;
        }

        tbody tr:hover {
            background-color: var(--warm-cream);
        }

        td ul {
            margin: 0;
            padding-left: 18px;
        }

        /* ================= FORM & INPUT ================= */
        form div, .mb-3 {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
            color: var(--text-dark);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--pastel-pink-border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text-dark);
            background-color: #FFFDFB;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--text-dark);
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(255, 206, 216, 0.45);
        }

        /* ================= ALERTS ================= */
        .alert {
            padding: 13px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #E6F4EA;
            color: #1E4620;
            border: 1px solid #CEEAD6;
        }

        .alert-danger {
            background-color: var(--soft-blush);
            color: #7A2029;
            border: 1px solid var(--pastel-pink-border);
        }

        /* ================= FOOTER ================= */
        footer {
            background-color: var(--pastel-pink);
            color: var(--text-dark);
            text-align: center;
            padding: 16px 24px;
            font-size: 13.5px;
            font-weight: 600;
            border-top: 2px solid var(--soft-blush);
            margin-top: auto;
        }

        /* ================= PAGINATION ================= */
        .mt-3 nav {
            background: transparent;
            box-shadow: none;
            border: none;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="nav-brand">
            📚 Sistem Informasi Perpustakaan Sederhana
        </a>

        @auth
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('books.index') }}">Buku</a>
                <a href="{{ route('categories.index') }}">Kategori</a>
                <a href="{{ route('members.index') }}">Anggota</a>
                <a href="{{ route('borrowings.index') }}">Data Peminjaman</a>

                @can('isAdmin')
                    <a href="{{ route('users.index') }}">Manajemen User</a>
                @endcan
            </div>

            <div class="nav-right">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin ingin logout?')">
                        Logout ({{ auth()->user()->name }})
                    </button>
                </form>
            </div>
        @endauth

        @guest
            <div class="nav-links">
                <a href="{{ route('login') }}">Login</a>
            </div>
        @endguest
    </nav>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <div>&copy; {{ date('Y') }} <strong>Sistem Informasi Perpustakaan Sederhana</strong>. All Rights Reserved.</div>
        <div style="font-size: 12px; font-weight: 500; color: var(--text-muted); margin-top: 4px;">
            Dikembangkan oleh Kelompok 2 &bull; Project UAS Pemrograman Web Framework
        </div>
    </footer>
</body>
</html>