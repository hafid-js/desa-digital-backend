<?php

namespace App\Queries;

use App\DTOs\DashboardSummary;
use App\Enums\StatusLaporan;
use App\Enums\StatusPengaduan;
use App\Enums\StatusProduk;
use App\Enums\StatusSurat;
use App\Support\Dummy\ApbdesDummy;
use Illuminate\Support\Collection;

/**
 * Read model yang merangkum data lintas modul untuk halaman dashboard.
 */
final class DashboardQuery
{
    public const TERBARU = 5;

    public function summary(): DashboardSummary
    {
        return new DashboardSummary(
            pengaduanTotal: $this->pengaduanTotal(),
            pengaduanPerluTindakLanjut: $this->pengaduanPerluTindakLanjut(),
            pengaduanTerbaru: $this->pengaduanTerbaru(),
            suratTotal: $this->suratTotal(),
            suratPerluProses: $this->suratPerluProses(),
            suratTerbaru: $this->suratTerbaru(),
            suratMandiri: $this->suratMandiri(),
            apbdesTotalTarget: $this->apbdesTotalTarget(),
            apbdesTotalRealisasi: $this->apbdesTotalRealisasi(),
            apbdesPersentase: $this->apbdesPersentase(),
            apbdesTahunAnggaran: $this->apbdesTahunAnggaran(),
            apbdesRincian: ApbdesDummy::all(),
            produkTotal: $this->produkTotal(),
            produkAktif: $this->produkCountByStatus(StatusProduk::Aktif),
            produkNonaktif: $this->produkCountByStatus(StatusProduk::Nonaktif),
            produkTerjual: $this->produkCountByStatus(StatusProduk::Terjual),
            produkTotalDilihat: $this->produkTotalDilihat(),
            produkTotalPenjual: $this->produkTotalPenjual(),
            laporanBaru: $this->laporanBaru(),
            produkTerbaru: $this->produkTerbaru(),
        );
    }

    public function pengaduanTotal(): int
    {
        return (new PengaduanQuery)->all()->count();
    }

    public function pengaduanPerluTindakLanjut(): int
    {
        return (new PengaduanQuery)->all()
            ->filter(fn ($p) => in_array($p->status, StatusPengaduan::perluTindakLanjut(), true))
            ->count();
    }

    /**
     * @return Collection<int, \stdClass>
     */
    public function pengaduanTerbaru(): Collection
    {
        return (new PengaduanQuery)->all()
            ->sortByDesc('created_at')
            ->take(self::TERBARU)
            ->values();
    }

    public function suratTotal(): int
    {
        return (new SuratQuery)->all()->count();
    }

    public function suratPerluProses(): int
    {
        return (new SuratQuery)->all()
            ->filter(fn ($s) => in_array($s->status, StatusSurat::perluProses(), true))
            ->count();
    }

    public function suratMandiri(): int
    {
        return (new SuratQuery)->all()->filter(fn ($s) => $s->mandiri === true)->count();
    }

    /**
     * @return Collection<int, \stdClass>
     */
    public function suratTerbaru(): Collection
    {
        return (new SuratQuery)->all()
            ->sortByDesc('tanggal_diajukan')
            ->take(self::TERBARU)
            ->values();
    }

    public function apbdesTotalTarget(): int
    {
        return (int) ApbdesDummy::all()->sum('jumlah_target');
    }

    public function apbdesTotalRealisasi(): int
    {
        return (int) ApbdesDummy::all()->sum('jumlah_realisasi');
    }

    public function apbdesPersentase(): float
    {
        $target = $this->apbdesTotalTarget();

        return $target > 0 ? round($this->apbdesTotalRealisasi() / $target * 100, 2) : 0.0;
    }

    public function apbdesTahunAnggaran(): int
    {
        return (int) (ApbdesDummy::all()->first()['tahun_anggaran'] ?? now()->year);
    }

    public function produkTotal(): int
    {
        return (new ProdukLapakQuery)->all()->count();
    }

    public function produkCountByStatus(StatusProduk $status): int
    {
        return (new ProdukLapakQuery)->all()->filter(fn ($p) => $p->status === $status)->count();
    }

    public function produkTotalDilihat(): int
    {
        return (int) (new ProdukLapakQuery)->all()->sum('dilihat');
    }

    public function produkTotalPenjual(): int
    {
        return (new ProdukLapakQuery)->all()
            ->map(fn ($p) => $p->penjual->id)
            ->unique()
            ->count();
    }

    public function laporanBaru(): int
    {
        return (new LaporanProdukQuery)->all()
            ->filter(fn ($l) => $l->status === StatusLaporan::Baru)
            ->count();
    }

    /**
     * @return Collection<int, \stdClass>
     */
    public function produkTerbaru(): Collection
    {
        return (new ProdukLapakQuery)->all()
            ->sortByDesc('dibuat_pada')
            ->take(self::TERBARU)
            ->values();
    }
}
