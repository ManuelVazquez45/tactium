<x-app-layout>

    <div class="bg-[#0B1220] min-h-screen text-gray-300">
        {{-- Header integrado para evitar saltos visuales --}}
        <div class=" bg-[#0B1220]/50 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-8 py-8 flex justify-between items-center">
                <h2 class="font-oxanium font-bold text-xl text-white uppercase tracking-[0.2em] italic">
                    Pagos de <span class="text-blue-400">{{ $jugador->nombre }} {{ $jugador->apellido }}</span>
                </h2>
                <a href="{{ route('pagos.index', $equipo) }}"
                   class="text-[10px] font-bold uppercase tracking-[0.3em] text-blue-400 hover:text-white border border-blue-500/30 hover:border-blue-400 px-4 py-2 transition-all">
                    ← Volver_al_sistema
                </a>
            </div>
        </div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-12 space-y-6">

            @if (session('success'))
                <div class="bg-blue-900/20 border border-blue-500/50 text-blue-200 px-4 py-3 rounded-sm backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Resumen HUD Homogéneo --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-[#0B1220] border border-green-500/20 rounded-sm px-4 py-5 text-center">
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">Total pagado</p>
                    <p class="text-2xl font-bold text-green-400 font-oxanium">{{ number_format($totalPagado, 2) }} €</p>
                </div>
                <div class="bg-[#0B1220] border border-yellow-500/20 rounded-sm px-4 py-5 text-center">
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">Pendiente</p>
                    <p class="text-2xl font-bold text-yellow-400 font-oxanium">{{ number_format($totalPendiente, 2) }} €</p>
                </div>
                <div class="bg-[#0B1220] border border-blue-500/20 rounded-sm px-4 py-5 text-center">
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">Total registros</p>
                    <p class="text-2xl font-bold text-blue-400 font-oxanium">{{ $pagos->count() }}</p>
                </div>
            </div>

            {{-- Tabla de pagos Táctica sin fondos blancos --}}
            <div class="bg-[#0B1220] border border-blue-500/20 rounded-sm overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-oxanium text-white uppercase tracking-wider">Historial de pagos</h3>
                        <a href="{{ route('pagos.create', $equipo) }}"
                            class="text-blue-400 hover:text-white border border-blue-500/30 px-3 py-1 rounded text-xs transition-all">+ Añadir pago</a>
                    </div>

                    @if ($pagos->isEmpty())
                        <p class="text-gray-600 text-sm italic text-center py-6">Sin registros de pagos.</p>
                    @else
                        <table class="w-full text-sm text-gray-400">
                            <thead class="border-b border-blue-500/10">
                                <tr>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Concepto</th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Importe</th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Fecha</th>
                                    <th class="px-4 py-3 text-left font-oxanium uppercase text-blue-500/70">Estado</th>
                                    <th class="px-4 py-3 text-right font-oxanium uppercase text-blue-500/70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-500/5">
                                @foreach ($pagos as $pago)
                                    <tr class="hover:bg-blue-900/10 transition-colors">
                                        <td class="px-4 py-3 text-white">{{ $pago->concepto }}</td>
                                        <td class="px-4 py-3 font-mono text-gray-300">{{ number_format($pago->importe, 2) }} €</td>
                                        <td class="px-4 py-3">{{ $pago->fecha_pago ? $pago->fecha_pago->format('d/m/Y') : '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider
                                                @if ($pago->estado === 'pagado') border border-green-500/20 text-green-500
                                                @elseif($pago->estado === 'pendiente') border border-yellow-500/20 text-yellow-500
                                                @else border border-red-500/20 text-red-500 @endif">
                                                {{ ucfirst(str_replace('_', ' ', $pago->estado)) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-right space-x-2">
                                            <a href="{{ route('pagos.edit', [$equipo, $pago]) }}" class="text-blue-400 hover:text-white text-xs">Editar</a>
                                            <form action="{{ route('pagos.destroy', [$equipo, $pago]) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400 text-xs">Borrar</button>
                                            </form>
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
