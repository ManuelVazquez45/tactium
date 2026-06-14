<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalle del Entrenamiento
            </h2>
            <a href="{{ route('entrenamientos.index', $equipo) }}" class="text-gray-600 hover:text-gray-900">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">

                    <div class="space-y-6">
                        <!-- Header con tipo -->
                        <div class="pb-4 border-b">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $equipo->nombre }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ $entrenamiento->fecha->format('d/m/Y') }}</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($entrenamiento->tipo === 'entrenamiento') bg-blue-100 text-blue-800
                                    @elseif($entrenamiento->tipo === 'partido') bg-red-100 text-red-800
                                    @else bg-green-100 text-green-800
                                    @endif
                                ">
                                    {{ ucfirst($entrenamiento->tipo) }}
                                </span>
                            </div>
                        </div>

                        <!-- Información General -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase">Hora Inicio</p>
                               <p class="text-gray-900 font-medium">{{ $entrenamiento->hora_inicio ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase">Hora Fin</p>
                             <p class="text-gray-900 font-medium">{{ $entrenamiento->hora_fin ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase">Lugar</p>
                                <p class="text-gray-900 font-medium">{{ $entrenamiento->lugar ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase">Duración</p>
                                <p class="text-gray-900 font-medium">{{ $entrenamiento->duracion_minutos ? $entrenamiento->duracion_minutos . ' min' : '-' }}</p>
                            </div>
                        </div>

                        <!-- Descripción -->
                        @if($entrenamiento->descripcion)
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase">Descripción</p>
                                <p class="text-gray-900 mt-2">{{ $entrenamiento->descripcion }}</p>
                            </div>
                        @endif

                        <!-- Notas -->
                        @if($entrenamiento->notas)
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase">Notas</p>
                                <p class="text-gray-900 mt-2">{{ $entrenamiento->notas }}</p>
                            </div>
                        @endif

                        <!-- Timestamp -->
                        <div class="pt-4 border-t text-xs text-gray-500">
                            <p>Creado: {{ $entrenamiento->created_at->format('d/m/Y H:i') }}</p>
                            <p>Actualizado: {{ $entrenamiento->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('entrenamientos.edit', [$equipo, $entrenamiento]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Editar
                        </a>
                        <form action="{{ route('entrenamientos.destroy', [$equipo, $entrenamiento]) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Está seguro de que desea eliminar este entrenamiento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                        <a href="{{ route('entrenamientos.index', $equipo) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
