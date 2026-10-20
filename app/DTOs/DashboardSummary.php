<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

/**
 * Ringkasan data untuk halaman dashboard.
 */
final readonly class DashboardSummary
{
    /**
     * @param  Collection<int, \stdClass>  $pengaduanTerbaru
     * @param  Collection<int, \stdClass>  $suratTerbaru
     * @param  Collection<int, \stdClass>  $produkTerbaru
     * @param  Collection<int, array<string, mixed>>  $apbdesRincian
     */
    public function __construct(
        public int $pengaduanTotal,
        public int $pengaduanPerluTindakLanjut,
        public Collection $pengaduanTerbaru,
        public int $suratTotal,
        public int $suratPerluProses,
        public Collection $suratTerbaru,
        public int $suratMandiri,
        public int $apbdesTotalTarget,
        public int $apbdesTotalRealisasi,
        public float $apbdesPersentase,
        public int $apbdesTahunAnggaran,
        public Collection $apbdesRincian,
        public int $produkTotal,
        public int $produkAktif,
        public int $produkNonaktif,
        public int $produkTerjual,
        public int $produkTotalDilihat,
        public int $produkTotalPenjual,
        public int $laporanBaru,
        public Collection $produkTerbaru,
    ) {}
}
