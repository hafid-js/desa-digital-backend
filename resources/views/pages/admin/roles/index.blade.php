@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Role Pengguna</h1>
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
                            <div class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <button type="button" class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modalTambahRole">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Role</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 0px;">
                                            <input class="form-check-input m-0" type="checkbox">
                                        </th>
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th class="text-center" style="min-width: 200px;">NAMA ROLE</th>
                                        <th class="text-center" style="width: 200px;">DESKRIPSI</th>
                                        <th class="text-center" style="width: 150px;">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($roles ?? collect([]) as $role)
                                        <tr>
                                            <td class="text-center">
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $role->nama ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $role->deskripsi ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbahRole{{ $role->id }}">
                                                        <i class="ti ti-edit"></i>
                                                    </button>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Ubah Role -->
                                        <div class="modal modal-blur fade" id="modalUbahRole{{ $role->id }}" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Role: {{ $role->nama }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST">
                                                            @csrf
                                                            <div class="space-y">
                                                                <div>
                                                                    <label class="form-label" for="nama-role-{{ $role->id }}">Nama Role</label>
                                                                    <input type="text" value="{{ $role->nama }}" class="form-control" id="nama-role-{{ $role->id }}" name="nama" required>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-label" for="deskripsi-role-{{ $role->id }}">Deskripsi</label>
                                                                    <textarea id="deskripsi-role-{{ $role->id }}" name="deskripsi" class="form-control" rows="3">{{ $role->deskripsi }}</textarea>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-label" for="status-role-{{ $role->id }}">Status</label>
                                                                    <select class="form-select" id="status-role-{{ $role->id }}" name="status" required>
                                                                        <option value="1">Aktif</option>
                                                                        <option value="0">Nonaktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i> Batal</button>
                                                        <button type="button" class="btn btn-primary"><i class="ti ti-check me-1"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada data role.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Role -->
    <div class="modal modal-blur fade" id="modalTambahRole" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Role Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="space-y">
                            <div>
                                <label class="form-label" for="nama-role-tambah">Nama Role</label>
                                <input type="text" placeholder="Nama role (contoh: Admin, Warga)" class="form-control" id="nama-role-tambah" name="nama" required>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="deskripsi-role-tambah">Deskripsi</label>
                                <textarea id="deskripsi-role-tambah" name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="status-role-tambah">Status</label>
                                <select class="form-select" id="status-role-tambah" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i> Batal</button>
                    <button type="button" class="btn btn-primary"><i class="ti ti-check me-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
