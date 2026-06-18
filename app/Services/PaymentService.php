<?php

namespace App\Services;

use App\Exceptions\InvalidPaymentException;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Collection;

class PaymentService
{
    /**
     * Process payment: validate tagihan status, create pembayaran record,
     * update tagihan status to lunas.
     *
     * @param Tagihan $tagihan The bill to pay
     * @param string $metode Payment method (tunai, transfer, qris)
     * @param int $kasirId Cashier user ID
     * @return Pembayaran The created payment record
     *
     * @throws InvalidPaymentException
     */
    public function processPayment(Tagihan $tagihan, string $metode, int $kasirId): Pembayaran
    {
        if ($tagihan->status === 'lunas') {
            throw new InvalidPaymentException(
                "Tagihan sudah lunas dan tidak dapat dibayar ulang."
            );
        }

        $noKuitansi = $this->generateReceiptNumber();

        $pembayaran = Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'no_kuitansi' => $noKuitansi,
            'tanggal' => now(),
            'jumlah' => $tagihan->total,
            'metode' => $metode,
            'kasir_id' => $kasirId,
        ]);

        $tagihan->update(['status' => 'lunas']);

        return $pembayaran;
    }

    /**
     * Generate unique receipt number.
     * Format: KWT-YYYYMMDD-XXXX (sequential daily counter).
     *
     * @return string Generated receipt number
     */
    public function generateReceiptNumber(): string
    {
        $today = now()->format('Ymd');

        $count = Pembayaran::whereDate('tanggal', now()->toDateString())->count();

        $sequence = str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        return "KWT-{$today}-{$sequence}";
    }

    /**
     * Search tagihan by no_sambungan or customer name.
     *
     * @param string $query Search query
     * @return Collection Matching tagihan with pelanggan relationship
     */
    public function searchTagihan(string $query): Collection
    {
        return Tagihan::whereHas('pelanggan', function ($q) use ($query) {
            $q->where('no_sambungan', 'LIKE', "%{$query}%")
              ->orWhere('nama', 'LIKE', "%{$query}%");
        })
        ->with('pelanggan')
        ->get();
    }
}
