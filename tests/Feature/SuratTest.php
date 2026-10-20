<?php

test('halaman permohonan surat dapat diakses', function () {
    $this->get(route('admin.surat.index'))
        ->assertOk()
        ->assertSee('Permohonan Surat')
        ->assertSee('Surat Keterangan Domisili')
        ->assertSee('Persyaratan pendaftaran sekolah anak');
});

test('permohonan surat dapat difilter berdasarkan status', function () {
    $this->get(route('admin.surat.index', ['status' => 'diajukan']))
        ->assertOk()
        ->assertSee('Syarat pengajuan beasiswa-putri')
        ->assertDontSee('Pengajuan akta kelahiran anak');
});

test('permohonan surat dapat difilter berdasarkan jenis surat', function () {
    $this->get(route('admin.surat.index', ['jenis' => 'S-17']))
        ->assertOk()
        ->assertSee('Pengajuan akta kelahiran anak')
        ->assertDontSee('Persyaratan pendaftaran sekolah anak');
});

test('permohonan surat dapat dicari dengan kata kunci', function () {
    $this->get(route('admin.surat.index', ['search' => 'kematian']))
        ->assertOk()
        ->assertSee('Peng mengurus surat keterangan kematian')
        ->assertDontSee('Persyaratan pendaftaran sekolah anak');
});
