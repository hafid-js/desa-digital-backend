<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Dummy\ApbdesDummy;
use Illuminate\Contracts\View\View;

class ApbdesController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.apbdes.index', [
            'apbdesList' => ApbdesDummy::all(),
        ]);
    }

    public function tambah(): View
    {
        return view('pages.admin.apbdes.tambah');
    }
}
