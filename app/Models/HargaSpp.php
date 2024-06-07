<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HargaSpp extends Model
{
    use HasFactory;

    protected $table = 'harga_spp';
    
    protected $primaryKey = 'id_spp';
    protected $fillable = [
        'nominal',
        'ajaran_kode',
        'metode_kode',
    ];

    // Relation to Ajaran
    public function ajaran()
    {
        return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran');
    }

    // Relation to Ajaran
    public function metode()
    {
        return $this->belongsTo(Metode::class, 'metode_kode', 'kode_metode');
    }

}
