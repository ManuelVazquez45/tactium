<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight italic font-oxanium">
            Actualizar <span class="text-blue-600">// Contraseña</span>
        </h2>
        <p class="mt-2 text-sm text-gray-500 uppercase tracking-widest font-oxanium">
            Usa una contraseña larga y aleatoria para mantener tu cuenta segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2 font-oxanium">
                Contraseña Actual
            </label>
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2 font-oxanium">
                Nueva Contraseña
            </label>
            <x-text-input id="update_password_password" name="password" type="password"
                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2 font-oxanium">
                Confirmar Contraseña
            </label>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm font-oxanium">
                Guardar
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs text-green-600 font-bold uppercase tracking-widest font-oxanium">
                    ✓ Guardado correctamente
                </p>
            @endif
        </div>
    </form>
</section>
