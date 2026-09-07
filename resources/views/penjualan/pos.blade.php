@extends('layouts.app')

@section('title', 'Mesin Kasir (POS)')

@section('content')

@include('layouts.navbar')

<!-- Memanggil Bootstrap Icons via CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        text-align: left;
    }

    .card-body-custom {
        padding: 1.25rem;
    }

    /* Gaya Kustom Input Kolom */
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

    /* Kartu Item Produk dalam Katalog Kasir */
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
    
    .btn-product-item:hover:not([disabled]) {
        border-color: var(--color-primary) !important;
        background-color: rgba(171, 136, 109, 0.05) !important;
    }

    /* Desain Tombol Tambah Keranjang (+) */
    .btn-add-cart-custom {
        background-color: #8E705C !important;
        border: 1.5px solid #8E705C !important;
        color: #FFFFFF !important;
        font-weight: 700;
        border-radius: 8px !important;
        transition: background-color 0.2s ease;
        width: 100%;
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

    /* Penataan Tabel Keranjang Belanja Kasir */
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

    /* Tombol Hapus */
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

    /* Tombol Checkout */
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

    /* Tombol Batal Transaksi */
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

<div class="pos-wrapper text-start">

    <!-- Notifikasi Pesan Kesalahan -->
    @if(session('errors'))
    <div class="alert alert-danger mb-4" style="border-radius: 8px; text-align: left;">
        <i class="bi bi-exclamation-triangle"></i> {{ session('errors') }}
    </div>
    @endif

    <!-- Bagian Header -->
    <div class="header-section">
        <h1 class="main-title">
            {{ (isset($mode) && $mode === 'edit') ? 'Ubah Transaksi Penjualan' : 'Entri Transaksi Baru (POS)' }}
        </h1>
        <p class="main-subtitle">Pilih produk katalog, atur jumlah kuantitas belanja, dan proses pembayaran konsumen</p>
    </div>

    <div class="row g-4">

        {{-- ============================ AREA KATALOG PRODUK (KIRI) ============================ --}}
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-box-seam"></i> Pilih Item Katalog Produk
                </div>
                <div class="card-body-custom">
                    
                    <!-- Form Pencarian Produk Kasir -->
                    <div class="mb-4">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="position-relative">
                                <input type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    class="form-control-custom w-100" 
                                    placeholder="Cari nama produk lalu tekan Enter..."
                                    style="padding-left: 2.5rem !important;" 
                                    autocomplete="off">
                                <i class="bi bi-search position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                            </div>
                        </form>
                    </div>

                    <!-- Daftar Card Katalog Produk -->
                    <div style="max-height: 55vh; overflow-y: auto; padding-right: 4px;">
                        @forelse($products as $product)
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
                                        <input type="number" name="quantity" value="1" min="1" 
                                               class="form-control form-control-custom h-100 text-center" 
                                               {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-add-cart-custom" 
                                                {{ (isset($sale) && $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                                            <i class="bi bi-plus-lg fs-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @empty
                            <div class="text-center text-muted py-4">Produk tidak ditemukan.</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        {{-- ============================ AREA KERANJANG BELANJA (KANAN) ============================ --}}
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-cart3"></i> Rincian Keranjang Belanja
                </div>
                <div class="card-body-custom">
                    
                    <!-- Tabel Item Belanja -->
                    <div class="table-responsive" style="max-height: 38vh; overflow-y: auto;">
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
                                                <input type="number" name="quantity" value="{{ $item->kuantitas }}" 
                                                       class="table-qty-input" onchange="this.form.submit();" 
                                                       {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
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
                    <div class="d-flex justify-content-between align-items-center my-3 pt-3" style="border-top: 1.5px dashed var(--color-border);">
                        <span class="fw-bold" style="color: var(--color-primary);">Total Pembayaran:</span>
                        <strong class="fs-4" style="color: var(--color-primary);">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                    </div>

                    <!-- Form Checkout -->
                    @if(isset($sale))
                    <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return confirm('Yakin ingin checkout ?');">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select name="payment_method" class="form-select select-payment-custom w-100" required {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="CASH">Tunai (Cash)</option>
                                <option value="QRIS">QRIS / Digital Pay</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-checkout-theme w-100 mb-2" {{ ($sale->itemPenjualan->count() == 0 || $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                            Proses Selesai (Checkout)
                        </button>
                    </form>

                    <!-- Form Batal Transaksi -->
                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-cancel-theme w-100" {{ ($sale->itemPenjualan->count() == 0 || $sale->status === 'COMPLETED') ? 'disabled' : '' }}>
                            Batalkan Sesi Transaksi
                        </button>
                    </form>
                    @endcan
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    let searchTimer;
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    if (searchInput) {
        // Debounce: Tunggu 500ms setelah selesai mengetik baru submit form
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });

        // Menjaga kursor tetap fokus di paling akhir teks setelah reload/submit
        document.addEventListener('DOMContentLoaded', function() {
            if (searchInput.value) {
                searchInput.focus();
                searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
            }
        });
    }
</script>

@endsection