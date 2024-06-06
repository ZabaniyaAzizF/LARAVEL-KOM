<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class DataSiswa extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'data_siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'id_siswa',
        'nama_siswa',
        'nis',
        'kelas_kode',
    ];

    // Menetapkan guard yang digunakan
    protected $guard_name = 'web';

}
