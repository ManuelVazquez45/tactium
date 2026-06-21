<?php

use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('equipos/{equipo}/jugadores', [JugadorController::class, 'guardar'])->name('jugadores.guardar');
    Route::get('equipos/{equipo}/jugadores/crear', [JugadorController::class, 'crear'])->name('jugadores.crear');
    Route::get('equipos/{equipo}/jugadores/{jugador}/editar', [JugadorController::class, 'editar'])->name('jugadores.editar');
    Route::put('equipos/{equipo}/jugadores/{jugador}', [JugadorController::class, 'actualizar'])->name('jugadores.actualizar');
    Route::delete('equipos/{equipo}/jugadores/{jugador}', [JugadorController::class, 'eliminar'])->name('jugadores.eliminar');
});
