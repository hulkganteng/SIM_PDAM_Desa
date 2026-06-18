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
        Schema::create('golongan_tarif', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->unique();
            $table->decimal('tarif_per_m3', 12, 2)->unsigned();
            $table->decimal('biaya_beban', 12, 2)->unsigned();
            $table->decimal('denda', 12, 2)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongan_tarif');
    }
};
