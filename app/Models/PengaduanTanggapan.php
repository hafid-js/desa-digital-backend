<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaduanTanggapan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_tanggapans';

    protected $fillable = [
        'pengaduan_id',
        'tanggapan',
        'status_sebelum',
        'status_sesudah',
        'diberi_oleh',
    ];

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }
}
