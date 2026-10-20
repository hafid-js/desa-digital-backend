<?php

test('halaman dashboard dapat diakses', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard');
});

test('halaman dashboard dirender di dalam layout aplikasi', function () {
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Lapak Warga', false)
        ->assertSee('livewire.js', false);
});
