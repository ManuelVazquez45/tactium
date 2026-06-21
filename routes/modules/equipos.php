<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('equipos/search', [EquipoController::class, 'search'])->name('equipos.search');
    Route::resource('equipos', EquipoController::class);
    Route::get('equipos-pendentes', [EquipoController::class, 'pendentes'])->name('equipos.pendentes');
    Route::patch('equipos/{equipo}/approve', [EquipoController::class, 'approve'])->name('equipos.approve');
    Route::patch('equipos/{equipo}/reject', [EquipoController::class, 'reject'])->name('equipos.reject');
});
