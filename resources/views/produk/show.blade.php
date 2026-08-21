@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="navbar-container-fix">
    @include('layouts.navbar')
</div>

<!-- Memanggil Bootstrap Icons untuk indikator visual -->
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

    .navbar-container-fix .container-fluid, 
    .navbar-container-fix .container {
        max-width: 1140px !important;
        margin: 0 auto !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    /* Pembungkus Konten Utama */
    .content-wrapper {
        padding: 2.5rem 15px;
        max-width: 1140px;
        margin: 0 auto;
    }

    /* Ruang Kepala (Header) & Hierarki Teks */
    .header-section {
        padding-left: 0.5rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
    .card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
        overflow: hidden;
    }

    /* Header internal dalam card */
    .card-header-custom {
        background-color: #FAFAFA !important;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 1.25rem 1.5rem;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .card-body-custom {
        padding: 2rem 1.5rem;
    }

    /* Thumbnail Bingkai Gambar Produk */
    .product-img-large {
        border: 1px solid var(--color-border);
        border-radius: 12px;
        object-fit: cover;
        padding: 6px;
        background-color: #FAFAFA;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
    }

    /* Penataan Tabel Spesifikasi */
    .table-aesthetic {
        margin-bottom: 0;
        width: 100%;
    }

    .table-aesthetic tr th {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.9rem 1rem;
        border-bottom: 1px solid #F0F0F0;
        vertical-align: middle;
    }

    .table-aesthetic tr td {
        padding: 0.9rem 1rem;
        font-size: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        color: #495057;
    }

    /* Label Penanda Stok */
    .badge-stock-success {
        background-color: rgba(40, 167, 69, 0.12);
        color: #28a745;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .badge-stock-danger {
        background-color: rgba(220, 53, 69, 0.12);
        color: #dc3545;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* Desain Tombol Kembali */
    .btn-back-custom {
        background-color: transparent !important;
        border: 1.5px solid var(--color-border) !important;
        color: var(--color-primary) !important;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-back-custom:hover {
        background-color: rgba(171, 136, 109, 0.1) !important;
        color: var(--color-primary) !important;
    }
</style>

<div class="content-wrapper">

    <!-- Bagian Kepala: Judul Utama & Tombol Kembali Sejajar -->
    <div class="header-section text-start">
        <div>
            <h1 class="main-title">Detail Informasi Produk</h1>
            <p class="main-subtitle">Periksa informasi spesifikasi, harga riil, dan ketersediaan stok produk terpilih</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-back-custom">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Wadah Utama Konten -->
    <div class="card-custom text-start">
        <div class="card-header-custom">
            <i class="bi bi-info-circle"></i> Data Identitas Produk: {{ $produk->nama }}
        </div>
        
        <div class="card-body-custom">
            <div class="row align-items-center">
                <!-- Bagian Kiri: Visualisasi Foto Produk -->
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    @if(!empty($produk->foto))
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="img-fluid product-img-large" style="max-height: 280px; width: 100%; object-fit: contain;">
                    @else
                        <div class="bg-light d-flex flex-column align-items-center justify-content-center rounded-3" style="height: 250px; border: 1.5px dashed var(--color-border);">
                            <i class="bi bi-image text-muted fs-1 mb-2"></i>
                            <span class="text-muted" style="font-size: 0.95rem;">Foto produk belum diunggah</span>
                        </div>
                    @endif
                </div>

                <!-- Bagian Kanan: Spesifikasi Data Ringkas -->
                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table-aesthetic">
                            <tr>
                                <th width="35%">Nama Produk</th>
                                <td><strong>{{ $produk->nama }}</strong></td>
                            </tr>
                            <tr>
                                <th>Harga Beli Toko</th>
                                <td>Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Harga Jual Konsumen</th>
                                <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kuantitas Sisa Stok</th>
                                <td>
                                    @if($produk->stok > 0)
                                        <span class="badge-stock-success"><i class="bi bi-check-circle"></i> Tersedia {{ $produk->stok }} Pcs</span>
                                    @else
                                        <span class="badge-stock-danger"><i class="bi bi-x-circle"></i> Stok Habis</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Operator Pemasok</th>
                                <td><i class="bi bi-person text-muted"></i> {{ $produk->user->name ?? 'Sistem Bawaan' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
