@extends('layouts.app')

@section('title', 'Tambah Pengguna')

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
        max-width: 800px;
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
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .form-control-custom {
        border: 1.5px solid var(--color-border);
        border-radius: 8px !important;
        padding: 0.65rem 1rem;
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
</style>

<div class="content-wrapper">

    <div class="header-section text-start">
        <h1 class="main-title">Tambah Pengguna Baru</h1>
        <p class="main-subtitle">Daftarkan akun baru ke dalam sistem operasional POS Anda</p>
    </div>

    <div class="form-card-custom text-start">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label-custom">Nama Lengkap</label>
                <input type="text" 
                       name="name" 
                       class="form-control form-control-custom @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap pengguna">
                @error('name')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Alamat Email</label>
                <input type="email" 
                       name="email" 
                       class="form-control form-control-custom @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}"
                       placeholder="nama@perusahaan.com">
                @error('email')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Kata Sandi (Password)</label>
                <input type="password" 
                       name="password" 
                       class="form-control form-control-custom @error('password') is-invalid @enderror" 
                       placeholder="Masukkan kata sandi minimal 8 karakter">
                @error('password')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- PERBAIKAN: Mengubah name="role" menjadi name="role_id" dan me-looping data $roles -->
            <div class="mb-4">
                <label class="form-label-custom">Hak Akses Sistem (Role)</label>
                <select name="role_id" class="form-control form-control-custom @error('role_id') is-invalid @enderror">
                    <option value="" disabled selected>-- Pilih Tingkatan Akses --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bagian Tombol Aksi -->
            <div class="d-flex align-items-center gap-2 pt-2">
                <button class="btn btn-primary-custom" type="submit">
                    <i class="bi bi-save"></i> Simpan Data
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
