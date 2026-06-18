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
        Schema::create('pencatatan_meter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->string('periode', 7);
            $table->unsignedInteger('meter_awal');
            $table->unsignedInteger('meter_akhir');
            $table->unsignedInteger('pemakaian');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('restrict');
            $table->string('foto', 255)->nullable();
            $table->timestamps();

            $table->unique(['pelanggan_id', 'periode'], 'pencatatan_meter_pelanggan_periode_unique');
            $table->index('periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_meter');
    }
};
