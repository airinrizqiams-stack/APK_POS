@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>

<a href="" class="btn btn-primary mb-3">create</a>

<form action="" method="" class="mb-3">
    <div class="input-group">
        <input 
            type="text" 
            name="search" 
            value="" 
            class="form-control" 
            placeholder="Search nama produk"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
      <td>{{ $product->user->name }}</td>
      <td>{{ $product->foto }}</td>
      <td>{{ $product->nama }}</td>
      <td>{{ $product->harga_beli }}</td>
      <td>{{ $product->harga_jual }}</td>
      <td>{{ $product->stok }}</td>
      <td>
        <a href="" class="btn btn-warning">Edit</a>
        ||
        <form action="" method="" class="d-inline">
           @csrf
           @method('DELETE')
          <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
            Hapus
          </button>
    </form>
  </td>
</tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>John</td>
      <td>Doe</td>
      <td>@social</td>
    </tr>
  </tbody>
</table>

@endsection
