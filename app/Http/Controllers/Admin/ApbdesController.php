<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class ApbdesController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.apbdes.index', [
            'apbdesList' => $this->apbdesDummy(),
        ]);
    }

    /**
     * Ringkasan realisasi APBDes untuk dashboard.
     *
     * @return array<string, mixed>
     */
    public function ringkasan(): array
    {
        $apbdes = $this->apbdesDummy();

        $totalTarget = $apbdes->sum('jumlah_target');
        $totalRealisasi = $apbdes->sum('jumlah_realisasi');

        return [
            'total_target' => $totalTarget,
            'total_realisasi' => $totalRealisasi,
            'persentase' => $totalTarget > 0 ? round($totalRealisasi / $totalTarget * 100, 2) : 0,
            'tahun_anggaran' => $apbdes->first()['tahun_anggaran'] ?? now()->year,
            'rincian' => $apbdes,
        ];
    }

    public function tambah(): View
    {
        return view('pages.admin.apbdes.tambah');
    }

    /**
     * Data rincian APBDes (dummy).
     *
     * @return Collection<int, array<string, mixed>>
     */
    private function apbdesDummy(): Collection
    {
        return collect($this->apbdesData());
    }

    /**
     * Data rincian APBDes (dummy).
     *
     * @return array<int, array<string, mixed>>
     */
    private function apbdesData(): array
    {
        return [
            [
                'judul' => 'Pendapatan Asli Desa',
                'section' => 'Pendapatan',
                'jumlah_realisasi' => 149382400,
                'jumlah_target' => 373456000,
                'persentase' => 40.00,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Dana Desa',
                'section' => 'Pendapatan',
                'jumlah_realisasi' => 174647992,
                'jumlah_target' => 434491400,
                'persentase' => 40.20,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Bidang Penyelenggaraan Pemerintahan',
                'section' => 'Pembelanjaan',
                'jumlah_realisasi' => 173323325,
                'jumlah_target' => 642272557,
                'persentase' => 26.83,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Bidang Pelaksanaan Pembangunan Desa',
                'section' => 'Pembelanjaan',
                'jumlah_realisasi' => 63372100,
                'jumlah_target' => 369859500,
                'persentase' => 17.13,
                'tahun_anggaran' => 2026,
            ],
            [
                'judul' => 'Pelaksanaan Umum',
                'section' => 'Pelaksanaan',
                'jumlah_realisasi' => 280178925,
                'jumlah_target' => 1099315413,
                'persentase' => 25.49,
                'tahun_anggaran' => 2026,
            ],
        ];
    }
}
