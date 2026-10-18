@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Artikel</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-xs-12 col-md-3 mb-2">
                    <div class="card mb-2">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    Semua Artikel Dinamis
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Kategori Artikel</h2>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    Pengumuman
                                </div>
                                <div class="list-group-item active">
                                    Pemerintahan Desa
                                </div>
                                <div class="list-group-item">
                                    Kegiatan dan Acara
                                </div>
                                <div class="list-group-item">
                                    Pembangunan Desa
                                </div>
                                <div class="list-group-item">
                                    Pelayanan Publik
                                </div>
                                <div class="list-group-item">
                                    Sosial dan Kemasyarakatan
                                </div>
                                <div class="list-group-item">
                                    Ekonomi dan UMKM
                                </div>
                                <div class="list-group-item">
                                    Pertanian dan Peternakan
                                </div>
                                <div class="list-group-item">
                                    Kesehatan dan Lingkungan
                                </div>
                                <div class="list-group-item">
                                    Pendidikan
                                </div>
                                <div class="list-group-item">
                                    Budaya dan Pariwisata
                                </div>
                                <div class="list-group-item">
                                    Keamanan dan Ketertiban
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-9 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <a href="{{ route('admin.artikel.tambah') }}"
                                        class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Artikel</span>
                                    </a>
                                </div>

                                <div class="col-12 col-md-auto">
                                    <a href="#"
                                        class="btn disabled btn-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-trash icon-lg me-1"></i>
                                        <span>Hapus Data Terpilih</span>
                                    </a>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <a href="#"
                                        class="btn btn-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-trash icon-lg me-1"></i>
                                        <span>Hapus Artikel Kategori Pemerintahan</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <select name="" class="form-select  d-flex d-md-inline-flex">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="2">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="8"
                                            size="3" aria-label="Invoices count">
                                    </div>
                                    entries
                                </div>

                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search invoice">
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
                                        <th class="text-center" style="width: 200px;">AKSI</th>
                                        <th class="text-center" style="min-width: 300px;">JUDUL</th>
                                        <th class="text-center" style="width: 100px;">HIT</th>
                                        <th class="text-center" style="width: 150px;">DIPOSTING PADA</th>
                                        <th class="text-center" style="width: 40px;"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="{{ route('admin.artikel.tambah') }}"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusArtikel"><i class="ti ti-trash"></i></a>
                                                <a href="#" class="btn btn-cyan btn-sm"><i
                                                        class="ti ti-folder-open"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-success btn-sm"><i
                                                        class="ti ti-eye"></i></a>
                                            </div>
                                        </td>
                                        <td style="white-space: normal; overflow-wrap: anywhere;">
                                            Sambut pilwana serentak: Bamus Sitapa lantik panitia pemilihan Wali
                                            Nagari
                                            periode 2022-2028
                                        </td>
                                        <td>1.440 Kali</td>
                                        <td>15 Dec 2017</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">2</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-nowrap gap-1">
                                                <a href="#" class="btn btn-warning btn-sm"><i
                                                        class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusArtikel"><i class="ti ti-trash"></i></a>
                                                <a href="#" class="btn btn-cyan btn-sm"><i
                                                        class="ti ti-folder-open"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-success btn-sm"><i
                                                        class="ti ti-eye"></i></a>
                                            </div>
                                        </td>
                                        <td style="white-space: normal; overflow-wrap: anywhere;">
                                            Sambut pilwana serentak: Bamus Sitapa lantik panitia pemilihan Wali
                                            Nagari
                                            periode 2022-2028
                                        </td>
                                        <td>1.440 Kali</td>
                                        <td>15 Dec 2017</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">3</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" class="btn btn-warning btn-sm"><i
                                                        class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusArtikel"><i class="ti ti-trash"></i></a>
                                                <a href="#" class="btn btn-cyan btn-sm"><i
                                                        class="ti ti-folder-open"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-success btn-sm"><i
                                                        class="ti ti-eye"></i></a>
                                            </div>
                                        </td>
                                        <td style="white-space: normal; overflow-wrap: anywhere;">
                                            Sambut pilwana serentak: Bamus Sitapa lantik panitia pemilihan Wali
                                            Nagari
                                            periode 2022-2028
                                        </td>
                                        <td>1.440 Kali</td>
                                        <td>15 Dec 2017</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">4</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" class="btn btn-warning btn-sm"><i
                                                        class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusArtikel"><i class="ti ti-trash"></i></a>
                                                <a href="#" class="btn btn-cyan btn-sm"><i
                                                        class="ti ti-folder-open"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-success btn-sm"><i
                                                        class="ti ti-eye"></i></a>
                                            </div>
                                        </td>
                                        <td style="white-space: normal; overflow-wrap: anywhere;">
                                            Sambut pilwana serentak: Bamus Sitapa lantik panitia pemilihan Wali
                                            Nagari
                                            periode 2022-2028
                                        </td>
                                        <td>1.440 Kali</td>
                                        <td>15 Dec 2017</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary">Showing <strong>1 to 8</strong> of <strong>16
                                            entries</strong></p>
                                </div>
                                <div class="col-auto">
                                    <nav aria-label="Pagination">
                                        <ul class="pagination m-0 ms-auto">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"
                                                    aria-label="Previous page">
                                                    <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-left -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true" focusable="false" class="icon">
                                                        <path d="M15 6l-6 6l6 6"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Page 1"> 1 </a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Page 2"> 2 </a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#" aria-label="Page 3"
                                                    aria-current="page">
                                                    3 </a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Page 4"> 4 </a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Page 5"> 5 </a>
                                            </li>

                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next page">
                                                    <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-right -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        aria-hidden="true" focusable="false" class="icon">
                                                        <path d="M9 6l6 6l-6 6"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- END PAGINATION -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Konfirmasi Hapus Artikel -->
    <div class="modal modal-blur fade" id="modalHapusArtikel" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalHapusArtikelTitle">Konfirmasi Penghapusan Data</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true" focusable="false"
                        class="icon mb-2 text-danger icon-lg">
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0">
                        </path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <div class="card-body">
                        <h1>Perhatian</h1>
                    </div>
                    <h3>Penghapusan data bersifat permanen dan tidak dapat dikembalikan</h3>
                    <p class="text-warning mb-3">
                        Apakah anda yakin ingin menghapus data ini?
                    </p>
                    <div class="d-flex flex-column align-items-start gap-2">
                        <input type="text" class="form-control" placeholder="Ketik HAPUS untuk melanjutkan" />

                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="ti ti-info-circle"></i>
                            <p class="mb-0">Ketik "<strong>HAPUS</strong>" (case sensitive)</p>
                        </span>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col"><button type="button" data-bs-dismiss="modal" class="btn w-100 btn-sm"><i
                                    class="ti ti-logout icon-lg me-1"></i> Tutup</button></div>
                        <div class="col"><button type="button" class="btn btn-danger btn-sm w-100"
                                data-bs-dismiss="modal"><i class="ti ti-trash icon-lg me-1"></i> Hapus</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
