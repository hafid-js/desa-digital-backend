<?php

use App\DTOs\PaginationResult;
use App\Enums\StatusPengaduan;
use App\Enums\StatusProduk;
use App\Enums\StatusSurat;
use App\Queries\DashboardQuery;
use App\Queries\ProdukLapakQuery;
use Illuminate\Support\Facades\Blade;

test('enum status menyediakan label dan warna badge', function () {
    expect(StatusPengaduan::Verifikasi->label())->toBe('Verifikasi')
        ->and(StatusPengaduan::Verifikasi->color())->toBe('cyan')
        ->and(StatusSurat::Selesai->color())->toBe('green')
        ->and(StatusProduk::Terjual->color())->toBe('blue');
});

test('komponen status badge merender label dan warna dari enum', function () {
    $html = Blade::render('<x-ui.status-badge :status="$status" />', [
        'status' => StatusPengaduan::Selesai,
    ]);

    expect($html)->toContain('badge badge-pill bg-green text-green-fg')
        ->and($html)->toContain('Selesai');
});

test('komponen paginasi hanya dirender saat halaman lebih dari satu', function () {
    $single = Blade::render('<x-tables.pagination :paginator="$paginator" />', [
        'paginator' => new PaginationResult(
            items: collect(),
            total: 3,
            perPage: 10,
            currentPage: 1,
            lastPage: 1,
            firstItem: 0,
            lastItem: 3,
        ),
    ]);

    $multi = Blade::render('<x-tables.pagination :paginator="$paginator" />', [
        'paginator' => new PaginationResult(
            items: collect(),
            total: 30,
            perPage: 10,
            currentPage: 2,
            lastPage: 3,
            firstItem: 11,
            lastItem: 20,
        ),
    ]);

    expect($single)->not->toContain('aria-label="Pagination"')
        ->and($multi)->toContain('aria-label="Pagination"')
        ->and($multi)->toContain('?page=3');
});

test('komponen stat card merender nilai, ikon, dan keterangan', function () {
    $html = Blade::render(
        '<x-ui.stat-card label="Produk Lapak" :nilai="12" ikon="ti-shopping-bag" warna="primary" keterangan="8 aktif tayang" link="#" />'
    );

    expect($html)->toContain('12')
        ->and($html)->toContain('Produk Lapak')
        ->and($html)->toContain('ti-shopping-bag')
        ->and($html)->toContain('8 aktif tayang');
});

test('komponen halaman kosong meresan pesan yang benar', function () {
    $html = Blade::render('<x-ui.empty-state :colspan="5" pesan="Belum ada produk." />');

    expect($html)->toContain('colspan="5"')
        ->and($html)->toContain('Belum ada produk.');
});

test('query lapak warga memfilter dan mempaginasikan data', function () {
    $query = new ProdukLapakQuery;

    expect($query->filter(null)->count())->toBe(12)
        ->and($query->paginate(null)->perPage)->toBe(10)
        ->and($query->paginate(null)->lastPage)->toBe(2)
        ->and($query->kategoriOptions())->toContain('Fashion & Pakaian')
        ->and($query->lokasiOptions())->toContain('Dusun Krajan');
});

test('ringkasan dashboard merangkum seluruh modul', function () {
    $summary = (new DashboardQuery)->summary();

    expect($summary->pengaduanTotal)->toBe(5)
        ->and($summary->pengaduanPerluTindakLanjut)->toBe(3)
        ->and($summary->suratTotal)->toBe(6)
        ->and($summary->produkTotal)->toBe(12)
        ->and($summary->produkAktif)->toBe(8)
        ->and($summary->laporanBaru)->toBe(2)
        ->and($summary->apbdesTotalTarget)->toBeGreaterThan(0)
        ->and($summary->pengaduanTerbaru)->toHaveCount(5);
});
