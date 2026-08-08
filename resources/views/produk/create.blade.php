@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h4>Tambah Produk</h4>

<form action="{{ route('produk.store') }}"
      method="POST"
      ecytype="multipart/form-data">
@include('Produk._form')
</form>
@endsection
