<x-app-layout>
    @if(auth()->user()->role === 'jugador' && !empty($equipos))
    <div class="py-10 bg-gray-50 min-h-screen relative">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Mi Equipo</h1>
            </div>

            @if($equipos->isEmpty())
                <div class="bg-blue-50 border border-blue-200 p-6 text-center">
                    <p class="text-gray-700">Aún no has sido asignado a un equipo.</p>
                </div>
            @else
                @foreach($equipos as $equipo)
                <div class="bg-white border border-gray-200 shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $equipo->nombre }}</h2>
                    <p class="text-gray-600 mb-4">{{ $equipo->descripcion }}</p>
                    <p class="text-sm text-gray-500"><strong>Entrenador:</strong> {{ $equipo->coach->name }}</p>
                    <a href="{{ route('equipos.ver', $equipo) }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded hover:bg-blue-700">
                        Ver Equipo
                    </a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    @else

    <div class="py-10 bg-gray-50 min-h-screen relative">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 font-oxanium text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-blue-600">Sistema_Principal</span>
                <span>/</span>
                <span class="text-gray-800 font-bold">Panel_Admin</span>
            </nav>

            <!-- TÍTULO -->
            <div class="mb-8">
                <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight font-oxanium">
                    Panel <span class="text-blue-600">// Admin</span>
                </h1>
                <p class="text-xs text-gray-400 uppercase tracking-widest mt-1 font-oxanium">Resumen operativo del
                    sistema</p>
            </div>

            <!-- KPIs -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
                <a href="{{ route('equipos.listar') }}" class="block hover:scale-105 transition-transform">
                    <div
                        class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-green-400 hover:shadow-md transition-all">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-green-500"></div>
                        <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2 font-oxanium">Equipos
                            Aprobados</p>
                        <h4 class="text-4xl text-gray-900 font-black">{{ $equiposCount ?? 0 }}</h4>
                    </div>
                </a>
                <a href="{{ route('entrenadores.listar') }}" class="block hover:scale-105 transition-transform">
                    <div
                        class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-blue-400 hover:shadow-md transition-all">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-blue-500"></div>
                        <p class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 font-oxanium">
                            Entrenadores Activos</p>
                        <h4 class="text-4xl text-gray-900 font-black">{{ $entrenadoresCount ?? 0 }}</h4>
                    </div>
                </a>

                <div
                    class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-yellow-400 hover:shadow-md transition-all">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-yellow-500"></div>
                    <p class="text-yellow-600 text-xs font-bold uppercase tracking-widest mb-2 font-oxanium">Solicitudes
                        Pendientes</p>
                    <h4 class="text-4xl text-yellow-500 font-black {{ $pendientesCount > 0 ? 'animate-pulse' : '' }}">
                        {{ $pendientesCount ?? 0 }}
                    </h4>
                </div>
                <a href="{{ route('equipos.listar') }}" class="block hover:scale-105 transition-transform">
                    <div
                        class="bg-white border border-gray-200 shadow-sm p-6 relative hover:border-red-400 hover:shadow-md transition-all cursor-default">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-red-500"></div>
                        <p class="text-red-500 text-xs font-bold uppercase tracking-widest mb-2 font-oxanium">Equipos
                            Rechazados</p>
                        <h4 class="text-4xl text-gray-900 font-black">{{ $rechazadosCount ?? 0 }}</h4>
                    </div>
                </a>
            </div>

            <!-- TABLA SOLICITUDES -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div
                    class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity">
                </div>

                <div class="p-6 lg:p-10">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight font-oxanium">
                                Solicitudes de Equipos <span class="text-blue-600">// En Espera</span>
                            </h3>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mt-1 font-oxanium">Equipos
                                pendientes de aprobación</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-oxanium">
                            <thead>
                                <tr class="text-blue-600 border-b-2 border-gray-200">
                                    <th class="pb-4 text-xs uppercase tracking-widest italic font-bold">ID</th>
                                    <th class="pb-4 text-xs uppercase tracking-widest italic font-bold">Equipo</th>
                                    <th class="pb-4 text-xs uppercase tracking-widest italic font-bold">Entrenador</th>
                                    <th class="pb-4 text-xs uppercase tracking-widest italic font-bold">Tiempo en espera
                                    </th>
                                    <th class="pb-4 text-xs uppercase tracking-widest italic font-bold text-right">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 divide-y divide-gray-100">
                                @if ($equiposSolicitados && $equiposSolicitados->count() > 0)
                                    @foreach ($equiposSolicitados as $equipo)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 font-mono text-sm text-gray-400">
                                                #{{ str_pad($equipo->id, 4, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td class="py-5 font-bold text-sm text-gray-900 italic">
                                                {{ $equipo->name ?? $equipo->nombre }}
                                            </td>
                                            <td class="py-5 text-sm text-blue-600 font-bold">
                                                {{ $equipo->coach->name ?? 'Usuario Desconocido' }}
                                            </td>
                                            <td class="py-5">
                                                <span
                                                    class="bg-blue-50 text-blue-700 px-3 py-1 text-xs border border-blue-200 font-bold uppercase tracking-widest">
                                                    {{ $equipo->created_at->diffForHumans() }}
                                                </span>
                                                <p class="text-xs text-gray-400 mt-1">
                                                    {{ $equipo->created_at->format('d/m/Y H:i') }}</p>
                                            </td>
                                            <td class="py-5 text-right">
                                                <div class="flex justify-end gap-3">
                                                    <form action="{{ route('equipos.aprobar', $equipo) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="bg-green-50 text-green-700 border border-green-300 hover:bg-green-100 hover:shadow-sm px-4 py-2 transition-all text-xs font-bold uppercase tracking-widest">
                                                            Aprobar
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('equipos.rechazar', $equipo) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="bg-red-50 text-red-700 border border-red-300 hover:bg-red-100 hover:shadow-sm px-4 py-2 transition-all text-xs font-bold uppercase tracking-widest">
                                                            Rechazar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400">
                                                <svg class="w-10 h-10 mb-3 opacity-40" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <p class="text-sm font-bold uppercase tracking-widest">No hay
                                                    solicitudes pendientes</p>
                                                <p class="text-xs mt-1">Todos los sistemas operativos.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

<x-footer />
