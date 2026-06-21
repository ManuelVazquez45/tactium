<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight italic font-oxanium">
            Eliminar <span class="text-red-600">// Cuenta</span>
        </h2>
        <p class="mt-2 text-sm text-gray-500 uppercase tracking-widest font-oxanium">
            Una vez eliminada, todos los datos serán borrados permanentemente. Descarga cualquier información que quieras conservar antes de proceder.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-red-700 transition-all shadow-sm font-oxanium">
        Eliminar Cuenta
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight italic font-oxanium mb-2">
                ¿Confirmar <span class="text-red-600">// Eliminación?</span>
            </h2>
            <p class="text-sm text-gray-500 uppercase tracking-widest font-oxanium mb-6">
                Esta acción es irreversible. Introduce tu contraseña para confirmar que deseas eliminar tu cuenta permanentemente.
            </p>

            <div class="mb-6">
                <label for="password" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2 font-oxanium">
                    Contraseña
                </label>
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-red-500 focus:ring-0 shadow-sm hover:border-red-400 transition-colors"
                    placeholder="Introduce tu contraseña" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-widest bg-white hover:bg-gray-50 transition-all shadow-sm font-oxanium">
                    Cancelar
                </button>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-red-700 transition-all shadow-sm font-oxanium">
                    Eliminar Cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>
