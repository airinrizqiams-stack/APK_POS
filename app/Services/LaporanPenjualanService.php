<?php

namespace App\Services;

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
=======
// Tambahkan kedua baris ini di atas class
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d

class LaporanPenjualanService
{
    public function ringkasanHariIni(): array
    {
<<<<<<< HEAD
=======
        // Pastikan DB di bawah ini menggunakan huruf kapital yang benar
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d
        $data = DB::table('penjualan')
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'COMPLETED')
            ->selectRaw('
                COUNT(*) as total_transaksi,
                SUM(total_pembayaran) as total_penjualan,
                SUM(CASE WHEN metode_pembayaran = "CASH" THEN total_pembayaran ELSE 0 END) as total_cash,
                SUM(CASE WHEN metode_pembayaran != "CASH" THEN total_pembayaran ELSE 0 END) as total_non_tunai
            ')
            ->first();

<<<<<<< HEAD
        return [
            'total_transaksi' => $data->total_transaksi ?? 0,
            'total_penjualan' => $data->total_penjualan ?? 0,
            'total_cash' => $data->total_cash ?? 0,
            'total_non_tunai' => $data->total_non_tunai ?? 0,
        ];
    }

    public function produkTerlarisHariIni(int $limit = 5)
    {
        return DB::table('item_penjualan')
           ->join('penjualan', 'penjualan.id', '=', 'item_penjualan.penjualan_id')
           ->join('produk', 'produk.id', '=', 'item_penjualan.produk_id')
           ->whereDate('penjualan.created_at', Carbon::today())
           ->where('penjualan.status', 'COMPLETED')
           ->groupBy('produk.id', 'produk.nama')
           ->select(
                'produk.nama',
                'produk.stok',
                DB::raw('SUM(item_penjualan.kuantitas) as total_terjual')
            )
            ->orderByDesc('total_terjual')
            ->limit($limit)
            ->get();
=======
        // Ubah objek StdClass menjadi array agar sesuai dengan return type array
        return (array) $data;
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d
    }
}
