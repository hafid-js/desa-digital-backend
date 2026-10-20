<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusPengaduan;
use App\Http\Controllers\Controller;
use App\Queries\PengaduanQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index(Request $request): View
    {
        $query = new PengaduanQuery;

        return view('pages.admin.pengaduan.index', [
            'pengaduans' => $query->paginate($request),
            'statuses' => $query->statusOptions(),
            'selectedStatus' => $request->status,
            'search' => $request->search,
            'queryString' => http_build_query(array_filter([
                'search' => $request->search ?: null,
                'status' => $request->status ?: null,
            ])),
        ]);
    }

    public function detail(string $kode): View
    {
        $pengaduan = (object) [
            'id' => 1,
            'kode_laporan' => $kode,
            'nama_pelapor' => 'Budi Santoso',
            'nik_pelapor' => '3201012345670001',
            'wilayah' => 'Dusun Krajan',
            'latitude' => -7.5432100,
            'longitude' => 110.1234500,
            'rincian' => 'Lampu jalan di jalan raya mati sejak 3 hari lalu, tempatnya di depan warung pak RT. Mohon segera diperbaiki agar malam menjadi lebih aman.',
            'visibilitas' => 'public',
            'status' => StatusPengaduan::Verifikasi,
            'tanggapan' => 'Aduan telah diterima dan sedang ditindaklanjuti oleh petugas jalan raya.',
            'waktu_kejadian' => now()->subDays(3),
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(1),
            'lampiran' => collect([
                (object) [
                    'id' => 1,
                    'pengaduan_id' => 1,
                    'tipe' => 'foto',
                    'path' => 'pengaduan/foto-lampu-mati.jpg',
                    'nama_asli' => 'foto-lampu-mati.jpg',
                    'urutan' => 1,
                    'created_at' => now()->subDays(3),
                ],
                (object) [
                    'id' => 2,
                    'pengaduan_id' => 1,
                    'tipe' => 'foto',
                    'path' => 'pengaduan/foto-lampu-mati-2.jpg',
                    'nama_asli' => 'foto-lampu-mati-2.jpg',
                    'urutan' => 2,
                    'created_at' => now()->subDays(3),
                ],
                (object) [
                    'id' => 3,
                    'pengaduan_id' => 1,
                    'tipe' => 'pdf',
                    'path' => 'pengaduan/laporan-kecelakaan.pdf',
                    'nama_asli' => 'laporan-kecelakaan.pdf',
                    'urutan' => 3,
                    'created_at' => now()->subDays(3),
                ],
                (object) [
                    'id' => 4,
                    'pengaduan_id' => 1,
                    'tipe' => 'video',
                    'path' => 'pengaduan/video-bukti.mp4',
                    'nama_asli' => 'video-bukti.mp4',
                    'urutan' => 4,
                    'created_at' => now()->subDays(3),
                ],
            ]),
        ];

        $tanggapans = collect([
            (object) [
                'id' => 1,
                'pengaduan_id' => 1,
                'tanggapan' => 'Aduan telah diterima dan diteruskan kepada instansi terkait untuk ditindaklanjuti.',
                'status_sebelum' => StatusPengaduan::Diterima,
                'status_sesudah' => StatusPengaduan::Verifikasi,
                'diberi_oleh' => 'Admin Desa',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 2,
                'pengaduan_id' => 1,
                'tanggapan' => 'Petugas sudah mengecek lokasi, lampu jalan akan diperbaiki besok pagi.',
                'status_sebelum' => StatusPengaduan::Verifikasi,
                'status_sesudah' => StatusPengaduan::Diproses,
                'diberi_oleh' => 'Petugas Jalan Raya',
                'created_at' => now()->subDays(1),
            ],
        ])->values();

        return view('pages.admin.pengaduan.detail', [
            'pengaduan' => $pengaduan,
            'tanggapans' => $tanggapans,
            'statuses' => [
                'diterima' => 'Diterima',
                'verifikasi' => 'Verifikasi',
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak',
            ],
        ]);
    }

    public function lampiran(string $kode): View
    {
        $pengaduan = (object) [
            'id' => 1,
            'kode_laporan' => $kode,
            'nama_pelapor' => 'Budi Santoso',
            'wilayah' => 'Dusun Krajan',
            'lampiran' => collect([
                (object) [
                    'id' => 1,
                    'tipe' => 'foto',
                    'path' => 'pengaduan/foto-lampu-mati.jpg',
                    'nama_asli' => 'foto-lampu-mati.jpg',
                    'urutan' => 1,
                ],
                (object) [
                    'id' => 2,
                    'tipe' => 'foto',
                    'path' => 'pengaduan/foto-lampu-mati-2.jpg',
                    'nama_asli' => 'foto-lampu-mati-2.jpg',
                    'urutan' => 2,
                ],
                (object) [
                    'id' => 3,
                    'tipe' => 'pdf',
                    'path' => 'pengaduan/laporan-kecelakaan.pdf',
                    'nama_asli' => 'laporan-kecelakaan.pdf',
                    'urutan' => 3,
                ],
                (object) [
                    'id' => 4,
                    'tipe' => 'video',
                    'path' => 'pengaduan/video-bukti.mp4',
                    'nama_asli' => 'video-bukti.mp4',
                    'urutan' => 4,
                ],
            ])->sortBy('urutan')->values(),
        ];

        return view('pages.admin.pengaduan.lampiran', [
            'pengaduan' => $pengaduan,
        ]);
    }

    public function tanggapan(Request $request, string $kode): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'tanggapan' => ['required', 'string', 'min:5'],
            'status' => ['sometimes', 'string', 'in:diterima,verifikasi,diproses,selesai,ditolak'],
        ])->validate();

        return back()
            ->with('success', 'Tanggapan berhasil disimpan.');
    }
}
