@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Form Artikel</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-xl-7 mb-2">
                    <div class="card">
                                    <div class="card-status-top bg-primary"></div>
                        <div class="card-header">
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-circle-chevron-left icon-lg me-2"> </i>
                                Kembali ke halaman artikel </a>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                @csrf
                                <div class="space-y">
                                    <div>
                                        <label class="form-label" for="judul-artikel"> Judul Artikel</label>

                                        <input type="text" placeholder="Judul Artikel" class="form-control"
                                            id="judul-artikel" name="judul_artikel">
                                        <p class="text-secondary mt-2">Judul artikel minimal 5 karakter dan maksimal 200
                                            karakter</p>
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="example-subject"> Kategori Artikel</label>

                                        <select class="form-select" id="example-subject" name="subject">
                                            <option>Pengumuman</option>
                                            <option>Pemerintahan Desa</option>
                                            <option>Kegiatan dan Acara</option>
                                            <option>Pelayanan Publik</option>
                                            <option>Pembangunan Desa</option>
                                            <option>Sosial dan Kemasyarakatan</option>
                                            <option>UMKM dan Ekonomi Desa</option>
                                            <option>Budaya dan Pariwisata</option>
                                            <option>Kesehatan dan Lingkungan</option>
                                            <option>Pendidikan</option>
                                        </select>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label" for="thumbnail-artikel">Thumbnail Artikel</label>
                                        <input type="file" id="thumbnail-artikel" name="thumbnail" class="form-control"
                                            accept="image/jpeg,image/png,image/webp">

                                        <p class="text-secondary mt-2 mb-2">
                                            Satu gambar thumbnail untuk artikel. Rasio tampilan
                                            diseragamkan agar konsisten.
                                        </p>

                                        <div id="thumbnail-preview" hidden>
                                            <img id="thumbnail-preview-image" class="thumbnail-preview-image"
                                                alt="Preview thumbnail">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label" for="isi-artikel"> Isi Artikel</label>

                                        <textarea id="hugerte-description"></textarea>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label">Foto Lampiran Artikel</label>
                                        <input type="file" id="photo-picker" class="form-control"
                                            accept="image/jpeg,image/png,image/webp" multiple>

                                        <p class="text-secondary mt-2">
                                            Pilih beberapa foto sekaligus. Thumbnail akan ditampilkan
                                            dengan rasio yang seragam; klik thumbnail untuk melihat
                                            foto secara penuh.
                                        </p>
                                    </div>

                                    <div id="photo-preview" class="row g-3"></div>

                                    <input type="file" id="cropped-files" name="lampiran[]" multiple hidden>

                                    <dialog id="crop-dialog" class="crop-dialog">
                                        <div class="crop-dialog-content">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <h3 class="card-title mb-0">Lihat Foto Penuh</h3>
                                                <button type="button" id="crop-close" class="btn-close"
                                                    aria-label="Tutup"></button>
                                            </div>

                                            <p class="text-secondary small">
                                                Foto ditampilkan utuh tanpa crop. Thumbnail di daftar
                                                menggunakan rasio tetap agar rapi.
                                            </p>

                                            <div class="crop-image-wrapper">
                                                <img id="crop-image" alt="Foto penuh">
                                            </div>

                                            <div class="d-flex flex-wrap gap-2 justify-content-end mt-3">
                                                <button type="button" class="btn btn-primary crop-close-action">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </dialog>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="card">
                                    <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <label class="form-label" for="document-picker"> Lampiran Dokumen (opsional)</label>

                            <input type="file" id="document-picker" class="form-control"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.csv,.txt" multiple>

                            <p class="text-secondary mt-2">
                                Pilih dokumen pendukung artikel. File asli akan
                                dikirim tanpa perubahan.
                            </p>

                            <div id="document-preview" class="list-group mt-3"></div>

                            <input type="file" id="document-files" name="dokumen[]" multiple hidden>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-between">
                                <a href="{{ route('admin.artikel.index') }}" class="btn btn-danger btn-sm"><i
                                        class="ti ti-x me-2"></i> Batal</a>
                                <button type="button" class="btn btn-primary btn-sm"><i class="ti ti-check me-2"></i>
                                    Simpan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
@endsection
