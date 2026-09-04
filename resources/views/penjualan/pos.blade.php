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

    .pos-wrapper {
        padding: 2.5rem 15px;
        max-width: 1200px;
        margin: 0 auto;
    }

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

    .btn-product-item {
        background-color: transparent !important;
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px 0 0 8px !important;
        color: var(--color-primary) !important;
        padding: 0.75rem 1rem !important;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-add-cart {
        background-color: var(--color-primary) !important;
        border: 1.5px solid var(--color-primary) !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 0 8px 8px 0 !important;
        transition: background-color 0.2s ease;
    }

    .btn-add-cart:hover:not([disabled]) {
        background-color: #35271d !important;
        border-color: #35271d !important;
    }

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

    .total-price-box {
        background-color: #FAFAFA;
        border-top: 1.5px solid var(--color-border);
        padding: 1.25rem;
        color: var(--color-primary);
    }

    .btn-checkout-custom {
        background-color: #28a745 !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        padding: 0.75rem 1rem;
        border: none;
        transition: all 0.2s ease;
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
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }
    .btn-cancel-custom:hover:not([disabled]) {
        background-color: rgba(220, 53, 69, 0.08) !important;
    }
    
    .btn-delete-item {
        background-color: #f8d7da !important;
        color: #721c24 !important;
        border: none;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-delete-item:hover {
        background-color: #dc3545 !important;
        color: #FFFFFF !important;
    }
</style>

<div class="pos-wrapper text-start">

    @if(session('errors'))
    <div class="alert alert-danger mb-4" style="border-radius: 8px;">
        <i class="bi bi-exclamation-triangle"></i> {{ session('errors') }}
    </div>
    @endif

    <div class="header-section">
        <h1 class="main-title">
            {{ request()->is('*/edit') ? 'Ubah Transaksi Penjualan' : 'Entri Transaksi Baru (POS)' }}
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
                    <div class="mb-4">
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="position-relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control-custom w-100"
                                       placeholder="Cari produk..."
                                       style="padding-left: 2.5rem !important;"
                                       onkeyup="this.form.submit()">
                                <i class="bi bi-search position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                            </div>
                        </form>
                    </div>
                    
                    <div style="max-height: 52vh; overflow-y: auto; padding-right: 4px;">
                        @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="mb-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="input-group">
                                    <button type="button" class="btn btn-product-item flex-grow-1 text-start" disabled style="background-color: #FFFFFF !important;">
                                        <span class="fw-bold d-block" style="color: var(--color-primary);">{{ $product->nama }}</span>
                                        <span class="text-muted small">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                    </button>
                                    <input type="number" name="qty" value="1" min="1" class="form-control form-control-custom text-center" style="max-width: 70px; border-radius: 0 !important; border-left: none; border-right: none;" {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                    <button type="submit" class="btn btn-add-cart px-3" {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================ KOLOM KERANJANG BELANJA (KANAN) ============================ --}}
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-cart3"></i> Keranjang Belanja Item Transaksi
                </div>
                <div class="card-body-custom p-0">
                    
                    <div style="max-height: 38vh; overflow-y: auto;">
                        <table class="table table-aesthetic">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center" style="width: 80px;">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($sale) && isset($sale->items) && count($sale->items) > 0)
                                    @foreach($sale->items as $item)
                                        <tr>
                                            <td>
                                                <span class="fw-bold d-block" style="color: var(--color-primary);">{{ $item->product->nama }}</span>
                                                <small class="text-muted">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</small>
Rp {{ number_format($item->subtotal, 0, ',', '.') }}

@endforeach
@else

Belum ada item di keranjang.

@endif

{{-- Bagian Kotak Total dan Tombol Pembayaran --}}

Total Tagihan:

Rp {{ isset($sale) && isset($sale->total_harga) ? number_format($sale->total_harga, 0, ',', '.') : '0' }}

Pilih Pembayaran
Tunai (Cash)
QRIS
Digital Pay

@csrf
<button type="submit" class="btn btn-checkout-custom w-100 shadow-sm" {{ !isset($sale) || $sale->status === 'COMPLETED' || empty($sale->items) || count($sale->items) == 0 ? 'disabled' : '' }}>
Checkout

@csrf
<button type="submit" class="btn btn-cancel-custom w-100" {{ !isset($sale) || $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
Batalkan Transaksi

@endsection