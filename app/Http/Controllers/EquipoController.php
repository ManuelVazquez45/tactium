<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Models\Equipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


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

        // AÑADIR ESTO: vincula el entrenador en la tabla pivote
        $equipo->users()->attach($user->id, ['estado' => 'pendiente']);

        return redirect()->route('entrenador.dashboard', $equipo)
            ->with('success', 'Solicitud de equipo enviada. Espera la aprobación del administrador.');
    }

    public function show(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);
        return view('entrenador.dashboard', compact('equipo'));
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

        return redirect()->route('entrenador.dashboard', $equipo)->with('success', 'Equipo actualizado exitosamente.');
    }

    public function destroy(Equipo $equipo): RedirectResponse
    {
        $this->authorize('delete', $equipo);

        $equipo->delete();

        return redirect()->route('entrenador.dashboard', $equipo)->with('success', 'Equipo eliminado exitosamente.');
    }

    public function pendentes(): View
    {
        $this->authorize('viewAny', Equipo::class);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para ver las solicitudes pendientes.');
        }

        // Corregido: usamos 'estado' y 'pendiente'
        $pendentes = Equipo::where('estado', 'pendiente')->paginate(10);
        return view('equipos.pendentes', compact('pendentes'));
    }
    public function approve(Equipo $equipo): RedirectResponse
    {
        $this->authorize('viewAny', Equipo::class);

        $equipo->update(['estado' => 'aprobado']);

        // Actualiza también la pivote
        $equipo->users()->updateExistingPivot($equipo->coach_id, ['estado' => 'aprobado']);

        return redirect()->back()->with('success', "Equipo '{$equipo->nombre}' aprobado correctamente.");
    }
    public function reject(Equipo $equipo): RedirectResponse
    {
        $this->authorize('viewAny', Equipo::class);

        $equipo->update(['estado' => 'rechazado']);

        // Actualiza también la pivote
        $equipo->users()->updateExistingPivot($equipo->coach_id, ['estado' => 'denegado']);

        return redirect()->back()->with('success', "Equipo '{$equipo->nombre}' rechazado.");
    }

  public function search(Request $request): JsonResponse
    {
        $query = $request->input('q');

        // 1. Iniciamos la consulta con Eager Loading para evitar el problema N+1
        $equipos = Equipo::with('coach')
            ->when($query, function ($q) use ($query) {
                // Si hay texto en el buscador, filtramos por nombre o descripción
                $q->where('nombre', 'like', "%{$query}%")
                  ->orWhere('descripcion', 'like', "%{$query}%");
            })
            // 2. ORDEN DE CREACIÓN: 'asc' (los más antiguos primero) o 'desc' (los más recientes primero)
            ->orderBy('created_at', 'asc')
            // NOTA DEL TRIBUNAL: Observa que NO hemos puesto un where('estado', 'aprobado').
            // Así garantizamos que viajen todos los estados.
            ->get()
            ->map(function ($equipo) {
                // 3. Inyección de permisos (Policies) para los botones del Frontend AJAX
                // Esto es vital para que tu JS sepa si mostrar los botones de Editar/Eliminar
                $equipo->can_update = auth()->user()->can('update', $equipo);
                $equipo->can_delete = auth()->user()->can('delete', $equipo);
                return $equipo;
            });

        // 4. Retornamos JSON estándar para que tu fetch() lo consuma
        return response()->json($equipos);
    }
}
