<x-guest-layout>
    <!-- CONTENEDOR PRINCIPAL: Estética de Centro de Mando Táctico -->
    <div class="min-h-screen flex flex-col items-center justify-center bg-[#0B1220] relative overflow-hidden px-6">

        <!-- Decoración de Fondo: Brillo neón y rejilla técnica -->
        <div class="absolute inset-0 opacity-10 pointer-events-none"
             style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 blur-[120px] rounded-full pointer-events-none"></div>

        <!-- TARJETA DE ACCESO: Glassmorphism y HUD [2, 3] -->
        <div class="relative w-full max-w-md p-10 bg-[#0B1220]/80 backdrop-blur-xl border border-blue-500/20 rounded-sm shadow-2xl">

            <!-- Micro-detalles HUD en las esquinas [3] -->
            <div class="absolute -top-[1px] -left-[1px] w-8 h-8 border-t border-l border-blue-500"></div>
            <div class="absolute -bottom-[1px] -right-[1px] w-8 h-8 border-b border-r border-blue-500"></div>

            <!-- Cabecera del Formulario -->
            <div class="mb-10 text-center">
                <h2 class="font-oxanium text-blue-500 text-[10px] font-bold tracking-[0.8em] uppercase mb-2">Secure_Link</h2>
                <p class="font-oxanium text-3xl text-white font-black uppercase tracking-tighter">Acceso al <span class="text-blue-600">Sistema</span></p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 font-mono text-[10px] text-blue-400 uppercase tracking-widest text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest" />
                    <x-text-input id="email"
                        class="block w-full bg-white/5 border-white/10 text-white text-sm focus:border-blue-500 focus:ring-0 transition-all placeholder:text-white/10"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="IDENTIFICADOR_USUARIO" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] uppercase font-bold" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <x-input-label for="password" :value="__('Password')" class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest" />
                        @if (Route::has('password.request'))
                            <a class="font-oxanium text-[8px] text-slate-500 uppercase tracking-widest hover:text-blue-400 transition-colors" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <x-text-input id="password"
                        class="block w-full bg-white/5 border-white/10 text-white text-sm focus:border-blue-500 focus:ring-0 transition-all"
                        type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] uppercase font-bold" />
                </div>

                <!-- Remember Me -->
                <div class="block">
                    <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded-sm border-white/10 bg-white/5 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-[#0B1220]" name="remember">
                        <span class="ms-3 font-oxanium text-[9px] text-slate-400 uppercase tracking-[0.2em] group-hover:text-blue-400 transition-colors">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Acciones Finales -->
                <div class="pt-4">
                    <x-primary-button class="w-full justify-center group relative py-4 bg-blue-600 text-white font-oxanium text-xs font-black uppercase tracking-[0.6em] overflow-hidden transition-all hover:bg-blue-500 shadow-[0_0_20px_rgba(37,99,235,0.4)] hover:shadow-[0_0_40px_rgba(37,99,235,0.6)]">
                        <!-- Esquinas HUD internas del botón [4] -->
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30 group-hover:border-white"></div>
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30 group-hover:border-white"></div>

                        <span class="relative z-10">Inicializar Sesión</span>

                        <!-- Efecto de brillo de sistema (Scanline) [5] -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Enlace a Registro (Metadato de sistema) -->
        <div class="mt-8">
            <a href="{{ route('register') }}" class="font-oxanium text-[9px] text-slate-500 uppercase tracking-[0.5em] hover:text-blue-400 transition-all">
                [ No_Account? // Create_Access ]
            </a>
        </div>
    </div>
</x-guest-layout>
