@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Kategori</h1>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                        class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah</span>
                                    </a>
                                </div>

                                <div class="col-12 col-md-auto">
                                    <a href="#"
                                        class="btn btn-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori">
                                        <i class="ti ti-trash icon-lg me-1"></i>
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <select name="" class="form-select form-select-sm d-flex d-md-inline-flex">
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
                                        <th>AKSI</th>
                                        <th>NAMA KATEGORI</th>
                                        <th style="width: 100px;">AKTIF</th>

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
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Informasi Publik
                                        </td>
                                        <td>Ya</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Pembangunan
                                        </td>
                                        <td>Ya</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Pemerintahan
                                        </td>
                                        <td>Ya</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Pendidikan
                                        </td>
                                        <td>Ya</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Kesehatan
                                        </td>
                                        <td>Ya</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Agama, Adat dan Budaya
                                        </td>
                                        <td>Ya</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input m-0" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="text-secondary">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbahKategori"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-purple btn-sm"><i
                                                        class="ti ti-lock-open"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            Pengumuman
                                        </td>
                                        <td>Ya</td>

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
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </main>

    
    <div class="modal modal-blur fade" id="modalHapusKategori" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalHapusKategoriTitle">Konfirmasi Penghapusan Data</h2>
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
                        <div class="col"><button type="button" data-bs-dismiss="modal" class="btn w-100"><i
                                    class="ti ti-logout icon-lg me-1"></i> Tutup</button></div>
                        <div class="col"><button type="button" class="btn btn-danger w-100"
                                data-bs-dismiss="modal"><i class="ti ti-trash icon-lg me-1"></i> Hapus</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="modal modal-blur fade" id="modalUbahKategori" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-start">
          <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="modalUbahKategoriTitle">Ubah Kategori</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <div class="modal-body">
                                <form method="POST">
                                    @csrf
                                  <div class="mb-3">
                                    <label class="form-label" for="nama-kategori"> Nama Kategori </label>

                                    <input type="text" class="form-control" id="nama-kategori" value="Informasi Publik">
                                  </div>
                                </form>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Simpan</button>
                              </div>
                            </div>
        </div>
    </div>
@endsection
