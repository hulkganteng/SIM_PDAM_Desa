<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of customer data.
     */
    public function collection(): Collection
    {
        return Pelanggan::with('golonganTarif')
            ->get()
            ->map(fn($p) => [
                'No Sambungan' => $p->no_sambungan,
                'Nama' => $p->nama,
                'Alamat' => $p->alamat,
                'Golongan' => $p->golonganTarif->nama ?? '-',
                'Status' => ucfirst($p->status),
            ]);
    }

    /**
     * Define column headings for the Excel export.
     */
    public function headings(): array
    {
        return ['No Sambungan', 'Nama', 'Alamat', 'Golongan', 'Status'];
    }
}
