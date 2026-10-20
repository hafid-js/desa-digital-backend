<?php

namespace App\Queries;

use App\DTOs\PaginationResult;
use App\Enums\StatusSurat;
use App\Support\Dummy\SuratDummy;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Query (read model) untuk daftar permohonan surat.
 */
final class SuratQuery
{
    public const PER_PAGE = 10;

    /**
     * @return Collection<int, \stdClass>
     */
    public function all(): Collection
    {
        return SuratDummy::all();
    }

    /**
     * @param  Request|null  $request  null berarti tanpa filter
     * @return Collection<int, \stdClass>
     */
    public function filter(?Request $request): Collection
    {
        $surat = $this->all();

        if ($request?->filled('status')) {
            $status = StatusSurat::tryFrom($request->string('status')->toString());

            $surat = $surat->filter(fn ($s) => $s->status === $status);
        }

        if ($request?->filled('jenis')) {
            $kode = $request->string('jenis')->toString();

            $surat = $surat->filter(fn ($s) => $s->kode_surat === $kode);
        }

        if ($request?->filled('search')) {
            $search = strtolower($request->string('search')->toString());

            $surat = $surat->filter(fn ($s) => str_contains(strtolower($s->kode_surat), $search)
                || str_contains(strtolower($s->nama_surat), $search)
                || str_contains(strtolower($s->nama_pemohon), $search)
                || str_contains(strtolower($s->wilayah), $search)
            );
        }

        return $surat->sortByDesc('tanggal_diajukan')->values();
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
        return collect(StatusSurat::cases())
            ->mapWithKeys(fn (StatusSurat $status) => [$status->value => $status->label()])
            ->all();
    }

    /**
     * Katalog jenis surat untuk filter dropdown.
     *
     * @return array<string, array<string, mixed>>
     */
    public function jenisOptions(): array
    {
        return [
            'S-41' => [
                'kode_surat' => 'S-41',
                'nama_surat' => 'Surat Keterangan Domisili',
                'mandiri' => true,
            ],
            'S-17' => [
                'kode_surat' => 'S-17',
                'nama_surat' => 'Surat Keterangan Kelahiran',
                'mandiri' => false,
            ],
            'S-21' => [
                'kode_surat' => 'S-21',
                'nama_surat' => 'Surat Keterangan Kematian',
                'mandiri' => false,
            ],
            'S-22' => [
                'kode_surat' => 'S-22',
                'nama_surat' => 'Surat Pernyataan Tidak Mampu',
                'mandiri' => false,
            ],
            'S-05' => [
                'kode_surat' => 'S-05',
                'nama_surat' => 'Surat Pengantar Kerja',
                'mandiri' => false,
            ],
        ];
    }
}
