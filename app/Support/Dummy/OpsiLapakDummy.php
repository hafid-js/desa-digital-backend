<?php

namespace App\Support\Dummy;

use Illuminate\Support\Collection;

/**
 * Master kategori, kondisi, dan lokasi produk lapak (dummy).
 *
 * Cerminan dari opsi lapak pada aplikasi warga.
 */
final class OpsiLapakDummy
{
    /**
     * @return Collection<int, \stdClass>
     */
    public static function kategori(): Collection
    {
        return collect(self::kategoriData());
    }

    /**
     * @return array<int, \stdClass>
     */
    private static function kategoriData(): array
    {
        return [
            (object) [
                'id' => 1,
                'nama' => 'Fashion & Pakaian',
                'jumlah_produk' => 24,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 2,
                'nama' => 'Kuliner & Olahan',
                'jumlah_produk' => 31,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 3,
                'nama' => 'Elektronik & Gadget',
                'jumlah_produk' => 18,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 4,
                'nama' => 'Hasil Bumi & Pertanian',
                'jumlah_produk' => 27,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 5,
                'nama' => 'Perlengkapan Rumah',
                'jumlah_produk' => 15,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 6,
                'nama' => 'Otomotif',
                'jumlah_produk' => 9,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 7,
                'nama' => 'Kerajinan & Souvenir',
                'jumlah_produk' => 22,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 8,
                'nama' => 'Lowongan Kerja & Jasa',
                'jumlah_produk' => 12,
                'is_aktif' => false,
            ],
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function kondisi(): array
    {
        return [
            'Baru',
            'Bekas - Seperti Baru',
            'Bekas - Bagus',
            'Bekas - Cukup',
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function lokasi(): array
    {
        return [
            'Dusun Krajan',
            'Dusun Kepudang',
            'Dusun Karangsari',
            'Dusun Kemplung',
            'Dusun Brembet',
            'Dusun Ngopeni',
            'Dusun Srigunting',
        ];
    }
}
