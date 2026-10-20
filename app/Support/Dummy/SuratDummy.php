<?php

namespace App\Support\Dummy;

use App\Enums\StatusSurat;
use Illuminate\Support\Collection;

/**
 * Data permohonan surat (dummy).
 *
 * Diganti factory/seeders begitu tabelnya siap dipakai.
 */
final class SuratDummy
{
    /**
     * @return Collection<int, \stdClass>
     */
    public static function all(): Collection
    {
        return collect(self::suratData());
    }

    /**
     * @return array<int, \stdClass>
     */
    private static function suratData(): array
    {
        return [

            (object) [
                'id' => 1,
                'kode_surat' => 'S-41',
                'nama_surat' => 'Surat Keterangan Domisili',
                'mandiri' => true,
                'nama_pemohon' => 'Budi Santoso',
                'nik' => '3201012345670001',
                'wilayah' => 'Dusun Krajan',
                'keperluan' => 'Persyaratan pendaftaran sekolah anak',
                'status' => StatusSurat::Diajukan,
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subHours(6),
            ],
            (object) [
                'id' => 2,
                'kode_surat' => 'S-17',
                'nama_surat' => 'Surat Keterangan Kelahiran',
                'mandiri' => false,
                'nama_pemohon' => 'Siti Rahayu',
                'nik' => '3201012345670002',
                'wilayah' => 'Dusun Kepudang',
                'keperluan' => 'Pengajuan akta kelahiran anak',
                'status' => StatusSurat::Diverifikasi,
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(1)->setTime(10, 20),
            ],
            (object) [
                'id' => 3,
                'kode_surat' => 'S-21',
                'nama_surat' => 'Surat Keterangan Kematian',
                'mandiri' => false,
                'nama_pemohon' => 'Ahmad Hidayat',
                'nik' => '3201012345670003',
                'wilayah' => 'Dusun Karangsari',
                'keperluan' => 'Peng mengurus surat keterangan kematian',
                'status' => StatusSurat::Diproses,
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(2)->setTime(9, 0),
            ],
            (object) [
                'id' => 4,
                'kode_surat' => 'S-41',
                'nama_surat' => 'Surat Keterangan Domisili',
                'mandiri' => true,
                'nama_pemohon' => 'Dewi Lestari',
                'nik' => '3201012345670004',
                'wilayah' => 'Dusun Kemplung',
                'keperluan' => 'Pengajuan bantuan sosial',
                'status' => StatusSurat::Selesai,
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(4)->setTime(14, 35),
            ],
            (object) [
                'id' => 5,
                'kode_surat' => 'S-22',
                'nama_surat' => 'Surat Pernyataan Tidak Mampu',
                'mandiri' => false,
                'nama_pemohon' => 'Joko Purwanto',
                'nik' => '3201012345670005',
                'wilayah' => 'Dusun Brembet',
                'keperluan' => 'Syarat pengajuan beasiswa-putri',
                'status' => StatusSurat::Diajukan,
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(6)->setTime(8, 45),
            ],
            (object) [
                'id' => 6,
                'kode_surat' => 'S-05',
                'nama_surat' => 'Surat Pengantar Kerja',
                'mandiri' => false,
                'nama_pemohon' => 'Rizal Ramadhan',
                'nik' => '3201012345670006',
                'wilayah' => 'Dusun Ngopeni',
                'keperluan' => 'Persyaratan pengajuan izin usaha',
                'status' => StatusSurat::Ditolak,
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(9)->setTime(11, 10),
            ],
        ];
    }
}
