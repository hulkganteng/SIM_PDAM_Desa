<?php

namespace App\Exports;

use App\Models\Tagihan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanExport implements FromCollection, WithHeadings
{
    public function __construct(private string $periode)
    {
    }

    /**
     * Return the collection of billing data for the given period.
     */
    public function collection(): Collection
    {
        return Tagihan::with('pelanggan')
            ->where('periode', $this->periode)
            ->get()
            ->map(fn($t) => [
                'No Sambungan' => $t->pelanggan->no_sambungan,
                'Nama' => $t->pelanggan->nama,
                'Pemakaian (m³)' => $t->pemakaian,
                'Total' => $t->total,
                'Denda' => $t->denda,
                'Status' => $t->status === 'lunas' ? 'Lunas' : 'Belum Bayar',
            ]);
    }

    /**
     * Define column headings for the Excel export.
     */
    public function headings(): array
    {
        return ['No Sambungan', 'Nama', 'Pemakaian (m³)', 'Total', 'Denda', 'Status'];
    }
}
