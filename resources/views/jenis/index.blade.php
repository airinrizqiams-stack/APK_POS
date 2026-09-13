@extends('layouts.app')

@section('title', 'Manajemen Jenis Produk')

@section('content')
@include('layouts.navbar')

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --color-bg: #E4E0E1;
        --color-card: #FFFFFF;
        --color-primary: #493628;
        --color-border: #AB886D;
        --color-muted: #6B5B52;
    }
    body { background-color: var(--color-bg) !important; font-family: 'Plus Jakarta Sans', sans-serif; }
    .page-wrapper { padding: 2.5rem 15px; max-width: 1000px; margin: 0 auto; }
    .card-custom { background: var(--color-card); border: 1px solid var(--color-border); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(73, 54, 40, 0.05); }
    .card-header-custom { background-color: #FAFAFA !important; border-bottom: 1.5px solid var(--color-border) !important; padding: 1rem 1.25rem; color: var(--color-primary); font-weight: 700; }
    .form-control-custom { border: 1.5px solid var(--color-border); border-radius: 8px !important; padding: 0.55rem 1rem; background-color: #FAFAFA; }
    .btn-custom { background-color: var(--color-primary) !important; color: white !important; font-weight: 600; border-radius: 8px !important; border: none; padding: 0.55rem 1.5rem; }
    .btn-custom:hover { opacity: 0.9; }
    .table-custom thead th { background-color: #FAFAFA !important; color: var(--color-primary) !important; border-bottom: 1.5px solid var(--color-border) !important; font-weight: 700; }
    
    /* Custom Styling Tombol Edit (Kuning) & Hapus (Merah) sesuai Gambar Contoh */
    .btn-edit-custom {
        background-color: #ffc107 !important;
        color: #000000 !important;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 8px !important;
        border: none;
        padding: 0.35rem 0.85rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }
    .btn-edit-custom:hover {
        background-color: #e0a800 !important;
        color: #000000 !important;
    }

    .btn-hapus-custom {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 8px !important;
        border: none;
        padding: 0.35rem 0.85rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }
    .btn-hapus-custom:hover {
        background-color: #c82333 !important;
        color: #ffffff !important;
    }
</style>

<div class="page-wrapper text-start">

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Form Tambah Jenis -->
        <div class="col-md-4">
            <div class="card-custom">
                <div class="card-header-custom"><i class="bi bi-plus-circle me-1"></i> Tambah Jenis</div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('jenis.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold" style="color: var(--color-muted);">Nama Jenis Produk</label>
                            <input type="text" name="nama_jenis" class="form-control form-control-custom @error('nama_jenis') is-invalid @enderror" placeholder="Contoh: Makanan, Minuman" required>
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Jenis -->
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom"><i class="bi bi-list-stars me-1"></i> Daftar Jenis Produk</div>
                <div class="p-0">
                    <table class="table table-custom mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 60px;" class="text-center">No</th>
                                <th>Nama Jenis</th>
                                <th style="width: 120px;" class="text-center">Status</th>
                                <th style="width: 180px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisList as $index => $jenis)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="fw-bold" style="color: var(--color-primary);">{{ $jenis->nama_jenis }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-muted border px-2 py-1" style="font-weight: 500;">Tersedia</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit (Kuning) -->
                                            <button type="button" class="btn btn-edit-custom" data-bs-toggle="modal" data-bs-target="#editModal{{ $jenis->id }}">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus (Merah) -->
                                            <form action="{{ route('jenis.destroy', $jenis->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-hapus-custom">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $jenis->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $jenis->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--color-border);">
                                            <div class="modal-header" style="background-color: #FAFAFA; border-bottom: 1.5px solid var(--color-border);">
                                                <h5 class="modal-title fw-bold" style="color: var(--color-primary);" id="editModalLabel{{ $jenis->id }}">
                                                    Edit Jenis Produk
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('jenis.update', $jenis->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body p-4 text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold" style="color: var(--color-muted);">Nama Jenis Produk</label>
                                                        <input type="text" name="nama_jenis" class="form-control form-control-custom" value="{{ old('nama_jenis', $jenis->nama_jenis) }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border-top: 1px solid #EFEFEF;">
                                                    <button type="button" class="btn btn-secondary btn-sm rounded-3" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-custom btn-sm">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada data jenis produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection