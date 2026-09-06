@extends('layouts.app')

@section('title', 'Mesin Kasir (POS)')

@section('content')

@include('layouts.navbar')

<!-- Memanggil Bootstrap Icons via CDN Resmi untuk ikon search -->
<link rel="stylesheet" href="https://jsdelivr.net">

<style>
    :root {
        --color-bg: #E4E0E1;
        --color-card: #FFFFFF;
        --color-primary: #493628; /* Cokelat Tua Utama */
        --color-border: #AB886D;  /* Cokelat Pudar Pembatas */
        --color-muted: #6B5B52;   /* Cokelat Teks */
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
        text-align: left;
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

    /* Penyelarasan Kotak Input */
    .form-control-custom {
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        padding: 0.55rem 1rem;
        font-size: 0.95rem;
        background-color: #FAFAFA;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15) !important;
        background-color: #FFFFFF;
    }

    /* KATALOG KIRI - Box Produk */
    .btn-product-item {
        background-color: #FFFFFF !important;
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        color: var(--color-primary) !important;
        padding: 0.75rem 1rem !important;
        transition: all 0.2s ease;
        text-align: left;
        width: 100%;
    }
    .btn-product-item:hover {
        border-color: var(--color-primary) !important;
    }

    /* Tombol Tambah (+) Cokelat Menengah Estetis */
    .btn-add-cart-custom {
        background-color: #8E705C !important;
        border: 1.5px solid #8E705C !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        transition: background-color 0.2s ease;
        width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 !important;
    }
    .btn-add-cart-custom:hover:not([disabled]) {
        background-color: var(--color-primary) !important;
        border-color: var(--color-primary) !important;
    }

    /* KERANJANG KANAN - Desain Grid Tabel Persis Gambar Contoh */
    .table-aesthetic {
        width: 100%;
        margin-bottom: 1.5rem;
        border-collapse: collapse;
    }
    .table-aesthetic th {
        background-color: #FAFAFA !important;
        color: var(--color-primary) !important;
        font-weight: 700;
        border-bottom: 1.5px solid var(--color-border) !important;
        padding: 0.75rem 0.5rem;
        text-align: left;
    }
    .table-aesthetic td {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #E4E0E1;
        text-align: left;
    }

    /* Input Qty Mini Dalam Tabel */
    .table-qty-input {
        max-width: 60px;
        text-align: center;
        border: 1px solid var(--color-border);
        border-radius: 6px;
        padding: 0.25rem;
        background-color: #FAFAFA;
    }

    /* Tombol Hapus Cokelat Kemerahan Red-Brown Ringan */
    .btn-delete-item-custom {
        background-color: #A54A4A !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.4rem 0.8rem;
        border-radius: 6px !important;
        font-size: 0.85rem;
        transition: background-color 0.2s ease;
    }
    .btn-delete-item-custom:hover {
        background-color: #843b3b !important;
    }

    /* Dropdown Pilihan Pembayaran */
    .select-payment-custom {
        border: 1.5px solid var(--color-border) !important;
        border-radius: 8px !important;
        padding: 0.65rem 1rem !important;
        color: var(--color-primary) !important;
        font-weight: 600;
        background-color: #FFFFFF !important;
    }

    /* Tombol Checkout Warna Tema Cokelat Tua Utama */
    .btn-checkout-theme {
        background-color: var(--color-primary) !important;
        border: 1.5px solid var(--color-primary) !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }
    .btn-checkout-theme:hover:not([disabled]) {
        background-color: #35271d !important;
        border-color: #35271d !important;
    }

    /* Tombol Batal Transaksi Warna Putih-Cokelat Interaktif */
    .btn-cancel-theme {
        background-color: #FFFFFF !important;
        border: 1.5px solid #5A4B41 !important;
        color: #5A4B41 !important;
        font-weight: 600;
        border-radius: 8px !important;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease-in-out;
    }
    .btn-cancel-theme:hover:not([disabled]) {
        background-color: #5A4B41 !important;
        color: #FFFFFF !important;
    }
</style>

<div class="pos-wrapper">

    @if(session('errors'))
    <div class="alert alert-danger mb-4" style="border-radius: 8px; text-align: left;">
        <i class="bi bi-exclamation-triangle"></i> {{ session('errors') }}
    </div>
    @endif

    <div class="header-section">
        <h1 class="main-title">
            {{ (isset($mode) && $mode === 'edit') ? 'Ubah Transaksi Penjualan' : 'Entri Transaksi Baru (POS)' }}
        </h1>
        <p class="main-subtitle">Pilih produk katalog, atur jumlah kuantitas belanja, dan proses pembayaran konsumen</p>
    </div>

    <div class="row g-4">

        {{-- ============================ AREA KATALOG PRODUK (KIRI) ============================ --}}
        <div class="col-md-6">
            <div class="p-3" style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px;">
                
                <!-- Pencarian Produk -->
                <div class="mb-4">
                    <form method="GET" action="{{ route('penjualan.create') }}">
                        <div class="position-relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control-custom w-100" placeholder="Cari produk..."
                                   style="padding-left: 2.5rem !important;" onkeyup="this.form.submit()">
                            <i class="bi bi-search position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                        </div>
                    </form>
                </div>

                <!-- Daftar Card Katalog Berjejer -->
                <div style="max-height: 62vh; overflow-y: auto; padding-right: 4px;">
                    @foreach($products as $product)
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="mb-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="row g-2 align-items-stretch">
                                <div class="col-8">
                                    <button type="button" class="btn btn-product-item h-100" disabled>
                                        <span class="fw-bold d-block" style="color: var(--color-primary);">{{ $product->nama }}</span>
                                        <span class="text-muted small">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                    </button>
                                </div>
                                <div class="col-2">
                                    <input type="number" name="quantity" value="1" min="1" class="form-control form-control-custom h-100 text-center" {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-add-cart-custom w-100 h-100" {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#FFFFFF" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- ============================ AREA KERANJANG BELANJA (KANAN) ============================ --}}
        <div class="col-md-6">
            <div class="p-3 text-start" style="background: #FFFFFF; border: 1px solid var(--color-border); border-radius: 12px;">
                
                <!-- Tabel Item Belanja -->
                <div class="table-responsive" style="max-height: 40vh; overflow-y: auto;">
                    <table class="table table-aesthetic">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th style="width: 80px;">Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sale) && $sale->itemPenjualan->count() > 0)
                                @foreach($sale->itemPenjualan as $item)
                                <tr>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->kuantitas }}" class="table-qty-input" onchange="this.form.submit();" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete-item-custom" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                                Hapus
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada item belanjaan di keranjang.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Total Pembayaran -->
                <div class="d-flex justify-content-between align-items-center my-3 pt-2" style="border-top: 1.5px dashed var(--color-border);">
                    <span class="fw-bold" style="color: var(--color-primary);">Total Pembayaran:</span>
                    <strong class="fs-5" style="color: var(--color-primary);">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                </div>

                <!-- Form Checkout -->
                @if(isset($sale))
                <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return confirm('Yakin ingin checkout?');">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <select name="payment_method" class="form-select select-payment-custom w-100" required {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Tunai (Cash)</option>
                            <option value="QRIS">QRIS Digital Pay</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-checkout-theme w-100 mb-2" {{ ($sale->itemPenjualan->count() == 0 || $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                        Checkout
                    </button>
                </form>

                <!-- Form Batal Transaksi -->
                @can('delete', $sale)
                <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-cancel-theme w-100" {{ ($sale->itemPenjualan->count() == 0 || $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                        Batal Transaksi
                    </button>
                </form>
                @endcan
                @endif

            </div>
        </div>

    </div>
</div>

@endsection