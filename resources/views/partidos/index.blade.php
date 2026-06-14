<x-app-layout>
    <div class="bg-[#0B1220] min-h-screen text-gray-300 font-sans">
        <div class=" bg-[#0B1220]/50 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-8 py-8 flex justify-between items-center">
                <h2 class="font-oxanium font-bold text-xl text-white uppercase tracking-[0.2em] italic">
                    Gestión // <span class="text-blue-400">Partidos</span>
                </h2>
                <a href="{{ route('partidos.create', $equipo) }}"
                   class="px-6 py-2 bg-blue-600/20 border border-blue-500 text-blue-400 hover:bg-blue-600 hover:text-white text-[10px] font-bold uppercase tracking-[0.3em] transition-all">
                    + Nuevo_Partido
                </a>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#0B1220] border border-blue-500/20 shadow-lg rounded-sm overflow-hidden">
                    <div class="p-6">
                        @if($partidos->isEmpty())
                            <p class="text-gray-500 text-center py-8 font-mono italic">>> No se encontraron registros de partidos.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs text-left">
                                    <thead class="bg-blue-900/10 border-b border-blue-500/20 uppercase tracking-widest text-blue-400">
                                        <tr>
                                            <th class="px-6 py-4">Fecha</th>
                                            <th class="px-6 py-4">Rival</th>
                                            <th class="px-6 py-4">Ubicación</th>
                                            <th class="px-6 py-4">Resultado</th>
                                            <th class="px-6 py-4">Estado</th>
                                            <th class="px-6 py-4 text-right">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-blue-500/10">
                                        @foreach($partidos as $partido)
                                            <tr class="hover:bg-blue-900/5 transition-colors text-gray-300">
                                                <td class="px-6 py-4 font-mono">{{ $partido->fecha->format('d/m/Y') }}</td>
                                                <td class="px-6 py-4 font-bold text-white">{{ $partido->rival }}</td>
                                                <td class="px-6 py-4">
                                                    <span class="px-2 py-1 border border-blue-500/30 rounded-sm text-[10px] uppercase font-bold text-blue-400">
                                                        {{ ucfirst($partido->tipo_ubicacion) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 font-mono font-bold text-white">
                                                    {{ $partido->estado === 'jugado' ? $partido->goles_favor . ' - ' . $partido->goles_contra : '---' }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="uppercase font-bold tracking-wider
                                                        @if($partido->estado === 'programado') text-yellow-500
                                                        @elseif($partido->estado === 'jugado') text-green-500
                                                        @else text-red-500 @endif">
                                                        {{ ucfirst($partido->estado) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-right space-x-3">
                                                    <a href="{{ route('partidos.show', [$equipo, $partido]) }}" class="text-blue-400 hover:text-white transition-colors">Ver</a>
                                                    <a href="{{ route('partidos.edit', [$equipo, $partido]) }}" class="text-blue-400 hover:text-white transition-colors">Editar</a>
                                                    <form action="{{ route('partidos.destroy', [$equipo, $partido]) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar partido?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">Borrar</button>
                                                    </form>
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
    </div>
</x-app-layout>
