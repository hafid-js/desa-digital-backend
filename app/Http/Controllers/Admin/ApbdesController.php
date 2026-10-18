<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ApbdesController extends Controller
{
    public function index()
    {
        return view('pages.admin.apbdes.index', [
            'apbdesList' => collect([
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
                    'section' => 'pendapatan',
                    'jumlah_realisasi' => 174647992,
                    'jumlah_target' => 434491400,
                    'persentase' => 40.20,
                    'tahun_anggaran' => 2026,
                ],
                [
                    'judul' => 'Bidang Penyelenggaraan Pemerintahan',
                    'section' => 'pembelanjaan',
                    'jumlah_realisasi' => 173323325,
                    'jumlah_target' => 642272557,
                    'persentase' => 26.83,
                    'tahun_anggaran' => 2026,
                ],
                [
                    'judul' => 'Bidang Pelaksanaan Pembangunan Desa',
                    'section' => 'pembelanjaan',
                    'jumlah_realisasi' => 63372100,
                    'jumlah_target' => 369859500,
                    'persentase' => 17.13,
                    'tahun_anggaran' => 2026,
                ],
                [
                    'judul' => 'Pelaksanaan Umum',
                    'section' => 'pelaksanaan',
                    'jumlah_realisasi' => 280178925,
                    'jumlah_target' => 1099315413,
                    'persentase' => 25.49,
                    'tahun_anggaran' => 2026,
                ],
            ]),
        ]);
    }

    public function tambah()
    {
        return view('pages.admin.apbdes.tambah');
    }
}
