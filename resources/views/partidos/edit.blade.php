<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('partidos.listar', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Partidos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Editar</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    Editar Partido <span class="text-blue-600">// {{ $equipo->nombre }}</span>
                </h2>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('partidos.actualizar', [$equipo, $partido]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Fecha</label>
                                <input type="date" name="fecha" value="{{ old('fecha', $partido->fecha->format('Y-m-d')) }}" required
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Hora</label>
                                <input type="time" name="hora" value="{{ old('hora', $partido->hora) }}"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Rival</label>
                            <input type="text" name="rival" value="{{ old('rival', $partido->rival) }}" required
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Lugar</label>
                            <input type="text" name="lugar" value="{{ old('lugar', $partido->lugar) }}"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Ubicación</label>
                                <select name="tipo_ubicacion" required
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                                    <option value="local" {{ old('tipo_ubicacion', $partido->tipo_ubicacion) === 'local' ? 'selected' : '' }}>Local</option>
                                    <option value="visitante" {{ old('tipo_ubicacion', $partido->tipo_ubicacion) === 'visitante' ? 'selected' : '' }}>Visitante</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Estado</label>
                                <select name="estado" required
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                                    <option value="programado" {{ old('estado', $partido->estado) === 'programado' ? 'selected' : '' }}>Programado</option>
                                    <option value="jugado" {{ old('estado', $partido->estado) === 'jugado' ? 'selected' : '' }}>Jugado</option>
                                    <option value="cancelado" {{ old('estado', $partido->estado) === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Goles a favor</label>
                                <input type="number" name="goles_favor" value="{{ old('goles_favor', $partido->goles_favor) }}" min="0"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Goles en contra</label>
                                <input type="number" name="goles_contra" value="{{ old('goles_contra', $partido->goles_contra) }}" min="0"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Descripción</label>
                            <textarea name="descripcion" rows="3"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                            >{{ old('descripcion', $partido->descripcion) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Notas</label>
                            <textarea name="notas" rows="2"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                            >{{ old('notas', $partido->notas) }}</textarea>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('partidos.listar', $equipo) }}"
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
