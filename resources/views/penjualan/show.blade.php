@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail Transaksi #{{ $penjualan->id }}</h4>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    {{-- Informasi Utama Transaksi --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p class="mb-1 text-muted">Tanggal Transaksi</p>
                    <h6 class="fw-bold">{{ $penjualan->created_at->format('d-m-Y H:i:s') }}</h6>
                </div>
                <div class="col-md-4">
                    <p class="mb-1 text-muted">Kasir</p>
                    <h6 class="fw-bold">{{ $penjualan->user->name ?? 'Tidak Diketahui' }}</h6>
                </div>
                <div class="col-md-4">
                    <p class="mb-1 text-muted">Metode Pembayaran / Status</p>
                    <h6>
                        <span class="badge bg-secondary">{{ $penjualan->metode_pembayaran ?? '-' }}</span>
                        <span class="badge {{ $penjualan->status === 'COMPLETED' ? 'bg-success' : 'bg-warning' }}">
                            {{ $penjualan->status }}
                        </span>
                    </h6>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Item Produk yang Dibeli --}}
    <div class="card">
        <div class="card-header fw-bold">Item yang Dibeli</div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah (Qty)</th>
                        <th class="text-end pe-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->itemPenjualan as $item)
                    <tr>
                        <td class="ps-3">{{ $item->produk->nama }}</td>
                        <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                        <td>{{ $item->kuantitas }}</td>
                        <td class="text-end pe-3">Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-dark">
                        <td colspan="3" class="text-end fw-bold ps-3">Total Pembayaran:</td>
                        <td class="text-end pe-3 fw-bold">Rp {{ number_format($penjualan->total_pembayaran) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
