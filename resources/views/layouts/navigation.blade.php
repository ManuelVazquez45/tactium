<!-- NAV DASHBOARD: INTERFAZ TÁCTICA PROFESIONAL -->
<nav x-data="{ open: false }" class="bg-[#0B1220] border-b border-blue-500/20 font-oxanium relative">

    <!-- Decoración HUD de fondo -->
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none"
        style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-50">
        <div class="flex justify-between items-center h-20">

            <!-- IZQUIERDA: Logo + Links -->
            <div class="flex items-center gap-8">

                <!-- LOGO -->
                <a href="{{ route('dashboard') }}" class="relative group shrink-0 transition-transform duration-300 hover:scale-105">
                    <div class="absolute inset-0 bg-blue-600/10 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <img src="{{ asset('images/logo_remove.png') }}" alt="Logo Tactium"
                        class="h-14 w-auto object-contain brightness-0 invert drop-shadow-[0_0_10px_rgba(255,255,255,0.15)]">
                </a>

                <!-- SEPARADOR VISUAL -->
                <div class="hidden sm:block h-8 w-px bg-blue-500/20"></div>

                <!-- LINKS ADMIN -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <div class="hidden sm:flex items-center gap-2">

                        <!-- INICIO -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="relative px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                            <span class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-white/40 hover:text-white' }} relative z-10 transition-colors duration-300">
                                {{ __('Inicio') }}
                            </span>
                            @if (request()->routeIs('dashboard'))
                                <div class="absolute inset-0 border border-blue-500/30 bg-blue-600/5 backdrop-blur-sm shadow-[0_0_15px_rgba(37,99,235,0.2)]">
                                    <div class="absolute top-0 left-0 w-2 h-2 border-t-2 border-l-2 border-blue-500"></div>
                                    <div class="absolute top-0 right-0 w-2 h-2 border-t-2 border-r-2 border-blue-500"></div>
                                    <div class="absolute bottom-0 left-0 w-2 h-2 border-b-2 border-l-2 border-blue-500"></div>
                                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b-2 border-r-2 border-blue-500"></div>
                                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-400 to-transparent"></div>
                                </div>
                            @endif
                        </x-nav-link>

                        <!-- EQUIPOS -->
                        <x-nav-link :href="route('equipos.index')" :active="request()->routeIs('equipos.*')"
                            class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                            <span class="{{ request()->routeIs('equipos.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                {{ __('Equipos') }}
                            </span>
                            <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                style="{{ request()->routeIs('equipos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                            </div>
                            @if (request()->routeIs('equipos.*'))
                                <div class="absolute -top-1 -left-2 w-2 h-2 border-t-2 border-l-2 border-blue-500 shadow-[0_0_10px_#2563eb]"></div>
                            @endif
                        </x-nav-link>

                        <!-- ENTRENADORES -->
                        <x-nav-link :href="route('entrenadores.index')" :active="request()->routeIs('entrenadores.*')"
                            class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                            <span class="{{ request()->routeIs('entrenadores.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                {{ __('Entrenadores') }}
                            </span>
                            <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                style="{{ request()->routeIs('entrenadores.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                            </div>
                            @if (request()->routeIs('entrenadores.*'))
                                <div class="absolute -top-1 -left-2 w-2 h-2 border-t-2 border-l-2 border-blue-500 shadow-[0_0_10px_#2563eb]"></div>
                            @endif
                        </x-nav-link>

                    </div>
                @endif

                <!-- LINKS ENTRENADOR -->
                @if (Auth::check() && Auth::user()->role === 'entrenador')
                    <div class="hidden sm:flex items-center gap-2">

                        <!-- INICIO -->
                        <x-nav-link :href="route('entrenador.dashboard')" :active="request()->routeIs('entrenador.dashboard')"
                            class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                            <span class="{{ request()->routeIs('entrenador.dashboard') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                {{ __('Inicio') }}
                            </span>
                            <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                style="{{ request()->routeIs('entrenador.dashboard') || request()->routeIs('jugadores.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                            </div>
                            @if (request()->routeIs('entrenador.dashboard') || request()->routeIs('jugadores.*'))
                                <div class="absolute -top-1 -left-2 w-2 h-2 border-t-2 border-l-2 border-blue-500 shadow-[0_0_10px_#2563eb]"></div>
                            @endif
                        </x-nav-link>

                        @php $equipo = Auth::user()->primerEquipoAceptado(); @endphp

                        @if ($equipo)
                            <!-- SEPARADOR -->
                            <div class="h-6 w-px bg-blue-500/20 mx-1"></div>

                            <!-- EQUIPO -->
                            <x-nav-link :href="route('equipos.show', $equipo)" :active="request()->routeIs('equipos.show')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('equipos.show') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Equipo') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('equipos.show') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>

                            <!-- ENTRENO -->
                            <x-nav-link :href="route('entrenamientos.index', $equipo)" :active="request()->routeIs('entrenamientos.*')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('entrenamientos.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Entreno') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('entrenamientos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>

                            <!-- PARTIDO -->
                            <x-nav-link :href="route('partidos.index', $equipo)" :active="request()->routeIs('partidos.*')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('partidos.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Partido') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('partidos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>

                            <!-- INSCRIPCIÓN -->
                            <x-nav-link :href="route('pagos.index', $equipo)" :active="request()->routeIs('pagos.*')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('pagos.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Inscripción') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('pagos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>
                        @else
                            <div class="h-6 w-px bg-blue-500/20 mx-1"></div>
                            <span class="text-white/20 text-[9px] px-4 uppercase tracking-[0.2em]">
                                {{ __('// Equipo Pendiente') }}
                            </span>
                        @endif
                    </div>
                @endif

                <!-- LINKS JUGADOR -->
                @if (Auth::check() && Auth::user()->role === 'jugador')
                    <div class="hidden sm:flex items-center gap-2">

                        @php $equipo = Auth::user()->primerEquipoAceptado(); @endphp

                        @if (!request()->routeIs('equipos.show', 'entrenamientos.*', 'partidos.*', 'pagos.show'))
                            <!-- INICIO -->
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Inicio') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('dashboard') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>
                        @endif

                        @if ($equipo)
                            @if (request()->routeIs('equipos.show', 'entrenamientos.*', 'partidos.*', 'pagos.show'))
                                <!-- SEPARADOR -->
                                <div class="h-6 w-px bg-blue-500/20 mx-1"></div>
                            @endif

                            <!-- EQUIPO -->
                            <x-nav-link :href="route('equipos.show', $equipo)" :active="request()->routeIs('equipos.show')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('equipos.show') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Equipo') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('equipos.show') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>

                            <!-- ENTRENO -->
                            <x-nav-link :href="route('entrenamientos.index', $equipo)" :active="request()->routeIs('entrenamientos.*')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('entrenamientos.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Entreno') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('entrenamientos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>

                            <!-- PARTIDO -->
                            <x-nav-link :href="route('partidos.index', $equipo)" :active="request()->routeIs('partidos.*')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('partidos.*') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Partido') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('partidos.*') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>

                            <!-- INSCRIPCIÓN -->
                            @php
                                $jugador = $equipo->jugadores()->where('email', auth()->user()->email)->first();
                            @endphp
                            @if ($jugador)
                            <x-nav-link :href="route('pagos.show', [$equipo, $jugador])" :active="request()->routeIs('pagos.show')"
                                class="relative group/link px-5 py-2 text-xs font-black uppercase tracking-[0.4em] transition-all border-none">
                                <span class="{{ request()->routeIs('pagos.show') ? 'text-white' : 'text-white/40 group-hover/link:text-white' }} transition-colors duration-300">
                                    {{ __('Inscripción') }}
                                </span>
                                <div class="absolute -bottom-1 left-0 h-[2px] bg-blue-600 shadow-[0_0_20px_#2563eb] transition-all duration-500"
                                    style="{{ request()->routeIs('pagos.show') ? 'width: 100%; opacity: 1;' : 'width: 0%; opacity: 0;' }}">
                                </div>
                            </x-nav-link>
                            @endif
                        @else
                            <div class="h-6 w-px bg-blue-500/20 mx-1"></div>
                            <span class="text-white/20 text-[9px] px-4 uppercase tracking-[0.2em]">
                                {{ __('// Equipo Pendiente') }}
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- DERECHA: Usuario -->
            <div class="hidden sm:flex sm:items-center gap-4 relative z-50">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white/10 text-xs font-bold uppercase tracking-[0.2em] text-white bg-white/5 hover:bg-white/10 transition-all duration-150 relative group">
                            <div class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-blue-500/40"></div>
                            <div class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-blue-500/40"></div>
                            <span class="opacity-70 group-hover:opacity-100 transition-opacity">{{ Auth::user()->name }}</span>
                            <svg class="ms-2 h-3 w-3 text-blue-500 transition-transform group-hover:translate-y-0.5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="relative z-50 mt-2 w-48 bg-[#0B1220]/95 backdrop-blur-xl border border-blue-500/40 shadow-[0_0_20px_rgba(37,99,235,0.2)]">
                            <div class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-blue-500"></div>
                            <div class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-blue-500"></div>
                            <div class="p-1 space-y-0.5 font-oxanium">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="flex items-center px-3 py-2 text-xs uppercase tracking-[0.2em] text-white/70 hover:text-white hover:bg-blue-600/30 transition-all border-l-2 border-transparent hover:border-blue-500">
                                    Mi_ID
                                </x-dropdown-link>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                                    @csrf
                                </form>
                                <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();"
                                    class="block px-3 py-2 text-xs uppercase tracking-[0.2em] text-red-400/70 hover:text-red-400 hover:bg-red-500/10 transition-all border-l-2 border-transparent hover:border-red-500 cursor-pointer">
                                    Salir_X
                                </a>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- HAMBURGUESA MÓVIL -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-white/70 hover:text-blue-500 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MENÚ MÓVIL -->
    <div x-show="open" x-transition class="sm:hidden bg-[#0B1220]/95 backdrop-blur-xl border-t border-blue-500/10">
        <div class="pt-4 pb-4 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                {{ __('// Inicio') }}
            </x-responsive-nav-link>
            @if(Auth::check() && Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('equipos.index')" :active="request()->routeIs('equipos.*')"
                    class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                    {{ __('// Equipos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('entrenadores.index')" :active="request()->routeIs('entrenadores.*')"
                    class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                    {{ __('// Entrenadores') }}
                </x-responsive-nav-link>
            @endif
            @if(Auth::check() && Auth::user()->role === 'jugador')
                @php $equipo = Auth::user()->primerEquipoAceptado(); @endphp
                @if($equipo)
                    <x-responsive-nav-link :href="route('equipos.show', $equipo)" :active="request()->routeIs('equipos.show')"
                        class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                        {{ __('// Equipo') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('entrenamientos.index', $equipo)" :active="request()->routeIs('entrenamientos.*')"
                        class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                        {{ __('// Entreno') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('partidos.index', $equipo)" :active="request()->routeIs('partidos.*')"
                        class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                        {{ __('// Partido') }}
                    </x-responsive-nav-link>
                    @php
                        $jugador = $equipo->jugadores()->where('email', auth()->user()->email)->first();
                    @endphp
                    @if($jugador)
                    <x-responsive-nav-link :href="route('pagos.show', [$equipo, $jugador])" :active="request()->routeIs('pagos.show')"
                        class="block text-xs font-bold uppercase tracking-[0.4em] text-white border-none py-3">
                        {{ __('// Inscripción') }}
                    </x-responsive-nav-link>
                    @endif
                @endif
            @endif
        </div>
    </div>
</nav>
