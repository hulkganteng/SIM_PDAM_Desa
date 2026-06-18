<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\PencatatanMeter;
use App\Models\Pengaduan;
use App\Models\Tagihan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with aggregated metrics.
     */
    public function index(): View
    {
        $currentPeriode = now()->format('Y-m');

        $pelangganAktif = Pelanggan::active()->count();

        $pendapatanBulanIni = Pembayaran::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        $tagihanBelumBayar = Tagihan::belumBayar()->count();

        $pengaduanTerbuka = Pengaduan::open()->count();

        // Meter reading progress for current period
        $meterCompleted = PencatatanMeter::byPeriode($currentPeriode)->count();
        $meterTotal = $pelangganAktif;

        return view('dashboard.index', compact(
            'pelangganAktif',
            'pendapatanBulanIni',
            'tagihanBelumBayar',
            'pengaduanTerbuka',
            'meterCompleted',
            'meterTotal',
            'currentPeriode'
        ));
    }
}
