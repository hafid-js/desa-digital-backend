<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        return view('pages.admin.kategori.index');
    }
}
