@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail Produk</h4>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Informasi Produk: {{ $produk->nama }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Bagian Foto Produk -->
                <div class="col-md-4 text-center mb-3">
                    @if(!empty($produk->foto))
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="img-fluid rounded img-thumbnail" style="max-height: 300px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded img-thumbnail" style="height: 250px;">
                            <span class="text-muted">Tidak Ada Foto</span>
                        </div>
                    @endif
                </div>

                <!-- Bagian Spesifikasi / Data -->
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="30%">Nama Produk</th>
                            <td>{{ $produk->nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga Beli</th>
                            <td>Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok Tersedia</th>
                            <td>
                                @if($produk->stok > 0)
                                    <span class="badge bg-success">{{ $produk->stok }} Pcs</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Diinput Oleh</th>
                            <td>{{ $produk->user->name ?? 'Sistem' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
