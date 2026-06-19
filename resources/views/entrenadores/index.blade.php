<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-blue-600 font-bold">Sistema_Principal</span>
                <span>/</span>
                <span class="text-gray-800 font-bold">Entrenadores</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    Entrenadores <span class="text-blue-600">// Coaches_Activos</span>
                </h2>
                <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Listado de entrenadores registrados en el sistema</p>
            </div>

            @if($entrenadores->count())
                <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-blue-600 border-b-2 border-gray-200">
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest italic">ID</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest italic">Nombre</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest italic">Email</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest italic">Rol</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest italic">Fecha de Registro</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($entrenadores as $entrenador)
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td class="px-6 py-5 font-mono text-sm text-gray-400">
                                            #{{ str_pad($entrenador->id, 4, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-5 text-sm font-black text-gray-900 italic uppercase tracking-wide">
                                            {{ $entrenador->name }}
                                        </td>
                                        <td class="px-6 py-5 text-sm text-gray-500 font-mono">
                                            {{ $entrenador->email }}
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-widest border
                                                @if($entrenador->role === 'entrenador') border-blue-300 bg-blue-50 text-blue-700
                                                @elseif($entrenador->role === 'admin') border-red-300 bg-red-50 text-red-700
                                                @else border-green-300 bg-green-50 text-green-700
                                                @endif">
                                                {{ ucfirst($entrenador->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm text-gray-500">
                                            {{ $entrenador->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $entrenadores->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white border border-gray-200 shadow-sm relative">
                    <div class="px-6 py-16 text-center">
                        <p class="text-gray-400 text-sm italic uppercase tracking-widest">No hay entrenadores registrados.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
