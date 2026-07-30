<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;

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
        'ringkasan' => $ringkasan,
        'produkStokRendah' => $this->stokService->produkStokRendah(),
        'produkStokHabis' => $this->stokService->produkStokHabis(),
    ]);
}

}
