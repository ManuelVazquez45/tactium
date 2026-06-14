<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntrenadorDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // <-- AÑADIDO: Necesario para el guardián

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/entrenador/dashboard', [EntrenadorDashboardController::class, 'index'])->name('entrenador.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/modules/equipos.php';
require __DIR__.'/modules/entrenadores.php';
require __DIR__.'/modules/jugadores.php';

// =========================================================================
// ZONA DE ALTA SEGURIDAD: Solo entrenadores con equipo aceptado
// =========================================================================
Route::middleware(['auth', 'equipo.aceptado'])->group(function () {
    // Al usar el alias, Laravel gestiona la ejecución de la clase de forma correcta
    require __DIR__.'/modules/entrenamientos.php';
    require __DIR__.'/modules/partidos.php';
     require __DIR__.'/modules/pagos.php';
});

