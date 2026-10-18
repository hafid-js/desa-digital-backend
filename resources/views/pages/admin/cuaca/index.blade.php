@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Lokasi Cuaca</h1>
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
                                    <button type="button" class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modalTambahCuaca">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Lokasi</span>
                                    </button>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <a href="#"
                                        class="btn btn-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-trash icon-lg me-1"></i>
                                        <span>Hapus Data Terpilih</span>
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
                                            size="3" aria-label="Locations count">
                                    </div>
                                    entries
                                </div>

                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search location">
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
                                        <th class="text-center" style="width: 100px;">AKSI</th>
                                        <th class="text-center" style="min-width: 200px;">NAMA LOKASI</th>
                                        <th class="text-end" style="width: 150px;">LATITUDE</th>
                                        <th class="text-end" style="width: 150px;">LONGITUDE</th>
                                        <th class="text-center" style="width: 100px;">AKTIF</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($cuacaList as $item)
                                        <tr>
                                            <td class="text-center">
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center flex-wrap gap-1">
                                                    <a href="#" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ $item['nama'] ?? '-' }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item['latitude'] ?? '-' }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item['longitude'] ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $item['is_aktif'] ? 'green text-green-fg' : 'secondary text-secondary-fg' }}">
                                                    {{ $item['is_aktif'] ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada data lokasi cuaca.</p>
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

    <!-- Modal Tambah Lokasi Cuaca -->
    <div class="modal modal-blur fade" id="modalTambahCuaca" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahCuacaTitle">Tambah Lokasi Cuaca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="space-y">
                            <div>
                                <label class="form-label" for="nama-cuaca">Nama Lokasi</label>
                                <input type="text" placeholder="Nama lokasi cuaca" class="form-control"
                                    id="nama-cuaca" name="nama">
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="latitude-cuaca">Latitude</label>
                                    <input type="number" step="any" placeholder="Contoh: -7.57971"
                                        class="form-control" id="latitude-cuaca" name="latitude">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="longitude-cuaca">Longitude</label>
                                    <input type="number" step="any" placeholder="Contoh: 109.88204"
                                        class="form-control" id="longitude-cuaca" name="longitude">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="status-cuaca">Status</label>
                                <select class="form-select" id="status-cuaca" name="is_aktif">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"><i
                            class="ti ti-x me-1"></i> Batal</button>
                    <button type="button" class="btn btn-primary w-100"><i
                            class="ti ti-check me-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
