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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihan')->onDelete('restrict');
            $table->string('no_kuitansi', 30)->unique();
            $table->dateTime('tanggal');
            $table->decimal('jumlah', 12, 2);
            $table->enum('metode', ['tunai', 'transfer', 'qris']);
            $table->foreignId('kasir_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();

            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
