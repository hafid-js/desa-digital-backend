@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Lapak Warga</div>
                    <h1 class="page-title">Laporan Produk</h1>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.lapak.index') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-circle-chevron-left icon-lg me-1"></i>
                            Kembali ke daftar produk
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
                            <form action="{{ route('admin.lapak.laporan') }}" method="GET"
                                class="row g-2 align-items-end">
                                <div class="col-12 col-md-5">
                                    <label class="form-label" for="cari-laporan">Cari Laporan</label>
                                    <div class="input-icon">
                                        <input type="text" name="search" id="cari-laporan" value="{{ $search }}"
                                            placeholder="Kode laporan, produk, atau pelapor..."
                                            class="form-control form-control-sm">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="filter-status-laporan">Status</label>
                                    <select class="form-select form-select-sm" id="filter-status-laporan" name="status">
                                        <option value="">Semua Status</option>
                                        @foreach ($statuses as $key => $label)
                                            <option value="{{ $key }}" {{ $selectedStatus == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-auto">
                                    <div class="btn-list">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="ti ti-filter icon-lg me-1"></i>
                                            Terapkan
                                        </button>
                                        @if ($search || $selectedStatus)
                                            <a href="{{ route('admin.lapak.laporan') }}" class="btn btn-sm">
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
                                        <th class="text-center" style="width: 150px;">KODE LAPORAN</th>
                                        <th style="min-width: 200px;">PRODUK</th>
                                        <th style="min-width: 150px;">PELAPOR</th>
                                        <th style="min-width: 250px;">ALASAN</th>
                                        <th class="text-center" style="width: 120px;">STATUS</th>
                                        <th class="text-center" style="width: 150px;">TANGGAL</th>
                                        <th class="text-center" style="width: 150px;">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($laporan->items as $l)
                                        <tr>
                                            <td>
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-outline text-blue">{{ $l->kode_laporan }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.lapak.detail', $l->produk_id) }}"
                                                    class="text-reset fw-medium">
                                                    {{ $l->nama_produk }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $l->pelapor }}
                                            </td>
                                            <td style="white-space: normal; overflow-wrap: anywhere;">
                                                <div class="fw-medium">{{ $l->alasan }}</div>
                                                <div class="text-secondary small">{{ $l->catatan }}</div>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="badge badge-pill bg-{{ $l->status === 'selesai' ? 'green text-green-fg' : ($l->status === 'ditolak' ? 'red text-red-fg' : ($l->status === 'diproses' ? 'orange text-orange-fg' : 'blue text-blue-fg')) }}">
                                                    {{ $statuses[$l->status] ?? ucfirst($l->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                {{ $l->dibuat_pada->format('d M Y H:i') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-nowrap gap-1 justify-content-center">
                                                    <a href="{{ route('admin.lapak.detail', $l->produk_id) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Lihat produk">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        title="Tandai selesai">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        title="Hapus produk bermasalah">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada laporan produk.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing <strong>{{ $laporan->firstItem }}</strong> to
                                        <strong>{{ $laporan->lastItem }}</strong> of
                                        <strong>{{ $laporan->total }}</strong> entries
                                    </p>
                                </div>
                                <div class="col-auto">
                                    @if ($laporan->lastPage > 1)
                                        <nav aria-label="Pagination">
                                            <ul class="pagination m-0 ms-auto">
                                                @if ($laporan->currentPage > 1)
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="?page={{ $laporan->currentPage - 1 }}{{ $queryString ? '&' . $queryString : '' }}"
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
                                                @for ($i = 1; $i <= $laporan->lastPage; $i++)
                                                    <li class="page-item {{ $i == $laporan->currentPage ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="?page={{ $i }}{{ $queryString ? '&' . $queryString : '' }}">
                                                            {{ $i }}
                                                        </a>
                                                    </li>
                                                @endfor
                                                @if ($laporan->currentPage < $laporan->lastPage)
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="?page={{ $laporan->currentPage + 1 }}{{ $queryString ? '&' . $queryString : '' }}"
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
