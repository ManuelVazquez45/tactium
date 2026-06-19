<x-app-layout>
    <div class="py-12 bg-[#0B1220] min-h-screen relative font-oxanium">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 50px 50px;">
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <nav class="flex mb-8 items-center space-x-2 text-[10px] uppercase tracking-widest text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-white">Mis_Jugadores</span>
            </nav>

            @if($equiposAprobados->isEmpty() && $solicitudesPendientes->isEmpty())
                <div class="bg-blue-900/20 border border-blue-500/50 backdrop-blur-md p-6 mb-8 relative group">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-400"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-blue-400"></div>

                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-white uppercase tracking-wider">¿Despliegue de nuevo escuadrón?</h3>
                            <p class="text-blue-300/70 text-xs mt-1 italic">Envía una solicitud para registrar tu equipo en el sistema principal.</p>
                        </div>
                        <a href="{{ route('equipos.create') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-500 transition-all hover:shadow-[0_0_15px_rgba(37,99,235,0.5)]">
                            + Crear Equipo
                        </a>
                    </div>
                </div>
            @endif

            @if(!$equiposAprobados->isEmpty())
                <div class="bg-white/5 backdrop-blur-xl border border-green-500/30 overflow-hidden relative mb-8">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-white uppercase tracking-widest text-green-400">
                                👥 Jugadores_Activos
                            </h3>

                        </div>

                        @foreach($equiposAprobados as $equipo)
                            <div class="mb-8 border-t border-white/10 pt-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="font-bold text-white text-base uppercase tracking-wider">{{ $equipo->nombre }}</h4>

                                    @can('update', $equipo)
                                        <a href="{{ route('jugadores.create', $equipo) }}" class="text-green-400 hover:text-green-300 text-xs font-bold tracking-widest uppercase transition-colors">
                                            + Reclutar Jugador
                                        </a>
                                    @endcan
                                </div>

                                @if($equipo->jugadores->isEmpty())
                                    <p class="text-slate-500 text-xs italic bg-black/20 p-3 border-l-2 border-slate-700">No hay efectivos registrados en esta unidad.</p>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-xs tracking-widest" id="tabla-jugadores-{{ $equipo->id }}">
                                            <thead>
                                                <tr class="text-blue-500 border-b border-blue-500/20 uppercase italic">
                                                    <th class="px-4 py-3">Nombre_y_Apellido</th>
                                                    <th class="px-4 py-3">Contacto</th>
                                                    <th class="px-4 py-3">Dorsal</th>
                                                    <th class="px-4 py-3">Posición</th>
                                                    <th class="px-4 py-3 text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-white divide-y divide-white/5">
                                                @foreach($equipo->jugadores as $jugador)
                                                    <tr class="hover:bg-blue-600/10 transition-colors jugador-row">
                                                        <td class="px-4 py-3 font-bold">{{ $jugador->nombre }} <span class="text-slate-400">{{ $jugador->apellido }}</span></td>
                                                        <td class="px-4 py-3 text-slate-400 font-mono text-[10px]">{{ $jugador->email }}</td>
                                                        <td class="px-4 py-3">
                                                            <span class="bg-blue-900/50 border border-blue-500 text-blue-300 px-2 py-0.5 font-mono">
                                                                {{ str_pad($jugador->numero_camiseta ?? 0, 2, '0', STR_PAD_LEFT) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 text-blue-200 uppercase text-[10px]">{{ $jugador->posicion ?? 'N/A' }}</td>
                                                        <td class="px-4 py-3 text-right space-x-3">
                                                            @can('update', $equipo)
                                                                <a href="{{ route('jugadores.edit', [$equipo, $jugador]) }}" class="text-blue-400 hover:text-white font-bold text-[10px] uppercase">
                                                                    Modificar
                                                                </a>
                                                                <form action="{{ route('jugadores.destroy', [$equipo, $jugador]) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Confirmar baja definitiva del efectivo?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-500 hover:text-red-400 font-bold text-[10px] uppercase">
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

            @if($solicitudesPendientes->count() > 0)
                <div class="bg-white/5 backdrop-blur-md border border-yellow-500/30 overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-yellow-500"></div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-yellow-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="animate-pulse">⏳</span> Autorización_Pendiente
                        </h3>

                        <div class="space-y-4">
                            @foreach($solicitudesPendientes as $equipo)
                                <div class="border-l-2 border-yellow-500 bg-yellow-900/10 p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-bold text-white uppercase tracking-wider">{{ $equipo->nombre }}</h4>
                                            <p class="text-slate-400 text-xs mt-1">{{ $equipo->descripcion }}</p>
                                            <p class="text-slate-500 font-mono text-[9px] mt-2">
                                                TIMESTAMP: {{ $equipo->created_at->format('Y-m-d H:i:s') }}
                                            </p>
                                        </div>
                                        <span class="inline-flex items-center px-2 py-1 border border-yellow-500 text-[10px] font-bold text-yellow-500 uppercase tracking-widest">
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
