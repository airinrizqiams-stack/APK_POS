@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
@include('layouts.navbar')

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

    .content-wrapper {
        padding: 2.5rem 15px;
        max-width: 1140px;
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

    .form-card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
    }

    .form-label-custom {
        color: var(--color-primary);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

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

    .btn-primary-custom {
        background-color: var(--color-primary) !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
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

    .btn-secondary-custom {
        background-color: transparent !important;
        border: 1.5px solid var(--color-muted) !important;
        color: var(--color-muted) !important;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        background-color: var(--color-muted) !important;
        color: #FFFFFF !important;
    }

    .preview-box {
        border: 1.5px dashed var(--color-border);
        border-radius: 8px;
        background-color: #FAFAFA;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 10px;
    }
</style>

<div class="content-wrapper">
    <!-- Header Section -->
    <div class="header-section text-start">
        <h1 class="main-title">Tambah Produk Baru</h1>
        <p class="main-subtitle">Isi formulir di bawah ini untuk menambahkan barang atau produk baru ke sistem katalog</p>
    </div>

    <!-- Form Container -->
    <div class="form-card-custom">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @include('produk._form')
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewText = document.getElementById('preview-text');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; 
            if (previewText) previewText.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        if (previewText) previewText.style.display = 'block';
    }
}
</script>
@endsection