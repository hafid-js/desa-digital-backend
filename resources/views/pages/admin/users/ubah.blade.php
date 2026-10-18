@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Ubah Pengguna</h1>
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
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-circle-chevron-left icon-lg me-2"> </i>
                                Kembali ke halaman pengguna </a>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                @csrf
                                <div class="space-y">
                                    <div>
                                        <label class="form-label" for="nama-user">Nama Lengkap</label>

                                        <input type="text" placeholder="Nama lengkap" class="form-control"
                                            id="nama-user" name="nama" required>
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="email-user">Email</label>

                                        <input type="email" placeholder="email@desa.id" class="form-control"
                                            id="email-user" name="email" required>
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="role-user">Role</label>

                                        <select class="form-select" id="role-user" name="role" required>
                                            <option value="admin">Admin</option>
                                            <option value="warga">Warga</option>
                                        </select>
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="status-user">Status</label>

                                        <select class="form-select" id="status-user" name="status" required>
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-between">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i
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
