<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('entrenamientos.listar', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Entrenamientos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Detalle</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    Detalle <span class="text-blue-600">// Entrenamiento</span>
                </h2>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8 space-y-8">

                    <!-- Header con tipo -->
                    <div class="pb-6 border-b border-gray-100 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-black text-gray-900 uppercase tracking-wider">{{ $equipo->nombre }}</h3>
                            <p class="text-gray-500 text-sm mt-1 font-mono">{{ $entrenamiento->fecha->format('d/m/Y') }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 border text-xs font-bold uppercase tracking-widest
                            @if($entrenamiento->tipo === 'entrenamiento') border-blue-300 text-blue-700 bg-blue-50
                            @elseif($entrenamiento->tipo === 'partido') border-red-300 text-red-700 bg-red-50
                            @else border-green-300 text-green-700 bg-green-50
                            @endif">
                            {{ ucfirst($entrenamiento->tipo) }}
                        </span>
                    </div>

                    <!-- Información General -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                        <div>
                            <p class="text-blue-600 uppercase italic text-xs tracking-widest font-bold mb-2">Hora Inicio</p>
                            <p class="text-gray-900 font-bold text-base">{{ $entrenamiento->hora_inicio ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-blue-600 uppercase italic text-xs tracking-widest font-bold mb-2">Hora Fin</p>
                            <p class="text-gray-900 font-bold text-base">{{ $entrenamiento->hora_fin ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-blue-600 uppercase italic text-xs tracking-widest font-bold mb-2">Lugar</p>
                            <p class="text-gray-900 font-bold text-base">{{ $entrenamiento->lugar ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-blue-600 uppercase italic text-xs tracking-widest font-bold mb-2">Duración</p>
                            <p class="text-gray-900 font-bold text-base">{{ $entrenamiento->duracion_minutos ? $entrenamiento->duracion_minutos . ' min' : '-' }}</p>
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($entrenamiento->descripcion)
                        <div>
                            <p class="text-blue-600 uppercase italic text-xs tracking-widest font-bold mb-3">Descripción</p>
                            <p class="text-gray-700 text-sm bg-gray-50 p-4 border-l-2 border-blue-300 leading-relaxed">{{ $entrenamiento->descripcion }}</p>
                        </div>
                    @endif

                    <!-- Notas -->
                    @if($entrenamiento->notas)
                        <div>
                            <p class="text-blue-600 uppercase italic text-xs tracking-widest font-bold mb-3">Notas</p>
                            <p class="text-gray-700 text-sm bg-gray-50 p-4 border-l-2 border-blue-300 leading-relaxed">{{ $entrenamiento->notas }}</p>
                        </div>
                    @endif

                    <!-- Timestamp -->
                    <div class="pt-6 border-t border-gray-100 text-xs text-gray-400 font-mono space-y-1">
                        <p>CREADO: {{ $entrenamiento->created_at->format('d/m/Y H:i') }}</p>
                        <p>ACTUALIZADO: {{ $entrenamiento->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Acciones -->
                    <div class="flex flex-wrap gap-3 pt-4">
                        <a href="{{ route('entrenamientos.editar', [$equipo, $entrenamiento]) }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                            Editar
                        </a>
                        <form action="{{ route('entrenamientos.eliminar', [$equipo, $entrenamiento]) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Está seguro de que desea eliminar este entrenamiento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-red-700 transition-all shadow-sm">
                                Eliminar
                            </button>
                        </form>
                        <a href="{{ route('entrenamientos.listar', $equipo) }}"
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
