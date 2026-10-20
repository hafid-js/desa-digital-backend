<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Queries\SuratQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Daftar permohonan surat dari warga. Data masih dummy sampai modul surat tersedia.
     */
    public function index(Request $request): View
    {
        $query = new SuratQuery;

        return view('pages.admin.surat.index', [
            'surat' => $query->paginate($request),
            'statuses' => $query->statusOptions(),
            'jenisSurat' => $query->jenisOptions(),
            'selectedStatus' => $request->status,
            'selectedJenis' => $request->jenis,
            'search' => $request->search,
            'queryString' => http_build_query(array_filter([
                'search' => $request->search ?: null,
                'status' => $request->status ?: null,
                'jenis' => $request->jenis ?: null,
            ])),
        ]);
    }
}
