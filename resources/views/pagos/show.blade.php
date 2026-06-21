<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('pagos.index', $equipo) }}" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Inscripciones</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">{{ $jugador->nombre }} {{ $jugador->apellido }}</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Pagos <span class="text-blue-600">// {{ $jugador->nombre }} {{ $jugador->apellido }}</span>
                    </h2>
                </div>
                <a href="{{ auth()->user()->role === 'jugador' ? route('equipos.show', $equipo) : route('pagos.index', $equipo) }}"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm whitespace-nowrap">
                    ← Volver
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 mb-6 text-sm font-bold uppercase tracking-widest">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KPIs RESUMEN -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-green-400 hover:shadow-md transition-all">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-green-500"></div>
                    <p class="text-xs font-bold uppercase tracking-widest text-green-600 mb-2">Total Pagado</p>
                    <p class="text-3xl font-black text-gray-900">{{ number_format($totalPagado, 2) }} <span class="text-lg text-green-600">€</span></p>
                </div>
                <div class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-yellow-400 hover:shadow-md transition-all">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-yellow-500"></div>
                    <p class="text-xs font-bold uppercase tracking-widest text-yellow-600 mb-2">Pendiente</p>
                    <p class="text-3xl font-black text-gray-900">{{ number_format($totalPendiente, 2) }} <span class="text-lg text-yellow-600">€</span></p>
                </div>
                <div class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-blue-400 hover:shadow-md transition-all">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-blue-500"></div>
                    <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-2">Total Registros</p>
                    <p class="text-3xl font-black text-gray-900">{{ $pagos->count() }}</p>
                </div>
            </div>

            <!-- TABLA PAGOS -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight italic">
                            Historial <span class="text-blue-600">// Pagos</span>
                        </h3>
                        @can('update', $equipo)
                            <a href="{{ route('pagos.create', $equipo) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm">
                                + Añadir Pago
                            </a>
                        @endcan
                    </div>

                    @if ($pagos->isEmpty())
                        <p class="text-gray-400 text-sm italic text-center py-8">Sin registros de pagos para este jugador.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-blue-600 border-b-2 border-gray-200">
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Concepto</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Importe</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Fecha</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Estado</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($pagos as $pago)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 text-sm font-bold text-gray-900">{{ $pago->concepto }}</td>
                                            <td class="py-5 font-mono font-black text-sm text-gray-900">{{ number_format($pago->importe, 2) }} €</td>
                                            <td class="py-5 text-sm text-gray-500">{{ $pago->fecha_pago ? $pago->fecha_pago->format('d/m/Y') : '-' }}</td>
                                            <td class="py-5">
                                                <span class="inline-flex items-center px-3 py-1 border text-xs font-bold uppercase tracking-widest
                                                    @if ($pago->estado === 'pagado') border-green-400 bg-green-50 text-green-700
                                                    @elseif($pago->estado === 'pendiente') border-yellow-400 bg-yellow-50 text-yellow-700
                                                    @else border-red-400 bg-red-50 text-red-700
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $pago->estado)) }}
                                                </span>
                                            </td>
                                            <td class="py-5 text-right space-x-4">
                                                @can('update', $equipo)
                                                    <a href="{{ route('pagos.edit', [$equipo, $pago]) }}"
                                                        class="text-green-600 hover:text-green-800 font-bold text-xs uppercase transition-colors">Editar</a>
                                                    <form action="{{ route('pagos.destroy', [$equipo, $pago]) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar pago?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-800 font-bold text-xs uppercase transition-colors">Borrar</button>
                                                    </form>
                                                @endcan
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
