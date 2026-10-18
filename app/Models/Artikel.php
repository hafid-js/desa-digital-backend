<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artikel extends Model
{
    protected $table = 'artikels';

    protected $fillable = [
        'judul_artikel',
        'isi_artikel',
    ];

    public function lampiran(): HasMany
    {
        return $this->hasMany(ArtikelLampiran::class, 'artikel_id')
            ->orderBy('urutan');
    }
}
