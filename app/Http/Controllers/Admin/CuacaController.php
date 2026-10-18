<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CuacaController extends Controller
{
    public function index()
    {
        return view('pages.admin.cuaca.index', [
            'cuacaList' => collect([
                [
                    'nama' => 'Kutoarjo',
                    'latitude' => -7.57971,
                    'longitude' => 109.88204,
                    'is_aktif' => true,
                ],
                [
                    'nama' => 'Gunung Condong',
                    'latitude' => -7.54321,
                    'longitude' => 110.12345,
                    'is_aktif' => true,
                ],
                [
                    'nama' => 'Cepedak, Bruno',
                    'latitude' => -7.55000,
                    'longitude' => 110.13000,
                    'is_aktif' => true,
                ],
            ]),
        ]);
    }

    public function tambah()
    {
        return view('pages.admin.cuaca.tambah');
    }
}
