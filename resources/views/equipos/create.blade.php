<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    @include('equipos.form', [
                        'method' => 'POST',
                        'action' => route('equipos.store'),
                        'equipo' => null,
                        'buttonText' => 'Crear Equipo'
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
