<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-300 text-green-800 px-6 py-4 text-sm font-bold uppercase tracking-widest">
                    {{ session('success') }}
                </div>
            @endif

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Mis_Jugadores</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    Mi Equipo <span class="text-blue-600">// Gestión_Jugadores</span>
                </h2>
                <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Panel de control del entrenador</p>
            </div>

            {{-- SIN EQUIPO --}}
            @if($equiposAprobados->isEmpty() && $solicitudesPendientes->isEmpty() && $equiposRechazados->isEmpty())
                <div class="bg-blue-50 border border-blue-300 p-8 mb-8 relative group shadow-sm">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-blue-500"></div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-blue-500"></div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider">¿Despliegue de nuevo escuadrón?</h3>
                            <p class="text-blue-600 text-sm mt-2 italic">Envía una solicitud para registrar tu equipo en el sistema principal.</p>
                        </div>
                        <a href="{{ route('equipos.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                            + Crear Equipo
                        </a>
                    </div>
                </div>
            @endif

            {{-- EQUIPOS APROBADOS --}}
            @if(!$equiposAprobados->isEmpty())
                <div class="bg-white border border-green-300 shadow-sm overflow-hidden relative mb-8 group">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-green-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-green-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>

                    <div class="p-8">
                        <h3 class="text-lg font-bold text-green-700 uppercase tracking-widest mb-6 flex items-center gap-3">
                            👥 <span>Jugadores_Activos</span>
                        </h3>

                        {{-- FORMULARIO INLINE AÑADIR JUGADOR --}}
                        @if($equipoSeleccionado)
                            <div class="bg-blue-50 border border-blue-300 p-8 mb-8 relative shadow-sm">
                                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-blue-500"></div>
                                <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-blue-500"></div>
                                <div class="flex justify-between items-center mb-6">
                                    <h4 class="text-base font-black text-gray-900 uppercase tracking-wider">Agregar Jugador a {{ $equipoSeleccionado->nombre }}</h4>
                                    <a href="{{ route('entrenador.dashboard') }}" class="text-red-500 hover:text-red-700 text-xs font-bold tracking-widest uppercase">✕ Cerrar</a>
                                </div>

                                <form method="POST" action="{{ route('jugadores.store', $equipoSeleccionado) }}" class="space-y-6">
                                    @csrf

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Nombre</label>
                                            <input type="text" name="nombre" value="{{ old('nombre') }}" required
                                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm @error('nombre') border-red-400 @enderror">
                                            @error('nombre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Apellido</label>
                                            <input type="text" name="apellido" value="{{ old('apellido') }}" required
                                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm @error('apellido') border-red-400 @enderror">
                                            @error('apellido')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" required
                                            class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm @error('email') border-red-400 @enderror">
                                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Número Camiseta</label>
                                            <input type="text" name="numero_camiseta" value="{{ old('numero_camiseta') }}"
                                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Posición</label>
                                            <input type="text" name="posicion" value="{{ old('posicion') }}"
                                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">F. Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm">
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-3 pt-4">
                                        <a href="{{ route('entrenador.dashboard') }}"
                                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm">
                                            Cancelar
                                        </a>
                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-green-700 transition-all shadow-sm">
                                            Crear Jugador
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        @foreach($equiposAprobados as $equipo)
                            <div class="mb-10 border-t border-gray-100 pt-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h4 class="font-black text-gray-900 text-base uppercase tracking-wider">{{ $equipo->nombre }}</h4>
                                    @can('update', $equipo)
                                        <a href="{{ route('entrenador.dashboard', ['equipo_id' => $equipo->id]) }}"
                                            class="inline-flex items-center px-4 py-2 border border-green-400 bg-green-50 text-green-700 hover:bg-green-100 text-xs font-bold tracking-widest uppercase transition-all shadow-sm">
                                            + Reclutar Jugador
                                        </a>
                                    @endcan
                                </div>

                                @if($equipo->jugadores->isEmpty())
                                    <p class="text-gray-400 text-sm italic bg-gray-50 p-4 border-l-2 border-gray-300">
                                        No hay efectivos registrados en esta unidad.
                                    </p>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left" id="tabla-jugadores-{{ $equipo->id }}">
                                            <thead>
                                                <tr class="text-blue-600 border-b-2 border-gray-200">
                                                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest italic">Nombre y Apellido</th>
                                                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest italic">Contacto</th>
                                                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest italic">Dorsal</th>
                                                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest italic">Posición</th>
                                                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest italic text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">
                                                @foreach($equipo->jugadores as $jugador)
                                                    <tr class="hover:bg-blue-50 transition-colors">
                                                        <td class="px-4 py-4 font-black text-sm text-gray-900 italic uppercase">
                                                            {{ $jugador->nombre }}
                                                            <span class="text-gray-400 font-normal normal-case">{{ $jugador->apellido }}</span>
                                                        </td>
                                                        <td class="px-4 py-4 text-gray-500 font-mono text-xs">{{ $jugador->email }}</td>
                                                        <td class="px-4 py-4">
                                                            <span class="inline-flex items-center px-3 py-1 border border-blue-300 bg-blue-50 text-blue-700 font-mono font-black text-xs">
                                                                {{ str_pad($jugador->numero_camiseta ?? 0, 2, '0', STR_PAD_LEFT) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-4 text-gray-600 uppercase text-xs font-bold">{{ $jugador->posicion ?? 'N/A' }}</td>
                                                        <td class="px-4 py-4 text-right space-x-4">
                                                            @can('update', $equipo)
                                                                <a href="{{ route('jugadores.edit', [$equipo, $jugador]) }}"
                                                                    class="text-green-600 hover:text-green-800 font-bold text-xs uppercase transition-colors">
                                                                    Modificar
                                                                </a>
                                                                <form action="{{ route('jugadores.destroy', [$equipo, $jugador]) }}"
                                                                    method="POST" style="display:inline"
                                                                    onsubmit="return confirm('¿Confirmar baja definitiva del efectivo?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="text-red-600 hover:text-red-800 font-bold text-xs uppercase transition-colors">
                                                                        Eliminar
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- SOLICITUDES PENDIENTES --}}
            @if($solicitudesPendientes->count() > 0)
                <div class="bg-white border border-yellow-300 shadow-sm overflow-hidden relative group">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-yellow-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-yellow-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>

                    <div class="p-8">
                        <h3 class="text-lg font-bold text-yellow-600 uppercase tracking-widest mb-6 flex items-center gap-3">
                            <span class="animate-pulse">⏳</span> Autorización_Pendiente
                        </h3>

                        <div class="space-y-4">
                            @foreach($solicitudesPendientes as $equipo)
                                <div class="border-l-2 border-yellow-400 bg-yellow-50 p-6">
                                    <div class="flex justify-between items-start gap-4">
                                        <div>
                                            <h4 class="font-black text-gray-900 uppercase tracking-wider text-base">{{ $equipo->nombre }}</h4>
                                            <p class="text-gray-500 text-sm mt-2">{{ $equipo->descripcion }}</p>
                                            <p class="text-gray-400 font-mono text-xs mt-3">
                                                TIMESTAMP: {{ $equipo->created_at->format('Y-m-d H:i:s') }}
                                            </p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 border border-yellow-400 bg-yellow-100 text-yellow-700 text-xs font-bold uppercase tracking-widest whitespace-nowrap">
                                            Standby
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
<x-footer />
