<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\ApbdesController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CuacaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::livewire('/admin/dashboard', 'pages::admin.dashboard')->name('admin.dashboard');

Route::get('/admin/artikel', [
    ArtikelController::class, 'index',
])->name('admin.artikel.index');

Route::get('/admin/artikel/tambah', [
    ArtikelController::class, 'tambah',
])->name('admin.artikel.tambah');

Route::get('/admin/kategori', [
    KategoriController::class, 'index',
])->name('admin.kategori.index');

Route::get('/admin/agenda', [
    AgendaController::class, 'index',
])->name('admin.agenda.index');

Route::get('/admin/agenda/detail', [
    AgendaController::class, 'detail',
])->name('admin.agenda.detail');

Route::get('/admin/apbdes', [
    ApbdesController::class, 'index',
])->name('admin.apbdes.index');

Route::get('/admin/apbdes/tambah', [
    ApbdesController::class, 'tambah',
])->name('admin.apbdes.tambah');

Route::get('/admin/banner', [
    BannerController::class, 'index',
])->name('admin.banner.index');

Route::get('/admin/banner/tambah', [
    BannerController::class, 'tambah',
])->name('admin.banner.tambah');

Route::get('/admin/pengaduan', [
    PengaduanController::class, 'index',
])->name('admin.pengaduan.index');

Route::get('/admin/pengaduan/{kode}', [
    PengaduanController::class, 'detail',
])->name('admin.pengaduan.detail');

Route::post('/admin/pengaduan/{kode}/tanggapan', [
    PengaduanController::class, 'tanggapan',
])->name('admin.pengaduan.tanggapan');

Route::get('/admin/cuaca', [
    CuacaController::class, 'index',
])->name('admin.cuaca.index');

Route::get('/admin/cuaca/tambah', [
    CuacaController::class, 'tambah',
])->name('admin.cuaca.tambah');
