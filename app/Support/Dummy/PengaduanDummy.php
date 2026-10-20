<?php

namespace App\Support\Dummy;

use App\Enums\StatusPengaduan;
use Illuminate\Support\Collection;

/**
 * Sumber data dummy pengaduan masyarakat.
 *
 * Diganti factory/seeders begitu tabel pengaduan siap dipakai.
 */
final class PengaduanDummy
{
    /**
     * @return Collection<int, \stdClass>
     */
    public static function all(): Collection
    {
        return collect(self::pengaduanData());
    }

    /**
     * @return array<int, \stdClass>
     */
    private static function pengaduanData(): array
    {
        return [

            (object) [
                'id' => 1,
                'kode_laporan' => 'PGD-2026-0001',
                'nama_pelapor' => 'Budi Santoso',
                'nik_pelapor' => '3201012345670001',
                'wilayah' => 'Dusun Krajan',
                'latitude' => -7.5432100,
                'longitude' => 110.1234500,
                'rincian' => 'Lampu jalan di jalan raya mati sejak 3 hari lalu, tempatnya di depan warung pak RT.',
                'visibilitas' => 'public',
                'status' => StatusPengaduan::Verifikasi,
                'tanggapan' => null,
                'waktu_kejadian' => now()->subDays(3),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            (object) [
                'id' => 2,
                'kode_laporan' => 'PGD-2026-0002',
                'nama_pelapor' => 'Siti Rahayu',
                'nik_pelapor' => '3201012345670002',
                'wilayah' => 'Dusun Ngopeni',
                'latitude' => -7.5500000,
                'longitude' => 110.1300000,
                'rincian' => 'Sampah menumpuk di depan pasar desa sejak kemarin, aroma sangat mengganggu.',
                'visibilitas' => 'public',
                'status' => StatusPengaduan::Diterima,
                'tanggapan' => null,
                'waktu_kejadian' => now()->subDays(2),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 3,
                'kode_laporan' => 'PGD-2026-0003',
                'nama_pelapor' => 'Ahmad Hidayat',
                'nik_pelapor' => '3201012345670003',
                'wilayah' => 'Dusun Ketapang',
                'latitude' => -7.5350000,
                'longitude' => 110.1150000,
                'rincian' => 'Jalan berlubang di gang RT 03, lubang cukup dalam dan berbahaya untuk kendaraan.',
                'visibilitas' => 'private',
                'status' => StatusPengaduan::Selesai,
                'tanggapan' => 'Lubang telah ditutup oleh petugas jalan raya.',
                'waktu_kejadian' => now()->subDays(5),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 4,
                'kode_laporan' => 'PGD-2026-0004',
                'nama_pelapor' => 'Dewi Lestari',
                'nik_pelapor' => '3201012345670004',
                'wilayah' => 'Dusun Srigunting',
                'latitude' => -7.5400000,
                'longitude' => 110.1250000,
                'rincian' => 'Air tidak mengalir di rumah sejak seminggu lalu, sumur telah kering.',
                'visibilitas' => 'public',
                'status' => StatusPengaduan::Ditolak,
                'tanggapan' => 'Permintaan ditolak karena tidak termasuk kewenangan desa.',
                'waktu_kejadian' => now()->subDays(7),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 5,
                'kode_laporan' => 'PGD-2026-0005',
                'nama_pelapor' => 'Joko Purwanto',
                'nik_pelapor' => '3201012345670005',
                'wilayah' => 'Dusun Krajan',
                'latitude' => -7.5432100,
                'longitude' => 110.1234500,
                'rincian' => 'Pohon besar tumbang menutup jalan raya setelah hujan lebat tadi malam.',
                'visibilitas' => 'public',
                'status' => StatusPengaduan::Diterima,
                'tanggapan' => null,
                'waktu_kejadian' => now()->subHours(12),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
        ];
    }
}
