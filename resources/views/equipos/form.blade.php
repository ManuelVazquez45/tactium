<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label for="nombre" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">
            Nombre del Equipo
        </label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            value="{{ old('nombre', $equipo?->nombre) }}"
            class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
            required
        />
        @error('nombre')
            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="descripcion" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2">
            Descripción
        </label>
        <textarea
            name="descripcion"
            id="descripcion"
            rows="4"
            class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
        >{{ old('descripcion', $equipo?->descripcion) }}</textarea>
        @error('descripcion')
            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3 pt-4">
        <button
            type="submit"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm"
        >
            {{ $buttonText ?? 'Guardar' }}
        </button>
        <a href="{{ route('equipos.index') }}"
            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-sm font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm">
            Cancelar
        </a>
    </div>
</form>
