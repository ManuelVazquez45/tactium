<?php

use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('equipos/{equipo}/jugadores', [JugadorController::class, 'store'])->name('jugadores.store');
    Route::get('equipos/{equipo}/jugadores/create', [JugadorController::class, 'create'])->name('jugadores.create');
    Route::get('equipos/{equipo}/jugadores/{jugador}/edit', [JugadorController::class, 'edit'])->name('jugadores.edit');
    Route::patch('equipos/{equipo}/jugadores/{jugador}', [JugadorController::class, 'update'])->name('jugadores.update');
    Route::delete('equipos/{equipo}/jugadores/{jugador}', [JugadorController::class, 'destroy'])->name('jugadores.destroy');
});
