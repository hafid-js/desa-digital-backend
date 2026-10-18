<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaduanLampiran extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_lampiran';

    protected $fillable = [
        'pengaduan_id',
        'tipe',
        'path',
        'nama_asli',
        'urutan',
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

    public const TIPE_FOTO = 'foto';

    public const TIPE_PDF = 'pdf';

    public const TIPE_VIDEO = 'video';

    public const TIPES = [
        self::TIPE_FOTO,
        self::TIPE_PDF,
        self::TIPE_VIDEO,
    ];

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }
}
