<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tingkatan extends Model
{
    use HasFactory;

    protected $table = 'tingkatan';
    
    protected $primaryKey = 'kode_tingkat';
    protected $keyType = 'string'; // Tipe data primary key adalah string
    public $incrementing = false;
    protected $fillable = [
        'kode_tingkat',
        'tingkatan'
    ];

    // Define relationship with Pembayaran
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'kelas_tingkat', 'kode_tingkat');
    }

}
