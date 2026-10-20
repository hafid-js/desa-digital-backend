<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LapakWargaController extends Controller
{
    /**
     * Daftar produk lapak warga. Data masih dummy sampai tabel produk tersedia.
     */
    public function index(Request $request): View
    {
        $produk = $this->produkDummy();

        if ($request->filled('status')) {
            $produk = $produk->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $produk = $produk->where('kategori', $request->kategori);
        }

        if ($request->filled('lokasi')) {
            $produk = $produk->where('lokasi', $request->lokasi);
        }

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $produk = $produk->filter(fn ($p) => stripos($p->nama_produk, $search) !== false
                || stripos($p->kategori, $search) !== false
                || stripos($p->lokasi, $search) !== false
                || stripos($p->penjual->nama, $search) !== false
            );
        }

        $produk = $produk->sortByDesc('dibuat_pada')->values();

        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $total = $produk->count();
        $lastPage = (int) ceil($total / $perPage);
        $currentPage = max(1, min($currentPage, $lastPage ?: 1));
        $offset = ($currentPage - 1) * $perPage;
        $paginated = $produk->slice($offset, $perPage);

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

        return view('pages.admin.lapak.index', [
            'produk' => $paginator,
            'statistik' => $this->statistikDummy(),
            'statuses' => $this->statuses(),
            'kategoriList' => $this->kategoriDummy()->pluck('nama')->all(),
            'lokasiList' => $this->lokasiDummy(),
            'selectedStatus' => $request->status,
            'selectedKategori' => $request->kategori,
            'selectedLokasi' => $request->lokasi,
            'search' => $request->search,
            'queryString' => http_build_query(array_filter([
                'search' => $request->search ?: null,
                'status' => $request->status ?: null,
                'kategori' => $request->kategori ?: null,
                'lokasi' => $request->lokasi ?: null,
            ])),
        ]);
    }

    /**
     * Ringkasan data lapak warga untuk dashboard.
     *
     * @return array<string, mixed>
     */
    public function ringkasan(): array
    {
        $produk = $this->produkDummy();

        return [
            'total_produk' => $produk->count(),
            'produk_aktif' => $produk->where('status', 'aktif')->count(),
            'produk_nonaktif' => $produk->where('status', 'nonaktif')->count(),
            'produk_terjual' => $produk->where('status', 'terjual')->count(),
            'total_dilihat' => $produk->sum('dilihat'),
            'total_penjual' => $produk->map(fn (\stdClass $p) => $p->penjual->id)->unique()->count(),
            'laporan_baru' => $this->laporanDummy()->where('status', 'baru')->count(),
            'produk_terbaru' => $produk->sortByDesc('dibuat_pada')->take(5)->values(),
        ];
    }

    /**
     * Detail produk beserta informasi penjual dan riwayat moderasi.
     */
    public function detail(string $id): View
    {
        $produk = $this->produkDummy()->firstWhere('id', $id);

        abort_if($produk === null, 404, 'Produk lapak tidak ditemukan.');

        $laporan = $this->laporanDummy()
            ->where('produk_id', $produk->id)
            ->values();

        return view('pages.admin.lapak.detail', [
            'produk' => $produk,
            'laporan' => $laporan,
            'statuses' => $this->statuses(),
            'kategoriList' => $this->kategoriDummy()->pluck('nama')->all(),
            'kondisiList' => $this->kondisiDummy(),
            'lokasiList' => $this->lokasiDummy(),
        ]);
    }

    /**
     * Master kategori, kondisi, dan lokasi untuk lapak warga.
     */
    public function kategori(): View
    {
        return view('pages.admin.lapak.kategori', [
            'kategori' => $this->kategoriDummy(),
            'kondisi' => $this->kondisiDummy(),
            'lokasi' => $this->lokasiDummy(),
        ]);
    }

    /**
     * Laporan warga terhadap produk lapak.
     */
    public function laporan(Request $request): View
    {
        $laporan = $this->laporanDummy();

        if ($request->filled('status')) {
            $laporan = $laporan->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $laporan = $laporan->filter(fn ($l) => stripos($l->kode_laporan, $search) !== false
                || stripos($l->nama_produk, $search) !== false
                || stripos($l->pelapor, $search) !== false
            );
        }

        $laporan = $laporan->sortByDesc('dibuat_pada')->values();

        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $total = $laporan->count();
        $lastPage = (int) ceil($total / $perPage);
        $currentPage = max(1, min($currentPage, $lastPage ?: 1));
        $offset = ($currentPage - 1) * $perPage;
        $paginated = $laporan->slice($offset, $perPage);

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

        return view('pages.admin.lapak.laporan', [
            'laporan' => $paginator,
            'statuses' => [
                'baru' => 'Baru',
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
     * Opsi status produk lapak.
     *
     * @return array<string, string>
     */
    private function statuses(): array
    {
        return [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
            'terjual' => 'Terjual',
        ];
    }

    /**
     * Ringkasan jumlah produk per status untuk kartu statistik.
     *
     * @return array<int, array<string, mixed>>
     */
    private function statistikDummy(): array
    {
        $produk = $this->produkDummy();

        return [
            [
                'label' => 'Total Produk',
                'nilai' => $produk->count(),
                'ikon' => 'ti-package',
                'warna' => 'primary',
            ],
            [
                'label' => 'Aktif Tayang',
                'nilai' => $produk->where('status', 'aktif')->count(),
                'ikon' => 'ti-eye',
                'warna' => 'green',
            ],
            [
                'label' => 'Nonaktif',
                'nilai' => $produk->where('status', 'nonaktif')->count(),
                'ikon' => 'ti-eye-off',
                'warna' => 'orange',
            ],
            [
                'label' => 'Terjual',
                'nilai' => $produk->where('status', 'terjual')->count(),
                'ikon' => 'ti-shopping-cart-check',
                'warna' => 'blue',
            ],
        ];
    }

    /**
     * Master kategori produk lapak (dummy).
     *
     * @return Collection<int, \stdClass>
     */
    private function kategoriDummy(): Collection
    {
        return collect($this->kategoriData());
    }

    /**
     * Data master kategori produk lapak (dummy).
     *
     * @return array<int, \stdClass>
     */
    private function kategoriData(): array
    {
        return [
            (object) [
                'id' => 1,
                'nama' => 'Fashion & Pakaian',
                'jumlah_produk' => 24,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 2,
                'nama' => 'Kuliner & Olahan',
                'jumlah_produk' => 31,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 3,
                'nama' => 'Elektronik & Gadget',
                'jumlah_produk' => 18,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 4,
                'nama' => 'Hasil Bumi & Pertanian',
                'jumlah_produk' => 27,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 5,
                'nama' => 'Perlengkapan Rumah',
                'jumlah_produk' => 15,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 6,
                'nama' => 'Otomotif',
                'jumlah_produk' => 9,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 7,
                'nama' => 'Kerajinan & Souvenir',
                'jumlah_produk' => 22,
                'is_aktif' => true,
            ],
            (object) [
                'id' => 8,
                'nama' => 'Lowongan Kerja & Jasa',
                'jumlah_produk' => 12,
                'is_aktif' => false,
            ],
        ];
    }

    /**
     * Master lokasi (dusun) produk lapak (dummy).
     *
     * @return array<int, string>
     */
    private function lokasiDummy(): array
    {
        return [
            'Dusun Krajan',
            'Dusun Kepudang',
            'Dusun Karangsari',
            'Dusun Kemplung',
            'Dusun Brembet',
            'Dusun Ngopeni',
            'Dusun Srigunting',
        ];
    }

    /**
     * Master kondisi produk lapak (dummy).
     *
     * @return array<int, string>
     */
    private function kondisiDummy(): array
    {
        return [
            'Baru',
            'Bekas - Seperti Baru',
            'Bekas - Bagus',
            'Bekas - Cukup',
        ];
    }

    /**
     * Daftar produk lapak warga (dummy).
     *
     * @return Collection<int, \stdClass>
     */
    private function produkDummy(): Collection
    {
        return collect($this->produkData());
    }

    /**
     * Data produk lapak warga (dummy).
     *
     * @return array<int, \stdClass>
     */
    private function produkData(): array
    {
        return [
            (object) [
                'id' => 1,
                'kode_produk' => 'LPK-2026-0001',
                'nama_produk' => 'Sepatu Laki-laki Kanvas Putih',
                'harga' => 185000,
                'harga_asli' => 250000,
                'diskon' => 26,
                'kategori' => 'Fashion & Pakaian',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Krajan',
                'deskripsi' => 'Sepatu kanvas ringan untuk aktivitas sehari-hari. Sol masih baru, ukuran 40-43, siap kirim via COD.',
                'foto' => [
                    'assets/static/products/product-1.jpg',
                    'assets/static/products/product-2.jpg',
                    'assets/static/products/product-3.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 342,
                'penjual' => (object) [
                    'id' => 11,
                    'nama' => 'Ahmad Fauzi',
                    'nik' => '3201012345670011',
                    'telepon' => '0812-3456-7890',
                    'dusun' => 'Dusun Krajan',
                    'avatar' => 'assets/static/avatars/000m.jpg',
                    'total_produk' => 6,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(1)->setTime(9, 15),
                'diperbarui_pada' => now()->subHours(6),
            ],
            (object) [
                'id' => 2,
                'kode_produk' => 'LPK-2026-0002',
                'nama_produk' => 'Keripik Pisang Madu Kemasan 250gr',
                'harga' => 25000,
                'harga_asli' => null,
                'diskon' => null,
                'kategori' => 'Kuliner & Olahan',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Karangsari',
                'deskripsi' => 'Keripik pisang madu asli hasil panen warga. Dibuat fresh setiap hari tanpa pengawet, kemasan 250 gram.',
                'foto' => [
                    'assets/static/products/product-4.jpg',
                    'assets/static/products/product-5.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 128,
                'penjual' => (object) [
                    'id' => 12,
                    'nama' => 'Siti Aminah',
                    'nik' => '3201012345670012',
                    'telepon' => '0813-2200-3344',
                    'dusun' => 'Dusun Karangsari',
                    'avatar' => 'assets/static/avatars/001f.jpg',
                    'total_produk' => 12,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(2)->setTime(14, 40),
                'diperbarui_pada' => now()->subDays(1),
            ],
            (object) [
                'id' => 3,
                'kode_produk' => 'LPK-2026-0003',
                'nama_produk' => 'Rice Cooker 1.5L',
                'harga' => 275000,
                'harga_asli' => 340000,
                'diskon' => 19,
                'kategori' => 'Elektronik & Gadget',
                'kondisi' => 'Bekas - Seperti Baru',
                'lokasi' => 'Dusun Kepudang',
                'deskripsi' => 'Rice cooker 1.5 liter, pemakaian 3 bulan, garansi resmi masih aktif. Semua fungsi normal, termasuk uap dan penghangat.',
                'foto' => [
                    'assets/static/products/product-6.jpg',
                    'assets/static/products/product-7.jpg',
                    'assets/static/products/product-8.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'Harga Diskon',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 517,
                'penjual' => (object) [
                    'id' => 13,
                    'nama' => 'Budi Santoso',
                    'nik' => '3201012345670013',
                    'telepon' => '0857-1122-8899',
                    'dusun' => 'Dusun Kepudang',
                    'avatar' => 'assets/static/avatars/002m.jpg',
                    'total_produk' => 3,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(3)->setTime(8, 5),
                'diperbarui_pada' => now()->subDays(2),
            ],
            (object) [
                'id' => 4,
                'kode_produk' => 'LPK-2026-0004',
                'nama_produk' => 'Kain Batik Tulis Motif Desa',
                'harga' => 450000,
                'harga_asli' => null,
                'diskon' => null,
                'kategori' => 'Kerajinan & Souvenir',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Kemplung',
                'deskripsi' => 'Kain batik tulis motif khas desa, panjang 2.5 meter. Dibuat tulis tangan oleh perajin warga, tidak ada dua keping yang sama.',
                'foto' => [
                    'assets/static/products/product-9.jpg',
                    'assets/static/products/product-10.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Preorder',
                'dilihat' => 264,
                'penjual' => (object) [
                    'id' => 14,
                    'nama' => 'Dewi Lestari',
                    'nik' => '3201012345670014',
                    'telepon' => '0819-4455-6677',
                    'dusun' => 'Dusun Kemplung',
                    'avatar' => 'assets/static/avatars/003f.jpg',
                    'total_produk' => 9,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(4)->setTime(19, 30),
                'diperbarui_pada' => now()->subDays(4),
            ],
            (object) [
                'id' => 5,
                'kode_produk' => 'LPK-2026-0005',
                'nama_produk' => 'Kursi Rotan Tamu',
                'harga' => 150000,
                'harga_asli' => 200000,
                'diskon' => 25,
                'kategori' => 'Perlengkapan Rumah',
                'kondisi' => 'Bekas - Bagus',
                'lokasi' => 'Dusun Brembet',
                'deskripsi' => 'Kursi rotan untuk tamu, kokoh dan tidak goyah. Minor goresan di kaki kursi, tidak mengganggu pemakaian.',
                'foto' => [
                    'assets/static/products/product-11.jpg',
                    'assets/static/products/product-12.jpg',
                ],
                'status' => 'nonaktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 97,
                'penjual' => (object) [
                    'id' => 15,
                    'nama' => 'Joko Purwanto',
                    'nik' => '3201012345670015',
                    'telepon' => '0821-9900-1122',
                    'dusun' => 'Dusun Brembet',
                    'avatar' => 'assets/static/avatars/004m.jpg',
                    'total_produk' => 2,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(6)->setTime(11, 20),
                'diperbarui_pada' => now()->subDays(2),
            ],
            (object) [
                'id' => 6,
                'kode_produk' => 'LPK-2026-0006',
                'nama_produk' => 'Jasa Servis Motor',
                'harga' => 50000,
                'harga_asli' => null,
                'diskon' => null,
                'kategori' => 'Lowongan Kerja & Jasa',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Krajan',
                'deskripsi' => 'Jasa servis motor keliling, penggantian oli, tune up, dan overhaul. Melayani dusun sekitar Desa Sukamaju.',
                'foto' => [
                    'assets/static/products/product-13.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'Harga Diskon',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 173,
                'penjual' => (object) [
                    'id' => 16,
                    'nama' => 'Rizal Ramadhan',
                    'nik' => '3201012345670016',
                    'telepon' => '0856-3344-5566',
                    'dusun' => 'Dusun Krajan',
                    'avatar' => 'assets/static/avatars/005m.jpg',
                    'total_produk' => 4,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(7)->setTime(7, 45),
                'diperbarui_pada' => now()->subDays(5),
            ],
            (object) [
                'id' => 7,
                'kode_produk' => 'LPK-2026-0007',
                'nama_produk' => 'Keripik Kentang Ori 1 Kg',
                'harga' => 35000,
                'harga_asli' => null,
                'diskon' => null,
                'kategori' => 'Kuliner & Olahan',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Ngopeni',
                'deskripsi' => 'Keripik kentang ori tanpa pengawet, renyah dan gurih. Dikirim dalam kemasan rapat agar tetap renyah saat diterima.',
                'foto' => [
                    'assets/static/products/product-1.jpg',
                    'assets/static/products/product-5.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 209,
                'penjual' => (object) [
                    'id' => 17,
                    'nama' => 'Nurul Hidayah',
                    'nik' => '3201012345670017',
                    'telepon' => '0877-1234-5678',
                    'dusun' => 'Dusun Ngopeni',
                    'avatar' => 'assets/static/avatars/006f.jpg',
                    'total_produk' => 8,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(8)->setTime(16, 10),
                'diperbarui_pada' => now()->subDays(3),
            ],
            (object) [
                'id' => 8,
                'kode_produk' => 'LPK-2026-0008',
                'nama_produk' => 'Baju Muslim Unisex Katun Rayon',
                'harga' => 135000,
                'harga_asli' => 175000,
                'diskon' => 23,
                'kategori' => 'Fashion & Pakaian',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Srigunting',
                'deskripsi' => 'Baju muslim unisex bahan katun rayon, adem dan tidak menerawang. Tersedia warna hitam, navy, dan maroon.',
                'foto' => [
                    'assets/static/products/product-2.jpg',
                    'assets/static/products/product-8.jpg',
                    'assets/static/products/product-12.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 388,
                'penjual' => (object) [
                    'id' => 18,
                    'nama' => 'Hendra Wijaya',
                    'nik' => '3201012345670018',
                    'telepon' => '0815-7788-9900',
                    'dusun' => 'Dusun Srigunting',
                    'avatar' => 'assets/static/avatars/007m.jpg',
                    'total_produk' => 5,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(10)->setTime(13, 0),
                'diperbarui_pada' => now()->subDays(4),
            ],
            (object) [
                'id' => 9,
                'kode_produk' => 'LPK-2026-0009',
                'nama_produk' => 'Vacuum Cleaner 2 In 1',
                'harga' => 420000,
                'harga_asli' => 550000,
                'diskon' => 24,
                'kategori' => 'Elektronik & Gadget',
                'kondisi' => 'Bekas - Cukup',
                'lokasi' => 'Dusun Srigunting',
                'deskripsi' => 'Vacuum cleaner 2 in 1 untuk salon dan rumah,hisap cukup kuat. Ada goresan penyScratch dan strap original sudah hilang.',
                'foto' => [
                    'assets/static/products/product-6.jpg',
                ],
                'status' => 'nonaktif',
                'penawaran' => 'Harga Diskon',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 145,
                'penjual' => (object) [
                    'id' => 19,
                    'nama' => 'Eko Prasetyo',
                    'nik' => '3201012345670019',
                    'telepon' => '0896-5544-3322',
                    'dusun' => 'Dusun Srigunting',
                    'avatar' => 'assets/static/avatars/008m.jpg',
                    'total_produk' => 1,
                    'status' => 'diblokir',
                ],
                'dibuat_pada' => now()->subDays(12)->setTime(20, 25),
                'diperbarui_pada' => now()->subDays(3),
            ],
            (object) [
                'id' => 10,
                'kode_produk' => 'LPK-2026-0010',
                'nama_produk' => 'Madu Hutan liar 500ml',
                'harga' => 95000,
                'harga_asli' => null,
                'diskon' => null,
                'kategori' => 'Hasil Bumi & Pertanian',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Karangsari',
                'deskripsi' => 'Madu hutan liar murni tanpa campuran, panen dari lebah liar di lereng bukit desa. Kental dan beraroma khas.',
                'foto' => [
                    'assets/static/products/product-9.jpg',
                    'assets/static/products/product-3.jpg',
                ],
                'status' => 'aktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 421,
                'penjual' => (object) [
                    'id' => 20,
                    'nama' => 'Supardi',
                    'nik' => '3201012345670020',
                    'telepon' => '0812-6655-4433',
                    'dusun' => 'Dusun Karangsari',
                    'avatar' => 'assets/static/avatars/009m.jpg',
                    'total_produk' => 7,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(15)->setTime(6, 55),
                'diperbarui_pada' => now()->subDays(9),
            ],
            (object) [
                'id' => 11,
                'kode_produk' => 'LPK-2026-0011',
                'nama_produk' => 'Motor Honda Beat 2020',
                'harga' => 12500000,
                'harga_asli' => 13800000,
                'diskon' => 9,
                'kategori' => 'Otomotif',
                'kondisi' => 'Bekas - Bagus',
                'lokasi' => 'Dusun Krajan',
                'deskripsi' => 'Honda Beat 2020, servis rutin, ban baru, kilometeran rendah. Full service, surat lengkap, dan bisa nego sewajarnya.',
                'foto' => [
                    'assets/static/products/product-10.jpg',
                    'assets/static/products/product-11.jpg',
                    'assets/static/products/product-13.jpg',
                ],
                'status' => 'terjual',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 1204,
                'penjual' => (object) [
                    'id' => 21,
                    'nama' => 'Agus Setiawan',
                    'nik' => '3201012345670021',
                    'telepon' => '0819-0011-2233',
                    'dusun' => 'Dusun Krajan',
                    'avatar' => 'assets/static/avatars/010m.jpg',
                    'total_produk' => 2,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(18)->setTime(10, 30),
                'diperbarui_pada' => now()->subDays(6),
            ],
            (object) [
                'id' => 12,
                'kode_produk' => 'LPK-2026-0012',
                'nama_produk' => 'Gula Aren Cair 1 Liter',
                'harga' => 45000,
                'harga_asli' => null,
                'diskon' => null,
                'kategori' => 'Kuliner & Olahan',
                'kondisi' => 'Baru',
                'lokasi' => 'Dusun Kepudang',
                'deskripsi' => 'Gula aren cair murni tanpa pemanis tambahan, siap diminum atau sebagai bahan oligo. Kemasan 1 liter.',
                'foto' => [
                    'assets/static/products/product-4.jpg',
                ],
                'status' => 'nonaktif',
                'penawaran' => 'COD',
                'ketersediaan' => 'Stok Tersedia',
                'dilihat' => 58,
                'penjual' => (object) [
                    'id' => 22,
                    'nama' => 'Rina Marlina',
                    'nik' => '3201012345670022',
                    'telepon' => '0852-7788-6655',
                    'dusun' => 'Dusun Kepudang',
                    'avatar' => 'assets/static/avatars/011f.jpg',
                    'total_produk' => 3,
                    'status' => 'aktif',
                ],
                'dibuat_pada' => now()->subDays(21)->setTime(17, 10),
                'diperbarui_pada' => now()->subDays(1),
            ],
        ];
    }

    /**
     * Laporan warga terhadap produk lapak (dummy).
     *
     * @return Collection<int, \stdClass>
     */
    private function laporanDummy(): Collection
    {
        return collect($this->laporanData());
    }

    /**
     * Data laporan warga terhadap produk lapak (dummy).
     *
     * @return array<int, \stdClass>
     */
    private function laporanData(): array
    {
        return [
            (object) [
                'id' => 1,
                'kode_laporan' => 'LPR-2026-0001',
                'produk_id' => 9,
                'nama_produk' => 'Vacuum Cleaner 2 In 1',
                'pelapor' => 'Sari Wulandari',
                'alasan' => 'Foto produk tidak sesuai',
                'catatan' => 'Foto utama masih foto vacuum cleaner berbeda dan deskripsi kurang jelas, layanan yang tidak dipesan belum dijelaskan.',
                'status' => 'baru',
                'dibuat_pada' => now()->subHours(5),
            ],
            (object) [
                'id' => 2,
                'kode_laporan' => 'LPR-2026-0002',
                'produk_id' => 11,
                'nama_produk' => 'Motor Honda Beat 2020',
                'pelapor' => 'Fajar Nugroho',
                'alasan' => 'Informasi tidak sesuai',
                'catatan' => 'Harga yang tertera berbeda saat waktu ditawar, mohon ditinjau kembali.',
                'status' => 'diproses',
                'dibuat_pada' => now()->subDays(2)->setTime(15, 20),
            ],
            (object) [
                'id' => 3,
                'kode_laporan' => 'LPR-2026-0003',
                'produk_id' => 5,
                'nama_produk' => 'Kursi Rotan Tamu',
                'pelapor' => 'Yuni Astuti',
                'alasan' => 'Barang tidak layak / rusak',
                'catatan' => 'Kursi lapuk dan goyah saat dipakai, kondisi berbeda dari foto.',
                'status' => 'selesai',
                'dibuat_pada' => now()->subDays(4)->setTime(9, 45),
            ],
            (object) [
                'id' => 4,
                'kode_laporan' => 'LPR-2026-0004',
                'produk_id' => 2,
                'nama_produk' => 'Keripik Pisang Madu Kemasan 250gr',
                'pelapor' => 'Dedi Susanto',
                'alasan' => 'Penjual tidak bisa dihubungi',
                'catatan' => 'Nomor telepon tidak aktif sejak 3 hari terakhir.',
                'status' => 'baru',
                'dibuat_pada' => now()->subDays(6)->setTime(12, 5),
            ],
            (object) [
                'id' => 5,
                'kode_laporan' => 'LPR-2026-0005',
                'produk_id' => 12,
                'nama_produk' => 'Gula Aren Cair 1 Liter',
                'pelapor' => 'Maya Lestari',
                'alasan' => 'Konten tidak pantas',
                'catatan' => 'Foto produk tidak jelas sama sekali, mohon ditambahkan foto yang lebih baik sebelum produk diaktifkan kembali.',
                'status' => 'ditolak',
                'dibuat_pada' => now()->subDays(9)->setTime(18, 30),
            ],
        ];
    }
}
