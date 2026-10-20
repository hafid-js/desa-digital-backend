<?php

namespace App\Queries;

use App\DTOs\PaginationResult;
use App\Enums\StatusPengaduan;
use App\Support\Dummy\PengaduanDummy;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Query (read model) untuk daftar pengaduan masyarakat.
 */
final class PengaduanQuery
{
    public const PER_PAGE = 10;

    /**
     * @return Collection<int, \stdClass>
     */
    public function all(): Collection
    {
        return PengaduanDummy::all();
    }

    /**
     * @param  Request|null  $request  null berarti tanpa filter
     * @return Collection<int, \stdClass>
     */
    public function filter(?Request $request): Collection
    {
        $pengaduans = $this->all();

        if ($request?->filled('status')) {
            $status = StatusPengaduan::tryFrom($request->string('status')->toString());

            $pengaduans = $pengaduans->filter(fn ($p) => $p->status === $status);
        }

        if ($request?->filled('search')) {
            $search = strtolower($request->string('search')->toString());

            $pengaduans = $pengaduans->filter(fn ($p) => str_contains(strtolower($p->kode_laporan), $search)
                || str_contains(strtolower($p->nama_pelapor), $search)
                || str_contains(strtolower($p->wilayah), $search)
                || str_contains(strtolower($p->rincian), $search)
            );
        }

        return $pengaduans->sortByDesc('created_at')->values();
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
        return collect(StatusPengaduan::cases())
            ->mapWithKeys(fn (StatusPengaduan $status) => [$status->value => $status->label()])
            ->all();
    }
}
