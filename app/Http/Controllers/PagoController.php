<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PagoController extends Controller
{
    public function index(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);

        $jugadores = $equipo->jugadores()
            ->withCount('pagos')
            ->withSum(['pagos as total_pagado' => function ($q) {
                $q->where('estado', 'pagado');
            }], 'importe')
            ->get();

        return view('pagos.index', compact('equipo', 'jugadores'));
    }

    public function show(Equipo $equipo, Jugador $jugador): View
    {
        $this->authorize('view', $equipo);

        $pagos          = $jugador->pagos()->orderBy('fecha_pago', 'desc')->get();
        $totalPagado    = $pagos->where('estado', 'pagado')->sum('importe');
        $totalPendiente = $pagos->where('estado', 'pendiente')->sum('importe');

        return view('pagos.show', compact('equipo', 'jugador', 'pagos', 'totalPagado', 'totalPendiente'));
    }

    public function create(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        $jugadores = $equipo->jugadores()->get();
        return view('pagos.create', compact('equipo', 'jugadores'));
    }

    public function store(Equipo $equipo, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $validated = $request->validate([
            'jugador_id' => 'required|exists:jugadores,id',
            'concepto'   => 'required|string|max:255',
            'importe'    => 'required|numeric|min:0',
            'fecha_pago' => 'nullable|date',
            'estado'     => 'required|in:pagado,pendiente,sin_pagar',
        ]);

        $validated['equipo_id'] = $equipo->id;

        Pago::create($validated);

        return redirect()->route('pagos.index', $equipo)
            ->with('success', 'Pago registrado correctamente.');
    }

    public function edit(Equipo $equipo, Pago $pago): View
    {
        $this->authorize('update', $equipo);
        if ($pago->equipo_id !== $equipo->id) {
            abort(403);
        }
        $jugadores = $equipo->jugadores()->get();
        return view('pagos.edit', compact('equipo', 'pago', 'jugadores'));
    }

    public function update(Equipo $equipo, Pago $pago, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($pago->equipo_id !== $equipo->id) {
            abort(403);
        }

        $validated = $request->validate([
            'jugador_id' => 'required|exists:jugadores,id',
            'concepto'   => 'required|string|max:255',
            'importe'    => 'required|numeric|min:0',
            'fecha_pago' => 'nullable|date',
            'estado'     => 'required|in:pagado,pendiente,sin_pagar',
        ]);

        $pago->update($validated);

        return redirect()->route('pagos.index', $equipo)
            ->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Equipo $equipo, Pago $pago): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($pago->equipo_id !== $equipo->id) {
            abort(403);
        }

        $pago->delete();

        return redirect()->route('pagos.index', $equipo)
            ->with('success', 'Pago eliminado correctamente.');
    }

    public function updateCuota(Equipo $equipo, Request $request): RedirectResponse
{
    $this->authorize('update', $equipo);

    $request->validate([
        'cuota' => 'required|numeric|min:0',
    ]);

    $equipo->update(['cuota' => $request->cuota]);

    return redirect()->route('pagos.index', $equipo)
        ->with('success', 'Cuota actualizada correctamente.');
}
}
