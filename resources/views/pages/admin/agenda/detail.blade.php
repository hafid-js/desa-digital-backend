@extends('layouts.app')

@section('content')
    <main id="content" class="page-body py-4">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">

                        <div class="card-img-top bg-gradient-primary text-white p-4 p-md-5 position-relative bg-primary">
                            <div class="mb-2">
                                <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-pill">
                                    <i class="ti ti-users me-1"></i> Diselenggarakan oleh: Arga Bina Cipta
                                </span>
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
                                            <div class="fw-semibold text-dark">Minggu, 25 Okt 2026</div>
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
                                    <i class="ti ti-file-description me-2 text-info"></i>Deskripsi & Pembahasan Kegiatan
                                </h3>
                                <p class="text-secondary leading-relaxed">
                                    Acara ini diselenggarakan untuk mengevaluasi efektivitas jadwal ronda malam warga,
                                    kesiapan fasilitas pendukung di Pos Satkamling, serta sosialisasi langkah pencegahan
                                    gangguan keamanan di lingkungan perumahan.
                                </p>
                                <p class="text-secondary leading-relaxed ">
                                    Seluruh warga dan pengurus RT/RW diharapkan hadir tepat waktu guna memberikan masukan
                                    dan aspirasi demi kenyamanan dan keamanan bersama.
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
    </main>
@endsection
