<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('entrenador.dashboard') }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Mis Jugadores</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Editar</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    Editar <span class="text-blue-600">// {{ $jugador->nombre }} {{ $jugador->apellido }}</span>
                </h2>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('jugadores.update', [$equipo, $jugador]) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="nombre" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $jugador->nombre) }}" required
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors @error('nombre') border-red-400 @enderror">
                            @error('nombre')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="apellido" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Apellido</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $jugador->apellido) }}" required
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors @error('apellido') border-red-400 @enderror">
                            @error('apellido')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $jugador->email) }}" required
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors @error('email') border-red-400 @enderror">
                            @error('email')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="numero_camiseta" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Número de Camiseta</label>
                                <input type="text" name="numero_camiseta" id="numero_camiseta" value="{{ old('numero_camiseta', $jugador->numero_camiseta) }}"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                            <div>
                                <label for="posicion" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Posición</label>
                                <input type="text" name="posicion" id="posicion" value="{{ old('posicion', $jugador->posicion) }}"
                                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="fecha_nacimiento" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $jugador->fecha_nacimiento) }}"
                                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('entrenador.dashboard', $equipo) }}"
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
