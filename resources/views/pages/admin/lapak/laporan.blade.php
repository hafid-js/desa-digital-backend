@extends('layouts.app')

@section('content')
<x-ui.page-header pretitle="Lapak Warga" title="Laporan Produk">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-circle-chevron-left icon-lg me-1"></i>
                            Kembali ke dashboard
                        </a>
    </x-ui.page-header>
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
                                            <td class="cell-wrap">
                                                <div class="fw-medium">{{ $l->alasan }}</div>
                                                <div class="text-secondary small">{{ $l->catatan }}</div>
                                            </td>
                                            <td class="text-center">
                                                <x-ui.status-badge :status="$l->status" />
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
                                        <x-ui.empty-state :colspan="8" pesan="Belum ada laporan produk." />
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
                                    <x-tables.pagination :paginator="$laporan" :query-string="$queryString" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
