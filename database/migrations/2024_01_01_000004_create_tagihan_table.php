<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('pencatatan_meter_id')->constrained('pencatatan_meter')->onDelete('restrict');
            $table->string('periode', 7);
            $table->unsignedInteger('pemakaian');
            $table->decimal('tarif_per_m3', 12, 2);
            $table->decimal('biaya_beban', 12, 2);
            $table->decimal('denda', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->date('jatuh_tempo');
            $table->timestamps();

            $table->unique(['pelanggan_id', 'periode'], 'tagihan_pelanggan_periode_unique');
            $table->index('status');
            $table->index('jatuh_tempo');
            $table->index('periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
