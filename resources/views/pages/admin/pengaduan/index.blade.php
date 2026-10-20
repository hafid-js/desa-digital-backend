@extends('layouts.app')

@section('content')
<x-ui.page-header title="Pengaduan Masyarakat" />
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <form action="{{ route('admin.pengaduan.index') }}" method="GET"
                                        class="d-flex align-items-center gap-2 mb-3">
                                        @if (!empty($selectedStatus))
                                            <input type="hidden" name="status" value="{{ $selectedStatus }}">
                                        @endif

                                        <div class="input-icon flex-fill position-relative">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                placeholder="Cari kode, pelapor, wilayah, atau rincian..."
                                                class="form-control form-control-sm pe-4">
                                        </div>

                                        {{-- <button type="submit" class="btn btn-primary"><i
                                                class="ti ti-search icon-lg"></i></button> --}}

                                        @if (request('search'))
                                            <a href="{{ route('admin.pengaduan.index', array_filter(['status' => $selectedStatus ?? null])) }}"
                                                class="btn">
                                                Bersihkan
                                            </a>
                                        @endif
                                    </form>
                                </div>

                                <div class="col-12 col-md-auto">
                                    <form method="GET" class="d-flex d-md-inline-flex align-items-center gap-2">
                                        <input type="hidden" name="search" value="{{ $search ?? '' }}">
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="">Semua Status</option>
                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ $selectedStatus == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 0px;">
                                            <input class="form-check-input m-0" type="checkbox">
                                        </th>
                                        <th class="text-center" style="width: 150px;">KODE LAPORAN</th>
                                        <th class="text-center" style="width: 150px;">PELAPOR</th>
                                        <th class="text-center" style="min-width: 150px;">WILAYAH</th>
                                        <th style="min-width: 200px;">RINCIAN</th>
                                        <th class="text-center" style="width: 120px;">STATUS</th>
                                        <th class="text-center" style="width: 150px;">WAKTU DIBUAT</th>
                                        <th class="text-center" style="width: 120px;">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($pengaduans->items as $p)
                                        <tr>
                                            <td>
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td>
                                                <span class="badge badge-outline text-blue">{{ $p->kode_laporan }}</span>
                                            </td>
                                            <td>
                                                {{ $p->nama_pelapor ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $p->wilayah ?? '-' }}
                                            </td>
                                            <td class="cell-wrap">
                                                {{ $p->rincian ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <x-ui.status-badge :status="$p->status" />
                                            </td>
                                            <td class="text-center">
                                                {{ $p->created_at ? $p->created_at->format('d M Y H:i') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pengaduan.detail', $p->kode_laporan) }}"
                                                    class="btn btn-sm btn-outline-primary"><i class="ti ti-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <x-ui.empty-state :colspan="8" pesan="Belum ada data pengaduan." />
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing <strong>{{ $pengaduans->firstItem ?? 0 }} to
                                            {{ $pengaduans->lastItem ?? 0 }}</strong> of
                                        <strong>{{ $pengaduans->total }}</strong> entries
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <x-tables.pagination :paginator="$pengaduans" :query-string="$queryString" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
