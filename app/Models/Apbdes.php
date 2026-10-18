<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    use HasFactory;

    protected $table = 'apbdes';

    protected $fillable = [
        'judul',
        'section',
        'jumlah_realisasi',
        'jumlah_target',
        'persentase',
        'tahun_anggaran',
    ];

    protected $casts = [
        'jumlah_realisasi' => 'integer',
        'jumlah_target' => 'integer',
        'persentase' => 'decimal:2',
        'tahun_anggaran' => 'integer',
    ];

    public const SECTION_PELAKSANAAN = 'pelaksanaan';

    public const SECTION_PENDAPATAN = 'pendapatan';

    public const SECTION_PEMBELANJAAN = 'pembelanjaan';

    public const SECTIONS = [
        self::SECTION_PELAKSANAAN,
        self::SECTION_PENDAPATAN,
        self::SECTION_PEMBELANJAAN,
    ];
}
