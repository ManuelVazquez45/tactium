<?php

use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;

Route::get('equipos/{equipo}/partidos', [PartidoController::class, 'index'])->name('partidos.index');
Route::get('equipos/{equipo}/partidos/create', [PartidoController::class, 'create'])->name('partidos.create');
Route::post('equipos/{equipo}/partidos', [PartidoController::class, 'store'])->name('partidos.store');
Route::get('equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'show'])->name('partidos.show');
Route::get('equipos/{equipo}/partidos/{partido}/edit', [PartidoController::class, 'edit'])->name('partidos.edit');
Route::patch('equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'update'])->name('partidos.update');
Route::delete('equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');
