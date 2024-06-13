<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'kode_pembayaran';
    protected $keyType = 'string'; // Tipe data primary key adalah string
    public $incrementing = false;
    protected $fillable = [
        'kode_pembayaran',
        'bulan',
        'nama_siswa',
        'nis',
        'kelas',
        'metode_kode',
        'bukti',
        'nominal',
        'status',
        'petugas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_kode', 'kode_kelas');
    }

    public function ajaran()
    {
        return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran'); // Update 'kode' to 'kode_ajaran' or your actual column name
    }

    public function metode()
    {
        return $this->belongsTo(Metode::class, 'metode_kode', 'kode_metode');
    }

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'siswa_id', 'id_siswa');
    }
}
