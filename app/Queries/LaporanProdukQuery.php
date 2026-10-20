<?php

namespace App\Queries;

use App\DTOs\PaginationResult;
use App\Enums\StatusLaporan;
use App\Support\Dummy\LaporanProdukDummy;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Query (read model) untuk laporan warga terhadap produk lapak.
 */
final class LaporanProdukQuery
{
    public const PER_PAGE = 10;

    /**
     * @return Collection<int, \stdClass>
     */
    public function all(): Collection
    {
        return LaporanProdukDummy::all();
    }

    /**
     * @param  Request|null  $request  null berarti tanpa filter
     * @return Collection<int, \stdClass>
     */
    public function filter(?Request $request): Collection
    {
        $laporan = $this->all();

        if ($request?->filled('status')) {
            $status = StatusLaporan::tryFrom($request->string('status')->toString());

            $laporan = $laporan->filter(fn ($l) => $l->status === $status);
        }

        if ($request?->filled('search')) {
            $search = strtolower($request->string('search')->toString());

            $laporan = $laporan->filter(fn ($l) => str_contains(strtolower($l->kode_laporan), $search)
                || str_contains(strtolower($l->nama_produk), $search)
                || str_contains(strtolower($l->pelapor), $search)
            );
        }

        return $laporan->sortByDesc('dibuat_pada')->values();
    }

    public function paginate(?Request $request): PaginationResult
    {
        return PaginationResult::fromCollection(
            $this->filter($request),
            self::PER_PAGE,
            (int) $request?->input('page', 1),
        );
    }

    /**
     * Opsi status untuk filter dropdown.
     *
     * @return array<string, string>
     */
    public function statusOptions(): array
    {
        return collect(StatusLaporan::cases())
            ->mapWithKeys(fn (StatusLaporan $status) => [$status->value => $status->label()])
            ->all();
    }
}
