<?php

use App\Http\Controllers\Api\ApbdesController;
use App\Http\Controllers\Api\CuacaController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('/apbdes', [ApbdesController::class, 'index'])->name('apbdes.index');
    Route::post('/apbdes', [ApbdesController::class, 'store'])->name('apbdes.store');
    Route::put('/apbdes/{apbdes}', [ApbdesController::class, 'update'])->name('apbdes.update');

    Route::get('/cuaca', [CuacaController::class, 'index'])->name('cuaca.index');
    Route::get('/cuaca/{cuaca}', [CuacaController::class, 'show'])->name('cuaca.show');
});
