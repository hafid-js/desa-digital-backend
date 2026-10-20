@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <a href="{{ route('admin.lapak.index') }}">Lapak Warga</a> / {{ $produk->kode_produk }}
                    </div>
                    <h1 class="page-title">{{ $produk->nama_produk }}</h1>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.lapak.index') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-circle-chevron-left icon-lg me-1"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12 col-md-5">
                                    <img src="{{ asset($produk->foto[0]) }}" alt="{{ $produk->nama_produk }}"
                                        class="w-100 rounded" style="aspect-ratio: 4 / 3; object-fit: cover;">
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                        <span
                                            class="badge badge-pill bg-{{ $produk->status === 'aktif' ? 'green text-green-fg' : ($produk->status === 'terjual' ? 'blue text-blue-fg' : 'orange text-orange-fg') }}">
                                            {{ $statuses[$produk->status] ?? ucfirst($produk->status) }}
                                        </span>
                                        <span class="badge bg-blue-lt text-blue-fg">{{ $produk->kategori }}</span>
                                        <span class="badge bg-azure-lt text-azure-fg">{{ $produk->kondisi }}</span>
                                        @if ($produk->penjual->status === 'diblokir')
                                            <span class="badge bg-red-lt text-red-fg">Penjual Diblokir</span>
                                        @endif
                                    </div>

                                    <div class="h1 mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                    @if ($produk->harga_asli)
                                        <div class="text-secondary">
                                            <s>Rp {{ number_format($produk->harga_asli, 0, ',', '.') }}</s>
                                            @if ($produk->diskon)
                                                <span class="badge bg-red-lt text-red-fg ms-2">-{{ $produk->diskon }}%</span>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="row mt-3">
                                        <div class="col-6 col-sm-4">
                                            <div class="text-secondary small">Dilihat</div>
                                            <div class="fw-medium">{{ number_format($produk->dilihat) }} kali</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div class="text-secondary small">Penawaran</div>
                                            <div class="fw-medium">{{ $produk->penawaran }}</div>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <div class="text-secondary small">Ketersediaan</div>
                                            <div class="fw-medium">{{ $produk->ketersediaan }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (count($produk->foto) > 1)
                                <div class="row g-2 mt-2">
                                    @foreach (array_slice($produk->foto, 1) as $foto)
                                        <div class="col-4 col-md-3">
                                            <img src="{{ asset($foto) }}" alt="Foto produk {{ $loop->iteration + 1 }}"
                                                class="rounded w-100" style="aspect-ratio: 1 / 1; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-secondary small mt-2 mb-0">
                                    {{ count($produk->foto) }} foto diunggah, foto pertama digunakan sebagai foto utama pada aplikasi.
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <h3 class="card-title">Deskripsi Produk</h3>
                            <p style="white-space: normal; overflow-wrap: anywhere;">{{ $produk->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="card mt-3" id="form-ubah">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-header">
                            <h3 class="card-title">Ubah Data Produk</h3>
                            <div class="card-actions text-secondary small">
                                Penyesuaian ini akan terkirim ke penjual sebagai notifikasi.
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12 col-md-8">
                                        <label class="form-label" for="nama-produk">Nama Produk</label>
                                        <input type="text" id="nama-produk" name="nama_produk" class="form-control"
                                            value="{{ $produk->nama_produk }}">
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label class="form-label" for="harga-produk">Harga</label>
                                        <input type="number" id="harga-produk" name="harga" class="form-control"
                                            value="{{ $produk->harga }}">
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label class="form-label" for="harga-asli-produk">Harga Asli</label>
                                        <input type="number" id="harga-asli-produk" name="harga_asli" class="form-control"
                                            value="{{ $produk->harga_asli }}">
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label class="form-label" for="diskon-produk">Diskon (%)</label>
                                        <input type="number" id="diskon-produk" name="diskon" class="form-control"
                                            value="{{ $produk->diskon }}" min="0" max="100">
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label class="form-label" for="kategori-produk">Kategori</label>
                                        <select class="form-select" id="kategori-produk" name="kategori">
                                            @foreach ($kategoriList as $kategori)
                                                <option value="{{ $kategori }}"
                                                    {{ $produk->kategori == $kategori ? 'selected' : '' }}>
                                                    {{ $kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label class="form-label" for="kondisi-produk">Kondisi</label>
                                        <select class="form-select" id="kondisi-produk" name="kondisi">
                                            @foreach ($kondisiList as $kondisi)
                                                <option value="{{ $kondisi }}"
                                                    {{ $produk->kondisi == $kondisi ? 'selected' : '' }}>
                                                    {{ $kondisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label class="form-label" for="lokasi-produk">Lokasi</label>
                                        <select class="form-select" id="lokasi-produk" name="lokasi">
                                            @foreach ($lokasiList as $lokasi)
                                                <option value="{{ $lokasi }}"
                                                    {{ $produk->lokasi == $lokasi ? 'selected' : '' }}>
                                                    {{ $lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="deskripsi-produk">Deskripsi</label>
                                        <textarea id="deskripsi-produk" name="deskripsi" rows="5"
                                            class="form-control">{{ $produk->deskripsi }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-between">
                                <a href="{{ route('admin.lapak.index') }}" class="btn btn-danger btn-sm">
                                    <i class="ti ti-x me-2"></i> Batal
                                </a>
                                <button type="button" class="btn btn-primary btn-sm">
                                    <i class="ti ti-check me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-header">
                            <h3 class="card-title">Laporan Terhadap Produk Ini</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="w-1">KODE</th>
                                        <th>PELAPOR</th>
                                        <th>ALASAN</th>
                                        <th class="w-1">STATUS</th>
                                        <th class="w-1">TANGGAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan as $l)
                                        <tr>
                                            <td>
                                                <span class="badge badge-outline text-blue">{{ $l->kode_laporan }}</span>
                                            </td>
                                            <td>{{ $l->pelapor }}</td>
                                            <td style="white-space: normal; overflow-wrap: anywhere;">
                                                <div class="fw-medium">{{ $l->alasan }}</div>
                                                <div class="text-secondary small">{{ $l->catatan }}</div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-pill bg-{{ $l->status === 'selesai' ? 'green text-green-fg' : ($l->status === 'ditolak' ? 'red text-red-fg' : ($l->status === 'diproses' ? 'orange text-orange-fg' : 'blue text-blue-fg')) }}">
                                                    {{ ucfirst($l->status) }}
                                                </span>
                                            </td>
                                            <td class="text-secondary">
                                                {{ $l->dibuat_pada->format('d M Y H:i') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada laporan untuk produk ini.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <h3 class="card-title mb-3">Moderasi Produk</h3>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="status-produk">Status Produk</label>
                                    <select class="form-select" id="status-produk" name="status">
                                        @foreach ($statuses as $key => $label)
                                            <option value="{{ $key }}" {{ $produk->status == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">
                                        Produk nonaktif tidak akan muncul di halaman lapak warga.
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-save me-1"></i> Simpan Status
                                    </button>
                                    <button type="button" class="btn btn-outline-purple">
                                        <i class="ti ti-lock me-1"></i> Blokir Penjual
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusProdukDetail">
                                        <i class="ti ti-trash me-1"></i> Hapus Produk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title fw-semibold">Informasi Penjual</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="{{ asset($produk->penjual->avatar) }}" alt="{{ $produk->penjual->nama }}"
                                    class="rounded-circle" width="48" height="48">
                                <div>
                                    <div class="fw-medium">{{ $produk->penjual->nama }}</div>
                                    <div class="text-secondary small">{{ $produk->penjual->dusun }}</div>
                                </div>
                            </div>

                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">NIK</div>
                                    <div class="datagrid-content">{{ $produk->penjual->nik }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Nomor HP</div>
                                    <div class="datagrid-content">{{ $produk->penjual->telepon }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Produk Aktif</div>
                                    <div class="datagrid-content">{{ $produk->penjual->total_produk }} produk</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status Akun</div>
                                    <div class="datagrid-content">
                                        <span
                                            class="badge badge-pill bg-{{ $produk->penjual->status === 'aktif' ? 'green text-green-fg' : 'red text-red-fg' }}">
                                            {{ $produk->penjual->status === 'aktif' ? 'Aktif' : 'Diblokir' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title fw-semibold">Informasi Produk</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Kode Produk</div>
                                    <div class="datagrid-content">{{ $produk->kode_produk }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Kategori</div>
                                    <div class="datagrid-content">{{ $produk->kategori }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Kondisi</div>
                                    <div class="datagrid-content">{{ $produk->kondisi }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Lokasi</div>
                                    <div class="datagrid-content">{{ $produk->lokasi }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Dibuat Pada</div>
                                    <div class="datagrid-content">{{ $produk->dibuat_pada->format('d M Y H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Diperbarui</div>
                                    <div class="datagrid-content">{{ $produk->diperbarui_pada->format('d M Y H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-blur fade" id="modalHapusProdukDetail" tabindex="-1" role="dialog" aria-modal="true"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Konfirmasi Penghapusan Data</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <h3>Penghapusan data bersifat permanen dan tidak dapat dikembalikan</h3>
                    <p class="text-warning mb-3">
                        Apakah anda yakin ingin menghapus produk "{{ $produk->nama_produk }}"?
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
@endsection
