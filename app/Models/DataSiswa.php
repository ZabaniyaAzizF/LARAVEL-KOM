<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $table = 'data_siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'id_siswa',
        'nama_siswa',
        'nis',
        'alamat',
        'telepon',
        'kelas_kode',
        'status',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_kode', 'kode_kelas');
    }

    public function ajaran()
    {
        return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran');
    }

}
