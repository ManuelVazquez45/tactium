<x-app-layout>
    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('equipos.index') }}" class="text-blue-600 font-bold">Equipos</a>
            </nav>

            <!-- CABECERA -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                        Equipos <span class="text-blue-600">// Listado_General</span>
                    </h2>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Módulo de gestión operativa de personal deportivo</p>
                </div>

                <div class="relative w-full md:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="buscador-equipos" placeholder="Buscar equipo..."
                        class="w-full bg-white border border-gray-300 text-gray-700 text-sm pl-10 p-3 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-all hover:border-blue-400 shadow-sm">
                </div>

                @can('create', App\Models\Equipo::class)
                    <a href="{{ route('equipos.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                        + Crear Equipo
                    </a>
                @endcan
            </div>

            <!-- CONTENEDOR EQUIPOS -->
            <div id="equipos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="col-span-full text-center py-12">
                    <p class="text-blue-500 text-sm tracking-widest uppercase animate-pulse">Sincronizando con base de datos táctica...</p>
                </div>
            </div>

            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscador = document.getElementById('buscador-equipos');
            const contenedor = document.getElementById('equipos-container');
            const csrfToken = document.getElementById('csrf-token').value;

            fetchEquipos();

            let timeoutId;
            buscador.addEventListener('input', function() {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => fetchEquipos(this.value), 300);
            });

            function fetchEquipos(query = '') {
                fetch(`/equipos/search?q=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Fallo en la comunicación con el servidor.');
                        return response.json();
                    })
                    .then(data => renderEquipos(data))
                    .catch(error => {
                        console.error('Error:', error);
                        contenedor.innerHTML = `
                        <div class="col-span-full bg-red-50 border border-red-300 p-6 text-center">
                            <p class="text-red-600 text-sm font-bold uppercase tracking-widest">Error al sincronizar la información.</p>
                        </div>`;
                    });
            }

            function renderEquipos(equipos) {
                contenedor.innerHTML = '';

                if (equipos.length === 0) {
                    contenedor.innerHTML = `
                    <div class="col-span-full bg-white border border-gray-200 shadow-sm py-16 text-center">
                        <p class="text-gray-400 text-sm italic tracking-widest uppercase">No se encontraron equipos en el sistema.</p>
                    </div>`;
                    return;
                }

                equipos.forEach(equipo => {
                    const entrenadorNombre = equipo.coach ? equipo.coach.name : 'Sin asignar';
                    const descripcionCorta = equipo.descripcion && equipo.descripcion.length > 120 ?
                        equipo.descripcion.substring(0, 120) + '...' :
                        (equipo.descripcion || 'Sin descripción disponible.');

                    let accionesHtml =
                        `<a href="/equipos/${equipo.id}" class="text-blue-600 hover:text-blue-800 transition-colors font-bold uppercase text-xs tracking-widest">Ver</a>`;

                    if (equipo.can_update) {
                        accionesHtml +=
                            `<a href="/equipos/${equipo.id}/edit" class="text-green-600 hover:text-green-800 transition-colors font-bold uppercase text-xs tracking-widest">Editar</a>`;
                    }

                    if (equipo.can_delete) {
                        accionesHtml += `
                        <form action="/equipos/${equipo.id}" method="POST" class="inline" onsubmit="return confirm('¿Confirmar eliminación?')">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors bg-transparent border-0 p-0 font-bold uppercase tracking-widest text-xs">
                                Eliminar
                            </button>
                        </form>`;
                    }

                    const card = `
                    <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group hover:border-blue-400 hover:shadow-md transition-all">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4 gap-4">
                                <div class="flex-1">
                                    <h3 class="text-base font-black text-gray-900 uppercase tracking-wide">${equipo.nombre}</h3>
                                    <p class="mt-2 text-gray-500 text-sm leading-relaxed">${descripcionCorta}</p>
                                    <p class="mt-3 text-gray-400 text-xs uppercase tracking-widest">
                                        Entrenador: <span class="text-blue-600 font-bold">${entrenadorNombre}</span>
                                    </p>
                                </div>
                                <div class="shrink-0">
                                    ${getEstadoBadge(equipo.estado)}
                                </div>
                            </div>

                            <div class="flex gap-5 pt-4 border-t border-gray-100 text-xs font-bold uppercase tracking-widest">
                                ${accionesHtml}
                            </div>
                        </div>
                    </div>`;
                    contenedor.innerHTML += card;
                });
            }

            function getEstadoBadge(estado) {
                switch (estado) {
                    case 'pendiente':
                        return '<span class="inline-flex items-center px-3 py-1 border border-yellow-400 bg-yellow-50 text-xs font-bold text-yellow-700 uppercase tracking-widest">Pendiente</span>';
                    case 'aprobado':
                        return '<span class="inline-flex items-center px-3 py-1 border border-green-400 bg-green-50 text-xs font-bold text-green-700 uppercase tracking-widest">Aprobado</span>';
                    case 'rechazado':
                        return '<span class="inline-flex items-center px-3 py-1 border border-red-400 bg-red-50 text-xs font-bold text-red-700 uppercase tracking-widest">Rechazado</span>';
                    default:
                        return '';
                }
            }
        });
    </script>
</x-app-layout>
