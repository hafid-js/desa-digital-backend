<?php

namespace App\Support\Dummy;

use App\Enums\StatusLaporan;
use Illuminate\Support\Collection;

/**
 * Data laporan warga terhadap produk lapak (dummy).
 *
 * Diganti factory/seeders begitu tabelnya siap dipakai.
 */
final class LaporanProdukDummy
{
    /**
     * @return Collection<int, \stdClass>
     */
    public static function all(): Collection
    {
        return collect(self::laporanData());
    }

    /**
     * @return array<int, \stdClass>
     */
    private static function laporanData(): array
    {
        return [

            (object) [
                'id' => 1,
                'kode_laporan' => 'LPR-2026-0001',
                'produk_id' => 9,
                'nama_produk' => 'Vacuum Cleaner 2 In 1',
                'pelapor' => 'Sari Wulandari',
                'alasan' => 'Foto produk tidak sesuai',
                'catatan' => 'Foto utama masih foto vacuum cleaner berbeda dan deskripsi kurang jelas, layanan yang tidak dipesan belum dijelaskan.',
                'status' => StatusLaporan::Baru,
                'dibuat_pada' => now()->subHours(5),
            ],
            (object) [
                'id' => 2,
                'kode_laporan' => 'LPR-2026-0002',
                'produk_id' => 11,
                'nama_produk' => 'Motor Honda Beat 2020',
                'pelapor' => 'Fajar Nugroho',
                'alasan' => 'Informasi tidak sesuai',
                'catatan' => 'Harga yang tertera berbeda saat waktu ditawar, mohon ditinjau kembali.',
                'status' => StatusLaporan::Diproses,
                'dibuat_pada' => now()->subDays(2)->setTime(15, 20),
            ],
            (object) [
                'id' => 3,
                'kode_laporan' => 'LPR-2026-0003',
                'produk_id' => 5,
                'nama_produk' => 'Kursi Rotan Tamu',
                'pelapor' => 'Yuni Astuti',
                'alasan' => 'Barang tidak layak / rusak',
                'catatan' => 'Kursi lapuk dan goyah saat dipakai, kondisi berbeda dari foto.',
                'status' => StatusLaporan::Selesai,
                'dibuat_pada' => now()->subDays(4)->setTime(9, 45),
            ],
            (object) [
                'id' => 4,
                'kode_laporan' => 'LPR-2026-0004',
                'produk_id' => 2,
                'nama_produk' => 'Keripik Pisang Madu Kemasan 250gr',
                'pelapor' => 'Dedi Susanto',
                'alasan' => 'Penjual tidak bisa dihubungi',
                'catatan' => 'Nomor telepon tidak aktif sejak 3 hari terakhir.',
                'status' => StatusLaporan::Baru,
                'dibuat_pada' => now()->subDays(6)->setTime(12, 5),
            ],
            (object) [
                'id' => 5,
                'kode_laporan' => 'LPR-2026-0005',
                'produk_id' => 12,
                'nama_produk' => 'Gula Aren Cair 1 Liter',
                'pelapor' => 'Maya Lestari',
                'alasan' => 'Konten tidak pantas',
                'catatan' => 'Foto produk tidak jelas sama sekali, mohon ditambahkan foto yang lebih baik sebelum produk diaktifkan kembali.',
                'status' => StatusLaporan::Ditolak,
                'dibuat_pada' => now()->subDays(9)->setTime(18, 30),
            ],
        ];
    }
}
