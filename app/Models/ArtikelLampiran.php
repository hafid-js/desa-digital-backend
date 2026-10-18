<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtikelLampiran extends Model
{
    protected $table = 'artikel_lampiran';

    protected $fillable = [
        'artikel_id',
        'path',
        'nama_asli',
        'urutan',
    ];

    public function artikel(): BelongsTo
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }
}
