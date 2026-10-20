<?php

namespace App\Enums;

enum StatusSurat: string
{
    case Diajukan = 'diajukan';
    case Diverifikasi = 'diverifikasi';
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
            self::Diajukan, self::Diverifikasi => 'blue',
            self::Diproses => 'orange',
            self::Selesai => 'green',
            self::Ditolak => 'red',
        };
    }

    /**
     * Status yang masih berjalan di perangkat desa.
     *
     * @return array<int, self>
     */
    public static function perluProses(): array
    {
        return [self::Diajukan, self::Diverifikasi, self::Diproses];
    }
}
