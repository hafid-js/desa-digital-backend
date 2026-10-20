<?php

namespace App\Enums;

enum StatusProduk: string
{
    case Aktif = 'aktif';
    case Nonaktif = 'nonaktif';
    case Terjual = 'terjual';

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
            self::Nonaktif => 'orange',
            self::Terjual => 'blue',
        };
    }
}
