<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ApbdesController extends Controller
{
    public function index()
    {
        return view('pages.admin.apbdes.index', [
            'apbdesList' => collect([]),
        ]);
    }

    public function tambah()
    {
        return view('pages.admin.apbdes.tambah');
    }
}
