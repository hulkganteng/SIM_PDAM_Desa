<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use App\Models\PencatatanMeter;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerUsageAndBulkPrintTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_own_usage_history(): void
    {
        $user = User::factory()->pelanggan()->create();
        $pelanggan = Pelanggan::factory()->create(['user_id' => $user->id]);

        PencatatanMeter::factory()->create([
            'pelanggan_id' => $pelanggan->id,
            'periode' => '2026-01',
            'meter_awal' => 100,
            'meter_akhir' => 125,
            'pemakaian' => 25,
        ]);

        $this->actingAs($user)
            ->get(route('portal.pemakaian'))
            ->assertOk()
            ->assertSee('Riwayat Pemakaian')
            ->assertSee('2026-01')
            ->assertSee('25 m3');
    }

    public function test_operational_user_can_print_bulk_bills_for_period(): void
    {
        $user = User::factory()->kasir()->create();
        $pelanggan = Pelanggan::factory()->create();
        $meter = PencatatanMeter::factory()->create([
            'pelanggan_id' => $pelanggan->id,
            'periode' => '2026-02',
            'pemakaian' => 18,
        ]);

        Tagihan::factory()->create([
            'pelanggan_id' => $pelanggan->id,
            'pencatatan_meter_id' => $meter->id,
            'periode' => '2026-02',
            'pemakaian' => 18,
            'total' => 50000,
        ]);

        $this->actingAs($user)
            ->get(route('tagihan.cetakMassal', ['periode' => '2026-02']))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }
}
