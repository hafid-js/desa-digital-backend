@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Lampiran Pengaduan</h1>
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
                            <div class="row g-2 justify-content-between align-items-center mb-3">
                                <div class="col-auto">
                                    <h5 class="card-title m-0">Lampiran: {{ $pengaduan->kode_laporan }}</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.pengaduan.detail', $pengaduan->kode_laporan) }}"
                                        class="btn btn-primary btn-sm"><i class="ti ti-arrow-left me-1"></i> Kembali ke
                                        Detail</a>
                                </div>
                            </div>

                            <div class="row g-3">
                                @forelse($pengaduan->lampiran as $item)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card h-100 ">
                                            <div class="card-body text-center">
                                                @switch($item->tipe)
                                                    @case('foto')
                                                        <i class="ti ti-image text-primary fs-1 mb-2"></i>
                                                        <span class="badge badge-pill bg-primary text-primary-fg">Foto</span>
                                                    @break

                                                    @case('pdf')
                                                        <i class="ti ti-file-type-pdf text-danger fs-1 mb-2"></i>
                                                        <span class="badge badge-pill bg-danger text-danger-fg">PDF</span>
                                                    @break

                                                    @case('video')
                                                        <i class="ti ti-file-video text-info fs-1 mb-2"></i>
                                                        <span class="badge badge-pill bg-info text-info-fg">Video</span>
                                                    @break

                                                    @default
                                                        <i class="ti ti-file text-secondary fs-1 mb-2"></i>
                                                        <span class="badge badge-pill bg-secondary text-secondary-fg">File</span>
                                                @endswitch

                                                <h6 class="card-title mt-2">{{ $item->nama_asli ?? $item->path }}</h6>
                                                <p class="small mb-3">{{ $item->tipe }}</p>

                                                <a href="{{ asset('storage/' . $item->path) }}" target="_blank"
                                                    class="btn btn-outline-primary w-100">
                                                    <i class="ti ti-eye me-1"></i> Lihat
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="col-12 text-center py-5">
                                            <i class="ti ti-file-off text-muted fs-1 mb-2"></i>
                                            <p class="text-muted mb-0">Belum ada lampiran.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
