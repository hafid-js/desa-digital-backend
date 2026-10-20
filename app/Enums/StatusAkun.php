<?php

namespace App\Enums;

enum StatusAkun: string
{
    case Aktif = 'aktif';
    case Diblokir = 'diblokir';

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
            self::Aktif => 'green',
            self::Diblokir => 'red',
        };
    }
}
