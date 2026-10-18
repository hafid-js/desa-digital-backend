@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Pengaduan Masyarakat</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <form method="GET" class="d-flex d-md-inline-flex align-items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $selectedStatus ?? '' }}">
                                        <input type="text" name="search" value="{{ $search ?? '' }}"
                                            placeholder="Cari kode, pelapor, wilayah, atau rincian..."
                                            class="form-control form-control-sm">
                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                class="ti ti-search"></i></button>
                                        @if($search ?? '')
                                            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary btn-sm">Bersihkan</a>
                                        @endif
                                    </form>
                                </div>

                                <div class="col-12 col-md-auto">
                                    <form method="GET" class="d-flex d-md-inline-flex align-items-center gap-2">
                                        <input type="hidden" name="search" value="{{ $search ?? '' }}">
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="">Semua Status</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status }}"
                                                    {{ $selectedStatus == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
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
                                            <td style="white-space: normal; overflow-wrap: anywhere;">
                                                {{ $p->rincian ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill bg-{{ $p->status === 'selesai' ? 'green text-green-fg' : ($p->status === 'ditolak' ? 'red text-red-fg' : ($p->status === 'verifikasi' ? 'cyan text-cyan-fg' : ($p->status === 'diproses' ? 'orange text-orange-fg' : 'blue text-blue-fg'))) }}">{{ ucfirst($p->status) }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $p->created_at ? $p->created_at->format('d M Y H:i') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pengaduan.detail', $p->kode_laporan) }}"
                                                    class="btn btn-sm btn-outline-primary"><i
                                                        class="ti ti-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada data pengaduan.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing <strong>{{ $pengaduans->firstItem ?? 0 }} to {{ $pengaduans->lastItem ?? 0 }}</strong> of <strong>{{ $pengaduans->total }}</strong> entries</p>
                                </div>
                                <div class="col-auto">
                                    @if($pengaduans->lastPage > 1)
                                        <nav aria-label="Pagination">
                                            <ul class="pagination m-0 ms-auto">
                                                @if($pengaduans->currentPage > 1)
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page={{ $pengaduans->currentPage - 1 }}{{ $queryString ? '&'.$queryString : '' }}" aria-label="Previous page">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" aria-hidden="true"
                                                                focusable="false" class="icon">
                                                                <path d="M15 6l-6 6l6 6"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endif
                                                @for($i = 1; $i <= $pengaduans->lastPage; $i++)
                                                    <li class="page-item {{ $i == $pengaduans->currentPage ? 'active' : '' }}">
                                                        <a class="page-link" href="?page={{ $i }}{{ $queryString ? '&'.$queryString : '' }}">
                                                            {{ $i }}
                                                        </a>
                                                    </li>
                                                @endfor
                                                @if($pengaduans->currentPage < $pengaduans->lastPage)
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page={{ $pengaduans->currentPage + 1 }}{{ $queryString ? '&'.$queryString : '' }}" aria-label="Next page">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" aria-hidden="true"
                                                                focusable="false" class="icon">
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
