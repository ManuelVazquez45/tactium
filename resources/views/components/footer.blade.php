<!-- FOOTER: TACTIUM COMMAND CONSOLE (ULTRA-PRO) -->
<footer class="relative bg-[#0B1220] pt-24 pb-8 overflow-hidden border-t border-blue-500/30">

    <!-- Decoración HUD: Rejilla de Perspectiva de Fondo -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 60px 60px;">
    </div>

    <!-- Halo de Seguridad Central -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-blue-600/10 blur-[120px] rounded-full"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <!-- BLOQUE 1: IDENTIDAD MASIVA (Logo sin deformación) -->
        <div class="flex flex-col items-center mb-16 group">
            <div class="relative mb-4">
                <div class="absolute inset-0 bg-blue-600/20 blur-2xl rounded-full scale-150 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <!-- Respetamos la proporción original para que no se vea estrecho -->
                <img src="{{ asset('images/Logo_blanco.png') }}"
                     alt="Tactium Logo"
                     class="relative h-32 md:h-48 w-auto object-contain drop-shadow-[0_0_40px_rgba(37,99,235,0.4)] transition-transform duration-700 hover:scale-105">
            </div>
            <h2 class="font-oxanium text-5xl md:text-8xl text-white font-black uppercase tracking-[0.2em] leading-none text-center">
                TACT<span class="text-blue-600 drop-shadow-[0_0_20px_rgba(37,99,235,0.5)]">IUM</span>
            </h2>
            <div class="mt-4 flex items-center space-x-2 opacity-30">
                <div class="h-px w-12 bg-blue-500"></div>
                <span class="text-[8px] font-mono text-blue-400 uppercase tracking-[0.8em]">Verified_Platform // 2026</span>
                <div class="h-px w-12 bg-blue-500"></div>
            </div>
        </div>

        <!-- BLOQUE 2: MÓDULOS DE INFORMACIÓN Y ENLACE -->
        <div class="grid lg:grid-cols-2 gap-12 mb-20">

            <!-- Módulo A: Información del Sistema & Newsletter -->
            <div class="relative p-8 bg-white/[0.02] border border-white/5 backdrop-blur-sm">
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-500"></div>
                <h3 class="font-oxanium text-blue-500 text-[10px] font-bold uppercase tracking-[0.5em] mb-6">// System_Manifesto</h3>
                <p class="text-slate-400 text-sm leading-relaxed font-light mb-8">
                    Elevando el estándar del fútbol base mediante tecnología de análisis de élite. <span class="text-white font-bold">Tactium</span> centraliza la gestión de plantillas, operativa deportiva y análisis de datos en una sola terminal de alto rendimiento [3, 4].
                </p>

                <!-- Email para Dudas (Newsletter Táctico) -->
                <div class="space-y-4">
                    <label class="font-oxanium text-white text-[9px] uppercase tracking-widest italic">Cualquier duda // Enviar Mensaje</label>
                    <div class="relative flex items-center group/input">
                        <input type="email" placeholder="INGRESAR_EMAIL_ID..."
                               class="w-full bg-transparent border-b border-white/20 px-0 py-3 text-[11px] text-white focus:border-blue-500 focus:outline-none font-mono transition-all placeholder:text-white/10">
                        <button class="absolute right-0 p-2 text-blue-500 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Módulo B: Directorio Táctico -->
            <div class="grid grid-cols-2 gap-8">
                <!-- Enlaces de Navegación -->
                <div class="space-y-6">
                    <h3 class="font-oxanium text-blue-500 text-[10px] font-bold uppercase tracking-[0.5em]">// Navigation</h3>
                    <ul class="space-y-4">
                        <li><a href="#inicio" class="text-slate-400 text-[11px] font-bold uppercase tracking-widest hover:text-blue-500 transition-all italic">Inicio</a></li>
                        <li><a href="#funciones" class="text-slate-400 text-[11px] font-bold uppercase tracking-widest hover:text-blue-500 transition-all italic">Sistemas</a></li>
                        <li><a href="#contacto" class="text-slate-400 text-[11px] font-bold uppercase tracking-widest hover:text-blue-500 transition-all italic">Contacto</a></li>
                    </ul>
                </div>
                <!-- Soporte y Ayuda -->
                <div class="space-y-6 text-right">
                    <h3 class="font-oxanium text-blue-500 text-[10px] font-bold uppercase tracking-[0.5em] text-right">// Support</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-400 text-[11px] font-bold uppercase tracking-widest hover:text-blue-500 transition-all">¿Quiénes somos?</a></li>
                        <li><a href="#" class="text-white text-[11px] font-black uppercase tracking-widest hover:text-blue-500 transition-all">Ayuda Online</a></li>
                        <li><a href="#" class="text-blue-500/50 text-[10px] font-mono uppercase tracking-widest hover:text-blue-400">API_DOCS_V1.2</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- BLOQUE 3: CIERRE DE SISTEMA Y REDES -->
        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
            <!-- Metadatos de Sistema -->
            <div class="flex items-center space-x-6 opacity-40">
                <span class="text-[8px] font-mono text-slate-500 tracking-tighter uppercase">© 2026 TACTIUM_STORAGE // DAW_PROJECT</span>
                <div class="h-3 w-px bg-white/10"></div>
                <span class="text-[8px] font-mono text-blue-500 uppercase">Build: Stable_1.2.0</span>
            </div>

            <!-- Redes Sociales con Brillo de Neón Individual -->
            <div class="flex items-center space-x-10">
                <a href="#" class="text-slate-400 hover:text-blue-500 hover:drop-shadow-[0_0_10px_#2563eb] transition-all transform hover:scale-125"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="text-slate-400 hover:text-red-600 hover:drop-shadow-[0_0_10px_#ef4444] transition-all transform hover:scale-125"><i class="fab fa-youtube text-xl"></i></a>
                <a href="#" class="text-slate-400 hover:text-blue-600 hover:drop-shadow-[0_0_10px_#2563eb] transition-all transform hover:scale-125"><i class="fab fa-facebook-f text-xl"></i></a>
                <a href="#" class="text-slate-400 hover:text-blue-400 hover:drop-shadow-[0_0_10px_#60a5fa] transition-all transform hover:scale-125"><i class="fab fa-x-twitter text-xl"></i></a>
            </div>
        </div>
    </div>
</footer>
