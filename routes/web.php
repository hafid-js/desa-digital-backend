<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\KategoriController;
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
