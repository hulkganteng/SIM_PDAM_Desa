<?php

namespace Tests\Feature;

use App\Models\GolonganTarif;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\PencatatanMeter;
use App\Models\Pengaduan;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FactoryValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_factory_creates_valid_model(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['id' => $user->id]);
        $this->assertContains($user->role, ['admin', 'petugas', 'kasir', 'pelanggan']);
        $this->assertContains($user->status, ['aktif', 'nonaktif']);
    }

    public function test_golongan_tarif_factory_creates_valid_model(): void
    {
        $tarif = GolonganTarif::factory()->create();

        $this->assertDatabaseHas('golongan_tarif', ['id' => $tarif->id]);
        $this->assertGreaterThanOrEqual(0, (float) $tarif->tarif_per_m3);
        $this->assertGreaterThanOrEqual(0, (float) $tarif->biaya_beban);
        $this->assertGreaterThanOrEqual(0, (float) $tarif->denda);
    }

    public function test_pelanggan_factory_creates_valid_model(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $this->assertDatabaseHas('pelanggan', ['id' => $pelanggan->id]);
        $this->assertNotEmpty($pelanggan->no_sambungan);
        $this->assertContains($pelanggan->status, ['aktif', 'nonaktif', 'diputus']);
        $this->assertNotNull($pelanggan->golongan_id);
    }

    public function test_pencatatan_meter_factory_creates_valid_model(): void
    {
        $meter = PencatatanMeter::factory()->create();

        $this->assertDatabaseHas('pencatatan_meter', ['id' => $meter->id]);
        $this->assertGreaterThanOrEqual($meter->meter_awal, $meter->meter_akhir);
        $this->assertEquals($meter->meter_akhir - $meter->meter_awal, $meter->pemakaian);
    }

    public function test_tagihan_factory_creates_valid_model(): void
    {
        $tagihan = Tagihan::factory()->create();

        $this->assertDatabaseHas('tagihan', ['id' => $tagihan->id]);
        $this->assertContains($tagihan->status, ['belum_bayar', 'lunas']);
        $this->assertNotNull($tagihan->jatuh_tempo);
    }

    public function test_pembayaran_factory_creates_valid_model(): void
    {
        $pembayaran = Pembayaran::factory()->create();

        $this->assertDatabaseHas('pembayaran', ['id' => $pembayaran->id]);
        $this->assertNotEmpty($pembayaran->no_kuitansi);
        $this->assertContains($pembayaran->metode, ['tunai', 'transfer', 'qris']);
    }

    public function test_pengaduan_factory_creates_valid_model(): void
    {
        $pengaduan = Pengaduan::factory()->create();

        $this->assertDatabaseHas('pengaduan', ['id' => $pengaduan->id]);
        $this->assertContains($pengaduan->kategori, ['air_mati', 'kebocoran', 'meter_rusak', 'lainnya']);
        $this->assertContains($pengaduan->status, ['baru', 'diproses', 'selesai']);
    }
}
