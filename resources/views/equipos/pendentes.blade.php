<x-app-layout>
    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('equipos.listar') }}" class="text-blue-600 font-bold">Equipos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Solicitudes Pendientes</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Equipos <span class="text-blue-600">// Solicitudes_Pendientes</span>
                    </h2>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Aprobación de nuevos equipos</p>
                </div>
                <a href="{{ route('equipos.listar') }}"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm whitespace-nowrap">
                    ← Volver
                </a>
            </div>

            <!-- TABLA EQUIPOS PENDIENTES -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    @if($pendentes->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-400 text-sm italic uppercase tracking-widest">No hay solicitudes pendientes.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-blue-600 border-b-2 border-gray-200">
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Nombre</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Descripción</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Entrenador</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic">Cuota</th>
                                        <th class="pb-4 text-xs font-bold uppercase tracking-widest italic text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($pendentes as $equipo)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="py-5 text-sm font-black text-gray-900 italic uppercase tracking-wide">
                                                {{ $equipo->nombre }}
                                            </td>
                                            <td class="py-5 text-sm text-gray-600">
                                                {{ substr($equipo->descripcion ?? '-', 0, 50) }}{{ strlen($equipo->descripcion ?? '') > 50 ? '...' : '' }}
                                            </td>
                                            <td class="py-5 text-sm font-bold text-gray-900">
                                                {{ $equipo->coach->name ?? '-' }}
                                            </td>
                                            <td class="py-5 text-sm text-gray-700 font-mono">
                                                {{ $equipo->cuota ? number_format($equipo->cuota, 2) . ' €' : '-' }}
                                            </td>
                                            <td class="py-5 text-right space-x-3">
                                                <form action="{{ route('equipos.aprobar', $equipo) }}" method="POST" class="inline" onsubmit="return confirm('¿Aprobar este equipo?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:text-green-800 font-bold text-xs uppercase transition-colors">Aprobar</button>
                                                </form>
                                                <form action="{{ route('equipos.rechazar', $equipo) }}" method="POST" class="inline" onsubmit="return confirm('¿Rechazar este equipo?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase transition-colors">Rechazar</button>
                                                </form>
                                                <a href="{{ route('equipos.ver', $equipo) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase transition-colors">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINACIÓN -->
                        @if($pendentes->hasPages())
                            <div class="mt-6 border-t border-gray-200 pt-4">
                                {{ $pendentes->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
