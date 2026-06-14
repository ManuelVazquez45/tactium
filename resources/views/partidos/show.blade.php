<x-app-layout>
    <div class="bg-[#0B1220] min-h-screen text-gray-300 font-sans">
        {{-- Header Táctico --}}
        <div class=" bg-[#0B1220]/50 backdrop-blur-md">
            <div class="max-w-3xl mx-auto px-8 py-8 flex justify-between items-center">
                <h2 class="font-oxanium font-bold text-xl text-white uppercase tracking-[0.2em] italic">
                    Detalle // <span class="text-blue-400">Partido</span>
                </h2>
                <a href="{{ route('partidos.index', $equipo) }}"
                   class="text-[10px] font-bold uppercase tracking-[0.3em] text-blue-400 hover:text-white border border-blue-500/30 px-4 py-2 transition-all">
                    ← Volver_al_sistema
                </a>
            </div>
        </div>

        {{-- Contenido Principal --}}
        <div class="py-12 px-6">
            <div class="max-w-3xl mx-auto bg-[#0B1220] border border-blue-500/20 shadow-lg rounded-sm overflow-hidden">
                <div class="p-8 space-y-8">

                    {{-- Cabecera del Partido --}}
                    <div class="pb-6 border-b border-blue-500/10 flex justify-between items-start">
                        <div>
                            <h3 class="font-oxanium text-2xl font-bold text-white uppercase tracking-wider">
                                {{ $equipo->nombre }} <span class="text-blue-500">vs</span> {{ $partido->rival }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2 font-mono uppercase">
                                {{ $partido->fecha->format('d/m/Y') }} {{ $partido->hora ? ' | ' . $partido->hora : '' }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 text-[10px] uppercase font-bold tracking-widest border border-blue-500/30
                            @if($partido->estado === 'programado') text-yellow-500
                            @elseif($partido->estado === 'jugado') text-green-500
                            @else text-red-500 @endif">
                            {{ ucfirst($partido->estado) }}
                        </span>
                    </div>

                    {{-- Grid de Datos --}}
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-oxanium text-gray-500 uppercase tracking-widest">Ubicación</p>
                            <p class="text-white mt-1">{{ ucfirst($partido->tipo_ubicacion) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-oxanium text-gray-500 uppercase tracking-widest">Lugar</p>
                            <p class="text-white mt-1">{{ $partido->lugar ?? '-' }}</p>
                        </div>
                        @if($partido->estado === 'jugado')
                        <div class="col-span-2">
                            <p class="text-[10px] font-oxanium text-gray-500 uppercase tracking-widest">Resultado Final</p>
                            <p class="text-3xl font-bold text-blue-400 font-mono mt-1">
                                {{ $partido->goles_favor }} - {{ $partido->goles_contra }}
                            </p>
                        </div>
                        @endif
                    </div>

                    {{-- Descripciones --}}
                    @if($partido->descripcion || $partido->notas)
                        <div class="space-y-4 pt-4 border-t border-blue-500/10">
                            @if($partido->descripcion)
                                <div>
                                    <p class="text-[10px] font-oxanium text-gray-500 uppercase tracking-widest">Descripción</p>
                                    <p class="text-gray-300 mt-1 text-sm leading-relaxed">{{ $partido->descripcion }}</p>
                                </div>
                            @endif
                            @if($partido->notas)
                                <div>
                                    <p class="text-[10px] font-oxanium text-gray-500 uppercase tracking-widest">Notas Técnicas</p>
                                    <p class="text-gray-300 mt-1 text-sm italic">{{ $partido->notas }}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Acciones --}}
                    <div class="pt-6 border-t border-blue-500/10 flex gap-3">
                        <a href="{{ route('partidos.edit', [$equipo, $partido]) }}"
                           class="px-6 py-2 bg-blue-600/20 border border-blue-500 text-blue-400 hover:bg-blue-600 hover:text-white text-[10px] font-bold uppercase tracking-widest transition-all">
                            Editar_Registro
                        </a>
                        <form action="{{ route('partidos.destroy', [$equipo, $partido]) }}" method="POST" onsubmit="return confirm('¿Eliminar partido?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-6 py-2 bg-red-600/20 border border-red-500 text-red-400 hover:bg-red-600 hover:text-white text-[10px] font-bold uppercase tracking-widest transition-all">
                                Borrar_Datos
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
