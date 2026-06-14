<?php

use App\Http\Controllers\EntrenamientoController;
use Illuminate\Support\Facades\Route;

Route::get('equipos/{equipo}/entrenamientos', [EntrenamientoController::class, 'index'])->name('entrenamientos.index');
Route::get('equipos/{equipo}/entrenamientos/create', [EntrenamientoController::class, 'create'])->name('entrenamientos.create');
Route::post('equipos/{equipo}/entrenamientos', [EntrenamientoController::class, 'store'])->name('entrenamientos.store');
Route::get('equipos/{equipo}/entrenamientos/{entrenamiento}', [EntrenamientoController::class, 'show'])->name('entrenamientos.show');
Route::get('equipos/{equipo}/entrenamientos/{entrenamiento}/edit', [EntrenamientoController::class, 'edit'])->name('entrenamientos.edit');
Route::patch('equipos/{equipo}/entrenamientos/{entrenamiento}', [EntrenamientoController::class, 'update'])->name('entrenamientos.update');
Route::delete('equipos/{equipo}/entrenamientos/{entrenamiento}', [EntrenamientoController::class, 'destroy'])->name('entrenamientos.destroy');
