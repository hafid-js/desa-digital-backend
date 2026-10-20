<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SuratController extends Controller
{
    /**
     * Daftar permohonan surat dari warga. Data masih dummy sampai modul surat tersedia.
     */
    public function index(Request $request): View
    {
        $surat = $this->suratDummy();

        if ($request->filled('status')) {
            $surat = $surat->where('status', $request->status);
        }

        if ($request->filled('jenis')) {
            $surat = $surat->where('kode_surat', $request->jenis);
        }

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $surat = $surat->filter(fn ($s) => stripos($s->kode_surat, $search) !== false
                || stripos($s->nama_surat, $search) !== false
                || stripos($s->nama_pemohon, $search) !== false
                || stripos($s->wilayah, $search) !== false
            );
        }

        $surat = $surat->sortByDesc('tanggal_diajukan')->values();

        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $total = $surat->count();
        $lastPage = (int) ceil($total / $perPage);
        $currentPage = max(1, min($currentPage, $lastPage ?: 1));
        $offset = ($currentPage - 1) * $perPage;
        $paginated = $surat->slice($offset, $perPage);

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

        return view('pages.admin.surat.index', [
            'surat' => $paginator,
            'statuses' => $this->statuses(),
            'jenisSurat' => $this->jenisSurat(),
            'selectedStatus' => $request->status,
            'selectedJenis' => $request->jenis,
            'search' => $request->search,
            'queryString' => http_build_query(array_filter([
                'search' => $request->search ?: null,
                'status' => $request->status ?: null,
                'jenis' => $request->jenis ?: null,
            ])),
        ]);
    }

    /**
     * Ringkasan permohonan surat untuk dashboard.
     *
     * @return array<string, mixed>
     */
    public function ringkasan(): array
    {
        $surat = $this->suratDummy();

        return [
            'total' => $surat->count(),
            'perlu_proses' => $surat->whereIn('status', ['diajukan', 'diverifikasi', 'diproses'])->count(),
            'mandiri' => $surat->where('mandiri', true)->count(),
            'terbaru' => $surat->sortByDesc('tanggal_diajukan')->take(5)->values(),
        ];
    }

    /**
     * Opsi status permohonan surat.
     *
     * @return array<string, string>
     */
    private function statuses(): array
    {
        return [
            'diajukan' => 'Diajukan',
            'diverifikasi' => 'Diverifikasi',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];
    }

    /**
     * Katalog jenis surat (dummy).
     *
     * @return array<string, array<string, mixed>>
     */
    private function jenisSurat(): array
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

    /**
     * Data permohonan surat (dummy).
     *
     * @return Collection<int, \stdClass>
     */
    private function suratDummy(): Collection
    {
        return collect($this->suratData())->map(fn (\stdClass $surat): \stdClass => $surat);
    }

    /**
     * Data permohonan surat (dummy).
     *
     * @return array<int, \stdClass>
     */
    private function suratData(): array
    {
        return [
            (object) [
                'id' => 1,
                'kode_surat' => 'S-41',
                'nama_surat' => 'Surat Keterangan Domisili',
                'mandiri' => true,
                'nama_pemohon' => 'Budi Santoso',
                'nik' => '3201012345670001',
                'wilayah' => 'Dusun Krajan',
                'keperluan' => 'Persyaratan pendaftaran sekolah anak',
                'status' => 'diajukan',
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subHours(6),
            ],
            (object) [
                'id' => 2,
                'kode_surat' => 'S-17',
                'nama_surat' => 'Surat Keterangan Kelahiran',
                'mandiri' => false,
                'nama_pemohon' => 'Siti Rahayu',
                'nik' => '3201012345670002',
                'wilayah' => 'Dusun Kepudang',
                'keperluan' => 'Pengajuan akta kelahiran anak',
                'status' => 'diverifikasi',
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(1)->setTime(10, 20),
            ],
            (object) [
                'id' => 3,
                'kode_surat' => 'S-21',
                'nama_surat' => 'Surat Keterangan Kematian',
                'mandiri' => false,
                'nama_pemohon' => 'Ahmad Hidayat',
                'nik' => '3201012345670003',
                'wilayah' => 'Dusun Karangsari',
                'keperluan' => 'Peng mengurus surat keterangan kematian',
                'status' => 'diproses',
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(2)->setTime(9, 0),
            ],
            (object) [
                'id' => 4,
                'kode_surat' => 'S-41',
                'nama_surat' => 'Surat Keterangan Domisili',
                'mandiri' => true,
                'nama_pemohon' => 'Dewi Lestari',
                'nik' => '3201012345670004',
                'wilayah' => 'Dusun Kemplung',
                'keperluan' => 'Pengajuan bantuan sosial',
                'status' => 'selesai',
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(4)->setTime(14, 35),
            ],
            (object) [
                'id' => 5,
                'kode_surat' => 'S-22',
                'nama_surat' => 'Surat Pernyataan Tidak Mampu',
                'mandiri' => false,
                'nama_pemohon' => 'Joko Purwanto',
                'nik' => '3201012345670005',
                'wilayah' => 'Dusun Brembet',
                'keperluan' => 'Syarat pengajuan beasiswa-putri',
                'status' => 'diajukan',
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(6)->setTime(8, 45),
            ],
            (object) [
                'id' => 6,
                'kode_surat' => 'S-05',
                'nama_surat' => 'Surat Pengantar Kerja',
                'mandiri' => false,
                'nama_pemohon' => 'Rizal Ramadhan',
                'nik' => '3201012345670006',
                'wilayah' => 'Dusun Ngopeni',
                'keperluan' => 'Persyaratan pengajuan izin usaha',
                'status' => 'ditolak',
                'berlaku_sampai' => now()->addMonth(),
                'tanggal_diajukan' => now()->subDays(9)->setTime(11, 10),
            ],
        ];
    }
}
