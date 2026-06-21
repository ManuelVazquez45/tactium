<x-app-layout>

    <div class="py-10 bg-gray-50 min-h-screen relative font-oxanium">

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- BREADCRUMBS -->
            <nav class="flex mb-6 items-center space-x-2 text-xs uppercase tracking-widest text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Tactium</a>
                <span>/</span>
                <a href="{{ route('equipos.listar') }}" class="hover:text-blue-600 transition-colors text-blue-600 font-bold">Equipos</a>
                <span>/</span>
                <span class="text-gray-800 font-bold">Editar</span>
            </nav>

            <!-- CABECERA -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic">
                    {{ __('Editar Equipo') }}
                </h2>
            </div>

            <!-- PANEL PRINCIPAL -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden relative group">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-30 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    @include('equipos.form', [
                        'method' => 'PUT',
                        'action' => route('equipos.actualizar', $equipo),
                        'equipo' => $equipo,
                        'buttonText' => 'Actualizar Equipo'
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
