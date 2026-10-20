@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Marketplace Desa</div>
                    <h1 class="page-title">Lapak Warga</h1>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.lapak.kategori') }}"
                            class="btn btn-outline-secondary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                            <i class="ti ti-list icon-lg me-1"></i>
                            <span>Master Kategori</span>
                        </a>
                        <a href="{{ route('admin.lapak.laporan') }}"
                            class="btn btn-outline-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                            <i class="ti ti-flag icon-lg me-1"></i>
                            <span>Laporan Produk</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @foreach ($statistik as $stat)
                    <div class="col-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-{{ $stat['warna'] }} text-{{ $stat['warna'] }}-fg avatar">
                                            <i class="ti {{ $stat['ikon'] }} icon-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $stat['nilai'] }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ $stat['label'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card mt-3">
                <div class="card-status-top bg-primary"></div>
                <div class="card-body">
                    <form action="{{ route('admin.lapak.index') }}" method="GET"
                        class="row g-2 align-items-end">
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="cari-produk">Cari Produk</label>
                            <div class="input-icon">
                                <input type="text" name="search" id="cari-produk" value="{{ $search }}"
                                    placeholder="Nama produk, kategori, atau penjual..."
                                    class="form-control form-control-sm">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="filter-status">Status</label>
                            <select class="form-select form-select-sm" id="filter-status" name="status">
                                <option value="">Semua Status</option>
                                @foreach ($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ $selectedStatus == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="filter-kategori">Kategori</label>
                            <select class="form-select form-select-sm" id="filter-kategori" name="kategori">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoriList as $kategori)
                                    <option value="{{ $kategori }}" {{ $selectedKategori == $kategori ? 'selected' : '' }}>
                                        {{ $kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label" for="filter-lokasi">Lokasi</label>
                            <select class="form-select form-select-sm" id="filter-lokasi" name="lokasi">
                                <option value="">Semua Lokasi</option>
                                @foreach ($lokasiList as $lokasi)
                                    <option value="{{ $lokasi }}" {{ $selectedLokasi == $lokasi ? 'selected' : '' }}>
                                        {{ $lokasi }}
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
                                @if ($search || $selectedStatus || $selectedKategori || $selectedLokasi)
                                    <a href="{{ route('admin.lapak.index') }}" class="btn btn-sm">
                                        Bersihkan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body border-bottom py-3">
                    <div class="row g-2">
                        <div class="col-12 col-md-auto">
                            <button type="button" class="btn btn-outline-danger btn-sm d-flex d-md-inline-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modalHapusProdukTerpilih">
                                <i class="ti ti-trash icon-lg me-1"></i>
                                <span>Hapus Terpilih</span>
                            </button>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button type="button" class="btn btn-outline-purple btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                <i class="ti ti-lock icon-lg me-1"></i>
                                <span>Nonaktifkan Terpilih</span>
                            </button>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button type="button" class="btn btn-outline-success btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                <i class="ti ti-lock-open icon-lg me-1"></i>
                                <span>Aktifkan Terpilih</span>
                            </button>
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
                                <th style="min-width: 230px;">PRODUK</th>
                                <th style="min-width: 170px;">KATEGORI</th>
                                <th style="width: 130px;">HARGA</th>
                                <th style="min-width: 150px;">PENJUAL</th>
                                <th style="width: 140px;">LOKASI</th>
                                <th class="text-center" style="width: 120px;">STATUS</th>
                                <th class="text-center" style="width: 120px;">DIBUAT</th>
                                <th class="text-center" style="width: 160px;">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($produk->items as $p)
                                <tr>
                                    <td>
                                        <input class="form-check-input m-0" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset($p->foto[0]) }}" alt="{{ $p->nama_produk }}"
                                                class="rounded" width="44" height="44" style="object-fit: cover;">
                                            <div class="text-truncate" style="max-width: 170px;">
                                                <a href="{{ route('admin.lapak.detail', $p->id) }}"
                                                    class="text-reset fw-medium d-block text-truncate">
                                                    {{ $p->nama_produk }}
                                                </a>
                                                <span class="text-secondary small">{{ $p->kode_produk }}</span>
                                            </div>
                                        </div>
                                        <div class="text-secondary small mt-1">
                                            <i class="ti ti-eye me-1"></i>{{ number_format($p->dilihat) }} kali dilihat
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-blue-lt text-blue-fg">
                                            {{ $p->kategori }}
                                        </span>
                                        <div class="text-secondary small mt-1">{{ $p->kondisi }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                                        @if ($p->harga_asli)
                                            <div class="text-secondary small">
                                                <s>Rp {{ number_format($p->harga_asli, 0, ',', '.') }}</s>
                                            </div>
                                        @endif
                                        @if ($p->diskon)
                                            <span class="badge bg-red-lt text-red-fg mt-1">-{{ $p->diskon }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset($p->penjual->avatar) }}" alt="{{ $p->penjual->nama }}"
                                                class="rounded-circle" width="28" height="28">
                                            <div>
                                                <div class="text-truncate" style="max-width: 140px;">
                                                    {{ $p->penjual->nama }}
                                                </div>
                                                <div class="text-secondary small">{{ $p->penjual->dusun }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $p->lokasi }}
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge badge-pill bg-{{ $p->status === 'aktif' ? 'green text-green-fg' : ($p->status === 'terjual' ? 'blue text-blue-fg' : 'orange text-orange-fg') }}">
                                            {{ $statuses[$p->status] ?? ucfirst($p->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{ $p->dibuat_pada->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-nowrap gap-1 justify-content-center">
                                            <a href="{{ route('admin.lapak.detail', $p->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Lihat detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.lapak.detail', $p->id) }}#form-ubah"
                                                class="btn btn-warning btn-sm" title="Ubah data produk">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-purple btn-sm"
                                                title="{{ $p->status === 'aktif' ? 'Nonaktifkan produk' : 'Aktifkan produk' }}">
                                                <i class="ti {{ $p->status === 'aktif' ? 'ti-lock' : 'ti-lock-open' }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" title="Hapus produk"
                                                data-bs-toggle="modal" data-bs-target="#modalHapusProduk">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <p class="text-secondary mb-0">Belum ada produk lapak yang sesuai filter.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="row g-2 justify-content-center justify-content-sm-between">
                        <div class="col-auto d-flex align-items-center">
                            <p class="m-0 text-secondary">Showing <strong>{{ $produk->firstItem }}</strong> to
                                <strong>{{ $produk->lastItem }}</strong> of
                                <strong>{{ $produk->total }}</strong> entries
                            </p>
                        </div>
                        <div class="col-auto">
                            @if ($produk->lastPage > 1)
                                <nav aria-label="Pagination">
                                    <ul class="pagination m-0 ms-auto">
                                        @if ($produk->currentPage > 1)
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="?page={{ $produk->currentPage - 1 }}{{ $queryString ? '&' . $queryString : '' }}"
                                                    aria-label="Previous page">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
                                                        focusable="false" class="icon">
                                                        <path d="M15 6l-6 6l6 6"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        @endif
                                        @for ($i = 1; $i <= $produk->lastPage; $i++)
                                            <li class="page-item {{ $i == $produk->currentPage ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="?page={{ $i }}{{ $queryString ? '&' . $queryString : '' }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endfor
                                        @if ($produk->currentPage < $produk->lastPage)
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="?page={{ $produk->currentPage + 1 }}{{ $queryString ? '&' . $queryString : '' }}"
                                                    aria-label="Next page">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
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
    </main>

    <div class="modal modal-blur fade" id="modalHapusProduk" tabindex="-1" role="dialog" aria-modal="true"
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
                        Apakah anda yakin ingin menghapus produk ini?
                    </p>
                    <div class="d-flex flex-column align-items-start gap-2">
                        <input type="text" class="form-control" placeholder="Ketik HAPUS untuk melanjutkan">

                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="ti ti-info-circle"></i>
                            <p class="mb-0">Ketik "<strong>HAPUS</strong>" (case sensitive)</p>
                        </span>
                    </div>
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

    <div class="modal modal-blur fade" id="modalHapusProdukTerpilih" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Konfirmasi Penghapusan Terpilih</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <h3>Seluruh produk yang dipilih akan dihapus permanen</h3>
                    <p class="text-warning mb-0">
                        Tindakan ini tidak dapat dibatalkan oleh petugas desa.
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
