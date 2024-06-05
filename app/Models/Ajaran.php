<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ajaran extends Model
{
    use HasFactory;

    protected $table = 'ajaran';
    
    protected $primaryKey = 'kode_ajaran';
    protected $keyType = 'string'; // Tipe data primary key adalah string
    public $incrementing = false;
    protected $fillable = [
        'kode_ajaran',
        'tahun_ajaran',
        'status'
    ];

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'ajaran_kode', 'kode_ajaran');
    }

    // Relation to Students
    public function user()
    {
        return $this->hasMany(User::class, 'ajaran_kode', 'kode_ajaran');
    }

    public function harga(): HasMany
    {
        return $this->hasMany(HargaSpp::class, 'ajaran_kode', 'kode_ajaran');
    }

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'ajaran_kode', 'kode_ajaran');
    }

}
