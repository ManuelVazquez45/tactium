<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('partidos.index', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Partidos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Detalle</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Detalle <span class="text-blue-600">// Partido</span>
                    </h2>
                </div>
                <a href="{{ route('partidos.index', $equipo) }}"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm whitespace-nowrap">
                    ← Volver
                </a>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8 space-y-8">

                    <!-- Cabecera del Partido -->
                    <div class="pb-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-wider">
                                {{ $equipo->nombre }} <span class="text-blue-600">vs</span> {{ $partido->rival }}
                            </h3>
                            <p class="text-sm text-gray-400 mt-2 font-mono uppercase">
                                {{ $partido->fecha->format('d/m/Y') }}{{ $partido->hora ? ' | ' . $partido->hora : '' }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 border text-xs font-bold uppercase tracking-widest
                            @if($partido->estado === 'programado') border-yellow-400 bg-yellow-50 text-yellow-700
                            @elseif($partido->estado === 'jugado') border-green-400 bg-green-50 text-green-700
                            @else border-red-400 bg-red-50 text-red-700
                            @endif">
                            {{ ucfirst($partido->estado) }}
                        </span>
                    </div>

                    <!-- Grid de Datos -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Ubicación</p>
                            <span class="inline-flex items-center px-3 py-1 border text-xs font-bold uppercase tracking-widest
                                {{ $partido->tipo_ubicacion === 'local' ? 'border-blue-300 bg-blue-50 text-blue-700' : 'border-purple-300 bg-purple-50 text-purple-700' }}">
                                {{ ucfirst($partido->tipo_ubicacion) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Lugar</p>
                            <p class="text-gray-900 font-bold text-base">{{ $partido->lugar ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Hora</p>
                            <p class="text-gray-900 font-bold text-base">{{ $partido->hora ?? '-' }}</p>
                        </div>
                        @if($partido->estado === 'jugado')
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Resultado Final</p>
                                <p class="text-3xl font-black text-gray-900 font-mono">
                                    {{ $partido->goles_favor }} <span class="text-blue-600">-</span> {{ $partido->goles_contra }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Descripción y Notas -->
                    @if($partido->descripcion || $partido->notas)
                        <div class="space-y-6 pt-6 border-t border-gray-100">
                            @if($partido->descripcion)
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-3">Descripción</p>
                                    <p class="text-gray-700 text-sm bg-gray-50 p-4 border-l-2 border-blue-300 leading-relaxed">{{ $partido->descripcion }}</p>
                                </div>
                            @endif
                            @if($partido->notas)
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-3">Notas Técnicas</p>
                                    <p class="text-gray-700 text-sm bg-gray-50 p-4 border-l-2 border-blue-300 leading-relaxed italic">{{ $partido->notas }}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Acciones -->
                    <div class="pt-6 border-t border-gray-100 flex flex-wrap gap-3">
                        @can('update', $equipo)
                            <a href="{{ route('partidos.edit', [$equipo, $partido]) }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                                Editar
                            </a>
                            <form action="{{ route('partidos.destroy', [$equipo, $partido]) }}" method="POST" onsubmit="return confirm('¿Eliminar partido?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-red-700 transition-all shadow-sm">
                                    Eliminar
                                </button>
                            </form>
                        @endcan
                        <a href="{{ route('partidos.index', $equipo) }}"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
