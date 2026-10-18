<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    /**
     * Daftar semua pengaduan (kelola admin).
     * Admin hanya bisa lihat & tanggapi, tidak bisa menambah data baru.
     * Data pengaduan datang dari aplikasi Flutter warga.
     */
    public function index(Request $request)
    {
        $pengaduans = collect([
            (object) [
                'id' => 1,
                'kode_laporan' => 'PGD-2026-0001',
                'nama_pelapor' => 'Budi Santoso',
                'nik_pelapor' => '3201012345670001',
                'wilayah' => 'Dusun Gunung Condong',
                'latitude' => -7.5432100,
                'longitude' => 110.1234500,
                'rincian' => 'Lampu jalan di jalan raya mati sejak 3 hari lalu, tempatnya di depan warung pak RT.',
                'visibilitas' => 'public',
                'status' => 'diproses',
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
                'wilayah' => 'Dusun Gunung Condong',
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
        ]);

        // Filter status
        if ($request->filled('status')) {
            $pengaduans = $pengaduans->where('status', $request->status);
        }

        // Filter search
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $pengaduans = $pengaduans->filter(fn ($p) => stripos($p->kode_laporan ?? '', $search) !== false ||
                stripos($p->nama_pelapor ?? '', $search) !== false ||
                stripos($p->wilayah ?? '', $search) !== false ||
                stripos($p->rincian ?? '', $search) !== false
            );
        }

        $pengaduans = $pengaduans->sortByDesc('created_at')->values();

        // Pagination manual (10 per halaman)
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
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak',
            ],
            'selectedStatus' => $request->status,
            'search' => $request->search,
        ]);
    }

    /**
     * Detail pengaduan beserta riwayat tanggapan.
     */
    public function detail(string $kode)
    {
        $pengaduan = (object) [
            'id' => 1,
            'kode_laporan' => $kode,
            'nama_pelapor' => 'Budi Santoso',
            'nik_pelapor' => '3201012345670001',
            'wilayah' => 'Dusun Gunung Condong',
            'latitude' => -7.5432100,
            'longitude' => 110.1234500,
            'rincian' => 'Lampu jalan di jalan raya mati sejak 3 hari lalu, tempatnya di depan warung pak RT. Mohon segera diperbaiki agar malam menjadi lebih aman.',
            'visibilitas' => 'public',
            'status' => 'diproses',
            'tanggapan' => 'Aduan telah diterima dan sedang ditindaklanjuti oleh petugas jalan raya.',
            'waktu_kejadian' => now()->subDays(3),
            'lampiran_foto' => null,
            'lampiran_pdf' => null,
            'lampiran_video' => null,
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(1),
        ];

        $tanggapans = collect([
            (object) [
                'id' => 1,
                'pengaduan_id' => 1,
                'tanggapan' => 'Aduan telah diterima dan diteruskan kepada instansi terkait untuk ditindaklanjuti.',
                'status_sebelum' => 'diterima',
                'status_sesudah' => 'diproses',
                'diberi_oleh' => 'Admin Desa',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 2,
                'pengaduan_id' => 1,
                'tanggapan' => 'Petugas sudah mengecek lokasi, lampu jalan akan diperbaiki besok pagi.',
                'status_sebelum' => 'diproses',
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
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak',
            ],
        ]);
    }

    /**
     * Beri tanggapan dan/atau ubah status pengaduan (admin/petugas desa).
     * Tidak ada endpoint tambah pengaduan dari sisi admin.
     */
    public function tanggapan(Request $request, string $kode)
    {
        $validated = Validator::make($request->all(), [
            'tanggapan' => ['required', 'string', 'min:5'],
            'status' => ['sometimes', 'string', 'in:diterima,diproses,selesai,ditolak'],
        ])->validate();

        return back()
            ->with('success', 'Tanggapan berhasil disimpan.');
    }
}
