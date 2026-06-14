<?php

use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

Route::get('equipos/{equipo}/pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::get('equipos/{equipo}/pagos/create', [PagoController::class, 'create'])->name('pagos.create');
Route::post('equipos/{equipo}/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('equipos/{equipo}/pagos/{pago}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
Route::patch('equipos/{equipo}/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('equipos/{equipo}/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');
Route::get('equipos/{equipo}/pagos/{jugador}', [PagoController::class, 'show'])->name('pagos.show');
Route::patch('equipos/{equipo}/cuota', [PagoController::class, 'updateCuota'])->name('pagos.cuota');
