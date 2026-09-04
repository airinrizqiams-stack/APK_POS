@extends('layouts.app')

@section('title', 'Manajemen Jenis Produk')

@section('content')
@include('layouts.navbar')

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
    .table-custom thead th { background-color: #FAFAFA !important; color: var(--color-primary) !important; border-bottom: 1.5px solid var(--color-border) !important; font-weight: 700; }
</style>

<div class="page-wrapper text-start">
    @if(session('success'))
        <div class="alert alert-success border-0 mb-4 shadow-sm" style="border-radius: 8px;">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
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
                            <input type="text" name="nama_jenis" class="form-control form-control-custom" placeholder="Contoh: Makanan, Minuman" required>
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
                    <table class="table table-custom mb-0 vertical-align-middle">
                        <thead>
                            <tr>
                                <th style="width: 80px;" class="text-center">No</th>
                                <th>Nama Jenis</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisList as $index => $jenis)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="fw-bold" style="color: var(--color-primary);">{{ $jenis->nama_jenis }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-muted border">Tersedia</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data jenis produk.</td>
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
