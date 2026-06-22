<x-guest-layout>
    <!-- CONTENEDOR PRINCIPAL: Estética de Centro de Mando -->
    <div class="min-h-screen flex flex-col items-center justify-center bg-[#0B1220] relative overflow-hidden px-6">

        <!-- Decoración de Fondo: Brillo neón y rejilla técnica -->
        <div class="absolute inset-0 opacity-10 pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 blur-[120px] rounded-full pointer-events-none"></div>

        <!-- TARJETA DE REGISTRO: Glassmorphism y HUD -->
        <div class="relative w-full max-w-md p-8 bg-[#0B1220]/80 backdrop-blur-xl border border-blue-500/20 rounded-sm shadow-2xl">

            <!-- Micro-detalles HUD en las esquinas -->
            <div class="absolute -top-[1px] -left-[1px] w-8 h-8 border-t border-l border-blue-500"></div>
            <div class="absolute -bottom-[1px] -right-[1px] w-8 h-8 border-b border-r border-blue-500"></div>

            <!-- Cabecera del Formulario -->
            <div class="mb-8 text-center">
                <h2 class="font-oxanium text-blue-500 text-[10px] font-bold tracking-[0.8em] uppercase mb-2">System_Access</h2>
                <p class="font-oxanium text-2xl text-white font-black uppercase tracking-tighter">Crear <span class="text-blue-600">Perfil Tactium</span></p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div class="space-y-1">
                    <x-input-label for="name" :value="__('Name')" class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest" />
                    <x-text-input id="name"
                        class="block w-full bg-white/5 border-white/10 text-white text-sm focus:border-blue-500 focus:ring-0 transition-all placeholder:text-white/10"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="NOMBRE_USUARIO" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-[10px] uppercase font-bold" />
                </div>

                <!-- Email Address -->
                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email')" class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest" />
                    <x-text-input id="email"
                        class="block w-full bg-white/5 border-white/10 text-white text-sm focus:border-blue-500 focus:ring-0 transition-all placeholder:text-white/10"
                        type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="EMAIL_ID@TACTIUM.COM" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] uppercase font-bold" />
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <x-input-label for="password" :value="__('Password')" class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest" />
                    <x-text-input id="password"
                        class="block w-full bg-white/5 border-white/10 text-white text-sm focus:border-blue-500 focus:ring-0 transition-all"
                        type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] uppercase font-bold" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest" />
                    <x-text-input id="password_confirmation"
                        class="block w-full bg-white/5 border-white/10 text-white text-sm focus:border-blue-500 focus:ring-0 transition-all"
                        type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-[10px] uppercase font-bold" />
                </div>

                <!-- Acciones Finales -->
                <div class="flex flex-col items-center space-y-6 mt-8">
                    <x-primary-button class="w-full justify-center group relative py-4 bg-blue-600 text-white font-oxanium text-xs font-black uppercase tracking-[0.6em] overflow-hidden transition-all hover:bg-blue-500 shadow-[0_0_20px_rgba(37,99,235,0.4)]">
                        <span class="relative z-10">Ejecutar Registro</span>
                        <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    </x-primary-button>

                    <a class="font-oxanium text-[9px] text-slate-500 uppercase tracking-widest hover:text-blue-400 transition-colors"
                        href="{{ route('login') }}">
                        [ {{ __('Already registered?') }} ]
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
