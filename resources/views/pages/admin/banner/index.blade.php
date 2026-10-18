@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Banner Carousel</h1>
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
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <a href="{{ route('admin.banner.tambah') }}"
                                        class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Banner</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="8"
                                            size="3" aria-label="Banners count">
                                    </div>
                                    entries
                                </div>

                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search banner">
                                    </div>
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
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th class="text-center" style="width: 100px;">GAMBAR</th>
                                        <th class="text-center" style="min-width: 200px;">JUDUL</th>
                                        <th class="text-center" style="min-width: 200px;">KETERANGAN</th>
                                        <th class="text-center" style="width: 100px;">STATUS</th>
                                        <th class="text-center" style="width: 100px;">URUTAN</th>
                                        <th class="text-center" style="width: 200px;">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($bannerList as $banner)
                                        <tr>
                                            <td>
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset($banner['gambar']) }}"
                                                    alt="{{ $banner['judul'] }}"
                                                    class="rounded" width="60" height="40">
                                            </td>
                                            <td>
                                                {{ $banner['judul'] ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $banner['keterangan'] ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $banner['status'] === 'Aktif' ? 'green text-green-fg' : 'secondary text-secondary-fg' }}">{{ $banner['status'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $banner['urutan'] ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    <a href="#" class="btn btn-warning btn-sm"><i
                                                            class="ti ti-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i
                                                            class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada data banner.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing <strong>1 to 8</strong> of <strong>3
                                            entries</strong></p>
                                </div>
                                <div class="col-auto">

                                    <nav aria-label="Pagination">
                                        <ul class="pagination m-0 ms-auto">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"
                                                    aria-label="Previous page">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" aria-hidden="true"
                                                        focusable="false" class="icon">
                                                        <path d="M15 6l-6 6l6 6"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#" aria-label="Page 1"
                                                    aria-current="page">
                                                    1
                                                </a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next page">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" aria-hidden="true"
                                                        focusable="false" class="icon">
                                                        <path d="M9 6l6 6l-6 6"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
