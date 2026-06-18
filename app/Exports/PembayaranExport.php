<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    public function __construct(
        private string $startDate,
        private string $endDate
    ) {
    }

    /**
     * Return the collection of payment data within the date range.
     */
    public function collection(): Collection
    {
        return Pembayaran::with('tagihan.pelanggan')
            ->whereBetween('tanggal', [$this->startDate, $this->endDate])
            ->get()
            ->map(fn($p) => [
                'Tanggal' => $p->tanggal->format('d/m/Y H:i'),
                'No Kuitansi' => $p->no_kuitansi,
                'Nama Pelanggan' => $p->tagihan->pelanggan->nama ?? '-',
                'Jumlah' => $p->jumlah,
                'Metode' => ucfirst($p->metode),
            ]);
    }

    /**
     * Define column headings for the Excel export.
     */
    public function headings(): array
    {
        return ['Tanggal', 'No Kuitansi', 'Nama Pelanggan', 'Jumlah', 'Metode'];
    }
}
