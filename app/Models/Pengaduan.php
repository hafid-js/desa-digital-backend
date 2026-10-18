<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'kode_laporan',
        'nama_pelapor',
        'nik_pelapor',
        'wilayah',
        'latitude',
        'longitude',
        'rincian',
        'visibilitas',
        'status',
        'tanggapan',
        'waktu_kejadian',
        'lampiran_foto',
        'lampiran_pdf',
        'lampiran_video',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'waktu_kejadian' => 'datetime',
    ];

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_DIPROSES = 'diproses';

    public const STATUS_SELESAI = 'selesai';

    public const STATUS_DITOLAK = 'ditolak';

    public const STATUSES = [
        self::STATUS_DITERIMA,
        self::STATUS_DIPROSES,
        self::STATUS_SELESAI,
        self::STATUS_DITOLAK,
    ];

    public const VISIBILITAS_PRIVATE = 'private';

    public const VISIBILITAS_PUBLIC = 'public';

    public function tanggapans(): HasMany
    {
        return $this->hasMany(PengaduanTanggapan::class, 'pengaduan_id')
            ->orderBy('created_at', 'desc');
    }
}
