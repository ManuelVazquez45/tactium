<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tactium - Gestión de Alto Rendimiento</title>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-oxanium {
            font-family: 'Oxanium', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-[#0B1220]" x-data="{ open: false }">

    <!-- HEADER INTEGRADO -->
    <header x-data="{ open: false, scrolled: false }" class="relative min-h-screen flex flex-col overflow-hidden bg-[#0B1220]">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/header_fondo.jpg') }}"
                class="w-full h-full object-cover opacity-50 grayscale-[20%] brightness-[0.9] transition-all duration-700"
                alt="Estadio Tactium">
            <!-- Degradado técnico: de un azul-grisáceo muy claro a nuestro azul oscuro profundo -->
            <div class="absolute inset-0 bg-gradient-to-b from-slate-200/90 via-slate-100/40 to-[#0B1220]"></div>
        </div>

        <!-- NAVEGACIÓN FIJA CON INTERCAMBIO DE LOGO DINÁMICO -->
        <nav @scroll.window="scrolled = (window.pageYOffset > 50)"
            :class="scrolled ? 'bg-[#0B1220]/95 py-3 shadow-2xl' : 'bg-transparent py-6'"
            class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 md:px-12 transition-all duration-500 backdrop-blur-md border-b border-blue-500/10">

            <!-- Línea de escaneo inferior reactiva -->
            <div :class="scrolled ? 'opacity-100' : 'opacity-0'"
                class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-500/50 to-transparent transition-opacity duration-500">
            </div>

            <!-- CONTENEDOR IZQUIERDA: Logo Dinámico + Enlaces -->
            <div class="flex items-center space-x-12">
                <div class="transition-transform hover:scale-105 duration-500">
                    <!-- INTERCAMBIO DE LOGO: Azul arriba, Blanco al bajar -->
                    <img :src="scrolled ? '{{ asset('images/Logo_blanco.png') }}' : '{{ asset('images/Logo_remove.png') }}'"
                        alt="Logo Tactium" class="w-12 h-12 md:w-16 md:h-16 object-contain transition-all duration-500"
                        :class="scrolled ? 'drop-shadow-[0_0_8px_rgba(255,255,255,0.2)]' : 'drop-shadow-md'">
                </div>

                <!-- Enlaces de Navegación -->
                <div class="hidden md:flex space-x-8 text-[9px] font-bold uppercase tracking-[0.5em] font-oxanium transition-colors duration-500"
                    :class="scrolled ? 'text-slate-200' : 'text-[#0B1220]'">
                    <a href="#inicio" class="group relative py-1 hover:text-blue-500 transition-colors">
                        <span class="relative z-10">Inicio</span>
                        <div
                            class="absolute -bottom-1 left-0 w-0 h-px bg-blue-500 group-hover:w-full transition-all duration-500 shadow-[0_0_8px_#2563eb]">
                        </div>
                    </a>
                    <a href="#funciones" class="group relative py-1 hover:text-blue-500 transition-colors">
                        <span class="relative z-10">Sistemas</span>
                        <div
                            class="absolute -bottom-1 left-0 w-0 h-px bg-blue-500 group-hover:w-full transition-all duration-500 shadow-[0_0_8px_#2563eb]">
                        </div>
                    </a>
                    <a href="#contacto" class="group relative py-1 hover:text-blue-500 transition-colors">
                        <span class="relative z-10">Contacto</span>
                        <div
                            class="absolute -bottom-1 left-0 w-0 h-px bg-blue-500 group-hover:w-full transition-all duration-500 shadow-[0_0_8px_#2563eb]">
                        </div>
                    </a>
                </div>
            </div>

            <!-- CONTENEDOR DERECHA: Botones de Acción -->
            <div class="flex items-center space-x-6 font-oxanium">
                <!-- BOTONES DESKTOP -->
                <a href="{{ route('login') }}"
                    class="hidden sm:block text-[9px] font-bold uppercase tracking-[0.3em] transition-colors duration-500"
                    :class="scrolled ? 'text-slate-300 hover:text-blue-400' : 'text-[#0B1220] hover:text-blue-600'">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}"
                    class="hidden sm:block group relative text-[9px] font-black uppercase tracking-[0.4em] bg-blue-600 text-white px-6 py-2 shadow-[0_0_15px_rgba(37,99,235,0.4)] hover:shadow-[0_0_30px_rgba(37,99,235,0.6)] transition-all">
                    Registro
                </a>

                <!-- MENÚ HAMBURGUESA MÓVIL -->
                <button @click="open = !open" class="sm:hidden p-2 text-blue-500 hover:text-blue-400 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- MENÚ MÓVIL DESPLEGABLE -->
        <div x-show="open" x-transition class="sm:hidden fixed top-20 left-0 right-0 bg-[#0B1220]/95 backdrop-blur-xl border-b border-blue-500/20 z-40">
            <div class="px-4 py-4 space-y-3 font-oxanium">
                <a href="#inicio" @click="open = false"
                    class="block text-xs font-bold uppercase tracking-[0.3em] text-blue-400 hover:text-blue-300 transition-colors py-2">
                    Inicio
                </a>
                <a href="#funciones" @click="open = false"
                    class="block text-xs font-bold uppercase tracking-[0.3em] text-blue-400 hover:text-blue-300 transition-colors py-2">
                    Sistemas
                </a>
                <a href="#contacto" @click="open = false"
                    class="block text-xs font-bold uppercase tracking-[0.3em] text-blue-400 hover:text-blue-300 transition-colors py-2">
                    Contacto
                </a>
                <div class="border-t border-blue-500/10 my-2"></div>
                <a href="{{ route('login') }}"
                    class="block text-xs font-bold uppercase tracking-[0.3em] text-blue-400 hover:text-blue-300 transition-colors py-2">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}"
                    class="block text-xs font-black uppercase tracking-[0.4em] bg-blue-600 text-white px-4 py-2 text-center shadow-[0_0_15px_rgba(37,99,235,0.4)] hover:shadow-[0_0_30px_rgba(37,99,235,0.6)] transition-all">
                    Registro
                </a>
            </div>
        </div>

        <!-- IMPORTANTE: Añade este margen al inicio de tu <header> para compensar la altura del nav fijo -->
        <div class="h-24" id="inicio"></div>
        <div class="relative z-10 flex-grow flex flex-col items-center justify-center text-center px-6 -mt-12">
            <!-- Título ligeramente más contenido para que "respire" -->
            <h1
                class="font-oxanium text-5xl sm:text-7xl lg:text-8xl xl:text-[9.5rem] font-black tracking-[0.2em] md:tracking-[0.4em] text-[#0B1220] uppercase leading-none mb-4">
                TACT<span class="text-blue-600 drop-shadow-[0_0_20px_rgba(37,99,235,0.3)]">IUM</span>
            </h1>

            <!-- ESLOGAN: HUD OSCURECIDO DE ALTA DEFINICIÓN -->
            <div class="relative flex flex-col items-center mb-12 group">

                <!-- Línea de escaneo superior (Más marcada para dar fuerza) -->
                <div class="w-20 h-px bg-blue-500/60 mb-4 group-hover:w-40 transition-all duration-700"></div>

                <div class="relative px-8 py-2">
                    <!-- CAPA OSCURECIDA: Cambiamos blanco por azul oscuro profundo con transparencia -->
                    <div class="absolute inset-0 bg-[#0B1220]/70 backdrop-blur-md border border-blue-500/20 rounded-sm">
                    </div>

                    <!-- Micro-detalles HUD en las esquinas (Azul neón brillante) -->
                    <div class="absolute -top-1 -left-1 w-2 h-2 border-t border-l border-blue-400"></div>
                    <div class="absolute -bottom-1 -right-1 w-2 h-2 border-b border-r border-blue-400"></div>

                    <!-- Texto del Eslogan: Ahora en blanco y azul claro para resaltar sobre el fondo oscuro -->
                    <p
                        class="relative z-10 font-oxanium text-[10px] md:text-xs text-slate-200 uppercase tracking-[0.4em] md:tracking-[0.6em] font-black text-center">
                        Control total del club. <span
                            class="text-blue-400 drop-shadow-[0_0_8px_rgba(96,165,250,0.4)]">Dentro y fuera del
                            campo.</span>
                    </p>
                </div>

                <!-- Metadatos de sistema (Siguen siendo muy sutiles) -->
                <div class="mt-3 opacity-30 flex items-center space-x-4">
                    <span class="text-[7px] font-mono text-[#0B1220] tracking-[0.8em] uppercase">Tactical_Layer</span>
                    <div class="w-1 h-1 bg-blue-600 rounded-full"></div>
                    <span class="text-[7px] font-mono text-[#0B1220] tracking-[0.8em] uppercase">Live_Data</span>
                </div>
            </div>
            <!-- BOTÓN "INICIALIZAR SISTEMA" - EVOLUCIÓN DEPORTIVA Y FUTURISTA -->
            <a href="#funciones"
                class="font-oxanium group relative px-16 py-7 bg-[#0B1220] text-white overflow-hidden border border-blue-500/30 hover:border-blue-400 hover:shadow-[0_0_50px_rgba(37,99,235,0.5)] transition-all duration-500 hover:scale-105 rounded-sm">

                <!-- ESQUINAS HUD ACTIVAS (Estilo Táctico) -->
                <!-- Estas esquinas se "cierran" o brillan más al pasar el ratón -->
                <div
                    class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-blue-500 opacity-40 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-blue-500 opacity-40 group-hover:opacity-100 transition-opacity duration-500">
                </div>

                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] transition-transform">
                </div>

                <!-- CONTENIDO DEL TEXTO -->
                <span
                    class="relative z-10 text-[11px] font-black uppercase tracking-[0.8em] group-hover:text-blue-100 transition-colors">
                    Inicializar Sistema
                </span>

                <!-- LÍNEA DE CARGA INFERIOR (Detalle de sistema activo) -->
                <div
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-blue-500 group-hover:w-2/3 transition-all duration-700 shadow-[0_0_10px_#2563eb]">
                </div>
            </a>

            <!-- Estilos necesarios para la animación en tu archivo CSS o bloque <style> -->
            <style>
                @keyframes shimmer {
                    100% {
                        transform: translateX(100%);
                    }
                }
            </style>
        </div>
    </header>

    <!-- SECCIÓN DE EXPLICACIÓN DEL SISTEMA -->
    <section id="funciones" class="relative py-24 bg-[#0B1220] overflow-hidden">

        <!-- Decoración de fondo: Grid tecnológico sutil -->
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: radial-gradient(#2563eb 0.5px, transparent 0.5px); background-size: 30px 30px;">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">

            <!-- Encabezado de la sección -->
            <div class="mb-16 border-l-4 border-blue-600 pl-6">
                <h2 class="font-oxanium text-blue-500 text-xs font-bold tracking-[0.5em] uppercase mb-2">
                    Core System // Operatividad
                </h2>
                <p class="font-oxanium text-3xl md:text-5xl text-white font-black uppercase tracking-tighter">
                    Gestión de <span class="text-blue-600">Alto Rendimiento</span>
                </p>
            </div>

            <!-- Grid de Módulos (Explicación del Programa) -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Módulo 01: Gestión de Plantilla -->
                <div
                    class="group relative p-8 bg-white/5 border border-white/10 rounded-sm transition-all hover:bg-white/10">
                    <!-- Esquina HUD activa -->
                    <div
                        class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-blue-500/20 group-hover:border-blue-500 transition-colors">
                    </div>

                    <h3
                        class="font-oxanium text-white text-lg font-bold uppercase tracking-widest mb-4 flex items-center">
                        <span class="text-blue-500 mr-3 text-xs">01/</span> Control de Plantilla
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed font-light mb-6">
                        Administración integral de jugadores (Altas, Bajas y Modificaciones) [4, 5]. Incluye un <span
                            class="text-blue-400 font-bold">Buscador AJAX</span> para localizar perfiles por posición o
                        equipo de forma instantánea [5, 6].
                    </p>
                    <div class="h-1 w-12 bg-blue-600/30 group-hover:w-full transition-all duration-500"></div>
                </div>

                <!-- Módulo 02: Planificación Táctica -->
                <div
                    class="group relative p-8 bg-white/5 border border-white/10 rounded-sm transition-all hover:bg-white/10">
                    <div
                        class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-blue-500/20 group-hover:border-blue-500 transition-colors">
                    </div>

                    <h3
                        class="font-oxanium text-white text-lg font-bold uppercase tracking-widest mb-4 flex items-center">
                        <span class="text-blue-500 mr-3 text-xs">02/</span> Centro de Partidos
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed font-light mb-6">
                        Gestión de calendario dinámico con <span class="text-blue-400 font-bold">FullCalendar</span>
                        [7]. Control de resultados, alineaciones y convocatorias en tiempo real [4, 8].
                    </p>
                    <div class="h-1 w-12 bg-blue-600/30 group-hover:w-full transition-all duration-500"></div>
                </div>

                <!-- Módulo 03: Analítica de Datos -->
                <div
                    class="group relative p-8 bg-white/5 border border-white/10 rounded-sm transition-all hover:bg-white/10">
                    <div
                        class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-blue-500/20 group-hover:border-blue-500 transition-colors">
                    </div>

                    <h3
                        class="font-oxanium text-white text-lg font-bold uppercase tracking-widest mb-4 flex items-center">
                        <span class="text-blue-500 mr-3 text-xs">03/</span> Smart Analytics
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed font-light mb-6">
                        Visualización de KPIs (goles, asistencias, minutos) mediante <span
                            class="text-blue-400 font-bold">Chart.js</span> [7, 9]. Monitorización de lesiones y estado
                        físico de la plantilla [10, 11].
                    </p>
                    <div class="h-1 w-12 bg-blue-600/30 group-hover:w-full transition-all duration-500"></div>
                </div>

                <!-- Módulo 04: Control de Sesiones -->
                <div
                    class="group relative p-8 bg-white/5 border border-white/10 rounded-sm transition-all hover:bg-white/10">
                    <div
                        class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-blue-500/20 group-hover:border-blue-500 transition-colors">
                    </div>

                    <h3
                        class="font-oxanium text-white text-lg font-bold uppercase tracking-widest mb-4 flex items-center">
                        <span class="text-blue-500 mr-3 text-xs">04/</span> Jerarquía de Roles
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed font-light mb-6">
                        Sistema de seguridad con tres niveles de acceso: <span class="text-blue-400 font-bold">Admin,
                            Entrenador y Jugador</span> [10, 12]. Garantiza que cada usuario vea solo la información que
                        le compete [6, 13].
                    </p>
                    <div class="h-1 w-12 bg-blue-600/30 group-hover:w-full transition-all duration-500"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECCIÓN DE CONTACTO: COMM_CENTER V2 (SOPORTE INTEGRADO) -->
    <section id="contacto" class="relative py-24 bg-[#0B1220] overflow-hidden">

        <!-- Decoración HUD de fondo -->
        <div class="absolute inset-0 opacity-5 pointer-events-none"
            style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-6">

            <!-- Título de Sección con Metadatos -->
            <div class="mb-16 text-center">
                <div class="inline-block px-4 py-1 border border-blue-500/30 mb-4">
                    <h2 class="font-oxanium text-blue-500 text-[9px] font-bold tracking-[0.8em] uppercase">
                        Establish // Connection_Protocol
                    </h2>
                </div>
                <p class="font-oxanium text-4xl md:text-6xl text-white font-black uppercase tracking-tighter">
                    Canales de <span class="text-blue-600">Enlace Directo</span>
                </p>
            </div>

            <!-- Grid de Contacto: Tres Columnas (Teléfono, Email y AYUDA) -->
            <div class="grid md:grid-cols-3 gap-6">

                <!-- Módulo 01: Teléfono -->
                <div
                    class="group relative p-8 bg-white/5 backdrop-blur-md border border-white/10 rounded-sm transition-all hover:border-blue-500/50">
                    <div
                        class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-blue-600/30 group-hover:border-blue-500 transition-colors">
                    </div>
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="text-blue-500 opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-oxanium text-blue-400 text-[9px] uppercase tracking-[0.4em]">Voice_Comm</h3>
                        <p class="text-xl text-white font-bold tracking-widest">+34 600 000 000</p>
                    </div>
                </div>

                <!-- Módulo 02: Email -->
                <div
                    class="group relative p-8 bg-white/5 backdrop-blur-md border border-white/10 rounded-sm transition-all hover:border-blue-500/50">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="text-blue-500 opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-oxanium text-blue-400 text-[9px] uppercase tracking-[0.4em]">Data_Stream</h3>
                        <p class="text-sm text-white font-bold tracking-widest uppercase">INFO@TACTIUM-APP.COM</p>
                    </div>
                </div>

                <!-- Módulo 03: AYUDA ONLINE (Cumplimiento de Requisito [1]) -->
                <div
                    class="group relative p-8 bg-blue-600/10 backdrop-blur-md border border-blue-500/40 rounded-sm transition-all hover:bg-blue-600/20">
                    <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-blue-500"></div>
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div class="text-blue-400 animate-pulse">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-oxanium text-white text-[9px] uppercase tracking-[0.4em]">Help_Center</h3>
                        <a href="/ayuda"
                            class="px-4 py-2 bg-blue-600 text-white text-[10px] font-black uppercase tracking-[0.3em] hover:bg-blue-500 transition-all">
                            Guía de Sistema
                        </a>
                    </div>
                </div>
            </div>

            <!-- BARRA SOCIAL HUD: El toque "Chulo" final -->
            <div class="mt-16 flex flex-wrap justify-center gap-8 border-t border-white/5 pt-10">
                <div
                    class="flex items-center space-x-3 opacity-40 hover:opacity-100 transition-opacity cursor-pointer">
                    <span class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest">X_Platform //</span>
                    <span class="text-white text-[11px] font-bold">@TACTIUM_FC</span>
                </div>
                <div
                    class="flex items-center space-x-3 opacity-40 hover:opacity-100 transition-opacity cursor-pointer">
                    <span class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest">Insta_Gram //</span>
                    <span class="text-white text-[11px] font-bold">TACTIUM.APP</span>
                </div>
                <div
                    class="flex items-center space-x-3 opacity-40 hover:opacity-100 transition-opacity cursor-pointer">
                    <span class="font-oxanium text-[10px] text-blue-400 uppercase tracking-widest">Dev_Api //</span>
                    <span class="text-white text-[11px] font-bold italic underline">DOCS_V1.2</span>
                </div>
            </div>

        </div>
    </section>
<x-footer />
</body>

</html>
