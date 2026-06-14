<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Partido - {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('partidos.index', $equipo) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form method="POST" action="{{ route('partidos.update', [$equipo, $partido]) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="date" name="fecha" value="{{ old('fecha', $partido->fecha->format('Y-m-d')) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Hora</label>
                                <input type="time" name="hora" value="{{ old('hora', $partido->hora) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rival</label>
                            <input type="text" name="rival" value="{{ old('rival', $partido->rival) }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lugar</label>
                            <input type="text" name="lugar" value="{{ old('lugar', $partido->lugar) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ubicación</label>
                                <select name="tipo_ubicacion" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="local" {{ old('tipo_ubicacion', $partido->tipo_ubicacion) === 'local' ? 'selected' : '' }}>Local</option>
                                    <option value="visitante" {{ old('tipo_ubicacion', $partido->tipo_ubicacion) === 'visitante' ? 'selected' : '' }}>Visitante</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado</label>
                                <select name="estado" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="programado" {{ old('estado', $partido->estado) === 'programado' ? 'selected' : '' }}>Programado</option>
                                    <option value="jugado" {{ old('estado', $partido->estado) === 'jugado' ? 'selected' : '' }}>Jugado</option>
                                    <option value="cancelado" {{ old('estado', $partido->estado) === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Goles a favor</label>
                                <input type="number" name="goles_favor" value="{{ old('goles_favor', $partido->goles_favor) }}" min="0"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Goles en contra</label>
                                <input type="number" name="goles_contra" value="{{ old('goles_contra', $partido->goles_contra) }}" min="0"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $partido->descripcion) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Notas</label>
                            <textarea name="notas" rows="2"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notas', $partido->notas) }}</textarea>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('partidos.index', $equipo) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
