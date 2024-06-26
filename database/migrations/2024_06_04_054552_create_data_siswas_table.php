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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nama_siswa');
            $table->string('nis');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('kelas_kode')->index();
            $table->enum('status', ['aktif', 'dikeluarkan', 'keluar', 'pindah', 'lulus'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};
