<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        return view('pages.admin.agenda.index');
    }

    public function tambah()
    {
        return view('pages.admin.agenda.tambah');
    }

    public function ubah()
    {
        return view('pages.admin.agenda.ubah');
    }
}
