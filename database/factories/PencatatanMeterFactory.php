<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\PencatatanMeter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PencatatanMeter>
 */
class PencatatanMeterFactory extends Factory
{
    protected $model = PencatatanMeter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $meterAwal = fake()->numberBetween(0, 500);
        $meterAkhir = $meterAwal + fake()->numberBetween(1, 100);
        $pemakaian = $meterAkhir - $meterAwal;

        return [
            'pelanggan_id' => Pelanggan::factory(),
            'periode' => fake()->date('Y-m'),
            'meter_awal' => $meterAwal,
            'meter_akhir' => $meterAkhir,
            'pemakaian' => $pemakaian,
            'petugas_id' => User::factory()->petugas(),
            'foto' => null,
        ];
    }
}
