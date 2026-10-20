<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index(Request $request): View
    {
        $pengaduans = $this->pengaduanDummy();

        if ($request->filled('status')) {
            $pengaduans = $pengaduans->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $pengaduans = $pengaduans->filter(fn ($p) => stripos($p->kode_laporan ?? '', $search) !== false ||
                stripos($p->nama_pelapor ?? '', $search) !== false ||
                stripos($p->wilayah ?? '', $search) !== false ||
                stripos($p->rincian ?? '', $search) !== false
            );
        }

        $pengaduans = $pengaduans->sortByDesc('created_at')->values();

        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $total = $pengaduans->count();
        $lastPage = (int) ceil($total / $perPage);
        $currentPage = max(1, min($currentPage, $lastPage ?: 1));
        $offset = ($currentPage - 1) * $perPage;
        $paginated = $pengaduans->slice($offset, $perPage);

        $paginator = (object) [
            'items' => $paginated,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'firstItem' => $paginated->isEmpty() ? 0 : $offset + 1,
            'lastItem' => $paginated->isEmpty() ? 0 : $offset + $paginated->count(),
            'hasMorePages' => $currentPage < $lastPage,
        ];

        return view('pages.admin.pengaduan.index', [
            'pengaduans' => $paginator,
            'statuses' => [
                'diterima' => 'Diterima',
                'verifikasi' => 'Verifikasi',
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak',
            ],
            'selectedStatus' => $request->status,
            'search' => $request->search,
            'queryString' => http_build_query(array_filter([
                'search' => $request->search ?: null,
                'status' => $request->status ?: null,
            ])),
        ]);
    }

    /**
     * Ringkasan pengaduan masyarakat untuk dashboard.
     *
     * @return array<string, mixed>
     */
    public function ringkasan(): array
    {
        $pengaduans = $this->pengaduanDummy();

        return [
            'total' => $pengaduans->count(),
            'perlu_tindak_lanjut' => $pengaduans->whereIn('status', ['diterima', 'verifikasi'])->count(),
            'terbaru' => $pengaduans->sortByDesc('created_at')->take(5)->values(),
        ];
    }

    /**
     * Data pengaduan masyarakat (dummy).
     *
     * @return Collection<int, \stdClass>
     */
    private function pengaduanDummy(): Collection
    {
        return collect($this->pengaduanData())->map(fn (\stdClass $pengaduan): \stdClass => $pengaduan);
    }

    /**
     * Data pengaduan masyarakat (dummy).
     *
     * @return array<int, \stdClass>
     */
    private function pengaduanData(): array
    {
        return [
            (object) [
                'id' => 1,
                'kode_laporan' => 'PGD-2026-0001',
                'nama_pelapor' => 'Budi Santoso',
                'nik_pelapor' => '3201012345670001',
                'wilayah' => 'Dusun Krajan',
                'latitude' => -7.5432100,
                'longitude' => 110.1234500,
                'rincian' => 'Lampu jalan di jalan raya mati sejak 3 hari lalu, tempatnya di depan warung pak RT.',
                'visibilitas' => 'public',
                'status' => 'verifikasi',
                'tanggapan' => 'Aduan telah diterima dan sedang ditindaklanjuti.',
                'waktu_kejadian' => now()->subDays(3),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            (object) [
                'id' => 2,
                'kode_laporan' => 'PGD-2026-0002',
                'nama_pelapor' => 'Siti Rahayu',
                'nik_pelapor' => '3201012345670002',
                'wilayah' => 'Dusun Ngopeni',
                'latitude' => -7.5500000,
                'longitude' => 110.1300000,
                'rincian' => 'Sampah menumpuk di depan pasar desa sejak kemarin, aroma sangat mengganggu.',
                'visibilitas' => 'public',
                'status' => 'diterima',
                'tanggapan' => null,
                'waktu_kejadian' => now()->subDays(2),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 3,
                'kode_laporan' => 'PGD-2026-0003',
                'nama_pelapor' => 'Ahmad Hidayat',
                'nik_pelapor' => '3201012345670003',
                'wilayah' => 'Dusun Ketapang',
                'latitude' => -7.5350000,
                'longitude' => 110.1150000,
                'rincian' => 'Jalan berlubang di gang RT 03, lubang cukup dalam dan berbahaya untuk kendaraan.',
                'visibilitas' => 'private',
                'status' => 'selesai',
                'tanggapan' => 'Lubang telah ditutup oleh petugas jalan raya.',
                'waktu_kejadian' => now()->subDays(5),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 4,
                'kode_laporan' => 'PGD-2026-0004',
                'nama_pelapor' => 'Dewi Lestari',
                'nik_pelapor' => '3201012345670004',
                'wilayah' => 'Dusun Srigunting',
                'latitude' => -7.5400000,
                'longitude' => 110.1250000,
                'rincian' => 'Air tidak mengalir di rumah sejak seminggu lalu, sumur telah kering.',
                'visibilitas' => 'public',
                'status' => 'ditolak',
                'tanggapan' => 'Permintaan ditolak karena tidak termasuk kewenangan desa.',
                'waktu_kejadian' => now()->subDays(7),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 5,
                'kode_laporan' => 'PGD-2026-0005',
                'nama_pelapor' => 'Joko Purwanto',
                'nik_pelapor' => '3201012345670005',
                'wilayah' => 'Dusun Krajan',
                'latitude' => -7.5432100,
                'longitude' => 110.1234500,
                'rincian' => 'Pohon besar tumbang menutup jalan raya setelah hujan lebat tadi malam.',
                'visibilitas' => 'public',
                'status' => 'diterima',
                'tanggapan' => null,
                'waktu_kejadian' => now()->subHours(12),
                'lampiran_foto' => null,
                'lampiran_pdf' => null,
                'lampiran_video' => null,
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
        ];
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
            'status' => 'verifikasi',
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
                'status_sebelum' => 'diterima',
                'status_sesudah' => 'verifikasi',
                'diberi_oleh' => 'Admin Desa',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 2,
                'pengaduan_id' => 1,
                'tanggapan' => 'Petugas sudah mengecek lokasi, lampu jalan akan diperbaiki besok pagi.',
                'status_sebelum' => 'verifikasi',
                'status_sesudah' => 'diproses',
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
