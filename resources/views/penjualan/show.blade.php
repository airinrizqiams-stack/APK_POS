@extends('layouts.app')

@section('title', 'Detail Transaksi Penjualan')

@section('content')

<div class="navbar-container-fix">
    @include('layouts.navbar')
</div>

<!-- Memanggil Bootstrap Icons via CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        margin-bottom: 1.75rem;
    }

    .card-header-custom {
        background-color: #FAFAFA !important;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 1.25rem 1.5rem;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .card-body-custom {
        padding: 1.5rem;
    }

    /* Penataan Tabel Aesthetic */
    .table-aesthetic {
        margin-bottom: 0;
        width: 100%;
    }

    .table-aesthetic thead th {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 0.85rem 1rem;
    }

    .table-aesthetic tbody td {
        padding: 0.9rem 1rem;
        font-size: 0.95rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        color: #495057;
    }

    /* Baris Rincian Pembayaran */
    .table-summary-row td {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-size: 0.95rem !important;
        padding: 0.65rem 1rem !important;
        border-bottom: none !important;
    }

    .table-total-row td {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-size: 1.05rem !important;
        padding: 1.1rem 1rem !important;
        border-top: 1.5px solid var(--color-border) !important;
        border-bottom: 1px solid #EFEFEF !important;
    }

    /* Label Penanda Status */
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
    }

    .badge-status-pending {
        background-color: rgba(255, 193, 7, 0.12);
        color: #856404;
        padding: 0.35rem 0.65rem;
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

    /* Box Tampilan QRIS pada Detail */
    .qris-detail-box {
        border: 2px dashed var(--color-border);
        background-color: #FAFAFA;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
    }
</style>

<div class="content-wrapper">

    <!-- Header -->
    <div class="header-section text-start">
        <div>
            <h1 class="main-title">Faktur Detail Transaksi</h1>
            <p class="main-subtitle">Informasi lengkap rincian pembayaran belanja konsumen dan status jurnal kasir</p>
        </div>
        <a href="{{ route('penjualan.index') }}" class="btn btn-back-custom">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Informasi Utama Transaksi --}}
    <div class="card-custom text-start">
        <div class="card-header-custom">
            <i class="bi bi-receipt"></i> Ringkasan Nota #{{ $penjualan->id }}
        </div>
        <div class="card-body-custom">
            <div class="row g-3 align-items-center">
                <div class="col-md-3">
                    <p class="mb-1 text-muted" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Tanggal Transaksi</p>
                    <h6 class="fw-bold" style="color: var(--color-primary);"><i class="bi bi-clock"></i> {{ $penjualan->created_at->format('d-m-Y H:i:s') }}</h6>
                </div>
                <div class="col-md-3">
                    <p class="mb-1 text-muted" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Kasir Bertugas</p>
                    <h6 class="fw-bold" style="color: var(--color-primary);"><i class="bi bi-person"></i> {{ $penjualan->user->name ?? 'Tidak Diketahui' }}</h6>
                </div>
                <div class="col-md-3">
                    <p class="mb-1 text-muted" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Metode & Status</p>
                    <div class="d-flex gap-2 align-items-center mt-1">
                        <span class="badge-method">{{ $penjualan->metode_pembayaran ?? '-' }}</span>
                        <span class="badge-status-{{ $penjualan->status === 'COMPLETED' ? 'completed' : 'pending' }}">
                            <i class="bi {{ $penjualan->status === 'COMPLETED' ? 'bi-check-circle' : 'bi-hourglass-split' }}"></i> {{ $penjualan->status }}
                        </span>
                    </div>
                </div>

                <!-- Kondisi Header: Jika CASH / TUNAI -->
                @if(($penjualan->metode_pembayaran ?? '') === 'CASH')
                    <div class="col-md-3">
                        <p class="mb-1 text-muted" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Pembayaran Tunai</p>
                        <h6 class="fw-bold mb-0" style="color: var(--color-primary);">
                            Bayar: Rp {{ number_format($penjualan->uang_dibayar ?? 0, 0, ',', '.') }}
                        </h6>
                        <small class="text-muted">Kembali: Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</small>
                    </div>

                <!-- Kondisi Header: Jika QRIS -->
                @elseif(($penjualan->metode_pembayaran ?? '') === 'QRIS')
                    <div class="col-md-3">
                        <p class="mb-1 text-muted" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Info Pembayaran QRIS</p>
                        <span class="badge bg-success"><i class="bi bi-check-all"></i> Terverifikasi Digital</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Tabel Item Produk & Rincian Pembayaran --}}
    <div class="card-custom text-start">
        <div class="card-header-custom">
            <i class="bi bi-cart3"></i> Rincian Item Barang Yang Dibeli
        </div>
        <div class="table-responsive">
            <table class="table table-aesthetic align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah (Qty)</th>
                        <th class="text-end pe-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->itemPenjualan as $item)
                    <tr>
                        <td class="ps-4"><strong>{{ $item->produk->nama }}</strong></td>
                        <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->kuantitas }} Unit</td>
                        <td class="text-end pe-4">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    
                    <!-- Total Keseluruhan Pembayaran -->
                    <tr class="table-total-row">
                        <td colspan="3" class="text-end fw-bold ps-4">Total Keseluruhan Pembayaran:</td>
                        <td class="text-end pe-4 fw-bold text-success">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</td>
                    </tr>

                    {{-- Kondisi 1: Tampilkan Uang Dibayar & Kembalian jika Pembayaran Tunai (CASH) --}}
                    @if(($penjualan->metode_pembayaran ?? '') === 'CASH')
                    <tr class="table-summary-row">
                        <td colspan="3" class="text-end fw-bold ps-4">Uang Dibayar:</td>
                        <td class="text-end pe-4 fw-bold" style="color: var(--color-primary);">Rp {{ number_format($penjualan->uang_dibayar ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="table-summary-row">
                        <td colspan="3" class="text-end fw-bold ps-4">Uang Kembalian:</td>
                        <td class="text-end pe-4 fw-bold text-muted">Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</td>
                    </tr>

                    {{-- Kondisi 2: Tampilkan QR Barcode jika Pembayaran QRIS --}}
                    @elseif(($penjualan->metode_pembayaran ?? '') === 'QRIS')
                    <tr class="table-summary-row">
                        <td colspan="4" class="p-4">
                            <div class="qris-detail-box mx-auto" style="max-width: 320px;">
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <span class="fw-bold fs-5 text-danger me-1">QRIS</span>
                                    <span class="badge bg-secondary style-sm" style="font-size: 0.65rem;">NATIONAL QR CODE</span>
                                </div>
                                <p class="small text-muted mb-2">Scan QR Pembayaran Digital Transaksi Ini</p>
                                
                                <div class="p-2 bg-white d-inline-block border rounded shadow-sm my-2">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TRANSAKSI_QRIS_ID_{{ $penjualan->id }}_TOTAL_{{ $penjualan->total_pembayaran }}" 
                                         alt="Barcode QRIS Transaksi" 
                                         style="width: 140px; height: 140px;">
                                </div>
                                
                                <div class="mt-2 text-success small fw-bold">
                                    <i class="bi bi-patch-check-fill"></i> Lunas via QRIS / e-Wallet
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection