@extends('layouts.app')

@section('title', 'Mesin Kasir (POS)')

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

    /* Pembungkus Utama Layar Kasir */
    .pos-wrapper {
        padding: 2.5rem 15px;
        max-width: 1200px;
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
    .card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header-custom {
        background-color: #FAFAFA !important;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 1rem 1.25rem;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 1rem;
    }

    .card-body-custom {
        padding: 1.25rem;
    }

    /* Gaya Kustom Input Kolom */
    .form-control-custom {
        border: 1.5px solid var(--color-border);
        border-radius: 8px !important;
        padding: 0.55rem 1rem;
        font-size: 0.95rem;
        background-color: #FAFAFA;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15);
        background-color: #FFFFFF;
    }

    /* Kartu Item Produk dalam Katalog Kasir */
    .btn-product-item {
        background-color: transparent !important;
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        color: var(--color-primary) !important;
        padding: 0.75rem 1rem !important;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .btn-product-item:hover:not([disabled]) {
        background-color: rgba(171, 136, 109, 0.1) !important;
        transform: translateY(-1px);
    }

    /* Desain Tombol Tambah Keranjang (+) */
    .btn-add-cart {
        background-color: var(--color-primary) !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        height: 45px;
        transition: background-color 0.2s ease;
    }

    .btn-add-cart:hover:not([disabled]) {
        background-color: #35271d !important;
    }

    /* Penataan Tabel Keranjang Belanja Kasir */
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
        padding: 0.75rem 1rem;
    }

    .table-aesthetic tbody td {
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        color: #495057;
    }

    /* Komponen Total Tagihan Pembayaran */
    .total-price-box {
        background-color: #FAFAFA;
        border-top: 1.5px solid var(--color-border);
        padding: 1.25rem;
        color: var(--color-primary);
    }

    /* Tombol Final Transaksi (Checkout / Batalkan) */
    .btn-checkout-custom {
        background-color: #28a745 !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        padding: 0.7rem 1rem;
        border: none;
        transition: background-color 0.2s ease;
    }
    .btn-checkout-custom:hover:not([disabled]) {
        background-color: #1e7e34 !important;
    }

    .btn-cancel-custom {
        background-color: transparent !important;
        border: 1.5px solid #dc3545 !important;
        color: #dc3545 !important;
        font-weight: 600;
        border-radius: 8px !important;
        padding: 0.65rem 1rem;
        transition: all 0.2s ease;
    }
    .btn-cancel-custom:hover:not([disabled]) {
        background-color: rgba(220, 53, 69, 0.08) !important;
    }
    
    .btn-delete-item {
        background-color: #f8d7da !important;
        color: #721c24 !important;
        border: none;
        padding: 0.35rem 0.6rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .btn-delete-item:hover {
        background-color: #dc3545 !important;
        color: #FFFFFF !important;
    }
</style>

<div class="pos-wrapper text-start">

    <!-- Notifikasi Eror Pesan Kendala Transaksi -->
    @if(session('errors'))
    <div class="alert alert-danger mb-4" style="border-radius: 8px;">
        <i class="bi bi-exclamation-triangle"></i> {{ session('errors') }}
    </div>
    @endif

    <!-- Bagian Kepala: Judul Terlokalisasi -->
    <div class="header-section">
        <h1 class="main-title">
            {{ isset($mode) && $mode == 'edit' ? 'Ubah Transaksi Penjualan' : 'Entri Transaksi Baru (POS)' }}
        </h1>
        <p class="main-subtitle">Pilih produk katalog, atur jumlah kuantitas belanja, dan proses pembayaran konsumen</p>
    </div>

    <div class="row g-4">

        {{-- ============================ KOLOM KATALOG PRODUK (KIRI) ============================ --}}
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-box-seam"></i> Pilih Item Katalog Produk
                </div>
                <div class="card-body-custom">
                    <!-- Bar Kolom Pencarian Produk Kasir -->
                    <div class="mb-4">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="position-relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control-custom w-100"
                                       placeholder="Cari nama produk di sini..."
                                       style="padding-left: 2.5rem !important;"
                                       onkeyup="this.form.submit()">
                                <i class="bi bi-search position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Daftar List Baris Menu Produk -->
                    <div style="max-height: 52vh; overflow-y: auto; padding-right: 4px;">
                        @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 mb-3 align-items-center">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="col-7">
                                    <button type="submit" class="btn btn-product-item w-100 text-start" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                        <span class="fw-bold d-block" style="font-size: 0.95rem;">{{ $product->nama }}</span>
                                        <span class="text-muted" style="font-size: 0.85rem;">Rp {{ number_format($product->harga_jual) }}</span>
                                    </button>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1"
                                           class="form-control-custom w-100" style="height: 45px;" {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                                </div>

                                <div class="col-2">
                                    <button type="submit" class="btn btn-add-cart w-100" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================ KOLOM STRUK KERANJANG BELANJA (KANAN) ============================ --}}
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-cart3"></i> Rincian Keranjang Belanja
                </div>
                
                <div class="table-responsive" style="min-height: 30vh; max-height: 40vh; overflow-y: auto;">
                    <table class="table table-aesthetic align-middle">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
SubtotalAksi@forelse($sale->itemPenjualan as $item){{ $item->produk->nama }}Rp {{ number_format($item->produk->harga_jual) }}@csrf@method('PUT')Rp {{ number_format($item->subtotal) }}@can('delete', $item)@csrf@method('DELETE')@endcan@empty Keranjang belanja saat ini masih kosong@endforelseJumlah Total Tagihan:Rp {{ number_format($sale->itemPenjualan->sum('subtotal')) }}@csrf@method('PUT')-- Pilih Metode Pembayaran --Tunai (Cash)QRIS / Digital Pay<button type="submit" class="btn btn-checkout-custom w-100 d-flex align-items-center justify-content-center gap-2" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }} style="height: 45px;"> Proses Selesai (Checkout)@can('delete', $sale)@csrf@method('DELETE')<button type="submit" class="btn btn-cancel-custom w-100 mt-2 d-flex align-items-center justify-content-center gap-2" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }} style="height: 45px;"> Batalkan Sesi Transaksi@endcan@endsection