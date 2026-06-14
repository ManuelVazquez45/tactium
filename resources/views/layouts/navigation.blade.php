<!-- NAV DASHBOARD: INTERFAZ TÁCTICA PROFESIONAL (ESTILO OSCURO / LETRAS BLANCAS) -->
<nav x-data="{ open: false }" class="bg-[#0B1220] border-b border-blue-500/20 font-oxanium relative">

    <!-- Decoración HUD: Rejilla de fondo sutil para profundidad técnica [6] -->
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none"
        style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-5">
        <div class="flex justify-between h-20">
            <div class="flex items-center">

                <!-- LOGO TACTIUM (Escudo en Blanco): Inversión de color para limpieza visual -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('dashboard') }}" class="relative transition-transform duration-500 hover:scale-105">
                        <div
                            class="absolute inset-0 bg-blue-600/10 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                        <img src="{{ asset('images/logo_remove.png') }}" alt="Logo Tactium"
                            class="h-12 w-auto object-contain brightness-0 invert drop-shadow-[0_0_8px_rgba(255,255,255,0.1)]">
                    </a>
                </div>

                <!-- ENLACE: INICIO (Estilo Activo de Marco HUD) - Solo Admin -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <div class="hidden space-x-10 sm:-my-px sm:ms-12 sm:flex h-full items-center">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="relative px-6 py-2 text-[11px] font-black uppercase tracking-[0.5em] transition-all border-none">

                            <!-- Texto siempre blanco, con opacidad si no está seleccionado -->
                            <span
                                class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-white/40 group-hover:text-white' }} relative z-10 transition-colors duration-300">
                                {{ __('Inicio') }}
                            </span>

                            <!-- NUEVO ESTILO ACTIVO: Marco de Encuadre Neón -->
                            @if (request()->routeIs('dashboard'))
                                <div
                                    class="absolute inset-0 border border-blue-500/30 bg-blue-600/5 backdrop-blur-sm shadow-[0_0_15px_rgba(37,99,235,0.2)]">
                                    <!-- Esquinas reforzadas estilo HUD -->
                                    <div class="absolute top-0 left-0 w-2 h-2 border-t-2 border-l-2 border-blue-500">
                                    </div>
                                    <div class="absolute top-0 right-0 w-2 h-2 border-t-2 border-r-2 border-blue-500">
                                    </div>
                                    <div class="absolute bottom-0 left-0 w-2 h-2 border-b-2 border-l-2 border-blue-500">
                                    </div>
                                    <div
                                        class="absolute bottom-0 right-0 w-2 h-2 border-b-2 border-r-2 border-blue-500">
                                    </div>

                                    <!-- Línea de escaneo de sistema superior -->
                                    <div
                                        class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-400 to-transparent">
                                    </div>
                                </div>
                            @endif
                        </x-nav-link>
                    </div>
                @endif

                <!-- ENLACE: EQUIPO (Solo para Admin) -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <x-nav-link :href="route('equipos.index')" :active="request()->routeIs('equipos.*')"
                        class="relative group py-1 text-[11px] font-black uppercase tracking-[0.5em] transition-all border-none">

                        <!-- Texto Blanco -->
                        <span
                            class="{{ request()->routeIs('equipos.*') ? 'text-white' : 'text-white/40 group-hover:text-white' }} transition-colors duration-300">
                            {{ __('Equipo') }}
                        </span>

                        <!-- INDICADOR ACTIVO: Línea de escaneo neón inferior -->
                        <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-700"
                            style="{{ request()->routeIs('equipos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                        </div>

                        <!-- Micro-detalle HUD en la esquina si está activo -->
                        @if (request()->routeIs('equipos.*'))
                            <div
                                class="absolute -top-1 -left-3 w-2 h-2 border-t-2 border-l-2 border-blue-500 shadow-[0_0_10px_#2563eb]">
                            </div>
                        @endif
                    </x-nav-link>
                @endif

                <!-- ENLACE: ENTRENADORES (Solo para Admin) -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <x-nav-link :href="route('entrenadores.index')" :active="request()->routeIs('entrenadores.*')"
                        class="relative group py-1 text-[11px] font-black uppercase tracking-[0.5em] transition-all border-none">

                        <!-- Texto Blanco -->
                        <span
                            class="{{ request()->routeIs('entrenadores.*') ? 'text-white' : 'text-white/40 group-hover:text-white' }} transition-colors duration-300">
                            {{ __('Entrenadores') }}
                        </span>

                        <!-- INDICADOR ACTIVO: Línea de escaneo neón inferior -->
                        <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-700"
                            style="{{ request()->routeIs('entrenadores.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                        </div>

                        <!-- Micro-detalle HUD en la esquina si está activo -->
                        @if (request()->routeIs('entrenadores.*'))
                            <div
                                class="absolute -top-1 -left-3 w-2 h-2 border-t-2 border-l-2 border-blue-500 shadow-[0_0_10px_#2563eb]">
                            </div>
                        @endif
                    </x-nav-link>
                @endif

                <!-- ENLACE: ENTRENADOR DASHBOARD (Solo para entrenadores) -->
                @if (Auth::check() && Auth::user()->role === 'entrenador')
                    <div class="hidden space-x-10 sm:-my-px sm:ms-12 sm:flex h-full items-center">
                        <x-nav-link :href="route('entrenador.dashboard')" :active="request()->routeIs('entrenador.dashboard')"
                            class="relative group py-1 text-[11px] font-black uppercase tracking-[0.5em] transition-all border-none">

                            <span
                                class="{{ request()->routeIs('entrenador.dashboard') ? 'text-white' : 'text-white/40 group-hover:text-white' }} transition-colors duration-300">
                                {{ __('Inicio') }}
                            </span>

                            <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-700"
                                style="{{ request()->routeIs('entrenador.dashboard') || request()->routeIs('jugadores.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                            </div>

                            @if (request()->routeIs('entrenador.dashboard') || request()->routeIs('jugadores.*'))
                                <div
                                    class="absolute -top-1 -left-3 w-2 h-2 border-t-2 border-l-2 border-blue-500 shadow-[0_0_10px_#2563eb]">
                                </div>
                            @endif
                        </x-nav-link>

                        @php
                            $equipo = Auth::user()->primerEquipoAceptado();
                        @endphp

                        @if ($equipo)
                            <x-nav-link :href="route('entrenamientos.index', $equipo)" :active="request()->routeIs('entrenamientos.*')">
                                {{ __('Entreno') }}
                            </x-nav-link>

                            <x-nav-link :href="route('partidos.index', $equipo)" :active="request()->routeIs('partidos.*')">
                                {{ __('Partido') }}
                            </x-nav-link>
                            <x-nav-link :href="route('pagos.index', $equipo)" :active="request()->routeIs('pagos.*')">
                                {{ __('Inscripción') }}
                            </x-nav-link>
                        @else
                            <span class="text-white/20 text-[9px] px-4 uppercase tracking-[0.2em] self-center">
                                {{ __('// Equipo Pendiente') }}
                            </span>
                        @endif
                    </div>
                @endif

            </div>

            <!-- MENÚ DE USUARIO: INTERFAZ HUD CON PRIORIDAD DE CAPA (Z-INDEX) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 relative z-50">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-white/10 text-[9px] font-bold uppercase tracking-[0.2em] text-white bg-white/5 hover:bg-white/10 transition-all duration-150 relative group">
                            <!-- Esquinas de diseño HUD en el botón [3, 5] -->
                            <div class="absolute top-0 left-0 w-1 h-1 border-t border-l border-blue-500/40"></div>
                            <div class="absolute bottom-0 right-0 w-1 h-1 border-b border-r border-blue-500/40"></div>

                            <div class="flex items-center">
                                <span class="opacity-70 group-hover:opacity-100 transition-opacity">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg class="ms-2 h-3 w-3 text-blue-500 transition-transform group-hover:translate-y-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <!-- MENÚ DESPLEGABLE HUD: TARJETA DE IDENTIFICACIÓN TÁCTICA -->
                    <!-- DROPDOWN COMPACTO: ESTILO MICRO-HUD -->
                    <x-slot name="content">
                        <div
                            class="relative z-50 mt-2 w-48 bg-[#0B1220]/90 backdrop-blur-xl border border-blue-500/40 shadow-[0_0_20px_rgba(37,99,235,0.2)]">

                            <!-- Esquinas Neón Minimalistas [1, 4] -->
                            <div class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-blue-500"></div>
                            <div class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-blue-500"></div>

                            <!-- Acciones Directas [5, 6] -->
                            <div class="p-1 space-y-0.5 font-oxanium">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="flex items-center px-3 py-2 text-[9px] uppercase tracking-[0.2em] text-white/70 hover:text-white hover:bg-blue-600/30 transition-all border-l-2 border-transparent hover:border-blue-500">
                                    Mi_ID
                                </x-dropdown-link>

                                <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                    style="display: none;">
                                    @csrf
                                </form>

                                <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();"
                                    class="block px-3 py-2 text-[9px] uppercase tracking-[0.2em] text-red-400/70 hover:text-red-400 hover:bg-red-500/10 transition-all border-l-2 border-transparent hover:border-red-500 cursor-pointer pointer-events-auto">
                                    Salir_X
                                </a>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- HAMBURGUESA MÓVIL: Responsive Real [1, 11] -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 text-white/70 hover:text-blue-500 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MENÚ MÓVIL DESPLEGABLE: Estética Glassmorphism [12, 13] -->
    <div x-show="open" x-transition class="sm:hidden bg-[#0B1220]/95 backdrop-blur-xl border-t border-blue-500/10">
        <div class="pt-4 pb-4 space-y-2 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="block text-[10px] font-bold uppercase tracking-[0.4em] text-white border-none">
                {{ __('// Inicio') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
