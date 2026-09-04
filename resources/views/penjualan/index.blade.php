@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')

@include('layouts.navbar')

<!-- Memanggil Bootstrap Icons via CDN -->
<link rel="stylesheet" href="https://jsdelivr.net">

<style>
    :root {
        --color-bg: #E4E0E1;
        --color-card: #FFFFFF;
        --color-primary: #493628;
        --color-border: #AB886D;
        --color-muted: #6B5B52;
    }

    body {
        background-color: var(--color-bg) !important;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        color: #333333;
    }

    /* Pembungkus Halaman Utama */
    .content-wrapper {
        padding: 2.5rem 15px;
        max-width: 1140px;
        margin: 0 auto;
    }

    /* Ruang Kepala (Header) & Hierarki Teks */
    .header-section {
        padding-left: 0.5rem;
        margin-bottom: 2rem;
    }

    .main-title {
        color: var(--color-primary);
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
    }

    .main-subtitle {
        color: var(--color-muted);
        font-size: 0.95rem;
        font-weight: 400;
    }

    /* Wadah Utama Konten (Card) */
    .table-card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
    }

    /* Gaya Kustom Kolom Input Pencarian */
    .form-control-custom {
        border: 1.5px solid var(--color-border);
        border-radius: 8px !important;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        background-color: #FAFAFA;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15) !important;
        background-color: #FFFFFF;
    }

    /* Desain Tombol Tambah & Tombol Cari */
    .btn-primary-custom {
        background-color: var(--color-primary) !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        transition: background-color 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-primary-custom:hover {
        background-color: #35271d !important;
    }

    .btn-search-custom {
        border: 1.5px solid var(--color-primary) !important;
        color: var(--color-primary) !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.6rem 1.25rem;
        transition: all 0.2s ease;
    }

    .btn-search-custom:hover {
        background-color: var(--color-primary) !important;
        color: #FFFFFF !important;
    }

    /* Penataan Tabel Aesthetic */
    .table-aesthetic {
        margin-bottom: 0;
    }

    .table-aesthetic thead th {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 0.75rem;
    }

    .table-aesthetic tbody td, 
    .table-aesthetic tbody th {
        padding: 0.85rem 0.75rem;
        font-size: 0.95rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        color: #495057;
    }

    /* Label Penanda Metode & Status */
    .badge-method {
        background-color: rgba(171, 136, 109, 0.15);
        color: var(--color-primary);
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .badge-status-completed {
        background-color: rgba(40, 167, 69, 0.12);
        color: #28a745;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    /* ==========================================================================
       PERBAIKAN CSS TOMBOL AKSI TABEL (BIRU, KUNING, MERAH SESUAI GAMBAR)
       ========================================================================== */
    .btn-action-custom {
        padding: 0.35rem 0.85rem !important;
        font-size: 0.85rem !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
        transition: opacity 0.2s ease;
    }

    .btn-action-custom:hover {
        opacity: 0.85;
        color: inherit;
    }

    /* Detail - Biru Cerah */
    .btn-action-detail {
        background-color: #2b9ebb !important;
        color: #FFFFFF !important;
    }

    /* Edit - Kuning Emas */
    .btn-action-edit {
        background-color: #ffc107 !important;
        color: #212529 !important;
    }

    /* Hapus - Merah Cerah */
    .btn-action-delete {
        background-color: #dc3545 !important;
        color: #FFFFFF !important;
    }
</style>

<div class="content-wrapper">

    <!-- Notifikasi Pesan Kesalahan Lama -->
    @if(session('errors'))
        <div class="alert alert-danger mb-4" style="border-radius: 8px;">
            <i class="bi bi-exclamation-triangle"></i> {{ session('errors') }}
        </div>
    @endif

    <!-- Bagian Kepala: Judul Terlokalisasi -->
    <div class="header-section text-start">
        <h1 class="main-title">Data Transaksi Penjualan</h1>
        <p class="main-subtitle">Pantau dan kelola riwayat seluruh transaksi masuk, metode pembayaran, serta status kasir</p>
    </div>

    <!-- Wadah Utama Konten -->
    <div class="table-card-custom">

        <!-- Baris Tombol Tambah Transaksi & Form Pencarian -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-4 text-start">
                <a href="{{ route('penjualan.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg"></i> Tambah Transaksi
                </a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('penjualan.index') }}" method="GET" class="row g-2 justify-content-end">
                    <div class="col-sm-8 col-md-7">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            class="form-control-custom w-100" 
                            placeholder="Cari transaksi penjualan..."
                        >
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <button class="btn btn-search-custom w-100" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Riwayat Penjualan -->
        <div class="table-responsive">
            <table class="table table-aesthetic align-middle text-start">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Tanggal Transaksi</th>
                        <th>Kasir Bertugas</th>
                        <th>Total Pembayaran</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th width="22%">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                    <tr>
                        <th>{{ $sales->firstItem() + $loop->index }}</th>
                        <td><i class="bi bi-clock text-muted"></i> {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td><strong>Rp {{ number_format($sale->total_pembayaran) }}</strong></td>
                        <td>
                            <span class="badge-method">{{ $sale->metode_pembayaran }}</span>
                        </td>
                        <td>
                            <span class="badge-status-completed"><i class="bi bi-check-circle"></i> {{ $sale->status }}</span>
                        </td>
                        <td>
                            <!-- PERBAIKAN: Penyesuaian class tombol aksi operasional tabel -->
                            <div class="d-flex align-items-center gap-1">
                                <a href="{{ route('penjualan.show', $sale->id) }}" class="btn-action-custom btn-action-detail">
                                    Detail
                                </a>
                                
                                <a href="{{ route('penjualan.edit', $sale->id) }}" class="btn-action-custom btn-action-edit">
                                    Edit
                                </a>

                                <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-custom btn-action-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data transaksi penjualan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Link -->
          {{ $sales->links() }}
@endsection