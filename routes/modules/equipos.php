<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('equipos/buscar', [EquipoController::class, 'buscar'])->name('equipos.buscar');
    Route::get('equipos', [EquipoController::class, 'listar'])->name('equipos.listar');
    Route::get('equipos/crear', [EquipoController::class, 'crear'])->name('equipos.crear');
    Route::get('equipos-pendientes', [EquipoController::class, 'pendientes'])->name('equipos.pendientes');
    Route::get('equipos/{equipo}/editar', [EquipoController::class, 'editar'])->name('equipos.editar');
    Route::post('equipos', [EquipoController::class, 'guardar'])->name('equipos.guardar');
    Route::get('equipos/{equipo}', [EquipoController::class, 'ver'])->name('equipos.ver');
    Route::put('equipos/{equipo}', [EquipoController::class, 'actualizar'])->name('equipos.actualizar');
    Route::delete('equipos/{equipo}', [EquipoController::class, 'eliminar'])->name('equipos.eliminar');
    Route::patch('equipos/{equipo}/aprobar', [EquipoController::class, 'aprobar'])->name('equipos.aprobar');
    Route::patch('equipos/{equipo}/rechazar', [EquipoController::class, 'rechazar'])->name('equipos.rechazar');
});

