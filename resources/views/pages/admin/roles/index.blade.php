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
                                    <a href="{{ route('admin.roles.tambah') }}"
                                        class="btn btn-primary btn-sm d-flex d-md-inline-flex align-items-center justify-content-center">
                                        <i class="ti ti-plus icon-lg me-1"></i>
                                        <span>Tambah Role</span>
                                    </a>
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
                                            <td>
                                                {{ $role->nama ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $role->deskripsi ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('admin.roles.ubah', $role->id ?? $loop->iteration) }}"
                                                        class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
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
@endsection
