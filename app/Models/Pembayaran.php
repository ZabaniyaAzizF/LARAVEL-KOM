<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        'id_pembayaran',
        'spp_bulan',
        'ajaran_kode',
        'user_id',
        'nis',
        'kelas_kode',
        'jumlah',
        'jenis',
        'bukti',
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

    // public function ajaran()
    // {
    //     return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran'); // Update 'kode' to 'kode_ajaran' or your actual column name
    // }
}
