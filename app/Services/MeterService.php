<?php

namespace App\Services;

use App\Exceptions\InvalidMeterReadingException;
use App\Models\PencatatanMeter;
use Illuminate\Http\UploadedFile;

class MeterService
{
    /**
     * Get previous period's meter_akhir for auto-population.
     * Returns null if no previous reading exists.
     *
     * @param int $pelangganId Customer ID
     * @param string $currentPeriode Current period in YYYY-MM format
     * @return int|null Previous meter_akhir value or null
     */
    public function getPreviousMeterAkhir(int $pelangganId, string $currentPeriode): ?int
    {
        return PencatatanMeter::where('pelanggan_id', $pelangganId)
            ->where('periode', '<', $currentPeriode)
            ->orderBy('periode', 'desc')
            ->value('meter_akhir');
    }

    /**
     * Calculate pemakaian from meter readings.
     * Throws exception if result is negative.
     *
     * @param int $meterAwal Starting meter value
     * @param int $meterAkhir Ending meter value
     * @return int Calculated usage
     *
     * @throws InvalidMeterReadingException
     */
    public function calculatePemakaian(int $meterAwal, int $meterAkhir): int
    {
        $pemakaian = $meterAkhir - $meterAwal;

        if ($pemakaian < 0) {
            throw new InvalidMeterReadingException(
                "Meter akhir ({$meterAkhir}) tidak boleh kurang dari meter awal ({$meterAwal})"
            );
        }

        return $pemakaian;
    }

    /**
     * Validate that no duplicate reading exists for pelanggan/periode.
     *
     * @param int $pelangganId Customer ID
     * @param string $periode Period in YYYY-MM format
     * @param int|null $excludeId Record ID to exclude (for update scenarios)
     * @return bool True if a duplicate exists
     */
    public function isDuplicate(int $pelangganId, string $periode, ?int $excludeId = null): bool
    {
        $query = PencatatanMeter::where('pelanggan_id', $pelangganId)
            ->where('periode', $periode);

        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    /**
     * Store meter photo and return file path.
     *
     * @param UploadedFile $file Uploaded photo file
     * @param int $pelangganId Customer ID
     * @param string $periode Period in YYYY-MM format
     * @return string Stored file path
     */
    public function storePhoto(UploadedFile $file, int $pelangganId, string $periode): string
    {
        $filename = "{$periode}." . $file->getClientOriginalExtension();
        $path = $file->storeAs("meter-photos/{$pelangganId}", $filename, 'public');

        return $path;
    }
}
