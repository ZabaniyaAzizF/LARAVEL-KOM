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
        'kelas',
        'tingkat_kode',
        'ajaran_kode'
    ];

     // Define relationship with Pembayaran
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'kelas_kode', 'kode_kelas');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'kelas_kode', 'kode_kelas');
    }

    // Relation to Ajaran
    public function ajaran()
    {
        return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran');
    }

    // Relation to Ajaran
    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'tingkat_kode', 'kode_tingkat');
    }

}
