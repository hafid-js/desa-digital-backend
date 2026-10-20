<?php

namespace App\Queries;

use App\DTOs\PaginationResult;
use App\Enums\StatusProduk;
use App\Support\Dummy\OpsiLapakDummy;
use App\Support\Dummy\ProdukLapakDummy;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Query (read model) untuk daftar produk lapak warga.
 */
final class ProdukLapakQuery
{
    public const PER_PAGE = 10;

    /**
     * @return Collection<int, \stdClass>
     */
    public function all(): Collection
    {
        return ProdukLapakDummy::all();
    }

    /**
     * @param  Request|null  $request  null berarti tanpa filter
     * @return Collection<int, \stdClass>
     */
    public function filter(?Request $request): Collection
    {
        $produk = $this->all();

        if ($request?->filled('status')) {
            $status = StatusProduk::tryFrom($request->string('status')->toString());

            $produk = $produk->filter(fn ($p) => $p->status === $status);
        }

        if ($request?->filled('kategori')) {
            $kategori = $request->string('kategori')->toString();

            $produk = $produk->filter(fn ($p) => $p->kategori === $kategori);
        }

        if ($request?->filled('lokasi')) {
            $lokasi = $request->string('lokasi')->toString();

            $produk = $produk->filter(fn ($p) => $p->lokasi === $lokasi);
        }

        if ($request?->filled('search')) {
            $search = strtolower($request->string('search')->toString());

            $produk = $produk->filter(fn ($p) => str_contains(strtolower($p->nama_produk), $search)
                || str_contains(strtolower($p->kategori), $search)
                || str_contains(strtolower($p->lokasi), $search)
                || str_contains(strtolower($p->penjual->nama), $search)
            );
        }

        return $produk->sortByDesc('dibuat_pada')->values();
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
        return collect(StatusProduk::cases())
            ->mapWithKeys(fn (StatusProduk $status) => [$status->value => $status->label()])
            ->all();
    }

    /**
     * Opsi kategori untuk filter dropdown.
     *
     * @return array<int, string>
     */
    public function kategoriOptions(): array
    {
        return OpsiLapakDummy::kategori()->pluck('nama')->all();
    }

    /**
     * Opsi lokasi (dusun) untuk filter dropdown.
     *
     * @return array<int, string>
     */
    public function lokasiOptions(): array
    {
        return OpsiLapakDummy::lokasi();
    }
}
