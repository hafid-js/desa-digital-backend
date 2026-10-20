<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.agenda.index');
    }

    public function detail(): View
    {
        return view('pages.admin.agenda.detail');
    }
}
