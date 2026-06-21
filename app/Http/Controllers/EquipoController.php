<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Models\Equipo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EquipoController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Equipo::class);
        $query = Equipo::query();

        if (auth()->user()->role !== 'admin') {
            $query->where('estado', 'aprobado');
        }

        $equipos = $query->paginate(10);
        return view('equipos.index', compact('equipos'));
    }

    public function create(): View
    {
        $this->authorize('create', Equipo::class);
        
        // Validar que el entrenador no tenga más de 1 equipo
        if (auth()->user()->role === 'entrenador') {
            $equipoExistente = Equipo::where('coach_id', auth()->id())->exists();
            if ($equipoExistente) {
                abort(403, 'Ya tienes un equipo registrado. Solo puedes crear un equipo.');
            }
        }
        
        return view('equipos.create');
    }

    public function store(StoreEquipoRequest $request): RedirectResponse
    {
        $user = auth()->user();
        
        // Limitar a 1 equipo por entrenador
        if ($user->role === 'entrenador') {
            $equipoExistente = Equipo::where('coach_id', $user->id)->exists();
            if ($equipoExistente) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Ya tienes un equipo registrado. Solo puedes crear un equipo.');
            }
        }
        
        $equipo = Equipo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'coach_id' => $user->id,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Solicitud de equipo enviada. Espera la aprobación del administrador.');
    }

    public function show(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);
        $jugadores = $equipo->jugadores()->get();
        return view('equipos.show', compact('equipo', 'jugadores'));
    }

    public function edit(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        return view('equipos.edit', compact('equipo'));
    }

    public function update(UpdateEquipoRequest $request, Equipo $equipo): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $equipo->update($request->validated());

        return redirect()->route('equipos.show', $equipo)->with('success', 'Equipo actualizado exitosamente.');
    }

    public function destroy(Equipo $equipo): RedirectResponse
    {
        $this->authorize('delete', $equipo);

        $equipo->delete();

        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado exitosamente.');
    }

    public function pendentes(): View
    {
        $this->authorize('viewAny', Equipo::class);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para ver las solicitudes pendientes.');
        }

        $pendentes = Equipo::where('estado', 'pendiente')->paginate(10);
        return view('equipos.pendentes', compact('pendentes'));
    }

    public function approve(Equipo $equipo): RedirectResponse
    {
        $this->authorize('viewAny', Equipo::class);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para aprobar solicitudes.');
        }

        $equipo->update(['estado' => 'aprobado']);
        return redirect()->back()->with('success', "Equipo '{$equipo->nombre}' aprobado correctamente.");
    }

    public function reject(Equipo $equipo): RedirectResponse
    {
        $this->authorize('viewAny', Equipo::class);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para rechazar solicitudes.');
        }

        $equipo->update(['estado' => 'denegado']);
        return redirect()->back()->with('success', "Equipo '{$equipo->nombre}' rechazado.");
    }

    public function search()
    {
        $this->authorize('viewAny', Equipo::class);

        $query = Equipo::query();

        if (auth()->user()->role !== 'admin') {
            $query->where('estado', 'aprobado');
        }

        if (request('q')) {
            $query->where('nombre', 'like', '%' . request('q') . '%');
        }

        $equipos = $query->with('coach')->get()->map(function ($equipo) {
            return [
                'id' => $equipo->id,
                'nombre' => $equipo->nombre,
                'descripcion' => $equipo->descripcion,
                'estado' => $equipo->estado,
                'coach' => $equipo->coach,
                'can_update' => auth()->user()->can('update', $equipo),
                'can_delete' => auth()->user()->can('delete', $equipo),
            ];
        });

        return response()->json($equipos);
    }
}
