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
            $table->string('kode_pembayaran')->primary();
            $table->string('siswa_id')->nullable()->index();
            $table->string('nama_siswa');
            $table->string('nis');
            $table->string('kelas');
            $table->string('metode_kode')->nullable()->index();
            $table->string('nominal');
            $table->string('bulan');
            $table->string('bukti')->nullable();
            $table->enum('status', ['lunas', 'belum lunas'])->default('lunas');
            $table->string('petugas')->nullable();
            $table->timestamps();
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
