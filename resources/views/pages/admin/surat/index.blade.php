@extends('layouts.app')

@section('content')
<x-ui.page-header pretitle="Layanan Administrasi" title="Permohonan Surat">
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
                            <x-tables.filter-bar :action="route('admin.surat.index')" :search="$search"
                                label="Cari Surat" placeholder="Kode surat, pemohon, atau wilayah..."
                                :bersihkan-url="route('admin.surat.index')"
                                :bersihkan="(bool) ($search || $selectedStatus || $selectedJenis)">
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
                            </x-tables.filter-bar>
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
                                            <td class="cell-wrap">
                                                {{ $s->keperluan }}
                                            </td>
                                            <td class="text-center">
                                                <x-ui.status-badge :status="$s->status" />
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
                                        <x-ui.empty-state :colspan="9" pesan="Belum ada permohonan surat yang sesuai filter." />
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
                                    <x-tables.pagination :paginator="$surat" :query-string="$queryString" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
