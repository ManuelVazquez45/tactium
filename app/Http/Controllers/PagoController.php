<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PagoController extends Controller
{
    public function listar(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);

        if (auth()->user()->role === 'jugador') {
            abort(403, 'No tienes permiso para ver el sistema de pagos.');
        }

        $jugadores = $equipo->jugadores()
            ->withCount('pagos')
            ->withSum(['pagos as total_pagado' => function ($q) {
                $q->where('estado', 'pagado');
            }], 'importe')
            ->get();

        return view('pagos.index', compact('equipo', 'jugadores'));
    }

    public function ver(Equipo $equipo, Jugador $jugador): View
    {
        $this->authorize('view', $equipo);

        if (auth()->user()->role === 'jugador') {
            if (auth()->user()->email !== $jugador->email) {
                abort(403, 'No puedes ver la inscripción de otro jugador.');
            }
        }

        $pagos          = $jugador->pagos()->orderBy('fecha_pago', 'desc')->get();
        $totalPagado    = $pagos->where('estado', 'pagado')->sum('importe');
        $totalPendiente = $pagos->where('estado', 'pendiente')->sum('importe');

        return view('pagos.show', compact('equipo', 'jugador', 'pagos', 'totalPagado', 'totalPendiente'));
    }

    public function crear(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        $jugadores = $equipo->jugadores()->get();
        return view('pagos.create', compact('equipo', 'jugadores'));
    }

    public function guardar(Equipo $equipo, StorePagoRequest $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $validated = $request->validated();
        $validated['equipo_id'] = $equipo->id;

        Pago::create($validated);

        return redirect()->route('pagos.listar', $equipo)
            ->with('success', 'Pago registrado correctamente.');
    }

    public function editar(Equipo $equipo, Pago $pago): View
    {
        $this->authorize('update', $equipo);
        if ($pago->equipo_id !== $equipo->id) {
            abort(403);
        }
        $jugadores = $equipo->jugadores()->get();
        return view('pagos.edit', compact('equipo', 'pago', 'jugadores'));
    }

    public function actualizar(Equipo $equipo, Pago $pago, UpdatePagoRequest $request): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($pago->equipo_id !== $equipo->id) {
            abort(403);
        }

        $pago->update($request->validated());

        return redirect()->route('pagos.listar', $equipo)
            ->with('success', 'Pago actualizado correctamente.');
    }

    public function eliminar(Equipo $equipo, Pago $pago): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($pago->equipo_id !== $equipo->id) {
            abort(403);
        }

        $pago->delete();

        return redirect()->route('pagos.listar', $equipo)
            ->with('success', 'Pago eliminado correctamente.');
    }

    public function actualizarCuota(Equipo $equipo, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $request->validate([
            'cuota' => 'required|numeric|min:0',
        ]);

        $equipo->update(['cuota' => $request->cuota]);

        return redirect()->route('pagos.listar', $equipo)
            ->with('success', 'Cuota actualizada correctamente.');
    }
}

