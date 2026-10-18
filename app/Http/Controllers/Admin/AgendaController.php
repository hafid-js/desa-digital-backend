<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        return view('pages.admin.agenda.index');
    }

    public function detail()
    {
        return view('pages.admin.agenda.detail');
    }
}
