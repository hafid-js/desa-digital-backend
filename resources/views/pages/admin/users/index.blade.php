@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Pengguna</h1>
                </div>
            </div>
        </div>
    </div>
    <main id="content" class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="8"
                                            size="3" aria-label="Users count">
                                    </div>
                                    entries
                                </div>

                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search user">
                                    </div>
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
                                        <th class="text-center" style="min-width: 200px;">NAMA</th>
                                        <th class="text-center" style="min-width: 200px;">EMAIL</th>
                                        <th class="text-center" style="width: 150px;">ROLE</th>
                                        <th class="text-center" style="width: 150px;">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($users ?? collect([]) as $user)
                                        <tr>
                                            <td class="text-center">
                                                <input class="form-check-input m-0" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                {{ $user->nama ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $user->email ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $user->role ?? 'Warga' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbahUser{{ $user->id }}">
                                                        <i class="ti ti-edit"></i>
                                                    </button>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Ubah User -->
                                        <div class="modal modal-blur fade" id="modalUbahUser{{ $user->id }}" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Pengguna: {{ $user->nama }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST">
                                                            @csrf
                                                            <div class="space-y">
                                                                <div>
                                                                    <label class="form-label" for="nama-user-{{ $user->id }}">Nama Lengkap</label>
                                                                    <input type="text" value="{{ $user->nama }}" class="form-control" id="nama-user-{{ $user->id }}" name="nama" required>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-label" for="email-user-{{ $user->id }}">Email</label>
                                                                    <input type="email" value="{{ $user->email }}" class="form-control" id="email-user-{{ $user->id }}" name="email" required>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-label" for="role-user-{{ $user->id }}">Role</label>
                                                                    <select class="form-select" id="role-user-{{ $user->id }}" name="role" required>
                                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="petugas_desa" {{ $user->role === 'petugas_desa' ? 'selected' : '' }}>Petugas Desa</option>
                                                                        <option value="warga" {{ $user->role === 'warga' ? 'selected' : '' }}>Warga</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-label" for="status-user-{{ $user->id }}">Status</label>
                                                                    <select class="form-select" id="status-user-{{ $user->id }}" name="status" required>
                                                                        <option value="1" {{ $user->status === '1' || $user->status === true ? 'selected' : '' }}>Aktif</option>
                                                                        <option value="0" {{ $user->status === '0' || $user->status === false ? 'selected' : '' }}>Nonaktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i> Batal</button>
                                                        <button type="button" class="btn btn-primary w-100"><i class="ti ti-check me-1"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <p class="text-secondary mb-0">Belum ada data pengguna.</p>
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

    <!-- Modal Tambah Pengguna -->
    <div class="modal modal-blur fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <div class="space-y">
                            <div>
                                <label class="form-label" for="nama-user-tambah">Nama Lengkap</label>
                                <input type="text" placeholder="Nama lengkap" class="form-control" id="nama-user-tambah" name="nama" required>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="email-user-tambah">Email</label>
                                <input type="email" placeholder="email@desa.id" class="form-control" id="email-user-tambah" name="email" required>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="role-user-tambah">Role</label>
                                <select class="form-select" id="role-user-tambah" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="petugas_desa">Petugas Desa</option>
                                    <option value="warga">Warga</option>
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="status-user-tambah">Status</label>
                                <select class="form-select" id="status-user-tambah" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i> Batal</button>
                    <button type="button" class="btn btn-primary w-100"><i class="ti ti-check me-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
