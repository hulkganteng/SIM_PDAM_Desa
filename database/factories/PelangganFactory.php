<?php

namespace Database\Factories;

use App\Models\GolonganTarif;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pelanggan>
 */
class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_sambungan' => 'PDAM-' . str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'no_hp' => fake()->numerify('08##########'),
            'golongan_id' => GolonganTarif::factory(),
            'status' => 'aktif',
            'user_id' => null,
        ];
    }

    /**
     * Set the pelanggan status to nonaktif.
     */
    public function nonaktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'nonaktif',
        ]);
    }

    /**
     * Set the pelanggan status to diputus.
     */
    public function diputus(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diputus',
        ]);
    }
}
