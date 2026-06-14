<x-app-layout>
    <div class="bg-[#0B1220] min-h-screen text-gray-300">
        {{-- Header Táctico --}}
        <div class=bg-[#0B1220]/50 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-8 py-8 flex justify-between items-center">
                <h2 class="font-oxanium font-bold text-xl text-white uppercase tracking-[0.2em] italic">
                    Inscripciones // <span class="text-blue-400">{{ $equipo->nombre }}</span>
                </h2>
                <a href="{{ route('pagos.create', $equipo) }}"
                    class="text-[10px] font-bold uppercase tracking-[0.3em] bg-blue-600/20 border border-blue-500 text-blue-400 hover:bg-blue-600 hover:text-white px-4 py-2 transition-all">
                    + Nuevo_Pago
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 space-y-6">
            @if (session('success'))
                <div
                    class="bg-blue-900/20 border border-blue-500/50 text-blue-200 px-4 py-3 rounded-sm backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Bloque Cuota (HUD Style) --}}
            <div class="bg-[#0B1220] border border-blue-500/20 rounded-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-oxanium text-white uppercase tracking-wider">Cuota del equipo</h3>
                        <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest">Configuración económica
                            global</p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-blue-400 font-oxanium">{{ number_format($equipo->cuota, 2) }}
                            €</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('pagos.cuota', $equipo) }}" class="mt-6 flex items-end gap-4">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-[10px] font-oxanium text-gray-400 uppercase tracking-widest">Cambiar
                            cuota (€)</label>
                        <input type="number" name="cuota" value="{{ old('cuota', $equipo->cuota) }}" step="0.01"
                            min="0" required
                            class="mt-1 block w-48 bg-[#0B1220] border border-blue-500/30 text-white rounded-sm focus:border-blue-400 focus:ring-0">
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-[10px] font-bold uppercase tracking-[0.2em] text-white hover:bg-blue-700 transition-all">
                        Actualizar
                    </button>
                </form>
            </div>

            {{-- Tabla de Jugadores Táctica --}}
            <div class="bg-[#0B1220] border border-blue-500/20 rounded-sm overflow-hidden">
                <div class="p-6">
                    @if ($jugadores->isEmpty())
                        <p class="text-gray-600 text-sm italic text-center py-8">Sin jugadores asignados.</p>
                    @else
                        <table class="w-full text-sm text-gray-400">
                            <thead class="border-b border-blue-500/10">
                                <tr>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Jugador</th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Posición
                                    </th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Total pagado
                                    </th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Pendiente
                                    </th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Estado</th>
                                    <th class="px-4 py-3 text-right font-oxanium uppercase text-blue-500/70">Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-500/5">
                                @foreach ($jugadores as $jugador)
                                    @php
                                        $pagado = $jugador->total_pagado ?? 0;
                                        $pendiente = max(0, $equipo->cuota - $pagado);
                                        $porcentaje =
                                            $equipo->cuota > 0 ? min(100, ($pagado / $equipo->cuota) * 100) : 0;
                                    @endphp
                                    <tr class="hover:bg-blue-900/10 transition-colors">
                                        <td class="px-4 py-3 text-white font-bold">{{ $jugador->nombre }}
                                            {{ $jugador->apellido }}</td>
                                        <td class="px-4 py-3">{{ $jugador->posicion ?? '-' }}</td>
                                        <td class="px-4 py-3 font-mono text-green-400">{{ number_format($pagado, 2) }} €
                                        </td>
                                        <td
                                            class="px-4 py-3 font-mono {{ $pendiente > 0 ? 'text-red-400' : 'text-green-400' }}">
                                            {{ number_format($pendiente, 2) }} €
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="w-32">
                                                <div class="flex justify-between text-[10px] mb-1 text-gray-500">
                                                    <span>{{ number_format($porcentaje, 0) }}%</span>
                                                    @if ($porcentaje >= 100)
                                                        <span class="text-green-500">✓</span>
                                                    @endif
                                                </div>
                                                <div class="w-full bg-blue-900/30 rounded-full h-1">
                                                    <div class="h-1 rounded-full {{ $porcentaje >= 100 ? 'bg-green-500' : 'bg-blue-500' }}"
                                                        style="width: {{ $porcentaje }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('pagos.show', [$equipo, $jugador]) }}"
                                                class="text-blue-400 hover:text-white text-xs underline">Ver
                                                detalles</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
