@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none ">
        <div class="container-xl">
            <div class="row g-2 ">
                <div class="col">
                    <h1 class="page-title">Form Agenda</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.agenda.index') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-circle-chevron-left icon-lg me-2"> </i>
                                Kembali ke halaman agenda </a>
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

                                            <input type="text" placeholder="Lokasi pelaksanaan" class="form-control"
                                                id="lokasi-agenda" name="lokasi">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="penyelenggara-agenda"> Penyelenggara</label>

                                            <input type="text" placeholder="Penyelenggara agenda" class="form-control"
                                                id="penyelenggara-agenda" name="penyelenggara">
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
    </main>
@endsection
