@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Tambah Lokasi Cuaca</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-xl-8 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.cuaca.index') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-circle-chevron-left icon-lg me-2"> </i>
                                Kembali ke halaman lokasi cuaca </a>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="space-y">
                                    <div>
                                        <label class="form-label" for="nama-cuaca">Nama Lokasi</label>

                                        <input type="text" placeholder="Nama lokasi cuaca" class="form-control"
                                            id="nama-cuaca" name="nama">
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="latitude-cuaca">Latitude</label>

                                            <input type="number" step="any" placeholder="Contoh: -7.57971"
                                                class="form-control" id="latitude-cuaca" name="latitude">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="longitude-cuaca">Longitude</label>

                                            <input type="number" step="any" placeholder="Contoh: 109.88204"
                                                class="form-control" id="longitude-cuaca" name="longitude">
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="status-cuaca">Status</label>

                                        <select class="form-select" id="status-cuaca" name="is_aktif">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-between">
                                <a href="{{ route('admin.cuaca.index') }}" class="btn btn-danger"><i
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
