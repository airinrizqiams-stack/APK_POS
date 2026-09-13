@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')

<!-- Memaksa navbar bawaan agar rata tengah mengikuti lebar form -->
<div class="navbar-container-fix">
    @include('layouts.navbar')
</div>

<!-- Bootstrap Icons CDN Fix -->
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
        max-width: 800px !important;
        margin: 0 auto !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    /* Pembungkus Halaman Form */
    .form-wrapper {
        padding: 2.5rem 15px;
        max-width: 800px;
        margin: 0 auto;
    }

    .header-section {
        padding-left: 0.25rem;
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

    /* Kotak Utama Form */
    .form-card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
    }

    .form-label-custom {
        font-weight: 600;
        color: var(--color-primary);
        margin-bottom: 0.5rem;
    }

    .form-control-custom {
        border: 1px solid var(--color-border);
        border-radius: 8px;
        padding: 0.6rem 0.9rem;
    }

    .form-control-custom:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.2rem rgba(73, 54, 40, 0.15);
    }

    .btn-action-custom {
        font-weight: 600;
        padding: 0.65rem 1.75rem;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    /* Tombol Simpan */
    .btn-save-custom {
        background-color: var(--color-primary) !important;
        border: 1.5px solid var(--color-primary) !important;
        color: #FFFFFF !important;
    }
    .btn-save-custom:hover {
        background-color: #35271d !important;
        border-color: #35271d !important;
    }

    /* Tombol Kembali */
    .btn-back-custom {
        background-color: #FFFFFF !important;
        border: 1.5px solid #5A4B41 !important;
        color: #5A4B41 !important;
    }
    .btn-back-custom:hover, .btn-back-custom:active, .btn-back-custom:focus {
        background-color: #5A4B41 !important;
        color: #FFFFFF !important;
    }

    .preview-box {
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px dashed var(--color-border);
        border-radius: 8px;
        background-color: #FAF9F6;
    }
</style>

<div class="form-wrapper">
    <!-- Header Page -->
    <div class="header-section text-start">
        <h1 class="main-title">Ubah Informasi Produk</h1>
        <p class="main-subtitle">Perbarui data spesifikasi, harga jual beli, atau unggah ulang gambar katalog produk</p>
    </div>

    <!-- Form Container -->
    <div class="form-card-custom">
        <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('produk._form')
        </form>
    </div>
</div>

<script>
    // Script Preview Image JavaScript
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewText = document.getElementById('preview-text');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if(previewText) previewText.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection