<?php

use App\Http\Controllers\EntrenamientoController;
use Illuminate\Support\Facades\Route;

Route::get('equipos/{equipo}/entrenamientos', [EntrenamientoController::class, 'listar'])->name('entrenamientos.listar');
Route::get('equipos/{equipo}/entrenamientos/crear', [EntrenamientoController::class, 'crear'])->name('entrenamientos.crear');
Route::post('equipos/{equipo}/entrenamientos', [EntrenamientoController::class, 'guardar'])->name('entrenamientos.guardar');
Route::get('equipos/{equipo}/entrenamientos/{entrenamiento}', [EntrenamientoController::class, 'ver'])->name('entrenamientos.ver');
Route::get('equipos/{equipo}/entrenamientos/{entrenamiento}/editar', [EntrenamientoController::class, 'editar'])->name('entrenamientos.editar');
Route::put('equipos/{equipo}/entrenamientos/{entrenamiento}', [EntrenamientoController::class, 'actualizar'])->name('entrenamientos.actualizar');
Route::delete('equipos/{equipo}/entrenamientos/{entrenamiento}', [EntrenamientoController::class, 'eliminar'])->name('entrenamientos.eliminar');
