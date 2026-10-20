<?php

namespace App\Enums;

enum StatusLaporan: string
{
    case Baru = 'baru';
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
            self::Baru => 'blue',
            self::Diproses => 'orange',
            self::Selesai => 'green',
            self::Ditolak => 'red',
        };
    }
}
