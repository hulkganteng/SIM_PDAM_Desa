<?php

namespace Database\Factories;

use App\Models\GolonganTarif;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GolonganTarif>
 */
class GolonganTarifFactory extends Factory
{
    protected $model = GolonganTarif::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->unique()->words(2, true),
            'tarif_per_m3' => fake()->randomFloat(2, 1.00, 50.00),
            'biaya_beban' => fake()->randomFloat(2, 5.00, 100.00),
            'denda' => fake()->randomFloat(2, 5.00, 25.00),
        ];
    }
}
