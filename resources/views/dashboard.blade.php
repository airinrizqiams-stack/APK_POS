<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke tittle untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<div class="text-center">
    <div class="row">
        <div class="col-md-12">~
            <h1>Today's Sales</h1>
        </div>
        <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Total Nilai Penjualan Hari inij
        <div>
        <div class="card-body">
           <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
        </div>
      </div>
    </div>
        <div class="col-md-6">
            <h3>Jumlah Transaksi Hari ini</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>
        <div class="col-md-6">
            <h3>Total pembayaran tunai</h3>
        </div>
        <div class="col-md-6">
            <h3>Total pembayaran non-tunai</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>
        <div class="col-md-6">
            <h3>Daftar produk stok rendah</h3>
        </div>
        <div class="col-md-6">
            <h3>Produk habis stok</h3>
        </div>
    </div>
</div>

<!-- batas Akhir isi konten -->
@endsection