@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Tambah APBDes</h1>
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
                            <a href="{{ route('admin.apbdes.index') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-circle-chevron-left icon-lg me-2"> </i>
                                Kembali ke halaman APBDes </a>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="space-y">
                                    <div>
                                        <label class="form-label" for="judul-apbdes">Judul Posisi Anggaran</label>

                                        <input type="text" placeholder="Judul posisi anggaran" class="form-control"
                                            id="judul-apbdes" name="judul">
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="bagian-apbdes">Bagian</label>

                                        <select class="form-select" id="bagian-apbdes" name="section">
                                            <option value="pelaksanaan">Pelaksanaan</option>
                                            <option value="pendapatan">Pendapatan</option>
                                            <option value="pembelanjaan">Pembelanjaan</option>
                                        </select>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="realisasi-apbdes">Jumlah Realisasi</label>

                                            <input type="number" placeholder="Jumlah realisasi" class="form-control"
                                                id="realisasi-apbdes" name="jumlah_realisasi">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="target-apbdes">Jumlah Target</label>

                                            <input type="number" placeholder="Jumlah target" class="form-control"
                                                id="target-apbdes" name="jumlah_target">
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="tahun-apbdes">Tahun Anggaran</label>

                                        <input type="number" placeholder="Tahun anggaran" class="form-control"
                                            id="tahun-apbdes" name="tahun_anggaran">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-between">
                                <a href="{{ route('admin.apbdes.index') }}" class="btn btn-danger"><i
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
