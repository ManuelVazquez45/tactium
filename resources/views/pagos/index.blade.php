<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-blue-600 font-bold">{{ $equipo->nombre }}</span>
                <span>/</span>
                <span class="text-gray-800 font-bold">Inscripciones</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Inscripciones <span class="text-blue-600">// {{ $equipo->nombre }}</span>
                    </h2>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Gestión económica del equipo</p>
                </div>
                <a href="{{ route('pagos.crear', $equipo) }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                    + Nuevo Pago
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 mb-6 text-sm font-bold uppercase tracking-widest">
                    {{ session('success') }}
                </div>
            @endif

            <!-- BLOQUE CUOTA -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group mb-6">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight italic">
                                Cuota del Equipo
                            </h3>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Configuración económica global</p>
                        </div>
                        <p class="text-4xl font-black text-blue-600">{{ number_format($equipo->cuota, 2) }} <span class="text-2xl">€</span></p>
                    </div>

                    <form method="POST" action="{{ route('pagos.actualizarCuota', $equipo) }}" class="mt-6 flex flex-col sm:flex-row items-end gap-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">Cambiar cuota (€)</label>
                            <input type="number" name="cuota" value="{{ old('cuota', $equipo->cuota) }}" step="0.01" min="0" required
                                class="block w-48 bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors">
                            @error('cuota')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                            Actualizar
                        </button>
                    </form>
                </div>
            </div>

            <!-- TABLA JUGADORES -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight italic mb-6">
                        Jugadores <span class="text-blue-600">// Estado de Pagos</span>
                    </h3>

                    @if ($jugadores->isEmpty())
                        <p class="text-gray-400 text-sm italic text-center py-8">Sin jugadores asignados al equipo.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-blue-600 border-b-2 border-gray-200">
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Jugador</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Posición</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Total pagado</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Pendiente</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Progreso</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($jugadores as $jugador)
                                        @php
                                            $pagado = $jugador->total_pagado ?? 0;
                                            $pendiente = max(0, $equipo->cuota - $pagado);
                                            $porcentaje = $equipo->cuota > 0 ? min(100, ($pagado / $equipo->cuota) * 100) : 0;
                                        @endphp
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 font-black text-sm text-gray-900 italic uppercase tracking-wide">
                                                {{ $jugador->nombre }} {{ $jugador->apellido }}
                                            </td>
                                            <td class="py-5 text-sm text-gray-500 uppercase">{{ $jugador->posicion ?? '-' }}</td>
                                            <td class="py-5 font-mono font-black text-sm text-green-600">
                                                {{ number_format($pagado, 2) }} €
                                            </td>
                                            <td class="py-5 font-mono font-black text-sm {{ $pendiente > 0 ? 'text-red-500' : 'text-green-600' }}">
                                                {{ number_format($pendiente, 2) }} €
                                            </td>
                                            <td class="py-5">
                                                <div class="w-36">
                                                    <div class="flex justify-between text-xs mb-1">
                                                        <span class="text-gray-500 font-bold">{{ number_format($porcentaje, 0) }}%</span>
                                                        @if ($porcentaje >= 100)
                                                            <span class="text-green-600 font-bold">✓ Al día</span>
                                                        @endif
                                                    </div>
                                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                                        <div class="h-2 rounded-full {{ $porcentaje >= 100 ? 'bg-green-500' : 'bg-blue-500' }}"
                                                            style="width: {{ $porcentaje }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-5 text-right">
                                                <a href="{{ route('pagos.ver', [$equipo, $jugador]) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase transition-colors">
                                                    Ver detalles
                                                </a>
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
