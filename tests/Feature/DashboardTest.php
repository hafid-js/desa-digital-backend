<?php

test('halaman dashboard dapat diakses', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard');
});

test('halaman dashboard menampilkan tabel utama layanan warga', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Pengaduan Masyarakat')
        ->assertSee('Permohonan Surat')
        ->assertSee('Rincian APBDes')
        ->assertSee('PGD-2026-0001')
        ->assertSee('Surat Keterangan Domisili');
});

test('halaman dashboard menampilkan ringkasan seluruh modul', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Realisasi APBDes')
        ->assertSee('Produk Lapak')
        ->assertSee('Laporan Produk')
        ->assertSee('Lokasi Cuaca Terdaftar')
        ->assertSee('Akses Cepat');
});

test('halaman dashboard dirender di dalam layout aplikasi', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Lapak Warga', false)
        ->assertSee('livewire.js', false);
});
