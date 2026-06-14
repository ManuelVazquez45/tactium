<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Entrenamiento - {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('entrenamientos.index', $equipo) }}" class="text-gray-600 hover:text-gray-900">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form method="POST" action="{{ route('entrenamientos.update', [$equipo, $entrenamiento]) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $entrenamiento->fecha->format('Y-m-d')) }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('fecha') border-red-500 @enderror"
                            >
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora Inicio</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio', $entrenamiento->hora_inicio) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>

                            <div>
                                <label for="hora_fin" class="block text-sm font-medium text-gray-700">Hora Fin</label>
                                <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin', $entrenamiento->hora_fin) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                            <select name="tipo" id="tipo" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('tipo') border-red-500 @enderror"
                            >
                                <option value="">Selecciona un tipo</option>
                                <option value="entrenamiento" {{ old('tipo', $entrenamiento->tipo) === 'entrenamiento' ? 'selected' : '' }}>Entrenamiento</option>
                                <option value="partido" {{ old('tipo', $entrenamiento->tipo) === 'partido' ? 'selected' : '' }}>Partido</option>
                                <option value="amistoso" {{ old('tipo', $entrenamiento->tipo) === 'amistoso' ? 'selected' : '' }}>Amistoso</option>
                            </select>
                            @error('tipo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lugar" class="block text-sm font-medium text-gray-700">Lugar</label>
                            <input type="text" name="lugar" id="lugar" value="{{ old('lugar', $entrenamiento->lugar) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>

                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('descripcion', $entrenamiento->descripcion) }}</textarea>
                        </div>

                        <div>
                            <label for="notas" class="block text-sm font-medium text-gray-700">Notas</label>
                            <textarea name="notas" id="notas" rows="2"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('notas', $entrenamiento->notas) }}</textarea>
                        </div>

                        <div>
                            <label for="duracion_minutos" class="block text-sm font-medium text-gray-700">Duración (minutos)</label>
                            <input type="number" name="duracion_minutos" id="duracion_minutos" value="{{ old('duracion_minutos', $entrenamiento->duracion_minutos) }}" min="1"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('entrenamientos.index', $equipo) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
