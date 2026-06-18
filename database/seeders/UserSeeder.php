<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table with accounts for all roles.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@pdam.desa',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas Lapangan',
                'email' => 'petugas@pdam.desa',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir Loket',
                'email' => 'kasir@pdam.desa',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('pelanggan123'),
                'role' => 'pelanggan',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
