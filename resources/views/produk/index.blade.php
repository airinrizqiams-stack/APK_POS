@extends('layouts.app')

@section('title', 'Katalog Produk')

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
        box-shadow: 0 0 0 0.25rem rgba(73, 54, 40, 0.15);
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

    /* Thumbnail Gambar Produk */
    .product-img-thumbnail {
        border: 1px solid var(--color-border);
        border-radius: 8px;
        object-fit: cover;
        padding: 4px;
        background-color: #FAFAFA;
    }

    /* Label Penanda Stok */
    .badge-stock {
        background-color: rgba(171, 136, 109, 0.15);
        color: var(--color-primary);
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Tombol Aksi Mini (Menyesuaikan Warna Earth Tone) */
    .btn-action-detail {
        background-color: #299ebe !important;
        color: #FFFFFF !important;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 6px;
        padding: 0.35rem 0.75rem;
        border: none;
        text-decoration: none;
    }

    .btn-action-edit {
        background-color: #ffc107 !important;
        color: #000000 !important;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 6px;
        padding: 0.35rem 0.75rem;
        border: none;
    }

    .btn-action-delete {
        background-color: #dc3545 !important;
        color: #FFFFFF !important;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 6px;
        padding: 0.35rem 0.75rem;
        border: none;
    }
</style>

<div class="content-wrapper">

    <!-- Bagian Kepala: Judul Terlokalisasi -->
    <div class="header-section text-start">
        <h1 class="main-title">Katalog Data Produk</h1>
        <p class="main-subtitle">Kelola informasi produk, stok inventori, serta pengaturan harga jual beli toko Anda</p>
    </div>

    <!-- Wadah Utama Konten -->
    <div class="table-card-custom">

        <!-- Baris Tombol Tambah & Form Pencarian -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-4 text-start">
                @can('create', App\Models\Produk::class)
                    <a href="{{ route('produk.create') }}" class="btn btn-primary-custom">
                        <i class="bi bi-plus-lg"></i> Tambah Produk
                    </a>
                @endcan
            </div>
            <div class="col-md-8">
                <form action="{{ route('produk.index') }}" method="GET" class="row g-2 justify-content-end">
                    <div class="col-sm-8 col-md-7">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            class="form-control-custom w-100" 
                            placeholder="Cari berdasarkan nama produk..."
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

        <!-- Tabel Data Produk -->
        <div class="table-responsive">
            <table class="table table-aesthetic align-middle text-start">
                <thead>
                    <tr>
                        <th width="6%">#</th>
                        <th>Oleh Pengguna</th>
                        <th width="12%">Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Sisa Stok</th>
                        <th width="22%">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <th>{{ $products->firstItem() + $loop->index }}</th>
                        <td>{{ $product->user->name }}</td>
                        <td>
                            @if($product->foto)
                                <img src="{{ asset('storage/'.$product->foto) }}" width="80" height="60" class="product-img-thumbnail">
                            @else
                                <span class="text-muted" style="font-size: 0.85rem;"><i class="bi bi-image"></i> Tanpa Foto</span>
                            @endif
                        </td>
                        <td><strong>{{ $product->nama }}</strong></td>
                        <td>Rp {{ number_format($product->harga_beli) }}</td>
                        <td>Rp {{ number_format($product->harga_jual) }}</td>
                        <td>
                            <span class="badge-stock">{{ $product->stok }} Unit</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @can('view', $product)
                                    <a href="{{ route('produk.show', $product) }}" class="btn btn-action-detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                @endcan
                                
                                @can('update', $product)
                                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-action-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endcan
                                
                                @can('delete', $product)
                                <!-- KODE PERBAIKAN TOTAL: Form murni dengan type="submit" dan konfirmasi asli HTML -->
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->nama }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    </tr>
                        Data produk tidak tersedia atau tidak ditemukan.
                    @endforelse
                        {{ $products->links() }}
                    @endsection