<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('equipos.show', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">{{ $equipo->nombre }}</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Entrenamientos</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Entrenamientos <span class="text-blue-600">// {{ $equipo->nombre }}</span>
                    </h2>
                </div>
                @can('update', $equipo)
                    <a href="{{ route('entrenamientos.create', $equipo) }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                        + Nuevo Entrenamiento
                    </a>
                @endcan
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    @if ($entrenamientos->isEmpty())
                        <p class="text-gray-400 text-sm italic text-center py-8 border-l-2 border-gray-200 bg-gray-50 p-4">
                            No hay entrenamientos registrados aún.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-blue-600 border-b-2 border-gray-200">
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Fecha</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Tipo</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Hora</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Lugar</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Descripción</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($entrenamientos as $entrenamiento)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 font-bold text-sm text-gray-900">
                                                {{ $entrenamiento->fecha->format('d/m/Y') }}
                                            </td>
                                            <td class="py-5">
                                                <span class="inline-flex items-center px-3 py-1 border text-xs font-bold uppercase tracking-widest
                                                    @if ($entrenamiento->tipo === 'entrenamiento') border-blue-300 text-blue-700 bg-blue-50
                                                    @elseif($entrenamiento->tipo === 'partido') border-red-300 text-red-700 bg-red-50
                                                    @else border-green-300 text-green-700 bg-green-50
                                                    @endif">
                                                    {{ ucfirst($entrenamiento->tipo) }}
                                                </span>
                                            </td>
                                            <td class="py-5 text-sm text-gray-500">
                                                @if ($entrenamiento->hora_inicio)
                                                    {{ $entrenamiento->hora_inicio }}
                                                    @if ($entrenamiento->hora_fin)
                                                        - {{ $entrenamiento->hora_fin }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="py-5 text-sm text-gray-500">
                                                {{ $entrenamiento->lugar ?? '-' }}
                                            </td>
                                            <td class="py-5 text-sm text-gray-500">
                                                {{ Str::limit($entrenamiento->descripcion, 40) ?? '-' }}
                                            </td>
                                            <td class="py-5 text-right space-x-4">
                                                <a href="{{ route('entrenamientos.show', [$equipo, $entrenamiento]) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase transition-colors">
                                                    Ver
                                                </a>
                                                @can('update', $equipo)
                                                    <a href="{{ route('entrenamientos.edit', [$equipo, $entrenamiento]) }}"
                                                        class="text-green-600 hover:text-green-800 font-bold text-xs uppercase transition-colors">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('entrenamientos.destroy', [$equipo, $entrenamiento]) }}"
                                                        method="POST" style="display:inline"
                                                        onsubmit="return confirm('¿Está seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-800 font-bold text-xs uppercase transition-colors">
                                                            Borrar
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

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('equipos.show', $equipo) }}"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm">
                            ← Volver al Equipo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
