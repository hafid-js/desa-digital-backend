<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusProduk;
use App\Http\Controllers\Controller;
use App\Queries\LaporanProdukQuery;
use App\Queries\ProdukLapakQuery;
use App\Support\Dummy\OpsiLapakDummy;
use App\Support\Dummy\ProdukLapakDummy;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LapakWargaController extends Controller
{
    /**
     * Daftar produk lapak warga. Data masih dummy sampai tabel produk tersedia.
     */
    public function index(Request $request): View
    {
        $query = new ProdukLapakQuery;

        return view('pages.admin.lapak.index', [
            'produk' => $query->paginate($request),
            'statistik' => $this->statistik(),
            'statuses' => $query->statusOptions(),
            'kategoriList' => $query->kategoriOptions(),
            'lokasiList' => $query->lokasiOptions(),
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
     * Detail produk beserta informasi penjual dan riwayat moderasi.
     */
    public function detail(string $id): View
    {
        $produk = ProdukLapakDummy::all()->firstWhere('id', $id);

        abort_if($produk === null, 404, 'Produk lapak tidak ditemukan.');

        $laporan = (new LaporanProdukQuery)->all()
            ->where('produk_id', $produk->id)
            ->values();

        return view('pages.admin.lapak.detail', [
            'produk' => $produk,
            'laporan' => $laporan,
            'statuses' => (new ProdukLapakQuery)->statusOptions(),
            'kategoriList' => OpsiLapakDummy::kategori()->pluck('nama')->all(),
            'kondisiList' => OpsiLapakDummy::kondisi(),
            'lokasiList' => OpsiLapakDummy::lokasi(),
        ]);
    }

    /**
     * Master kategori, kondisi, dan lokasi untuk lapak warga.
     */
    public function kategori(): View
    {
        return view('pages.admin.lapak.kategori', [
            'kategori' => OpsiLapakDummy::kategori(),
            'kondisi' => OpsiLapakDummy::kondisi(),
            'lokasi' => OpsiLapakDummy::lokasi(),
        ]);
    }

    /**
     * Laporan warga terhadap produk lapak.
     */
    public function laporan(Request $request): View
    {
        $query = new LaporanProdukQuery;

        return view('pages.admin.lapak.laporan', [
            'laporan' => $query->paginate($request),
            'statuses' => $query->statusOptions(),
            'selectedStatus' => $request->status,
            'search' => $request->search,
            'queryString' => http_build_query(array_filter([
                'search' => $request->search ?: null,
                'status' => $request->status ?: null,
            ])),
        ]);
    }

    /**
     * Ringkasan jumlah produk per status untuk kartu statistik.
     *
     * @return array<int, array<string, mixed>>
     */
    private function statistik(): array
    {
        $query = new ProdukLapakQuery;
        $produk = $query->all();

        return [
            [
                'label' => 'Total Produk',
                'nilai' => $produk->count(),
                'ikon' => 'ti-package',
                'warna' => 'primary',
            ],
            [
                'label' => 'Aktif Tayang',
                'nilai' => $produk->where('status', StatusProduk::Aktif)->count(),
                'ikon' => 'ti-eye',
                'warna' => 'green',
            ],
            [
                'label' => 'Nonaktif',
                'nilai' => $produk->where('status', StatusProduk::Nonaktif)->count(),
                'ikon' => 'ti-eye-off',
                'warna' => 'orange',
            ],
            [
                'label' => 'Terjual',
                'nilai' => $produk->where('status', StatusProduk::Terjual)->count(),
                'ikon' => 'ti-shopping-cart-check',
                'warna' => 'blue',
            ],
        ];
    }
}
