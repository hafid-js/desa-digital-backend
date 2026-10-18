<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.admin.roles.index');
    }

    public function tambah()
    {
        return view('pages.admin.roles.tambah');
    }

    public function ubah($id)
    {
        return view('pages.admin.roles.ubah', ['id' => $id]);
    }
}
