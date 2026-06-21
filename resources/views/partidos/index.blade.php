<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('equipos.ver', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">{{ $equipo->nombre }}</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Partidos</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Partidos <span class="text-blue-600">// {{ $equipo->nombre }}</span>
                    </h2>
                </div>
                @can('update', $equipo)
                    <a href="{{ route('partidos.crear', $equipo) }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                        + Nuevo Partido
                    </a>
                @endcan
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    @if($partidos->isEmpty())
                        <p class="text-gray-400 text-sm italic text-center py-8">No se encontraron registros de partidos.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-blue-600 border-b-2 border-gray-200">
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Fecha</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Rival</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Ubicación</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Resultado</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Estado</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($partidos as $partido)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 font-mono text-sm text-gray-900 font-bold">{{ $partido->fecha->format('d/m/Y') }}</td>
                                            <td class="py-5 font-black text-sm text-gray-900 italic uppercase tracking-wide">{{ $partido->rival }}</td>
                                            <td class="py-5">
                                                <span class="px-3 py-1 border text-xs font-bold uppercase tracking-widest
                                                    {{ $partido->tipo_ubicacion === 'local' ? 'border-blue-300 bg-blue-50 text-blue-700' : 'border-purple-300 bg-purple-50 text-purple-700' }}">
                                                    {{ ucfirst($partido->tipo_ubicacion) }}
                                                </span>
                                            </td>
                                            <td class="py-5 font-mono font-black text-sm text-gray-900">
                                                {{ $partido->estado === 'jugado' ? $partido->goles_favor . ' - ' . $partido->goles_contra : '---' }}
                                            </td>
                                            <td class="py-5">
                                                <span class="px-3 py-1 border text-xs font-bold uppercase tracking-widest
                                                    @if($partido->estado === 'programado') border-yellow-400 bg-yellow-50 text-yellow-700
                                                    @elseif($partido->estado === 'jugado') border-green-400 bg-green-50 text-green-700
                                                    @else border-red-400 bg-red-50 text-red-700
                                                    @endif">
                                                    {{ ucfirst($partido->estado) }}
                                                </span>
                                            </td>
                                            <td class="py-5 text-right space-x-4">
                                                <a href="{{ route('partidos.ver', [$equipo, $partido]) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase transition-colors">Ver</a>
                                                @can('update', $equipo)
                                                    <a href="{{ route('partidos.editar', [$equipo, $partido]) }}"
                                                        class="text-green-600 hover:text-green-800 font-bold text-xs uppercase transition-colors">Editar</a>
                                                    <form action="{{ route('partidos.eliminar', [$equipo, $partido]) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar partido?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-800 font-bold text-xs uppercase transition-colors">Borrar</button>
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
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
