<?php

namespace App\Services;

// Tambahkan kedua baris ini di atas class
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LaporanPenjualanService
{
    public function ringkasanHariIni(): array
    {
        // Pastikan DB di bawah ini menggunakan huruf kapital yang benar
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

        // Ubah objek StdClass menjadi array agar sesuai dengan return type array
        return (array) $data;
    }
}
