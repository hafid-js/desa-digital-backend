<?php

use App\Http\Controllers\Api\ApbdesController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->name('api.v1.')->group(function () {
    Route::get('/apbdes', [ApbdesController::class, 'index'])->name('apbdes.index');
    Route::post('/apbdes', [ApbdesController::class, 'store'])->name('apbdes.store');
    Route::put('/apbdes/{apbdes}', [ApbdesController::class, 'update'])->name('apbdes.update');
});
