<?php

use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

Route::get('equipos/{equipo}/pagos', [PagoController::class, 'listar'])->name('pagos.listar');
Route::get('equipos/{equipo}/pagos/crear', [PagoController::class, 'crear'])->name('pagos.crear');
Route::post('equipos/{equipo}/pagos', [PagoController::class, 'guardar'])->name('pagos.guardar');
Route::get('equipos/{equipo}/pagos/{pago}/editar', [PagoController::class, 'editar'])->name('pagos.editar');
Route::put('equipos/{equipo}/pagos/{pago}', [PagoController::class, 'actualizar'])->name('pagos.actualizar');
Route::delete('equipos/{equipo}/pagos/{pago}', [PagoController::class, 'eliminar'])->name('pagos.eliminar');
Route::get('equipos/{equipo}/pagos/{jugador}', [PagoController::class, 'ver'])->name('pagos.ver');
Route::patch('equipos/{equipo}/cuota', [PagoController::class, 'actualizarCuota'])->name('pagos.actualizarCuota');
