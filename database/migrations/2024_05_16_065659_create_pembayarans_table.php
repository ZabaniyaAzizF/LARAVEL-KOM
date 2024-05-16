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
            $table->string('ajaran_kode');
            $table->string('id')->index();
            $table->string('kelas_kode')->index();
            $table->string('jumlah');
            $table->enum('jenis', ['cash', 'transfer'])->default('cash');
            $table->string('subtotal');
            $table->string('bukti');
            $table->enum('status', ['lunas', 'belum lunas'])->default('lunas');
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
