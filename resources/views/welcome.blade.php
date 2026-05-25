<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tactium - Gestión de Alto Rendimiento</title>
    <!-- Fuente Oxanium para el look futurista -->
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-oxanium { font-family: 'Oxanium', sans-serif; }
        .text-dark-tactium { color: #0B1220; }
        .bg-dark-tactium { background-color: #0B1220; }
    </style>
</head>
<body class="antialiased bg-dark-tactium">

    <!-- CONTENEDOR UNIFORME: DE CLARO A OSCURO -->
    <div class="relative min-h-screen flex flex-col overflow-hidden bg-gradient-to-b from-slate-100 via-white/80 to-dark-tactium">

        <!-- IMAGEN DE FONDO INTEGRADA -->
        <div class="absolute inset-0 z-0">
            <!-- La foto de fútbol se mezcla con el degradado usando mix-blend-multiply para que sea uniforme -->
            <img src="{{ asset('images/header_fondo.jpg') }}"
                 class="w-full h-full object-cover opacity-30 mix-blend-multiply grayscale-[30%]"
                 alt="Fondo Fútbol">
            <!-- Capa de suavizado para que la transición de la foto sea imperceptible -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-dark-tactium"></div>
        </div>

        <!-- NAVEGACIÓN (Parte clara para resaltar el logo #0B1220) -->
        <nav class="relative z-20 flex items-center justify-between px-12 py-10 transition-all duration-500">
            <div class="flex items-center space-x-16">
                <!-- Logo Grande en su color original #0B1220 -->
                <div class="transition-transform hover:scale-110">
                    <img src="{{ asset('images/logo_remove.png') }}" alt="Logo Tactium" class="w-32 h-32 object-contain drop-shadow-md">
                </div>

                <!-- Enlaces en el color del logo con espaciado futurista -->
                <div class="hidden md:flex space-x-12 text-[11px] font-bold uppercase tracking-[0.6em] text-dark-tactium font-oxanium">
                    <a href="#inicio" class="hover:text-blue-600 transition-colors">Inicio</a>
                    <a href="#funciones" class="hover:text-blue-600 transition-colors">Sistemas</a>
                    <a href="#contacto" class="hover:text-blue-600 transition-colors">Contacto</a>
                </div>
            </div>

            <!-- Botones de Acceso -->
            <div class="flex items-center space-x-8 font-oxanium">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-[11px] font-bold uppercase tracking-[0.4em] text-dark-tactium border border-dark-tactium/20 px-8 py-3 rounded-sm">Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[11px] font-bold uppercase tracking-[0.4em] text-dark-tactium hover:text-blue-600 transition">Login</a>
                        <a href="{{ route('register') }}" class="text-[11px] font-bold uppercase tracking-[0.4em] bg-dark-tactium text-white px-10 py-3 rounded-sm shadow-2xl hover:bg-blue-900 transition-all">
                            Registro
                        </a>
                    @endauth
                @endif
            </div>
        </nav>

        <!-- CONTENIDO CENTRAL (Hero) -->
        <div class="relative z-10 flex-grow flex flex-col items-center justify-center text-center px-4 -mt-20">
            <h1 class="font-oxanium text-7xl md:text-[10rem] font-black tracking-[0.7em] text-dark-tactium uppercase leading-none mb-8 drop-shadow-sm">
                TACT<span class="text-blue-600">IUM</span>
            </h1>

            <p class="font-oxanium text-xs md:text-sm text-dark-tactium/70 max-w-3xl mb-16 uppercase tracking-[1em] font-extrabold">
                Control total del club. Dentro y fuera del campo.
            </p>

            <a href="#funciones" class="font-oxanium group relative px-20 py-6 bg-dark-tactium text-white overflow-hidden rounded-sm transition-all shadow-[0_20px_50px_rgba(0,0,0,0.3)] hover:shadow-blue-600/20">
                <span class="relative z-10 text-[10px] font-bold uppercase tracking-[0.7em]">Inicializar</span>
                <div class="absolute inset-0 bg-blue-600 -translate-x-full group-hover:translate-x-0 transition-transform duration-700"></div>
            </a>
        </div>
    </div>

    <!-- SECCIÓN DE FUNCIONES (Ya en el fondo oscuro sólido) -->
    <section id="funciones" class="relative z-10 py-32 px-10 bg-dark-tactium">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-1 shadow-2xl shadow-black/50">
            <div class="p-14 bg-white/5 border border-white/5 hover:bg-white/10 transition-all">
                <h3 class="font-oxanium text-blue-500 text-xs font-bold tracking-[0.5em] uppercase mb-6 text-glow">01 // Plantilla</h3>
                <p class="text-gray-400 text-[10px] tracking-[0.3em] uppercase leading-loose">Gestión de jugadores con buscador AJAX avanzado [4].</p>
            </div>
            <div class="p-14 bg-white/5 border border-white/5 hover:bg-white/10 transition-all">
                <h3 class="font-oxanium text-blue-500 text-xs font-bold tracking-[0.5em] uppercase mb-6 text-glow">02 // Táctica</h3>
                <p class="text-gray-400 text-[10px] tracking-[0.3em] uppercase leading-loose">Control de convocatorias y calendario interactivo [5].</p>
            </div>
            <div class="p-14 bg-white/5 border border-white/5 hover:bg-white/10 transition-all">
                <h3 class="font-oxanium text-blue-500 text-xs font-bold tracking-[0.5em] uppercase mb-6 text-glow">03 // Data</h3>
                <p class="text-gray-400 text-[10px] tracking-[0.3em] uppercase leading-loose">Análisis de rendimiento con gráficas Chart.js [6].</p>
            </div>
        </div>
    </section>

</body>
</html>
