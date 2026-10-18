@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Tambah Banner</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-xl-8 mb-2">
                    <div class="card">
                                    <div class="card-status-top bg-primary"></div>
                        <div class="card-header">
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-circle-chevron-left icon-lg me-2"> </i>
                                Kembali ke halaman banner </a>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="space-y">
                                    <div>
                                        <label class="form-label" for="judul-banner">Judul Banner</label>

                                        <input type="text" placeholder="Judul banner" class="form-control"
                                            id="judul-banner" name="judul">
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="keterangan-banner">Keterangan</label>

                                        <input type="text" placeholder="Keterangan singkat" class="form-control"
                                            id="keterangan-banner" name="keterangan">
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label" for="gambar-banner">Gambar Banner</label>
                                        <input type="file" id="gambar-banner" name="gambar" class="form-control"
                                            accept="image/jpeg,image/png,image/webp">

                                        <p class="text-orange mt-2 mb-2">
                                            Satu gambar untuk banner carousel di halaman beranda.
                                        </p>
                                        <img src="{{ asset('assets/static/photos/brainstorming-session-with-creative-designers.jpg') }}"
                                            alt="Preview banner" class="rounded form-imagecheck-image"
                                            height="200" width="400">
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="status-banner">Status</label>

                                        <select class="form-select" id="status-banner" name="status">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Nonaktif">Nonaktif</option>
                                        </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="urutan-banner">Urutan</label>

                                            <input type="number" placeholder="Urutan tampilan" class="form-control"
                                                id="urutan-banner" name="urutan" value="1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-between">
                                <a href="{{ route('admin.banner.index') }}" class="btn btn-danger"><i
                                        class="ti ti-x me-2"></i> Batal</a>
                                <button type="button" class="btn btn-primary"><i
                                        class="ti ti-check me-2"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
