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
        'kelas_kode',
    ];
}
