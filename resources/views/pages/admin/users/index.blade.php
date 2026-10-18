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
                                                <a href="{{ route('admin.users.ubah', $user->id ?? $loop->iteration) }}"
                                                    class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                            </td>
                                        </tr>
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
@endsection
