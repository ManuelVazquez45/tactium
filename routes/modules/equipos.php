<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    // 1º RUTAS ESPECÍFICAS (Deben ir primero para que Laravel no las confunda con un ID)
    Route::get('equipos/search', [EquipoController::class, 'search'])->name('equipos.search');
    Route::get('equipos-pendentes', [EquipoController::class, 'pendentes'])->name('equipos.pendentes');

    // 2º RUTA RESOURCE (Contiene la ruta /equipos/{equipo} genérica)
    Route::resource('equipos', EquipoController::class);

    // 3º RUTAS CON PARÁMETROS DINÁMICOS ADICIONALES
    Route::patch('equipos/{equipo}/approve', [EquipoController::class, 'approve'])->name('equipos.approve');
    Route::patch('equipos/{equipo}/reject', [EquipoController::class, 'reject'])->name('equipos.reject');

});
