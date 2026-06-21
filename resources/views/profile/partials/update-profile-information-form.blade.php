<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight italic font-oxanium">
            Información <span class="text-blue-600">// Perfil</span>
        </h2>
        <p class="mt-2 text-sm text-gray-500 uppercase tracking-widest font-oxanium">
            Actualiza el nombre y email de tu cuenta.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2 font-oxanium">
                Nombre
            </label>
            <x-text-input id="name" name="name" type="text"
                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-blue-600 italic mb-2 font-oxanium">
                Email
            </label>
            <x-text-input id="email" name="email" type="email"
                class="block w-full bg-white border border-gray-300 text-gray-900 px-4 py-3 text-sm focus:border-blue-500 focus:ring-0 shadow-sm hover:border-blue-400 transition-colors"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border border-yellow-300 p-4">
                    <p class="text-sm text-gray-800 font-oxanium">
                        Tu dirección de email no está verificada.
                        <button form="send-verification"
                            class="text-blue-600 hover:text-blue-800 underline font-bold text-xs uppercase tracking-widest ml-1">
                            Reenviar email de verificación
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs text-green-600 font-bold uppercase tracking-widest font-oxanium">
                            ✓ Nuevo enlace de verificación enviado.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition-all shadow-sm font-oxanium">
                Guardar
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs text-green-600 font-bold uppercase tracking-widest font-oxanium">
                    ✓ Perfil actualizado
                </p>
            @endif
        </div>
    </form>
</section>
