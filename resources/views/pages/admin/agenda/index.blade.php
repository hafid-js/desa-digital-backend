@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Agenda</h1>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambahAgenda"
                                        class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah</span>
                                    </a>
                                </div>

                                <div class="col-12 col-md-auto">
                                    <a href="#"
                                        class="btn btn-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#modalHapusKategori">
                                        <i class="ti ti-trash icon-lg me-1"></i>
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <select name="" class="form-select form-select-sm  d-flex d-md-inline-flex">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Akan Datang</option>
                                        <option value="2">Berlangsung</option>
                                        <option value="2">Selesai</option>
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
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 0px;">
                                            <input class="form-check-input m-0" type="checkbox">
                                        </th>
                                        <th class="text-center" style="min-width: 50px;">No.</th>
                                        <th class="text-center" style="min-width: 150px;">AKSI</th>
                                        <th style="min-width: 200px;">JUDUL</th>
                                        <th>GAMBAR</th>
                                        <th style="min-width: 200px;">TANGGAL MULAI</th>
                                        <th style="min-width: 200px;">TANGGAL SELESAI</th>
                                        <th style="min-width: 200px;">LOKASI</th>
                                        <th style="min-width: 200px;">PENYELENGGARA</th>
                                        <th>DESKRIPSI</th>
                                        <th>STATUS</th>

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
                                                <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAgenda"><i class="ti ti-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusKategori"><i class="ti ti-trash"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalDetailAgenda"
                                                    class="btn btn-success btn-sm"><i class="ti ti-eye"></i></a>
                                            </div>
                                        </td>

                                        <td>
                                            FESTIVAL KOPI CONDONG
                                        </td>
                                        <td>
                                            <img src="{{ asset('assets/static/photos/brainstorming-session-with-creative-designers.jpg') }}"
                                                alt="Brainstorming session with creative designers"
                                                class="rounded form-imagecheck-image">
                                        </td>
                                        <td>22 Oktober 2026</td>
                                        <td>25 Oktober 2026</td>
                                        <td>Balai Desa Gunung Condong</td>
                                        <td>Karang Taruna</td>

                                        <td>
                                            <p class="card-text desc-kegiatan">
                                                Turnamen Voli Pemuda Cup merupakan ajang kompetisi olahraga tahunan yang
                                                digagas Karang Taruna untuk wadah penyaluran bakat serta gaya hidup sehat
                                                bagi generasi muda di wilayah desa kita.
                                            </p>
                                        </td>
                                        <td><span class="badge bg-cyan text-cyan-fg">Akan Datang</span></td>

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

    <div class="modal modal-blur fade" id="modalDetailAgenda" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                            <div class="card-img-top bg-gradient-primary text-white p-4 p-md-5 position-relative"
                                style="background: linear-gradient(135deg, #206bc4 0%, #0054a6 100%);">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-pill">
                                        <i class="ti ti-users me-1"></i> Diselenggarakan oleh: Arga Bina Cipta
                                    </span>

                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <h1 class="card-title text-white display-6 fw-bold mb-0">
                                    Sosialisasi Keamanan Lingkungan & Evaluasi Pos Satkamling
                                </h1>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center">
                                            <div class="bg-primary-subtle text-primary p-2 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                style="width: 42px; height: 42px;">
                                                <i class="ti ti-calendar fs-2"></i>
                                            </div>
                                            <div>
                                                <div class="text-muted small fw-semibold">TANGGAL</div>
                                                <div class="fw-bold text-dark">Minggu, 25 Okt 2026</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center">
                                            <div class="bg-primary-subtle text-primary p-2 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                style="width: 42px; height: 42px;">
                                                <i class="ti ti-clock fs-2"></i>
                                            </div>
                                            <div>
                                                <div class="text-muted small fw-semibold">WAKTU</div>
                                                <div class="fw-bold text-dark">19:30 WIB - Selesai</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center">
                                            <div class="bg-primary-subtle text-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                style="width: 42px; height: 42px; flex-shrink: 0;">
                                                <i class="ti ti-map-pin" style="font-size: 1.25rem;"></i>
                                            </div>
                                            <div>
                                                <div class="text-muted small fw-semibold">LOKASI</div>
                                                <div class="fw-bold text-dark">Balai Warga RT 05 / Pos Ronda</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4 text-muted opacity-25">

                                <div class="prose max-w-none">
                                    <h3 class="fw-bold mb-3">
                                        <i class="ti ti-file-description me-2 text-info"></i>Deskripsi & Pembahasan
                                        Kegiatan
                                    </h3>
                                    <p class="text-secondary leading-relaxed">
                                        Acara ini diselenggarakan untuk mengevaluasi efektivitas jadwal ronda malam warga,
                                        kesiapan fasilitas pendukung di Pos Satkamling, serta sosialisasi langkah pencegahan
                                        gangguan keamanan di lingkungan perumahan.
                                    </p>
                                </div>

                            </div>

                            <div class="card-footer bg-light px-4 py-3 d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="ti ti-info-circle text-warning me-1"></i> Harap hadir 15 menit sebelum acara
                                    dimulai.
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modalTambahAgenda" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-start">
            <div class="modal-content">

                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="modal-header">
                                <h2 class="modal-title" id="modalHapusKategoriTitle">Form Tambah Agenda</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="judul-agenda"> Judul Agenda</label>

                                            <input type="text" placeholder="Judul Agenda" class="form-control"
                                                id="judul-agenda" name="judul">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="gambar-agenda"> Gambar Agenda</label>
                                            <input type="file" id="gambar-agenda" name="gambar" class="form-control"
                                                accept="image/jpeg,image/png,image/webp">

                                            <p class="text-orange mt-2 mb-2">
                                                Satu gambar untuk ilustrasi agenda.
                                            </p>
                                            <img src="{{ asset('assets/static/photos/brainstorming-session-with-creative-designers.jpg') }}"
                                                alt="Brainstorming session with creative designers"
                                                class="rounded form-imagecheck-image" height="300" width="300">
                                        </div>


                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="tanggal-mulai"> Tanggal Mulai</label>

                                                <input type="date" class="form-control" id="tanggal-mulai"
                                                    name="tanggal_mulai">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="tanggal-selesai"> Tanggal Selesai</label>

                                                <input type="date" class="form-control" id="tanggal-selesai"
                                                    name="tanggal_selesai">
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="lokasi-agenda"> Lokasi</label>

                                                <input type="text" placeholder="Lokasi pelaksanaan"
                                                    class="form-control" id="lokasi-agenda" name="lokasi">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="penyelenggara-agenda">
                                                    Penyelenggara</label>

                                                <input type="text" placeholder="Penyelenggara agenda"
                                                    class="form-control" id="penyelenggara-agenda" name="penyelenggara">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="form-label" for="deskripsi-agenda"> Deskripsi</label>

                                            <textarea id="deskripsi-agenda" name="deskripsi" class="form-control" rows="8"></textarea>
                                        </div>

                                        <div class="col-xl-3">
                                            <label class="form-label" for="status-agenda"> Status</label>

                                            <select class="form-select" id="status-agenda" name="status">
                                                <option value="Akan Datang">Akan Datang</option>
                                                <option value="Berlangsung">Berlangsung</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="btn-list justify-content-between">
                                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-danger"><i
                                            class="ti ti-x me-2"></i> Batal</a>
                                    <button type="button" class="btn btn-primary"><i class="ti ti-check me-2"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
