<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.users.index');
    }

    public function ubah($id)
    {
        return view('pages.admin.users.ubah', ['id' => $id]);
    }
}
