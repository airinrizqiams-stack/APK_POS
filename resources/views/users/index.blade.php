@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

@include('layouts.navbar')

<!-- Memanggil Bootstrap Icons untuk indikator visual pada tombol dan input -->
<link rel="stylesheet" href="https://jsdelivr.net">

<style>
    :root {
        --color-primary: #607274;
        --color-bg: #FAEED1;
        --color-card: #FFFFFF;
        --color-muted: #B2A59B;
        --color-border: #DED0B6;
    }

    body {
        background-color: var(--color-bg) !important;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        color: #333333;
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

    /* Wadah Utama (Card) */
    .table-card-custom {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(96, 114, 116, 0.05);
    }

    /* Gaya Kustom Input & Tombol Pencarian */
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
        box-shadow: 0 0 0 0.25rem rgba(96, 114, 116, 0.15);
        background-color: #FFFFFF;
    }

    /* Desain Tombol-Tombol Aksi */
    .btn-primary-custom {
        background-color: var(--color-primary) !important;
        border: none !important;
        color: #FFFFFF !important;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        transition: background-color 0.2s ease;
    }

    .btn-primary-custom:hover {
        background-color: #4d5c5e !important;
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

    .table-aesthetic tbody td {
        padding: 0.85rem 0.75rem;
        font-size: 0.95rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        color: #495057;
    }

    /* Badge untuk Hak Akses (Role) */
    .badge-role {
        background-color: rgba(96, 114, 116, 0.1);
        color: var(--color-primary);
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    /* Tombol Aksi Mini (Edit & Hapus) */
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
        <h1 class="main-title">Manajemen Pengguna</h1>
        <p class="main-subtitle">Kelola hak akses, tambah, atau perbarui data pengguna sistem POS Anda</p>
    </div>

    <!-- Wadah Utama Konten -->
    <div class="table-card-custom">
        
        <!-- Baris Tombol Tambah & Form Pencarian -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-4 text-start">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg"></i> Tambah Pengguna
                </a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.users') }}" method="GET" class="row g-2 justify-content-end">
                    <div class="col-sm-8 col-md-7">
                        <input 
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control-custom w-100"
                            placeholder="Cari berdasarkan nama atau email..."
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

        <!-- Tabel Data Pengguna -->
        <div class="table-responsive">
            <table class="table table-aesthetic align-middle text-start">
                <thead>
                    <tr>
                        <th width="8%">#</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Email</th>
                        <th>Hak Akses (Role)</th>
                        <th width="20%">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge-role">{{ $user->role->name ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-action-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-muted text-center py-4">
                            <i class="bi bi-info-circle"></i> Tidak ada data pengguna yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Bagian Pagination Sistem -->
        <div class="mt-4 d-flex justify-content-start">
            {{ $users->links() }}
        </div>
        
    </div>
</div>

@endsection
