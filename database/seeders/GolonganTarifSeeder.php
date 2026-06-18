<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganTarifSeeder extends Seeder
{
    /**
     * Seed the golongan_tarif table with default tariff groups.
     */
    public function run(): void
    {
        $tarifs = [
            [
                'nama' => 'Rumah Tangga',
                'tarif_per_m3' => 3500,
                'biaya_beban' => 10000,
                'denda' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sosial',
                'tarif_per_m3' => 2500,
                'biaya_beban' => 7500,
                'denda' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Komersial/Niaga',
                'tarif_per_m3' => 7500,
                'biaya_beban' => 25000,
                'denda' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tarifs as $tarif) {
            DB::table('golongan_tarif')->updateOrInsert(
                ['nama' => $tarif['nama']],
                $tarif
            );
        }
    }
}
