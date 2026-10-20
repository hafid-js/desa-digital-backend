<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.banner.index', [
            'bannerList' => collect([
                [
                    'judul' => 'Sambutan Kepala Desa',
                    'keterangan' => 'Selamat datang di halaman resmi Desa Digital',
                    'gambar' => 'assets/static/photos/brainstorming-session-with-creative-designers.jpg',
                    'status' => 'Aktif',
                    'urutan' => 1,
                ],
                [
                    'judul' => 'Program Bantuan Sosial',
                    'keterangan' => 'Pendaftaran bantuan sosial telah dibuka',
                    'gambar' => 'assets/static/photos/a-woman-works-on-a-laptop-at-home.jpg',
                    'status' => 'Aktif',
                    'urutan' => 2,
                ],
                [
                    'judul' => 'Agenda Acara Desa',
                    'keterangan' => 'Jangan lewatkan acara tahunan desa kami',
                    'gambar' => 'assets/static/photos/a-visit-to-the-bookstore.jpg',
                    'status' => 'Nonaktif',
                    'urutan' => 3,
                ],
            ]),
        ]);
    }

    public function tambah(): View
    {
        return view('pages.admin.banner.tambah');
    }
}
