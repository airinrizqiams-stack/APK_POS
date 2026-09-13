<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- 1. Tambahkan ini

class JenisController extends Controller
{
    public function index()
    {
        $jenisList = Jenis::all();
        return view('jenis.index', compact('jenisList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'user_id'    => Auth::id(), // <-- 2. Tambahkan user_id yang sedang login
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenis = Jenis::findOrFail($id);
        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jenis = Jenis::findOrFail($id);

        if ($jenis->produk()->count() > 0) {
            return redirect()->route('jenis.index')->with('error', 'Jenis tidak bisa dihapus karena masih digunakan oleh produk');
        }

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus');
    }
}