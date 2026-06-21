<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Pago - {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('pagos.index', $equipo) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form method="POST" action="{{ route('pagos.update', [$equipo, $pago]) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jugador</label>
                            <select name="jugador_id" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un jugador</option>
                                @foreach($jugadores as $jugador)
                                    <option value="{{ $jugador->id }}" {{ old('jugador_id', $pago->jugador_id) == $jugador->id ? 'selected' : '' }}>
                                        {{ $jugador->nombre }} {{ $jugador->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jugador_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Concepto</label>
                            <input type="text" name="concepto" value="{{ old('concepto', $pago->concepto) }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('concepto')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Importe (€)</label>
                                <input type="number" name="importe" value="{{ old('importe', $pago->importe) }}" step="0.01" min="0" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('importe')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de pago</label>
                                <input type="date" name="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago?->format('Y-m-d')) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="sin_pagar" {{ old('estado', $pago->estado) === 'sin_pagar' ? 'selected' : '' }}>Sin pagar</option>
                                <option value="pendiente" {{ old('estado', $pago->estado) === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="pagado" {{ old('estado', $pago->estado) === 'pagado' ? 'selected' : '' }}>Pagado</option>
                            </select>
                            @error('estado')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('pagos.index', $equipo) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
