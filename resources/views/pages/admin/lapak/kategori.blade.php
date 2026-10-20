@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Lapak Warga</div>
                    <h1 class="page-title">Master Lapak</h1>
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
            <div class="card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#tab-kategori" class="nav-link active" data-bs-toggle="tab" role="tab"
                                aria-selected="true">
                                <i class="ti ti-list icon-lg me-1"></i>
                                Kategori Produk
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tab-kondisi" class="nav-link" data-bs-toggle="tab" role="tab"
                                aria-selected="false">
                                <i class="ti ti-box icon-lg me-1"></i>
                                Kondisi Produk
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tab-lokasi" class="nav-link" data-bs-toggle="tab" role="tab"
                                aria-selected="false">
                                <i class="ti ti-map-pin icon-lg me-1"></i>
                                Lokasi / Dusun
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-kategori" role="tabpanel">
                            <div class="row g-2 mb-3">
                                <div class="col-12 col-md-auto">
                                    <button type="button" class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Kategori</span>
                                    </button>
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
                                            <th class="text-center" style="width: 120px;">AKSI</th>
                                            <th>NAMA KATEGORI</th>
                                            <th class="text-center" style="width: 150px;">JUMLAH PRODUK</th>
                                            <th class="text-center" style="width: 100px;">AKTIF</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($kategori as $k)
                                            <tr>
                                                <td>
                                                    <input class="form-check-input m-0" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-nowrap gap-1 justify-content-center">
                                                        <button type="button" class="btn btn-warning btn-sm" title="Ubah kategori"
                                                            data-bs-toggle="modal" data-bs-target="#modalUbahKategori">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-purple btn-sm"
                                                            title="{{ $k->is_aktif ? 'Nonaktifkan kategori' : 'Aktifkan kategori' }}">
                                                            <i class="ti {{ $k->is_aktif ? 'ti-lock' : 'ti-lock-open' }}"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus kategori"
                                                            data-bs-toggle="modal" data-bs-target="#modalHapusKategori">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $k->nama }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $k->jumlah_produk }}
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-{{ $k->is_aktif ? 'green text-green-fg' : 'secondary text-secondary-fg' }}">
                                                        {{ $k->is_aktif ? 'Ya' : 'Tidak' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-kondisi" role="tabpanel">
                            <div class="row g-2 mb-3">
                                <div class="col-12 col-md-auto">
                                    <button type="button" class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#modalTambahKondisi">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Kondisi</span>
                                    </button>
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
                                            <th class="text-center" style="width: 120px;">AKSI</th>
                                            <th>NAMA KONDISI</th>
                                            <th class="text-center" style="width: 150px;">JUMLAH PRODUK</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($kondisi as $k)
                                            <tr>
                                                <td>
                                                    <input class="form-check-input m-0" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-nowrap gap-1 justify-content-center">
                                                        <button type="button" class="btn btn-warning btn-sm" title="Ubah kondisi"
                                                            data-bs-toggle="modal" data-bs-target="#modalUbahKondisi">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus kondisi"
                                                            data-bs-toggle="modal" data-bs-target="#modalHapusKategori">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $k }}
                                                </td>
                                                <td class="text-center">
                                                    {{ [8, 5, 3, 2][$loop->index] ?? 0 }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-lokasi" role="tabpanel">
                            <div class="row g-2 mb-3">
                                <div class="col-12 col-md-auto">
                                    <button type="button" class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#modalTambahLokasi">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Lokasi</span>
                                    </button>
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
                                            <th class="text-center" style="width: 120px;">AKSI</th>
                                            <th>NAMA DUSUN</th>
                                            <th class="text-center" style="width: 150px;">JUMLAH PRODUK</th>
                                            <th class="text-center" style="width: 100px;">AKTIF</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($lokasi as $l)
                                            <tr>
                                                <td>
                                                    <input class="form-check-input m-0" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-nowrap gap-1 justify-content-center">
                                                        <button type="button" class="btn btn-warning btn-sm" title="Ubah lokasi"
                                                            data-bs-toggle="modal" data-bs-target="#modalUbahLokasi">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus lokasi"
                                                            data-bs-toggle="modal" data-bs-target="#modalHapusKategori">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $l }}
                                                </td>
                                                <td class="text-center">
                                                    {{ [3, 2, 3, 1, 1, 1, 1][$loop->index] ?? 0 }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-green text-green-fg">Ya</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-blur fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama-kategori-baru"> Nama Kategori </label>
                            <input type="text" class="form-control" id="nama-kategori-baru"
                                placeholder="Contoh: Electronics & Gadget">
                        </div>

                        <div class="form-hint">
                            Kategori ini akan langsung tampil pada pilihan kategori di aplikasi warga.
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

    <div class="modal modal-blur fade" id="modalUbahKategori" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Kategori Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama-kategori"> Nama Kategori </label>
                            <input type="text" class="form-control" id="nama-kategori" value="Fashion & Pakaian">
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

    <div class="modal modal-blur fade" id="modalTambahKondisi" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kondisi Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama-kondisi-baru"> Nama Kondisi </label>
                            <input type="text" class="form-control" id="nama-kondisi-baru"
                                placeholder="Contoh: Bekas - Rusak Ringan">
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

    <div class="modal modal-blur fade" id="modalUbahKondisi" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Kondisi Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama-kondisi"> Nama Kondisi </label>
                            <input type="text" class="form-control" id="nama-kondisi" value="Bekas - Seperti Baru">
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

    <div class="modal modal-blur fade" id="modalTambahLokasi" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Lokasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama-lokasi-baru"> Nama Dusun </label>
                            <input type="text" class="form-control" id="nama-lokasi-baru"
                                placeholder="Contoh: Dusun Sukamaju">
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

    <div class="modal modal-blur fade" id="modalUbahLokasi" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Lokasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama-lokasi"> Nama Dusun </label>
                            <input type="text" class="form-control" id="nama-lokasi" value="Dusun Krajan">
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

    <div class="modal modal-blur fade" id="modalHapusKategori" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Konfirmasi Penghapusan Data</h2>
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
                        Produk pada kategori ini perlu dipindahkan terlebih dahulu.
                    </p>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" data-bs-dismiss="modal" class="btn w-100 btn-sm">
                                <i class="ti ti-logout icon-lg me-1"></i> Tutup
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm w-100">
                                <i class="ti ti-trash icon-lg me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
