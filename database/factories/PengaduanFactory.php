<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengaduan>
 */
class PengaduanFactory extends Factory
{
    protected $model = Pengaduan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pelanggan_id' => Pelanggan::factory(),
            'kategori' => fake()->randomElement(['air_mati', 'kebocoran', 'meter_rusak', 'lainnya']),
            'deskripsi' => fake()->paragraph(),
            'status' => 'baru',
            'tanggal' => fake()->dateTimeBetween('-30 days', 'now'),
            'catatan_admin' => null,
        ];
    }

    /**
     * Set the pengaduan status to diproses.
     */
    public function diproses(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diproses',
        ]);
    }

    /**
     * Set the pengaduan status to selesai.
     */
    public function selesai(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'selesai',
            'catatan_admin' => fake()->sentence(),
        ]);
    }
}
