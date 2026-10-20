<?php

use App\Models\CuacaLokasi;
use App\Queries\DashboardQuery;
use Livewire\Component;

new class extends Component
{
    public function render()
    {
        $summary = (new DashboardQuery())->summary();

        return $this->view([
            'summary' => $summary,
            'statistik' => [
                [
                    'label' => 'Pengaduan',
                    'nilai' => $summary->pengaduanTotal,
                    'keterangan' => $summary->pengaduanPerluTindakLanjut.' perlu ditindaklanjuti',
                    'ikon' => 'ti-alert-circle',
                    'warna' => 'red',
                    'link' => route('admin.pengaduan.index'),
                ],
                [
                    'label' => 'Permohonan Surat',
                    'nilai' => $summary->suratTotal,
                    'keterangan' => $summary->suratPerluProses.' sedang diproses',
                    'ikon' => 'ti-file-certificate',
                    'warna' => 'orange',
                    'link' => route('admin.surat.index'),
                ],
                [
                    'label' => 'Realisasi APBDes',
                    'nilai' => $summary->apbdesPersentase.'%',
                    'keterangan' => 'tahun anggaran '.$summary->apbdesTahunAnggaran,
                    'ikon' => 'ti-coins',
                    'warna' => 'green',
                    'link' => route('admin.apbdes.index'),
                ],
                [
                    'label' => 'Produk Lapak',
                    'nilai' => $summary->produkTotal,
                    'keterangan' => $summary->produkAktif.' aktif tayang',
                    'ikon' => 'ti-shopping-bag',
                    'warna' => 'primary',
                    'link' => route('admin.lapak.index'),
                ],
                [
                    'label' => 'Laporan Produk',
                    'nilai' => $summary->laporanBaru,
                    'keterangan' => 'laporan baru perlu ditinjau',
                    'ikon' => 'ti-flag',
                    'warna' => 'azure',
                    'link' => route('admin.lapak.laporan'),
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
                    'label' => 'Pengaduan',
                    'deskripsi' => 'Tindak lanjuti laporan warga',
                    'ikon' => 'ti-alert-circle',
                    'link' => route('admin.pengaduan.index'),
                ],
                [
                    'label' => 'Permohonan Surat',
                    'deskripsi' => 'Verifikasi dan proses surat warga',
                    'ikon' => 'ti-file-certificate',
                    'link' => route('admin.surat.index'),
                ],
                [
                    'label' => 'APBDes',
                    'deskripsi' => 'Rincian realisasi anggaran desa',
                    'ikon' => 'ti-coins',
                    'link' => route('admin.apbdes.index'),
                ],
                [
                    'label' => 'Artikel',
                    'deskripsi' => 'Kelola berita dan pengumuman desa',
                    'ikon' => 'ti-photo-video',
                    'link' => route('admin.artikel.index'),
                ],
                [
                    'label' => 'Agenda',
                    'deskripsi' => 'Jadwal kegiatan dan acara desa',
                    'ikon' => 'ti-calendar-week',
                    'link' => route('admin.agenda.index'),
                ],
                [
                    'label' => 'Lapak Warga',
                    'deskripsi' => 'Produk dan laporan warga',
                    'ikon' => 'ti-shopping-bag',
                    'link' => route('admin.lapak.index'),
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
                    <x-ui.stat-card :label="$stat['label']" :nilai="$stat['nilai']"
                        :keterangan="$stat['keterangan']" :ikon="$stat['ikon']" :warna="$stat['warna']"
                        :link="$stat['link']" variant="icon-right" />
                </div>
            @endforeach
        </div>

        <div class="row row-cards mt-3">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h3 class="card-title">Pengaduan Masyarakat</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-list icon-lg me-1"></i>
                                Kelola semua pengaduan
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">KODE</th>
                                    <th>PELAPOR</th>
                                    <th>WILAYAH</th>
                                    <th>RINCIAN</th>
                                    <th class="w-1">STATUS</th>
                                    <th class="w-1">TANGGAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($summary->pengaduanTerbaru as $p)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.pengaduan.detail', $p->kode_laporan) }}"
                                                class="badge badge-outline text-blue">
                                                {{ $p->kode_laporan }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $p->nama_pelapor }}
                                        </td>
                                        <td>
                                            {{ $p->wilayah }}
                                        </td>
                                        <td class="cell-wrap">
                                            {{ $p->rincian }}
                                        </td>
                                        <td>
                                            <x-ui.status-badge :status="$p->status" />
                                        </td>
                                        <td class="text-secondary">
                                            {{ $p->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <p class="text-secondary mb-0">Belum ada pengaduan masyarakat.</p>
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
            </div>
        </div>

        <div class="row row-cards mt-3">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h3 class="card-title">Permohonan Surat</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.surat.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-list icon-lg me-1"></i>
                                Kelola semua surat
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">KODE</th>
                                    <th>JENIS SURAT</th>
                                    <th>PEMOHON</th>
                                    <th>KEPERLUAN</th>
                                    <th class="w-1">STATUS</th>
                                    <th class="w-1">DIAJUKAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($summary->suratTerbaru as $s)
                                    <tr>
                                        <td>
                                            <span class="badge badge-outline text-blue">{{ $s->kode_surat }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $s->nama_surat }}</div>
                                            @if ($s->mandiri)
                                                <span class="badge bg-green-lt text-green-fg mt-1">Mandiri</span>
                                            @else
                                                <span class="badge bg-orange-lt text-orange-fg mt-1">Perlu Proses Desa</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $s->nama_pemohon }}
                                        </td>
                                        <td class="cell-wrap">
                                            {{ $s->keperluan }}
                                        </td>
                                        <td>
                                            <x-ui.status-badge :status="$s->status" />
                                        </td>
                                        <td class="text-secondary">
                                            {{ $s->tanggal_diajukan->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <p class="text-secondary mb-0">Belum ada permohonan surat.</p>
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
                        <h3 class="card-title">Rincian APBDes</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.apbdes.index') }}" class="btn btn-outline-primary btn-sm">
                                Kelola
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Total realisasi</span>
                                <span class="fw-medium">
                                    Rp {{ number_format($summary->apbdesTotalRealisasi, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Total anggaran</span>
                                <span class="fw-medium">
                                    Rp {{ number_format($summary->apbdesTotalTarget, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        @foreach ($summary->apbdesRincian as $r)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-truncate me-2">{{ $r['judul'] }}</span>
                                    <span class="fw-medium">{{ number_format($r['persentase'], 1) }}%</span>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar" style="width: {{ $r['persentase'] }}%"
                                        role="progressbar" aria-valuenow="{{ $r['persentase'] }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
                                    <th class="w-1">STATUS</th>
                                    <th class="w-1">DILIHAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($summary->produkTerbaru as $p)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset($p->foto[0]) }}" alt="{{ $p->nama_produk }}"
                                                    class="rounded" width="40" height="40"
                                                    class="img-cover">
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
                                            <x-ui.status-badge :status="$p->status" />
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
