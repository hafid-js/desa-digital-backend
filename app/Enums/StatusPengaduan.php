<?php

namespace App\Enums;

enum StatusPengaduan: string
{
    case Diterima = 'diterima';
    case Verifikasi = 'verifikasi';
    case Diproses = 'diproses';
    case Selesai = 'selesai';
    case Ditolak = 'ditolak';

    /**
     * Label yang ditampilkan di tabel dan badge.
     */
    public function label(): string
    {
        return ucfirst($this->value);
    }

    /**
     * Warna badge (prefix kelas Tailwind Tabler).
     */
    public function color(): string
    {
        return match ($this) {
            self::Diterima => 'blue',
            self::Verifikasi => 'cyan',
            self::Diproses => 'orange',
            self::Selesai => 'green',
            self::Ditolak => 'red',
        };
    }

    /**
     * Status yang masih perlu ditindaklanjuti petugas.
     *
     * @return array<int, self>
     */
    public static function perluTindakLanjut(): array
    {
        return [self::Diterima, self::Verifikasi];
    }
}
