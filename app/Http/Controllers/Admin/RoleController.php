<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.admin.roles.index', [
            'roles' => collect([
                (object) [
                    'id' => 1,
                    'nama' => 'Admin',
                    'deskripsi' => 'Akses penuh ke semua fitur sistem',
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Petugas Desa',
                    'deskripsi' => 'Mengelola data desa dan pengaduan warga',
                ],
                (object) [
                    'id' => 3,
                    'nama' => 'Warga',
                    'deskripsi' => 'Akses terbatas ke layanan publik',
                ],
            ]),
        ]);
    }
}
