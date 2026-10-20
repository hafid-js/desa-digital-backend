@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Layanan Administrasi</div>
                    <h1 class="page-title">Permohonan Surat</h1>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-circle-chevron-left icon-lg me-1"></i>
                            Kembali ke dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <form action="{{ route('admin.surat.index') }}" method="GET"
                                class="row g-2 align-items-end">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="cari-surat">Cari Surat</label>
                                    <div class="input-icon">
                                        <input type="text" name="search" id="cari-surat" value="{{ $search }}"
                                            placeholder="Kode surat, pemohon, atau wilayah..."
                                            class="form-control form-control-sm">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="filter-status-surat">Status</label>
                                    <select class="form-select form-select-sm" id="filter-status-surat" name="status">
                                        <option value="">Semua Status</option>
                                        @foreach ($statuses as $key => $label)
                                            <option value="{{ $key }}" {{ $selectedStatus == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="filter-jenis-surat">Jenis Surat</label>
                                    <select class="form-select form-select-sm" id="filter-jenis-surat" name="jenis">
                                        <option value="">Semua Jenis</option>
                                        @foreach ($jenisSurat as $kode => $jenis)
                                            <option value="{{ $kode }}" {{ $selectedJenis == $kode ? 'selected' : '' }}>
                                                {{ $kode }} - {{ $jenis['nama_surat'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <div class="btn-list">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="ti ti-filter icon-lg me-1"></i>
                                            Terapkan
                                        </button>
                                        @if ($search || $selectedStatus || $selectedJenis)
                                            <a href="{{ route('admin.surat.index') }}" class="btn btn-sm">
                                                Bersihkan
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 0px;">
                                            <input class="form-check-input m-0" type="checkbox">
                                        </th>
                                        <th class="text-center" style="width: 110px;">KODE</th>
                                        <th style="min-width: 220px;">JENIS SURAT</th>
                                        <th style="min-width: 180px;">PEMOHON</th>
                                        <th style="min-width: 150px;">WILAYAH</th>
                                        <th style="min-width: 220px;">KEPERLUAN</th>
                                        <th class="text-center" style="width: 140px;">STATUS</th>
                                        <th class="text-center" style="width: 150px;">DIAJUKAN</th>
                                        <th class="text-center" style="width: 140px;">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($surat->items as $s)
                                        <tr>
                                            <td>
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td class="text-center">
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
                                                <div>{{ $s->nama_pemohon }}</div>
                                                <div class="text-secondary small">{{ $s->nik }}</div>
                                            </td>
                                            <td>
                                                {{ $s->wilayah }}
                                            </td>
                                            <td style="white-space: normal; overflow-wrap: anywhere;">
                                                {{ $s->keperluan }}
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="badge badge-pill bg-{{ $s->status === 'selesai' ? 'green text-green-fg' : ($s->status === 'ditolak' ? 'red text-red-fg' : ($s->status === 'diproses' ? 'orange text-orange-fg' : 'blue text-blue-fg')) }}">
                                                    {{ $statuses[$s->status] ?? ucfirst($s->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                {{ $s->tanggal_diajukan->format('d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-nowrap gap-1 justify-content-center">
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        title="Lihat detail">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        title="Verifikasi">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        title="Unduh surat">
                                                        <i class="ti ti-download"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada permohonan surat yang sesuai filter.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing <strong>{{ $surat->firstItem }}</strong> to
                                        <strong>{{ $surat->lastItem }}</strong> of
                                        <strong>{{ $surat->total }}</strong> entries
                                    </p>
                                </div>
                                <div class="col-auto">
                                    @if ($surat->lastPage > 1)
                                        <nav aria-label="Pagination">
                                            <ul class="pagination m-0 ms-auto">
                                                @if ($surat->currentPage > 1)
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="?page={{ $surat->currentPage - 1 }}{{ $queryString ? '&' . $queryString : '' }}"
                                                            aria-label="Previous page">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" aria-hidden="true" focusable="false"
                                                                class="icon">
                                                                <path d="M15 6l-6 6l6 6"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endif
                                                @for ($i = 1; $i <= $surat->lastPage; $i++)
                                                    <li class="page-item {{ $i == $surat->currentPage ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="?page={{ $i }}{{ $queryString ? '&' . $queryString : '' }}">
                                                            {{ $i }}
                                                        </a>
                                                    </li>
                                                @endfor
                                                @if ($surat->currentPage < $surat->lastPage)
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="?page={{ $surat->currentPage + 1 }}{{ $queryString ? '&' . $queryString : '' }}"
                                                            aria-label="Next page">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" aria-hidden="true" focusable="false"
                                                                class="icon">
                                                                <path d="M9 6l6 6l-6 6"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
