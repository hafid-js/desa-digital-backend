<?php

test('halaman daftar lapak warga dapat diakses', function () {
    $this->get(route('admin.lapak.index'))->assertOk();
});

test('daftar lapak warga menampilkan data produk dummy', function () {
    $this->get(route('admin.lapak.index'))
        ->assertOk()
        ->assertSee('Lapak Warga')
        ->assertSee('Sepatu Laki-laki Kanvas Putih')
        ->assertSee('Fashion & Pakaian');
});

test('daftar lapak warga dapat difilter berdasarkan status dan pencarian', function () {
    $this->get(route('admin.lapak.index', ['status' => 'terjual']))
        ->assertOk()
        ->assertSee('Motor Honda Beat 2020')
        ->assertDontSee('Sepatu Laki-laki Kanvas Putih');

    $this->get(route('admin.lapak.index', ['search' => 'rotan']))
        ->assertOk()
        ->assertSee('Kursi Rotan Tamu');
});

test('halaman detail lapak warga dapat diakses', function () {
    $this->get(route('admin.lapak.detail', 1))
        ->assertOk()
        ->assertSee('Sepatu Laki-laki Kanvas Putih')
        ->assertSee('Informasi Penjual')
        ->assertSee('Ahmad Fauzi');
});

test('detail lapak warga menolak produk yang tidak ditemukan', function () {
    $this->get(route('admin.lapak.detail', 9999))->assertNotFound();
});

test('halaman master lapak dapat diakses', function () {
    $this->get(route('admin.lapak.kategori'))
        ->assertOk()
        ->assertSee('Kategori Produk')
        ->assertSee('Kondisi Produk')
        ->assertSee('Dusun Karangsari');
});

test('halaman laporan produk lapak dapat diakses', function () {
    $this->get(route('admin.lapak.laporan'))
        ->assertOk()
        ->assertSee('Laporan Produk')
        ->assertSee('LPR-2026-0001');
});
