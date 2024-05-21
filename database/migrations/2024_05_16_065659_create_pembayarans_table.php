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
            $table->id('id_pembayaran');
            $table->string('spp_bulan');
            $table->string('ajaran_kode')->index();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->string('nis', 10);
            $table->string('kelas_kode')->index();
            $table->foreign('kelas_kode')->references('kode_kelas')->on('kelas')->onDelete('cascade'); // Foreign key to kelas table
            $table->string('jumlah');
            $table->string('jenis', 10)->nullable();
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
