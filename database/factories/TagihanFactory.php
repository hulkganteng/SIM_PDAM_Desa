<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\PencatatanMeter;
use App\Models\Tagihan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tagihan>
 */
class TagihanFactory extends Factory
{
    protected $model = Tagihan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pemakaian = fake()->numberBetween(1, 100);
        $tarifPerM3 = fake()->randomFloat(2, 1.00, 50.00);
        $biayaBeban = fake()->randomFloat(2, 5.00, 100.00);
        $denda = 0;
        $total = ($pemakaian * $tarifPerM3) + $biayaBeban + $denda;

        return [
            'pelanggan_id' => Pelanggan::factory(),
            'pencatatan_meter_id' => PencatatanMeter::factory(),
            'periode' => fake()->date('Y-m'),
            'pemakaian' => $pemakaian,
            'tarif_per_m3' => $tarifPerM3,
            'biaya_beban' => $biayaBeban,
            'denda' => $denda,
            'total' => $total,
            'status' => 'belum_bayar',
            'jatuh_tempo' => fake()->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
        ];
    }

    /**
     * Set the tagihan status to lunas.
     */
    public function lunas(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'lunas',
        ]);
    }

    /**
     * Set jatuh_tempo to a past date (overdue).
     */
    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'jatuh_tempo' => fake()->dateTimeBetween('-30 days', '-1 days')->format('Y-m-d'),
        ]);
    }
}
