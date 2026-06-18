<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pembayaran>
 */
class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggal = fake()->dateTimeBetween('-30 days', 'now');
        $dailySequence = fake()->unique()->numberBetween(1, 9999);

        return [
            'tagihan_id' => Tagihan::factory(),
            'no_kuitansi' => 'KWT-' . $tanggal->format('Ymd') . '-' . str_pad($dailySequence, 4, '0', STR_PAD_LEFT),
            'tanggal' => $tanggal,
            'jumlah' => fn (array $attributes) => Tagihan::find($attributes['tagihan_id'])?->total ?? fake()->randomFloat(2, 10.00, 5000.00),
            'metode' => fake()->randomElement(['tunai', 'transfer', 'qris']),
            'kasir_id' => User::factory()->kasir(),
        ];
    }
}
