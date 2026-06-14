<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $equipo->nombre }}
            </h2>
            <div class="flex gap-2">
                @can('update', $equipo)
                    <a
                        href="{{ route('equipos.edit', $equipo) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700"
                    >
                        Editar
                    </a>
                @endcan

                @can('delete', $equipo)
                    <form
                        action="{{ route('equipos.destroy', $equipo) }}"
                        method="POST"
                        style="display:inline"
                        onsubmit="return confirm('¿Está seguro? Esta acción no se puede deshacer.')"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                        >
                            Eliminar
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nombre</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $equipo->nombre }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Entrenador</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $equipo->coach->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                            <p class="mt-1">
                                @if($equipo->estado === 'pendiente')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        Pendiente de aprobación
                                    </span>
                                @elseif($equipo->estado === 'aprobado')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        Aprobado
                                    </span>
                                @elseif($equipo->estado === 'rechazado')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        Rechazado
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                            <p class="mt-1 text-gray-900">{{ $equipo->descripcion ?? 'Sin descripción' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Creado</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $equipo->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Última actualización</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $equipo->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a
                            href="{{ route('equipos.index') }}"
                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
                        >
                            ← Volver a equipos
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN DE JUGADORES -->
            @if($equipo->estado === 'aprobado')
                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Jugadores del Equipo</h3>
                            @can('update', $equipo)
                                <a
                                    href="{{ route('jugadores.create', $equipo) }}"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700"
                                >
                                    + Agregar Jugador
                                </a>
                            @endcan
                        </div>

                        @if($equipo->jugadores->isEmpty())
                            <p class="text-gray-500">No hay jugadores registrados aún.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-gray-50 border-b">
                                        <tr>
                                            <th class="px-6 py-3 text-left font-medium text-gray-700">Nombre</th>
                                            <th class="px-6 py-3 text-left font-medium text-gray-700">Apellido</th>
                                            <th class="px-6 py-3 text-left font-medium text-gray-700">Email</th>
                                            <th class="px-6 py-3 text-left font-medium text-gray-700">Camiseta</th>
                                            <th class="px-6 py-3 text-left font-medium text-gray-700">Posición</th>
                                            <th class="px-6 py-3 text-left font-medium text-gray-700">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @foreach($equipo->jugadores as $jugador)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 text-gray-900">{{ $jugador->nombre }}</td>
                                                <td class="px-6 py-4 text-gray-600">{{ $jugador->apellido }}</td>
                                                <td class="px-6 py-4 text-gray-600">{{ $jugador->email }}</td>
                                                <td class="px-6 py-4 text-gray-600">
                                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                                        {{ $jugador->numero_camiseta ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-gray-600">{{ $jugador->posicion ?? '-' }}</td>
                                                <td class="px-6 py-4 text-sm space-x-2">
                                                    @can('update', $equipo)
                                                        <a
                                                            href="{{ route('jugadores.edit', [$equipo, $jugador]) }}"
                                                            class="text-blue-600 hover:text-blue-900 font-medium"
                                                        >
                                                            Editar
                                                        </a>
                                                    @endcan

                                                    @can('delete', $equipo)
                                                        <form
                                                            action="{{ route('jugadores.destroy', [$equipo, $jugador]) }}"
                                                            method="POST"
                                                            style="display:inline"
                                                            onsubmit="return confirm('¿Está seguro?')"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                type="submit"
                                                                class="text-red-600 hover:text-red-900 font-medium"
                                                            >
                                                                Eliminar
                                                            </button>
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
            @endif

            <!-- SECCIÓN DE ENTRENAMIENTOS -->
            @if($equipo->estado === 'aprobado')
                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">📅 Entrenamientos</h3>
                            @can('update', $equipo)
                                <a
                                    href="{{ route('entrenamientos.create', $equipo) }}"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700"
                                >
                                    + Nuevo Entrenamiento
                                </a>
                            @endcan
                        </div>

                        <p class="text-gray-600 text-sm mb-4">Gestiona todos los entrenamientos y eventos del equipo.</p>

                        @can('update', $equipo)
                            <a
                                href="{{ route('entrenamientos.index', $equipo) }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
                            >
                                Ver todos los entrenamientos →
                            </a>
                        @endcan
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
