<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
<<<<<<< HEAD
use Illuminate\Support\Carbon;
=======
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d

class DashboardController extends Controller
{
   public function __construct(
    protected LaporanPenjualanService $laporanService,
    protected MonitoringStokService $stokService
) {}

public function index()
{
    $ringkasan = $this->laporanService->ringkasanHariIni();

    return view('dashboard', [
<<<<<<< HEAD
        'tanggalHariIni' => Carbon::now(),
        'ringkasan' => $ringkasan,
        'produkTerlaris' => $this->laporanService->produkTerlarisHariIni(),
=======
        'ringkasan' => $ringkasan,
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d
        'produkStokRendah' => $this->stokService->produkStokRendah(),
        'produkStokHabis' => $this->stokService->produkStokHabis(),
    ]);
}

}
