<?php

namespace App\Services;

use App\Models\GolonganTarif;
use App\Models\PencatatanMeter;
use App\Models\Tagihan;

class BillingService
{
    /**
     * Calculate bill total for a single meter reading.
     * Formula: (pemakaian × tarif_per_m3) + biaya_beban
     *
     * @param int $pemakaian Usage in cubic meters
     * @param GolonganTarif $tarif The tariff group
     * @return float Calculated total
     */
    public function calculateTotal(int $pemakaian, GolonganTarif $tarif): float
    {
        return ($pemakaian * $tarif->tarif_per_m3) + $tarif->biaya_beban;
    }

    /**
     * Generate bills for all customers with meter readings in the given period.
     * Skips customers already billed (idempotent).
     *
     * @param string $periode Billing period in YYYY-MM format
     * @param int $dueDays Number of days until due date (default 20)
     * @return array{created: int, skipped: int} Counts of created and skipped bills
     */
    public function generateForPeriod(string $periode, int $dueDays = 20): array
    {
        $results = ['created' => 0, 'skipped' => 0];

        $readings = PencatatanMeter::where('periode', $periode)
            ->whereDoesntHave('tagihan')
            ->with('pelanggan.golonganTarif')
            ->get();

        foreach ($readings as $reading) {
            $tarif = $reading->pelanggan->golonganTarif;
            $total = $this->calculateTotal($reading->pemakaian, $tarif);

            Tagihan::create([
                'pelanggan_id' => $reading->pelanggan_id,
                'pencatatan_meter_id' => $reading->id,
                'periode' => $periode,
                'pemakaian' => $reading->pemakaian,
                'tarif_per_m3' => $tarif->tarif_per_m3,
                'biaya_beban' => $tarif->biaya_beban,
                'denda' => 0,
                'total' => $total,
                'status' => 'belum_bayar',
                'jatuh_tempo' => now()->addDays($dueDays)->toDateString(),
            ]);
            $results['created']++;
        }

        return $results;
    }

    /**
     * Apply penalties to all overdue bills (past jatuh_tempo, still belum_bayar).
     * Only applies once per bill (denda must be 0).
     *
     * @return int Number of penalties applied
     */
    public function applyPenalties(): int
    {
        $overdueTagihan = Tagihan::where('status', 'belum_bayar')
            ->where('jatuh_tempo', '<', now())
            ->where('denda', 0)
            ->with('pelanggan.golonganTarif')
            ->get();

        $count = 0;
        foreach ($overdueTagihan as $tagihan) {
            $dendaAmount = $tagihan->pelanggan->golonganTarif->denda;
            $tagihan->update([
                'denda' => $dendaAmount,
                'total' => $tagihan->total + $dendaAmount,
            ]);
            $count++;
        }

        return $count;
    }

    /**
     * Check if a bill is overdue.
     *
     * @param Tagihan $tagihan The bill to check
     * @return bool True if the bill is unpaid and past due date
     */
    public function isOverdue(Tagihan $tagihan): bool
    {
        return $tagihan->status === 'belum_bayar' && $tagihan->jatuh_tempo->lt(now());
    }
}
