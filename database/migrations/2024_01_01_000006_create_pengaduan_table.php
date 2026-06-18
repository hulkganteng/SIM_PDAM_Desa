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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->enum('kategori', ['air_mati', 'kebocoran', 'meter_rusak', 'lainnya']);
            $table->text('deskripsi');
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->dateTime('tanggal');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
