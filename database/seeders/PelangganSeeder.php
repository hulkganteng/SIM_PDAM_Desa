<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Seed the pelanggan table with sample customers.
     */
    public function run(): void
    {
        // Get golongan_tarif IDs
        $rumahTangga = DB::table('golongan_tarif')->where('nama', 'Rumah Tangga')->value('id');
        $sosial = DB::table('golongan_tarif')->where('nama', 'Sosial')->value('id');
        $komersial = DB::table('golongan_tarif')->where('nama', 'Komersial/Niaga')->value('id');

        // Get the pelanggan user (Budi Santoso) for linking
        $budiUserId = DB::table('users')->where('email', 'budi@gmail.com')->value('id');

        $pelanggan = [
            [
                'no_sambungan' => 'PDAM-0001',
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 10, RT 01/RW 02, Desa Sukamaju',
                'no_hp' => '081234567001',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => $budiUserId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0002',
                'nama' => 'Siti Rahayu',
                'alamat' => 'Jl. Kenanga No. 5, RT 02/RW 01, Desa Sukamaju',
                'no_hp' => '081234567002',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0003',
                'nama' => 'Ahmad Hidayat',
                'alamat' => 'Jl. Melati No. 12, RT 03/RW 02, Desa Sukamaju',
                'no_hp' => '081234567003',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0004',
                'nama' => 'Dewi Lestari',
                'alamat' => 'Jl. Anggrek No. 8, RT 01/RW 03, Desa Sukamaju',
                'no_hp' => '081234567004',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0005',
                'nama' => 'Hendra Wijaya',
                'alamat' => 'Jl. Mawar No. 3, RT 04/RW 01, Desa Sukamaju',
                'no_hp' => '081234567005',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0006',
                'nama' => 'Yayasan Panti Asuhan Kasih',
                'alamat' => 'Jl. Pahlawan No. 20, RT 01/RW 01, Desa Sukamaju',
                'no_hp' => '081234567006',
                'golongan_id' => $sosial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0007',
                'nama' => 'Masjid Al-Ikhlas',
                'alamat' => 'Jl. Raya Desa No. 1, RT 02/RW 01, Desa Sukamaju',
                'no_hp' => '081234567007',
                'golongan_id' => $sosial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0008',
                'nama' => 'Gereja HKBP Sukamaju',
                'alamat' => 'Jl. Harmoni No. 15, RT 03/RW 02, Desa Sukamaju',
                'no_hp' => '081234567008',
                'golongan_id' => $sosial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0009',
                'nama' => 'Toko Jaya Makmur',
                'alamat' => 'Jl. Pasar No. 7, RT 01/RW 04, Desa Sukamaju',
                'no_hp' => '081234567009',
                'golongan_id' => $komersial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0010',
                'nama' => 'Warung Makan Sederhana',
                'alamat' => 'Jl. Pasar No. 12, RT 01/RW 04, Desa Sukamaju',
                'no_hp' => '081234567010',
                'golongan_id' => $komersial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0011',
                'nama' => 'Rina Kusuma',
                'alamat' => 'Jl. Dahlia No. 9, RT 02/RW 03, Desa Sukamaju',
                'no_hp' => '081234567011',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0012',
                'nama' => 'Joko Susilo',
                'alamat' => 'Jl. Flamboyan No. 4, RT 03/RW 01, Desa Sukamaju',
                'no_hp' => '081234567012',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0013',
                'nama' => 'Wati Supriyati',
                'alamat' => 'Jl. Cempaka No. 6, RT 04/RW 02, Desa Sukamaju',
                'no_hp' => '081234567013',
                'golongan_id' => $rumahTangga,
                'status' => 'nonaktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0014',
                'nama' => 'Hotel Desa Permai',
                'alamat' => 'Jl. Raya Desa No. 25, RT 01/RW 01, Desa Sukamaju',
                'no_hp' => '081234567014',
                'golongan_id' => $komersial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0015',
                'nama' => 'Surya Pratama',
                'alamat' => 'Jl. Bougenville No. 11, RT 02/RW 03, Desa Sukamaju',
                'no_hp' => '081234567015',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0016',
                'nama' => 'Puskesmas Sukamaju',
                'alamat' => 'Jl. Kesehatan No. 2, RT 01/RW 02, Desa Sukamaju',
                'no_hp' => '081234567016',
                'golongan_id' => $sosial,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0017',
                'nama' => 'Bengkel Motor Jaya',
                'alamat' => 'Jl. Pasar No. 18, RT 02/RW 04, Desa Sukamaju',
                'no_hp' => '081234567017',
                'golongan_id' => $komersial,
                'status' => 'diputus',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_sambungan' => 'PDAM-0018',
                'nama' => 'Agus Setiawan',
                'alamat' => 'Jl. Teratai No. 14, RT 04/RW 03, Desa Sukamaju',
                'no_hp' => '081234567018',
                'golongan_id' => $rumahTangga,
                'status' => 'aktif',
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($pelanggan as $p) {
            DB::table('pelanggan')->updateOrInsert(
                ['no_sambungan' => $p['no_sambungan']],
                $p
            );
        }
    }
}
