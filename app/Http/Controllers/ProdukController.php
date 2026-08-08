<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

         if ($keyword) {
        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
        ->orderBy('nama')
        ->paginate(10)
        ->withQueryString();
    } else {
        $products = Produk::latest()->paginate(10)->withQueryString();
    }

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Mengambil data yang sudah lolos validasi dari StoreRequest
        $dataReq = $request->validated();

        $data['user_id'] = Auth::id();
        $data['nama'] = $dataReq['name'];
        $data['harga_beli'] = $dataReq['purchase_price'];
        $data['harga_plat'] = $dataReq['selling_price']; // Pastikan di database namanya 'harga_plat' bukan 'harga_jual'
        $data['stok'] = $dataReq['stock']; // Disederhanakan karena stock sudah pasti wajib diisi (required)

        // Logika upload file foto jika user memilih file
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        } // Tanda kurung kurawal ini sekarang sejajar dan menutup blok 'if' dengan benar

        // Menyimpan data ke database
        Produk::create($data);

        // Mengarahkan kembali ke halaman index produk admin
        return redirect()->route('produk.index')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
