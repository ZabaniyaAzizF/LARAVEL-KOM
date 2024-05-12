<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'id_siswa',
        'kelas_kode',
        'nis',
        'nama_siswa',
        'telepon',
        'alamat'
    ];

    public function Kelas(): BelongsTo{
        return $this->belongsTo(kelas::class, 'kelas_kode', 'kode_kelas');
    }
}
