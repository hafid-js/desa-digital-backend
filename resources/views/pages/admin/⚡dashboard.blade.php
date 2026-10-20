<?php

use App\Http\Controllers\Admin\LapakWargaController;
use App\Models\Banner;
use App\Models\CuacaLokasi;
use App\Models\Pengaduan;
use App\Models\User;
use Livewire\Component;

new class extends Component
{
    public function render()
    {
        $lapak = app(LapakWargaController::class)->ringkasan();

        return $this->view([
            'lapak' => $lapak,
            'statistik' => [
                [
                    'label' => 'Produk Lapak',
                    'nilai' => $lapak['total_produk'],
                    'keterangan' => $lapak['produk_aktif'].' aktif tayang',
                    'ikon' => 'ti-shopping-bag',
                    'warna' => 'primary',
                    'link' => route('admin.lapak.index'),
                ],
                [
                    'label' => 'Laporan Produk',
                    'nilai' => $lapak['laporan_baru'],
                    'keterangan' => 'laporan baru perlu ditinjau',
                    'ikon' => 'ti-flag',
                    'warna' => 'red',
                    'link' => route('admin.lapak.laporan'),
                ],
                [
                    'label' => 'Pengaduan',
                    'nilai' => Pengaduan::count(),
                    'keterangan' => 'laporan warga masuk',
                    'ikon' => 'ti-alert-circle',
                    'warna' => 'orange',
                    'link' => route('admin.pengaduan.index'),
                ],
                [
                    'label' => 'Pengguna',
                    'nilai' => User::count(),
                    'keterangan' => 'warga terdaftar',
                    'ikon' => 'ti-users',
                    'warna' => 'azure',
                    'link' => route('admin.users.index'),
                ],
                [
                    'label' => 'Banner',
                    'nilai' => Banner::count(),
                    'keterangan' => 'banner tayang di aplikasi',
                    'ikon' => 'ti-carousel-horizontal',
                    'warna' => 'green',
                    'link' => route('admin.banner.index'),
                ],
                [
                    'label' => 'Lokasi Cuaca',
                    'nilai' => CuacaLokasi::count(),
                    'keterangan' => 'lokasi prakiraan cuaca',
                    'ikon' => 'ti-thermometer',
                    'warna' => 'cyan',
                    'link' => route('admin.cuaca.index'),
                ],
            ],
            'cuacaLokasi' => CuacaLokasi::orderBy('nama')->get(),
            'modul' => [
                [
                    'label' => 'Artikel',
                    'deskripsi' => 'Kelola berita dan pengumuman desa',
                    'ikon' => 'ti-photo-video',
                    'link' => route('admin.artikel.index'),
                ],
                [
                    'label' => 'Kategori Artikel',
                    'deskripsi' => 'Kelompokkan artikel sesuai kategori',
                    'ikon' => 'ti-list',
                    'link' => route('admin.kategori.index'),
                ],
                [
                    'label' => 'Agenda',
                    'deskripsi' => 'Jadwal kegiatan dan acara desa',
                    'ikon' => 'ti-calendar-week',
                    'link' => route('admin.agenda.index'),
                ],
                [
                    'label' => 'APBDes',
                    'deskripsi' => 'Data anggaran dan keuangan desa',
                    'ikon' => 'ti-coins',
                    'link' => route('admin.apbdes.index'),
                ],
                [
                    'label' => 'Master Lapak',
                    'deskripsi' => 'Kategori, kondisi, dan lokasi produk',
                    'ikon' => 'ti-package',
                    'link' => route('admin.lapak.kategori'),
                ],
                [
                    'label' => 'Role & Pengguna',
                    'deskripsi' => 'Atur akses petugas dan warga',
                    'ikon' => 'ti-shield-check',
                    'link' => route('admin.roles.index'),
                ],
            ],
        ]);
    }
};

?>

<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Overview</div>

                    <h1 class="page-title">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xl">
        <div class="row row-cards">
            @foreach ($statistik as $stat)
                <div class="col-6 col-lg-4 col-xl-2">
                    <a href="{{ $stat['link'] }}" class="card card-sm text-decoration-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="h1 mb-0">{{ $stat['nilai'] }}</div>
                                    <div class="text-secondary">{{ $stat['label'] }}</div>
                                </div>
                                <span class="bg-{{ $stat['warna'] }} text-{{ $stat['warna'] }}-fg avatar">
                                    <i class="ti {{ $stat['ikon'] }} icon-lg"></i>
                                </span>
                            </div>
                            <div class="text-secondary small mt-2">{{ $stat['keterangan'] }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row row-cards mt-3">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h3 class="card-title">Produk Lapak Terbaru</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.lapak.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-list icon-lg me-1"></i>
                                Kelola semua produk
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>PRODUK</th>
                                    <th>KATEGORI</th>
                                    <th>HARGA</th>
                                    <th>STATUS</th>
                                    <th class="w-1">DILIHAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lapak['produk_terbaru'] as $p)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset($p->foto[0]) }}" alt="{{ $p->nama_produk }}"
                                                    class="rounded" width="40" height="40"
                                                    style="object-fit: cover;">
                                                <div class="text-truncate" style="max-width: 220px;">
                                                    <a href="{{ route('admin.lapak.detail', $p->id) }}"
                                                        class="text-reset fw-medium d-block text-truncate">
                                                        {{ $p->nama_produk }}
                                                    </a>
                                                    <span class="text-secondary small">{{ $p->penjual->nama }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-blue-lt text-blue-fg">{{ $p->kategori }}</span>
                                        </td>
                                        <td>
                                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-pill bg-{{ $p->status === 'aktif' ? 'green text-green-fg' : ($p->status === 'terjual' ? 'blue text-blue-fg' : 'orange text-orange-fg') }}">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td class="text-secondary">
                                            {{ number_format($p->dilihat) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-secondary mb-0">Belum ada produk lapak.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h3 class="card-title">Akses Cepat</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            @foreach ($modul as $m)
                                <div class="col-12 col-sm-6">
                                    <a href="{{ $m['link'] }}"
                                        class="card card-sm text-decoration-none h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="ti {{ $m['ikon'] }} me-2 text-primary"></i>
                                                <span class="fw-medium">{{ $m['label'] }}</span>
                                            </div>
                                            <div class="text-secondary small">{{ $m['deskripsi'] }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h3 class="card-title">Lokasi Cuaca Terdaftar</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.cuaca.index') }}" class="btn btn-outline-primary btn-sm">
                                Kelola
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse ($cuacaLokasi as $lokasi)
                                <div class="list-group-item d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-medium">{{ $lokasi->nama }}</div>
                                        <div class="text-secondary small">
                                            {{ $lokasi->latitude }}, {{ $lokasi->longitude }}
                                        </div>
                                    </div>
                                    <span
                                        class="badge bg-{{ $lokasi->is_aktif ? 'green text-green-fg' : 'secondary text-secondary-fg' }}">
                                        {{ $lokasi->is_aktif ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            @empty
                                <div class="list-group-item text-secondary">
                                    Belum ada lokasi cuaca terdaftar.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
