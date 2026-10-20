<?php

test('halaman dashboard dapat diakses', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard');
});

test('halaman dashboard menampilkan ringkasan data', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Produk Lapak')
        ->assertSee('Laporan Produk')
        ->assertSee('Produk Lapak Terbaru')
        ->assertSee('Akses Cepat')
        ->assertSee('Lokasi Cuaca Terdaftar');
});

test('halaman dashboard dirender di dalam layout aplikasi', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Lapak Warga', false)
        ->assertSee('livewire.js', false);
});
