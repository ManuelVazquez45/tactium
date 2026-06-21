<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('equipos.listar') }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Equipos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">{{ $equipo->nombre }}</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        {{ $equipo->nombre }} <span class="text-blue-600">// Ficha_Equipo</span>
                    </h2>
                </div>
                @if(auth()->user()->role === 'entrenador' && auth()->user()->id === $equipo->coach_id)
                    <a href="{{ route('jugadores.crear', $equipo) }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                        + Agregar Jugador
                    </a>
                @endif
            </div>

            <!-- INFO DEL EQUIPO -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group mb-6">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Descripción</p>
                            <p class="text-gray-800 text-sm leading-relaxed">{{ $equipo->descripcion ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Entrenador</p>
                            <p class="text-gray-900 font-black text-sm uppercase">{{ $equipo->coach->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Estado</p>
                            <span class="inline-flex items-center px-3 py-1 border text-xs font-bold uppercase tracking-widest
                                {{ $equipo->estado === 'aprobado' ? 'border-green-400 bg-green-50 text-green-700' : 'border-yellow-400 bg-yellow-50 text-yellow-700' }}">
                                {{ ucfirst($equipo->estado) }}
                            </span>
                        </div>
                    </div>

                    {{-- MI INSCRIPCIÓN (solo jugador) --}}
                    @if(auth()->user()->role === 'jugador')
                        @php
                            $jugador = $equipo->jugadores()->where('email', auth()->user()->email)->first();
                        @endphp
                        @if($jugador)
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <h4 class="text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-4">Mi Inscripción</h4>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Nombre Completo</p>
                                        <p class="font-black text-gray-900 text-sm uppercase">{{ $jugador->nombre }} {{ $jugador->apellido }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Email</p>
                                        <p class="font-bold text-gray-900 text-sm font-mono">{{ $jugador->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Nº Camiseta</p>
                                        <span class="inline-flex items-center px-3 py-1 border border-blue-300 bg-blue-50 text-blue-700 font-mono font-black text-sm">
                                            {{ str_pad($jugador->numero_camiseta ?? 0, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Posición</p>
                                        <p class="font-black text-gray-900 text-sm uppercase">{{ $jugador->posicion ?? '-' }}</p>
                                    </div>
                                    @if($jugador->fecha_nacimiento)
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Fecha de Nacimiento</p>
                                            <p class="font-bold text-gray-900 text-sm">{{ $jugador->fecha_nacimiento->format('d/m/Y') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <!-- TABLA JUGADORES -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight italic mb-6">
                        Jugadores <span class="text-blue-600">// Plantilla</span>
                    </h3>

                    @if($jugadores->isEmpty())
                        <p class="text-gray-400 text-sm italic uppercase tracking-widest text-center py-8">No hay jugadores registrados aún.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-blue-600 border-b-2 border-gray-200">
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Nombre</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Email</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Posición</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Camiseta</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($jugadores as $jugador)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 text-sm font-black text-gray-900 italic uppercase tracking-wide">
                                                {{ $jugador->nombre }} {{ $jugador->apellido }}
                                            </td>
                                            <td class="py-5 text-sm text-gray-500 font-mono">{{ $jugador->email }}</td>
                                            <td class="py-5 text-sm text-gray-600 uppercase font-bold">{{ $jugador->posicion ?? '-' }}</td>
                                            <td class="py-5">
                                                <span class="inline-flex items-center px-3 py-1 border border-blue-300 bg-blue-50 text-blue-700 font-mono font-black text-xs">
                                                    {{ str_pad($jugador->numero_camiseta ?? 0, 2, '0', STR_PAD_LEFT) }}
                                                </span>
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
</x-app-layout>
<x-footer />
