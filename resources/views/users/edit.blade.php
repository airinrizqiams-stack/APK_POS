@extends('layouts.app')

@section('title', 'Ubah Pengguna')

@section('content')

<div class="navbar-container-fix">
    @include('layouts.navbar')
</div>

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
        max-width: 800px !important;
        margin: 0 auto !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

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

    .form-card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05);
    }

    .btn-interactive-custom {
        background-color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-simpan {
        border: 1.5px solid var(--color-primary) !important;
        color: var(--color-primary) !important;
    }

    .btn-simpan:hover, .btn-simpan:active, .btn-simpan:focus {
        background-color: var(--color-primary) !important;
        color: #FFFFFF !important;
    }

    .btn-kembali {
        border: 1.5px solid #5A4B41 !important;
        color: #5A4B41 !important;
    }

    .btn-kembali:hover, .btn-kembali:active, .btn-kembali:focus {
        background-color: #5A4B41 !important;
        color: #FFFFFF !important;
    }
</style>

<div class="form-wrapper">

    <div class="header-section text-start">
        <h1 class="main-title">Ubah Data Pengguna</h1>
        <p class="main-subtitle">Perbarui informasi profil atau tingkatan hak akses pengguna yang sudah terdaftar</p>
    </div>

    <div class="form-card-custom">
        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT') 
            @include('users._form')
        </form>
    </div>

</div>

@endsection
