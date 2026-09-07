<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    // 1. Tampilkan Halaman Daftar Jenis
    public function index()
    {
        $jenisList = Jenis::all();
        return view('jenis.index', compact('jenisList'));
    }

    // 2. Simpan Data Jenis Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan');
    }
}
