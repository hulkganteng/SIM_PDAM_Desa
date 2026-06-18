<?php

namespace App\Services;

use App\Models\Pelanggan;

class PelangganService
{
    /**
     * Generate unique no_sambungan.
     * Format: PDAM-XXXX (zero-padded sequential, never resets).
     *
     * @return string Generated connection number
     */
    public function generateNoSambungan(): string
    {
        $lastPelanggan = Pelanggan::orderByRaw("CAST(SUBSTRING(no_sambungan, 6) AS UNSIGNED) DESC")
            ->value('no_sambungan');

        if ($lastPelanggan) {
            $lastNumber = (int) substr($lastPelanggan, 5); // Extract number after "PDAM-"
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return 'PDAM-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Check if customer can be deactivated/disconnected.
     * Returns false if customer has any unpaid bills.
     *
     * @param Pelanggan $pelanggan The customer to check
     * @return bool True if customer can be disconnected
     */
    public function canDisconnect(Pelanggan $pelanggan): bool
    {
        return !$pelanggan->tagihans()
            ->where('status', 'belum_bayar')
            ->exists();
    }
}
