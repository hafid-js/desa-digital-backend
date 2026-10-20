<?php

namespace App\Support\Dummy;

use Illuminate\Support\Collection;

/**
 * Data rincian APBDes (dummy).
 *
 * Diganti factory/seeders begitu tabelnya siap dipakai.
 */
final class ApbdesDummy
{
    /**
     * @return Collection<int, array<string, mixed>>
     */
    public static function all(): Collection
    {
        return collect(self::apbdesData());
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private static function apbdesData(): array
    {
        return [

            [
                'judul' => 'Pendapatan Asli Desa',
                'section' => 'Pendapatan',
                'jumlah_realisasi' => 149382400,
                'jumlah_target' => 373456000,
                'persentase' => 40.00,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Dana Desa',
                'section' => 'Pendapatan',
                'jumlah_realisasi' => 174647992,
                'jumlah_target' => 434491400,
                'persentase' => 40.20,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Bidang Penyelenggaraan Pemerintahan',
                'section' => 'Pembelanjaan',
                'jumlah_realisasi' => 173323325,
                'jumlah_target' => 642272557,
                'persentase' => 26.83,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Bidang Pelaksanaan Pembangunan Desa',
                'section' => 'Pembelanjaan',
                'jumlah_realisasi' => 63372100,
                'jumlah_target' => 369859500,
                'persentase' => 17.13,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Pelaksanaan Umum',
                'section' => 'Pelaksanaan',
                'jumlah_realisasi' => 280178925,
                'jumlah_target' => 1099315413,
                'persentase' => 25.49,
                'tahun_anggaran' => 2026,
            ],
        ];
    }
}
