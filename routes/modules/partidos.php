<?php

use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;

Route::get('equipos/{equipo}/partidos', [PartidoController::class, 'listar'])->name('partidos.listar');
Route::get('equipos/{equipo}/partidos/crear', [PartidoController::class, 'crear'])->name('partidos.crear');
Route::post('equipos/{equipo}/partidos', [PartidoController::class, 'guardar'])->name('partidos.guardar');
Route::get('equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'ver'])->name('partidos.ver');
Route::get('equipos/{equipo}/partidos/{partido}/editar', [PartidoController::class, 'editar'])->name('partidos.editar');
Route::put('equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'actualizar'])->name('partidos.actualizar');
Route::delete('equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'eliminar'])->name('partidos.eliminar');
