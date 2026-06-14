<?php

use App\Http\Controllers\EntrenadorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/entrenadores', [EntrenadorController::class, 'index'])->name('entrenadores.index');
});
