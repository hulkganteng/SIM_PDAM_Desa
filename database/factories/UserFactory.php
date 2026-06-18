<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['admin', 'petugas', 'kasir', 'pelanggan']),
            'status' => 'aktif',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Set the user role to admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * Set the user role to petugas.
     */
    public function petugas(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'petugas',
        ]);
    }

    /**
     * Set the user role to kasir.
     */
    public function kasir(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'kasir',
        ]);
    }

    /**
     * Set the user role to pelanggan.
     */
    public function pelanggan(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'pelanggan',
        ]);
    }

    /**
     * Set the user status to nonaktif.
     */
    public function nonaktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'nonaktif',
        ]);
    }
}
