<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Entrenamientos - {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('entrenamientos.create', $equipo) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700">
                + Nuevo Entrenamiento
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">

                    @if ($entrenamientos->isEmpty())
                        <p class="text-gray-500 text-center py-8">No hay entrenamientos registrados aún.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-100 border-b">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Fecha</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Tipo</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Hora</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Lugar</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Descripción</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @foreach ($entrenamientos as $entrenamiento)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-gray-900 font-medium">
                                                {{ $entrenamiento->fecha->format('d/m/Y') }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                    @if ($entrenamiento->tipo === 'entrenamiento') bg-blue-100 text-blue-800
                                                    @elseif($entrenamiento->tipo === 'partido') bg-red-100 text-red-800
                                                    @else bg-green-100 text-green-800 @endif
                                                ">
                                                    {{ ucfirst($entrenamiento->tipo) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-gray-600">
                                                @if ($entrenamiento->hora_inicio)
                                                    {{ $entrenamiento->hora_inicio }}
                                                    @if ($entrenamiento->hora_fin)
                                                        - {{ $entrenamiento->hora_fin }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-gray-600">
                                                {{ $entrenamiento->lugar ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-gray-600">
                                                {{ Str::limit($entrenamiento->descripcion, 40) ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 space-x-2">
                                                <a href="{{ route('entrenamientos.show', [$equipo, $entrenamiento]) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-medium text-xs">
                                                    Ver
                                                </a>
                                                <a href="{{ route('entrenamientos.edit', [$equipo, $entrenamiento]) }}"
                                                    class="text-blue-600 hover:text-blue-900 font-medium text-xs">
                                                    Editar
                                                </a>
                                                <form
                                                    action="{{ route('entrenamientos.destroy', [$equipo, $entrenamiento]) }}"
                                                    method="POST" style="display:inline"
                                                    onsubmit="return confirm('¿Está seguro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 font-medium text-xs">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('equipos.show', $equipo) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            ← Volver al Equipo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
