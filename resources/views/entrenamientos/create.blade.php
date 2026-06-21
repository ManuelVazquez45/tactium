<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('entrenamientos.listar', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Entrenamientos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Nuevo</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    Nuevo Entrenamiento <span class="text-blue-600">// {{ $equipo->nombre }}</span>
                </h2>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('entrenamientos.guardar', $equipo) }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="fecha" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" required
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors @error('fecha') border-red-400 @enderror">
                            @error('fecha')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="hora_inicio" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Hora Inicio</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                            <div>
                                <label for="hora_fin" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Hora Fin</label>
                                <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="tipo" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Tipo</label>
                            <select name="tipo" id="tipo" required
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors @error('tipo') border-red-400 @enderror">
                                <option value="">Selecciona un tipo</option>
                                <option value="entrenamiento" {{ old('tipo') === 'entrenamiento' ? 'selected' : '' }}>Entrenamiento</option>
                                <option value="amistoso" {{ old('tipo') === 'amistoso' ? 'selected' : '' }}>Amistoso</option>
                            </select>
                            @error('tipo')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lugar" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Lugar</label>
                            <input type="text" name="lugar" id="lugar" value="{{ old('lugar') }}"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                        </div>

                        <div>
                            <label for="descripcion" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                            >{{ old('descripcion') }}</textarea>
                        </div>

                        <div>
                            <label for="notas" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Notas</label>
                            <textarea name="notas" id="notas" rows="2"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                            >{{ old('notas') }}</textarea>
                        </div>

                        <div>
                            <label for="duracion_minutos" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Duración (minutos)</label>
                            <input type="number" name="duracion_minutos" id="duracion_minutos" value="{{ old('duracion_minutos') }}" min="1"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                                Crear Entrenamiento
                            </button>
                            <a href="{{ route('entrenamientos.listar', $equipo) }}"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
