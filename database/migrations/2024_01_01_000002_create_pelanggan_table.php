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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('no_sambungan', 20)->unique();
            $table->string('nama', 255);
            $table->text('alamat');
            $table->string('no_hp', 20);
            $table->foreignId('golongan_id')->constrained('golongan_tarif')->onDelete('restrict');
            $table->enum('status', ['aktif', 'nonaktif', 'diputus'])->default('aktif');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
