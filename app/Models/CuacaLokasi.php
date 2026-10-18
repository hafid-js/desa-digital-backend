<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuacaLokasi extends Model
{
    use HasFactory;

    protected $table = 'cuaca_lokasi';

    protected $fillable = [
        'nama',
        'latitude',
        'longitude',
        'is_aktif',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_aktif' => 'boolean',
    ];
}
