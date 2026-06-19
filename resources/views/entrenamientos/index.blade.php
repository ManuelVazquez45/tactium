<x-app-layout>

    <div class="py-12 bg-[#0B1220] min-h-screen relative font-oxanium">
        <!-- Decoración HUD de fondo -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 50px 50px;">
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-8 items-center space-x-2 text-[10px] uppercase tracking-widest text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Tactium</a>
                <span>/</span>
                <span class="text-blue-500">{{ $equipo->nombre }}</span>
                <span>/</span>
                <span class="text-white">Entrenamientos</span>
            </nav>

            <!-- CABECERA -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-white font-oxanium text-lg uppercase tracking-tighter italic">
                    Entrenamientos <span class="text-blue-500">// {{ $equipo->nombre }}</span>
                </h2>
                <a href="{{ route('entrenamientos.create', $equipo) }}"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-500 transition-all hover:shadow-[0_0_15px_rgba(37,99,235,0.5)]">
                    + Nuevo Entrenamiento
                </a>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white/5 backdrop-blur-xl border border-blue-500/20 overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    @if ($entrenamientos->isEmpty())
                        <p class="text-slate-500 text-xs italic bg-black/20 p-4 border-l-2 border-slate-700 text-center">
                            No hay entrenamientos registrados aún.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-[10px] tracking-widest">
                                <thead>
                                    <tr class="text-blue-500 border-b border-blue-500/20">
                                        <th class="pb-4 uppercase italic">Fecha</th>
                                        <th class="pb-4 uppercase italic">Tipo</th>
                                        <th class="pb-4 uppercase italic">Hora</th>
                                        <th class="pb-4 uppercase italic">Lugar</th>
                                        <th class="pb-4 uppercase italic">Descripción</th>
                                        <th class="pb-4 uppercase italic text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white divide-y divide-white/5">
                                    @foreach ($entrenamientos as $entrenamiento)
                                        <tr class="group hover:bg-blue-600/5 transition-colors">
                                            <td class="py-4 font-bold">
                                                {{ $entrenamiento->fecha->format('d/m/Y') }}
                                            </td>
                                            <td class="py-4">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 border text-[9px] font-bold uppercase tracking-widest
                                                    @if ($entrenamiento->tipo === 'entrenamiento') border-blue-500 text-blue-300 bg-blue-900/30
                                                    @elseif($entrenamiento->tipo === 'partido') border-red-500 text-red-300 bg-red-900/30
                                                    @else border-green-500 text-green-300 bg-green-900/30 @endif
                                                ">
                                                    {{ ucfirst($entrenamiento->tipo) }}
                                                </span>
                                            </td>
                                            <td class="py-4 text-slate-400">
                                                @if ($entrenamiento->hora_inicio)
                                                    {{ $entrenamiento->hora_inicio }}
                                                    @if ($entrenamiento->hora_fin)
                                                        - {{ $entrenamiento->hora_fin }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="py-4 text-slate-400">
                                                {{ $entrenamiento->lugar ?? '-' }}
                                            </td>
                                            <td class="py-4 text-slate-400">
                                                {{ Str::limit($entrenamiento->descripcion, 40) ?? '-' }}
                                            </td>
                                            <td class="py-4 text-right space-x-3">
                                                <a href="{{ route('entrenamientos.show', [$equipo, $entrenamiento]) }}"
                                                    class="text-blue-400 hover:text-white font-bold uppercase transition-colors">
                                                    Ver
                                                </a>
                                                <a href="{{ route('entrenamientos.edit', [$equipo, $entrenamiento]) }}"
                                                    class="text-green-400 hover:text-green-300 font-bold uppercase transition-colors">
                                                    Editar
                                                </a>
                                                <form
                                                    action="{{ route('entrenamientos.destroy', [$equipo, $entrenamiento]) }}"
                                                    method="POST" style="display:inline"
                                                    onsubmit="return confirm('¿Está seguro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-400 font-bold uppercase transition-colors">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-8">
                        <a href="{{ route('equipos.show', $equipo) }}"
                            class="inline-flex items-center px-6 py-2 border border-white/10 text-white text-[10px] font-bold uppercase tracking-widest bg-white/5 hover:bg-white/10 transition-all">
                            ← Volver al Equipo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
