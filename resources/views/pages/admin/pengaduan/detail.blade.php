@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Detail Pengaduan</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title mb-1">{{ $pengaduan->kode_laporan }}</h5>
                                    <x-ui.status-badge :status="$pengaduan->status" />
                                </div>
                                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-primary btn-sm"><i
                                        class="ti ti-arrow-left me-1"></i> Kembali</a>
                            </div>

                            <hr>

                            <div class="row g-3 mb-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold small">Pelapor</label>
                                    <p class="mb-0">{{ $pengaduan->nama_pelapor ?? '-' }}</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold small ">NIK</label>
                                    <p class="mb-0">{{ $pengaduan->nik_pelapor ?? '-' }}</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold small ">Wilayah</label>
                                    <p class="mb-0">{{ $pengaduan->wilayah ?? '-' }}</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold small ">Visibilitas</label>
                                    <p class="mb-0">{{ ucfirst($pengaduan->visibilitas) }}</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold small ">Waktu Kejadian</label>
                                    <p class="mb-0">
                                        {{ $pengaduan->waktu_kejadian ? $pengaduan->waktu_kejadian->format('d M Y H:i') : '-' }}
                                    </p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold small ">Dibuat Pada</label>
                                    <p class="mb-0">
                                        {{ $pengaduan->created_at ? $pengaduan->created_at->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold small ">Rincian Laporan</label>
                                <div class="p-3 rounded border">
                                    <p class="mb-0">{{ $pengaduan->rincian ?? '-' }}</p>
                                </div>
                            </div>
                            <label class="form-label fw-semibold small ">Lampiran</label>
                            @if ($pengaduan->lampiran->count() > 0)
                                <div class="mb-4">
                                    <a href="{{ route('admin.pengaduan.lampiran', $pengaduan->kode_laporan) }}"
                                        class="btn btn-outline-primary btn-sm w-100"><i class="ti ti-file me-1"></i> Lihat
                                        Semua Lampiran
                                        ({{ $pengaduan->lampiran->count() }})</a>
                                </div>
                            @endif

                            @if ($pengaduan->tanggapan)
                                <div class="mb-4">
                                    <label class="form-label fw-semibold small ">Tanggapan Terakhir</label>
                                    <div class="p-3 bg-success-lightest rounded border border-success">
                                        <p class="mb-1 ">{{ $pengaduan->tanggapan }}</p>
                                        <small class="text-success">{{ $pengaduan->status->label() }}</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Berikan Tanggapan</h5>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.pengaduan.tanggapan', $pengaduan->kode_laporan) }}"
                                method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggapan / Respon</label>
                                    <textarea name="tanggapan" rows="4" class="form-control" placeholder="Ketik tanggapan untuk warga..."></textarea>
                                    <div class="form-text">Tanggapan akan dikirim ke warga pelapor.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ubah Status</label>
                                    <select name="status" class="form-select">
                                        @foreach ($statuses as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ $pengaduan->status->value == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary"><i class="ti ti-send me-1"></i> Kirim
                                        Tanggapan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h2 class="card-title fw-semibold">Riwayat Tanggapan</h2>
                        </div>
                        <div class="card-body">
                            <ul class="steps steps-vertical">
                                @forelse($tanggapans as $t)
                                    <li class="step-item">
                                        <div class="card card-body">
                                            <div class="d-flex justify-content-between mb-2">
                                                <x-ui.status-badge :status="$t->status_sebelum" />
                                                <div class="text-secondary float-end">10 hrs ago</div>

                                            </div>
                                            <p>{{ $t->tanggapan }}</p>
                                        </div>
                                    </li>
                                @empty
                                    <p>Belum ada riwayat tanggapan.</p>
                                @endforelse
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
