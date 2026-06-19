<x-app-layout>

    <div class="py-12 bg-[#0B1220] min-h-screen relative font-oxanium">
        <!-- Decoración HUD de fondo -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 50px 50px;">
        </div>

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-[10px] uppercase tracking-widest text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('entrenamientos.index', $equipo) }}" class="hover:text-blue-500 transition-colors text-blue-500">Entrenamientos</a>
                <span>/</span>
                <span class="text-white">Editar</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-white font-oxanium text-lg uppercase tracking-tighter italic">
                    Editar Entrenamiento <span class="text-blue-500">// {{ $equipo->nombre }}</span>
                </h2>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white/5 backdrop-blur-xl border border-blue-500/20 overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('entrenamientos.update', [$equipo, $entrenamiento]) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="fecha" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $entrenamiento->fecha->format('Y-m-d')) }}" required
                                class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0 @error('fecha') border-red-500 @enderror"
                            >
                            @error('fecha')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="hora_inicio" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Hora Inicio</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio', $entrenamiento->hora_inicio) }}"
                                    class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0"
                                >
                            </div>

                            <div>
                                <label for="hora_fin" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Hora Fin</label>
                                <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin', $entrenamiento->hora_fin) }}"
                                    class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="tipo" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Tipo</label>
                            <select name="tipo" id="tipo" required
                                class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0 @error('tipo') border-red-500 @enderror"
                            >
                                <option value="">Selecciona un tipo</option>
                                <option value="entrenamiento" {{ old('tipo', $entrenamiento->tipo) === 'entrenamiento' ? 'selected' : '' }}>Entrenamiento</option>
                                <option value="partido" {{ old('tipo', $entrenamiento->tipo) === 'partido' ? 'selected' : '' }}>Partido</option>
                                <option value="amistoso" {{ old('tipo', $entrenamiento->tipo) === 'amistoso' ? 'selected' : '' }}>Amistoso</option>
                            </select>
                            @error('tipo')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lugar" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Lugar</label>
                            <input type="text" name="lugar" id="lugar" value="{{ old('lugar', $entrenamiento->lugar) }}"
                                class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0"
                            >
                        </div>

                        <div>
                            <label for="descripcion" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0"
                            >{{ old('descripcion', $entrenamiento->descripcion) }}</textarea>
                        </div>

                        <div>
                            <label for="notas" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Notas</label>
                            <textarea name="notas" id="notas" rows="2"
                                class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0"
                            >{{ old('notas', $entrenamiento->notas) }}</textarea>
                        </div>

                        <div>
                            <label for="duracion_minutos" class="block text-[10px] font-bold uppercase tracking-widest text-blue-500 italic mb-2">Duración (minutos)</label>
                            <input type="number" name="duracion_minutos" id="duracion_minutos" value="{{ old('duracion_minutos', $entrenamiento->duracion_minutos) }}" min="1"
                                class="block w-full bg-[#0B1220] border border-blue-500/30 text-white px-4 py-2 text-sm focus:border-blue-500 focus:ring-0"
                            >
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-500 transition-all hover:shadow-[0_0_15px_rgba(37,99,235,0.5)]">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('entrenamientos.index', $equipo) }}"
                                class="inline-flex items-center px-6 py-2 border border-white/10 text-white text-xs font-bold uppercase tracking-widest bg-white/5 hover:bg-white/10 transition-all">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
