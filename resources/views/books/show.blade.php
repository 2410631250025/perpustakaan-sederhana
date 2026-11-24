@extends('layouts.app')

@section('content')
<style>
    .book-detail-wrapper {
        max-width: 920px;
        margin: 24px auto;
        padding: 0 15px;
    }

    .book-detail-card {
        display: flex;
        flex-direction: row;
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1e4e8;
    }

    /* Panel Kiri: Area Cover (Pink Pastel) */
    .book-cover-panel {
        width: 35%;
        min-width: 260px;
        background: linear-gradient(180deg, #f4a7bd 0%, #de7b99 100%);
        padding: 36px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #ffffff;
    }

    .book-cover-img {
        width: 190px;
        height: 270px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid rgba(255, 255, 255, 0.35);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.18);
        margin-bottom: 16px;
    }

    .book-cover-placeholder {
        width: 190px;
        height: 270px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        border: 2px dashed rgba(255, 255, 255, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.85);
    }

    .book-cover-caption {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
    }

    /* Panel Kanan: Area Informasi */
    .book-info-panel {
        flex: 1;
        padding: 36px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .book-page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
    }

    .book-page-subtitle {
        font-size: 13px;
        color: #64748b;
        margin: 0 0 24px 0;
    }

    .book-title {
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
    }

    .book-author {
        font-size: 14px;
        color: #64748b;
        margin: 0 0 24px 0;
    }

    /* Grid 4 Kotak Informasi */
    .book-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }

    .book-info-box {
        background: #fff9fb;
        border: 1px solid #f5dce4;
        border-radius: 12px;
        padding: 14px 16px;
    }

    .book-info-label {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 8px;
        display: block;
    }

    .book-info-value {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }

    .book-badge {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
    }

    .badge-category {
        background-color: #fce7f3;
        color: #be185d;
    }

    .badge-available {
        background-color: #dcfce7;
        color: #15803d;
    }

    .badge-empty {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    /* Tombol Aksi */
    .book-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn-back-custom {
        padding: 10px 22px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-back-custom:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .btn-edit-custom {
        padding: 10px 22px;
        border-radius: 8px;
        background: #eab308;
        color: #ffffff;
        border: none;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-edit-custom:hover {
        background: #ca8a04;
        color: #ffffff;
    }

    /* Responsif untuk layar HP */
    @media (max-width: 768px) {
        .book-detail-card {
            flex-direction: column;
        }
        .book-cover-panel {
            width: 100%;
        }
        .book-info-panel {
            padding: 24px;
        }
        .book-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="book-detail-wrapper">
    <div class="book-detail-card">
        <!-- Bagian Kiri: Cover Buku -->
        <div class="book-cover-panel">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->title }}" class="book-cover-img">
            @else
                <div class="book-cover-placeholder">
                    <span>Tidak ada cover</span>
                </div>
            @endif
            <p class="book-cover-caption">Sistem Informasi Perpustakaan</p>
        </div>

        <!-- Bagian Kanan: Detail Informasi Buku -->
        <div class="book-info-panel">
            <h2 class="book-page-title">Detail Buku</h2>
            <p class="book-page-subtitle">Informasi lengkap mengenai koleksi buku perpustakaan.</p>

            <h3 class="book-title">{{ $book->title }}</h3>
            <p class="book-author">
                Ditulis oleh {{ $book->author && $book->author !== '-' ? $book->author : 'Penulis tidak diketahui' }}
            </p>

            <!-- 4 Kotak Informasi -->
            <div class="book-info-grid">
                <div class="book-info-box">
                    <span class="book-info-label">Kategori</span>
                    <span class="book-badge badge-category">
                        {{ $book->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </div>

                <div class="book-info-box">
                    <span class="book-info-label">Tahun Terbit</span>
                    <div class="book-info-value">{{ $book->year ?? '-' }}</div>
                </div>

                <div class="book-info-box">
                    <span class="book-info-label">Stok Buku</span>
                    <div class="book-info-value">{{ $book->stock }} pcs</div>
                </div>

                <div class="book-info-box">
                    <span class="book-info-label">Status Ketersediaan</span>
                    @if($book->stock > 0)
                        <span class="book-badge badge-available">Tersedia</span>
                    @else
                        <span class="book-badge badge-empty">Stok Habis</span>
                    @endif
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="book-actions">
                <a href="{{ route('books.index') }}" class="btn-back-custom">Kembali</a>
                <a href="{{ route('books.edit', $book->id) }}" class="btn-edit-custom">Edit Buku</a>
            </div>
        </div>
    </div>
</div>
@endsection