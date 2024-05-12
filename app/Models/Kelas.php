<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $primaryKey = 'kode_kelas';
    protected $keyType = 'string'; // Tipe data primary key adalah string
    public $incrementing = false;
    protected $fillable = [
        'kode_kelas',
        'kelas'
    ];

    public function Siswa(): HasMany{
        return $this->hasMany(siswa::class, 'kelas_kode', 'kode_kelas');
     }

}
