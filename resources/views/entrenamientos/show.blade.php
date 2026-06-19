<x-app-layout>

    <div class="py-12 bg-[#0B1220] min-h-screen relative font-oxanium">
        <!-- Decoración HUD de fondo -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 50px 50px;">
        </div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-[10px] uppercase tracking-widest text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('entrenamientos.index', $equipo) }}" class="hover:text-blue-500 transition-colors text-blue-500">Entrenamientos</a>
                <span>/</span>
                <span class="text-white">Detalle</span>
            </nav>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white/5 backdrop-blur-xl border border-blue-500/20 overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8 space-y-8">

                    <!-- Header con tipo -->
                    <div class="pb-6 border-b border-white/10 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold text-white uppercase tracking-wider">{{ $equipo->nombre }}</h3>
                            <p class="text-slate-400 text-xs mt-1 font-mono">{{ $entrenamiento->fecha->format('d/m/Y') }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 border text-[9px] font-bold uppercase tracking-widest
                            @if($entrenamiento->tipo === 'entrenamiento') border-blue-500 text-blue-300 bg-blue-900/30
                            @elseif($entrenamiento->tipo === 'partido') border-red-500 text-red-300 bg-red-900/30
                            @else border-green-500 text-green-300 bg-green-900/30
                            @endif
                        ">
                            {{ ucfirst($entrenamiento->tipo) }}
                        </span>
                    </div>

                    <!-- Información General -->
                    <div class="grid grid-cols-2 gap-6 text-[10px] tracking-widest">
                        <div>
                            <p class="text-blue-500 uppercase italic mb-1">Hora Inicio</p>
                            <p class="text-white font-bold text-sm">{{ $entrenamiento->hora_inicio ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-blue-500 uppercase italic mb-1">Hora Fin</p>
                            <p class="text-white font-bold text-sm">{{ $entrenamiento->hora_fin ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-blue-500 uppercase italic mb-1">Lugar</p>
                            <p class="text-white font-bold text-sm">{{ $entrenamiento->lugar ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-blue-500 uppercase italic mb-1">Duración</p>
                            <p class="text-white font-bold text-sm">{{ $entrenamiento->duracion_minutos ? $entrenamiento->duracion_minutos . ' min' : '-' }}</p>
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($entrenamiento->descripcion)
                        <div>
                            <p class="text-blue-500 uppercase italic text-[10px] tracking-widest mb-2">Descripción</p>
                            <p class="text-slate-300 text-sm bg-black/20 p-3 border-l-2 border-slate-700">{{ $entrenamiento->descripcion }}</p>
                        </div>
                    @endif

                    <!-- Notas -->
                    @if($entrenamiento->notas)
                        <div>
                            <p class="text-blue-500 uppercase italic text-[10px] tracking-widest mb-2">Notas</p>
                            <p class="text-slate-300 text-sm bg-black/20 p-3 border-l-2 border-slate-700">{{ $entrenamiento->notas }}</p>
                        </div>
                    @endif

                    <!-- Timestamp -->
                    <div class="pt-6 border-t border-white/10 text-[9px] text-slate-500 font-mono space-y-1">
                        <p>CREADO: {{ $entrenamiento->created_at->format('d/m/Y H:i') }}</p>
                        <p>ACTUALIZADO: {{ $entrenamiento->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Acciones -->
                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('entrenamientos.edit', [$equipo, $entrenamiento]) }}"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-500 transition-all hover:shadow-[0_0_15px_rgba(37,99,235,0.5)]">
                            Editar
                        </a>
                        <form action="{{ route('entrenamientos.destroy', [$equipo, $entrenamiento]) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Está seguro de que desea eliminar este entrenamiento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-red-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-red-500 transition-all">
                                Eliminar
                            </button>
                        </form>
                        <a href="{{ route('entrenamientos.index', $equipo) }}"
                            class="inline-flex items-center px-6 py-2 border border-white/10 text-white text-xs font-bold uppercase tracking-widest bg-white/5 hover:bg-white/10 transition-all">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
