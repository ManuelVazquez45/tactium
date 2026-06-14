<x-app-layout>

    <div class="py-12 bg-[#0B1220] min-h-screen relative">
        <!-- Decoración HUD de fondo -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 50px 50px;">
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- 1. BREADCRUMBS: Navegación Táctica -->
            <nav class="flex mb-8 items-center space-x-2 font-oxanium text-[10px] uppercase tracking-widest text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-blue-500">Sistema_Principal</span>
                <span>/</span>
                <span class="text-white">Panel_Admin</span>
            </nav>

            <!-- 2. RESUMEN DE ESTADOS (KPIs) [8-10] -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <a href="{{ route('equipos.index') }}" class="block hover:scale-105 transition-transform">
                    <div class="bg-white/5 backdrop-blur-md border border-blue-500/20 p-6 relative hover:border-green-400/40">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-500"></div>
                        <p class="text-green-500 text-[8px] font-bold uppercase tracking-widest mb-1">Equipos_Aprobados</p>
                        <h4 class="text-3xl text-white font-black">{{ $equiposCount ?? 0 }}</h4>
                    </div>
                </a>
                <a href="{{ route('entrenadores.index') }}" class="block hover:scale-105 transition-transform">
                    <div class="bg-white/5 backdrop-blur-md border border-blue-500/20 p-6 relative hover:border-blue-400/40">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-500"></div>
                        <p class="text-blue-500 text-[8px] font-bold uppercase tracking-widest mb-1">Entrenadores_Activos</p>
                        <h4 class="text-3xl text-white font-black">{{ $entrenadoresCount ?? 0 }}</h4>
                    </div>
                </a>
                <a href="{{ route('equipos.pendentes') }}" class="block hover:scale-105 transition-transform">
                    <div class="bg-white/5 backdrop-blur-md border border-blue-500/20 p-6 relative hover:border-yellow-400/40">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-500"></div>
                        <p class="text-yellow-500 text-[8px] font-bold uppercase tracking-widest mb-1">Solicitudes_Pendientes</p>
                        <h4 class="text-3xl text-yellow-500 font-black {{ $pendientesCount > 0 ? 'animate-pulse' : '' }}">{{ $pendientesCount ?? 0 }}</h4>
                    </div>
                </a>
                <div class="bg-white/5 backdrop-blur-md border border-blue-500/20 p-6 relative hover:border-red-400/40 cursor-default">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-500"></div>
                    <p class="text-red-500 text-[8px] font-bold uppercase tracking-widest mb-1">Equipos_Rechazados</p>
                    <h4 class="text-3xl text-white font-black">{{ $rechazadosCount ?? 0 }}</h4>
                </div>
            </div>

            <!-- 3. MÓDULO DE ENTRENADORES: Gestión de Coaches Registrados [6, 7] -->
            <div class="bg-white/5 backdrop-blur-xl border border-blue-500/20 overflow-hidden relative group">
                <!-- Esquinas HUD -->
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-white font-oxanium text-lg uppercase tracking-tighter italic">
                            Entrenadores Registrados <span class="text-blue-500">// Coaches_Activos</span>
                        </h3>
                        <a href="#" class="text-blue-400 text-xs font-bold hover:text-blue-300">VER TODOS →</a>
                    </div>

                    <!-- TABLA TÁCTICA -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-oxanium text-[10px] tracking-widest">
                            <thead>
                                <tr class="text-blue-500 border-b border-blue-500/20">
                                    <th class="pb-4 uppercase italic">ID</th>
                                    <th class="pb-4 uppercase italic">Nombre_Entrenador</th>
                                    <th class="pb-4 uppercase italic">Email_Contacto</th>
                                    <th class="pb-4 uppercase italic">Equipos</th>
                                    <th class="pb-4 uppercase italic text-right">Fecha_Registro</th>
                                </tr>
                            </thead>
                            <tbody class="text-white divide-y divide-white/5">
                                @if($entrenadores && $entrenadores->count() > 0)
                                    @foreach($entrenadores as $entrenador)
                                        <tr class="group hover:bg-blue-600/5 transition-colors">
                                            <td class="py-4 font-mono">#{{ str_pad($entrenador->id, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td class="py-4 font-bold italic">{{ $entrenador->name }}</td>
                                            <td class="py-4 text-slate-400 text-[9px]">{{ $entrenador->email }}</td>
                                            <td class="py-4">
                                                <span class="bg-blue-600/20 px-2 py-1 rounded text-xs">{{ $entrenador->equipos_count ?? 0 }}</span>
                                            </td>
                                            <td class="py-4 text-right text-slate-400 text-[9px]">
                                                {{ $entrenador->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-slate-400">
                                            No hay entrenadores registrados aún.
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
</x-app-layout>

<x-footer />
