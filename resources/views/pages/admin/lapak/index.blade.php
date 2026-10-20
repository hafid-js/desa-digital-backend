@extends('layouts.app')

@section('content')
<x-ui.page-header pretitle="Marketplace Desa" title="Lapak Warga">
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
    </x-ui.page-header>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @foreach ($statistik as $stat)
                    <div class="col-6 col-lg-3">
                        <x-ui.stat-card :label="$stat['label']" :nilai="$stat['nilai']"
                            :ikon="$stat['ikon']" :warna="$stat['warna']" />
                    </div>
                @endforeach
            </div>

            <div class="card mt-3">
                <div class="card-status-top bg-primary"></div>
                <div class="card-body">
                    <x-tables.filter-bar :action="route('admin.lapak.index')" :search="$search"
                        label="Cari Produk" placeholder="Nama produk, kategori, atau penjual..."
                        :bersihkan-url="route('admin.lapak.index')"
                        :bersihkan="(bool) ($search || $selectedStatus || $selectedKategori || $selectedLokasi)">
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
                    </x-tables.filter-bar>
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
                                                class="rounded" width="44" height="44" class="img-cover">
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
                                        <x-ui.status-badge :status="$p->status" />
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
                                                title="{{ $p->status === \App\Enums\StatusProduk::Aktif ? 'Nonaktifkan produk' : 'Aktifkan produk' }}">
                                                <i class="ti {{ $p->status === \App\Enums\StatusProduk::Aktif ? 'ti-lock' : 'ti-lock-open' }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" title="Hapus produk"
                                                data-bs-toggle="modal" data-bs-target="#modalHapusProduk">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <x-ui.empty-state :colspan="10" pesan="Belum ada produk lapak yang sesuai filter." />
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
                            <x-tables.pagination :paginator="$produk" :query-string="$queryString" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-ui.confirm-modal id="modalHapusProduk" />

    <x-ui.confirm-modal id="modalHapusProdukTerpilih"
        judul="Konfirmasi Penghapusan Terpilih"
        pesan="Seluruh produk yang dipilih akan dihapus permanen"
        :ketik-hapus="false" />
@endsection
