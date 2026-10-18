<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.users.index', [
            'users' => collect([
                (object) [
                    'id' => 1,
                    'nama' => 'Budi Santoso',
                    'email' => 'budi@desa.id',
                    'role' => 'Admin',
                ],
                (object) [
                    'id' => 2,
                    'nama' => 'Siti Rahayu',
                    'email' => 'siti@desa.id',
                    'role' => 'Petugas Desa',
                ],
                (object) [
                    'id' => 3,
                    'nama' => 'Ahmad Hidayat',
                    'email' => 'ahmad@desa.id',
                    'role' => 'Warga',
                ],
                (object) [
                    'id' => 4,
                    'nama' => 'Dewi Lestari',
                    'email' => 'dewi@desa.id',
                    'role' => 'Warga',
                ],
            ]),
        ]);
    }
}
