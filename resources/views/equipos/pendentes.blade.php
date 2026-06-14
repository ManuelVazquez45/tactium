<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitudes Pendientes de Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($pendentes->isEmpty())
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-gray-500 text-lg">No hay solicitudes pendientes de aprobación.</p>
                </div>
            @else
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre Equipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entrenador</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Solicitado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($pendentes as $equipo)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $equipo->nombre }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $equipo->coach->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($equipo->descripcion, 50) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $equipo->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <form action="{{ route('equipos.approve', $equipo) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                                ✓ Aprobar
                                            </button>
                                        </form>
                                        <form action="{{ route('equipos.reject', $equipo) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                                ✗ Rechazar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $pendentes->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
