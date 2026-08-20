<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Dashboard')

<!-- batas awal isi konten -->
@section('content')

<!-- Memaksa isi elemen di dalam navbar agar otomatis masuk rapi ke tengah -->
<div class="navbar-container-fix">
    @include('layouts.navbar')
</div>

<!-- Memanggil Bootstrap Icons untuk indikator visual modern -->
<link rel="stylesheet" href="https://jsdelivr.net">

<style>
    :root {
        --color-primary: #607274;
        --color-bg: #FAEED1;
        --color-card: #FFFFFF;
        --color-muted: #B2A59B;
        --color-border: #DED0B6;
    }

    body {
        background-color: var(--color-bg) !important;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        color: #333333;
    }

    /* Menarik tombol logout dan menu navigasi agar sejajar lurus ke dalam (tidak terlalu ke tepi) */
    .navbar-container-fix .container-fluid, 
    .navbar-container-fix .container {
        max-width: 1140px !important;
        margin: 0 auto !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .navbar-container-fix .navbar {
        background-color: #FFFFFF !important;
        border-bottom: 1px solid var(--color-border);
    }

    /* Pembungkus halaman utama - Diatur sejajar sempurna dengan batas tepi wadah */
    .dashboard-wrapper {
        padding: 2.5rem 15px;
        max-width: 1140px;
        margin: 0 auto;
    }

    /* Penyesuaian Ruang Kepala: Membawa judul teks bergeser agak ketengah */
    .header-section-custom {
        padding-left: 1rem;
        margin-bottom: 2.5rem;
    }

    /* Hierarki Teks Utama (Bahasa Indonesia) */
    .main-title {
        color: var(--color-primary);
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.35rem;
    }

    .main-subtitle {
        color: var(--color-muted);
        font-size: 0.95rem;
        font-weight: 400;
    }

    /* Pembatas Antar Bagian Data */
    .section-title {
        color: var(--color-primary);
        font-size: 1.25rem;
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 2px solid var(--color-border);
        padding-bottom: 0.5rem;
    }

    .subsection-title {
        color: var(--color-primary);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Pembaruan Visual Kotak Data Ringkasan (Card) */
    .metric-card-custom {
        background: var(--color-card) !important;
        border: 1px solid var(--color-border) !important;
        border-radius: 12px !important;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(96, 114, 116, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }

    .metric-label {
        color: var(--color-muted);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .metric-value {
        color: var(--color-primary);
        font-size: 1.4rem;
        font-weight: 700;
    }

    .metric-icon-box {
        background-color: rgba(96, 114, 116, 0.1);
        color: var(--color-primary);
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Penataan Wadah Tabel Ringkas */
    .table-card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(96, 114, 116, 0.05);
        margin-bottom: 1rem;
    }

    .table-aesthetic {
        margin-bottom: 0;
    }

    .table-aesthetic thead th {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 0.75rem;
    }

    .table-aesthetic tbody td {
        padding: 0.75rem;
        font-size: 0.95rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        color: #495057;
    }

    /* Warna Elemen Penanda (Badges) */
    .badge-low-stock {
        background-color: #fff3cd;
        color: #856404;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-out-of-stock {
        background-color: #f8d7da;
        color: #721c24;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .badge-best-seller {
        background-color: rgba(96, 114, 116, 0.1);
        color: var(--color-primary);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }
</style>

<div class="dashboard-wrapper">
    
    <!-- Bagian Kepala: Judul Utama Sekarang Tergeser Mengikuti Struktur Kotak Konten -->
    <div class="header-section-custom text-start">
        <h1 class="main-title">Ringkasan Hari Ini</h1>
        <p class="main-subtitle">
            <i class="bi bi-calendar3"></i> Data statistik aktivitas sistem POS pada {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
        </p>
    </div>

    @can('viewAny', App\Models\User::class)
    <!-- Ringkasan Penjualan Masuk -->
    <h2 class="section-title"><i class="bi bi-graph-up-arrow"></i> Performa Penjualan</h2>
    <div class="row g-4 mb-2 text-start">
        <div class="col-md-6">
            <div class="metric-card-custom">
                <div>
                    <div class="metric-label">Total Nilai Penjualan Hari ini</div>
                    <div class="metric-value">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
                </div>
                <div class="metric-icon-box">
                    <i class="bi bi-currency-dollar"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="metric-card-custom">
                <div>
                    <div class="metric-label">Jumlah Transaksi Hari ini</div>
                    <div class="metric-value">{{ $ringkasan['total_transaksi'] }} Transaksi</div>
                </div>
                <div class="metric-icon-box">
                    <i class="bi bi-cart-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Arus Kas Transaksi -->
    <h2 class="section-title"><i class="bi bi-wallet2"></i> Arus Kas & Status Pembayaran</h2>
    <div class="row g-4 mb-2 text-start">
        <div class="col-md-6">
            <div class="metric-card-custom">
                <div>
                    <div class="metric-label">Total Pembayaran Tunai</div>
                    <div class="metric-value">Rp {{ number_format($ringkasan['total_cash']) }}</div>
                </div>
                <div class="metric-icon-box">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="metric-card-custom">
                <div>
                    <div class="metric-label">Total Pembayaran Non-Tunai</div>
                    <div class="metric-value">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div>
                </div>
                <div class="metric-icon-box">
                    <i class="bi bi-credit-card"></i>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <!-- Inventori Produk -->
    <h2 class="section-title"><i class="bi bi-box-seam"></i> Manajemen Inventori Kritis</h2>
    <div class="row g-4">
        <!-- Daftar Produk Stok Rendah -->
        <div class="col-md-6 text-start">
            <h3 class="subsection-title"><i class="bi bi-arrow-down-right-circle text-warning"></i> Daftar Produk Stok Rendah</h3>
            <div class="table-card-custom">
                <div class="table-responsive">
                    <table class="table table-aesthetic">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Nama Produk</th>
                                <th class="text-end">Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-end"><span class="badge-low-stock">{{ $produk->stok }} Unit</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-3">
                                         <i class="bi bi-check-circle text-success"></i> Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $produkStokRendah->links() }}
                </div>
            </div>
        </div>
       <!-- Daftar Produk Habis -->
            Produk Habis Stok
            {{ $produkStokHabis->links() }} 
            Produk Terlaris (Best Seller)
    @endsection