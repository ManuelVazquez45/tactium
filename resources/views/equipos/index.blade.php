<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Equipos') }}
            </h2>
            @can('create', App\Models\Equipo::class)
                <a
                    href="{{ route('equipos.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
                >
                    + Crear Equipo
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($equipos->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($equipos as $equipo)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $equipo->nombre }}</h3>
                                        <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($equipo->descripcion, 100) }}</p>
                                        <p class="mt-2 text-gray-500 text-xs">Entrenador: <strong>{{ $equipo->coach->name }}</strong></p>
                                    </div>
                                    <div>
                                        @if($equipo->estado === 'pendiente')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                Pendiente
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
                                    </div>
                                </div>

                                <div class="mt-4 flex gap-2">
                                    @can('view', $equipo)
                                        <a
                                            href="{{ route('equipos.show', $equipo) }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
                                        >
                                            Ver
                                        </a>
                                    @endcan

                                    @can('update', $equipo)
                                        <a
                                            href="{{ route('equipos.edit', $equipo) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm font-medium"
                                        >
                                            Editar
                                        </a>
                                    @endcan

                                    @can('delete', $equipo)
                                        <form
                                            action="{{ route('equipos.destroy', $equipo) }}"
                                            method="POST"
                                            style="display:inline"
                                            onsubmit="return confirm('¿Está seguro?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="text-red-600 hover:text-red-900 text-sm font-medium"
                                            >
                                                Eliminar
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $equipos->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6 text-center">
                        <p class="text-gray-600">No hay equipos disponibles.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
