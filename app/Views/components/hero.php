<section class="relative min-h-[100dvh] flex items-center justify-center px-4 overflow-hidden" id="home">
    
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[120px] opacity-60"></div>
    </div>

    <div class="max-w-7xl w-full mx-auto grid lg:grid-cols-2 gap-12 sm:gap-16 items-center relative z-10 pt-20 lg:pt-0">
        
        <div class="space-y-8 lg:space-y-10 reveal text-center lg:text-left order-2 lg:order-1">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-800/50 border border-green-500/20 text-green-400 text-xs sm:text-sm font-semibold tracking-wide uppercase backdrop-blur-sm">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                </span>
                Elérhető projektekre • <?= date('Y') ?>
            </div>
        
            <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-extrabold text-white tracking-tight leading-[1.1]">
                <?= e($settings['site_name'] ?? 'Kiss Bendegúz') ?>
                <span class="block p-2 text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-teal-400 to-emerald-400 mt-2 lg:mt-4">
                    <?= e($settings['site_tagline'] ?? 'Full Stack Developer') ?>
                </span>
            </h1>
        
            <p class="text-lg sm:text-xl text-slate-400 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-light">
                <?= e($settings['seo_description'] ?? 'Prémium webes megoldások tervezése és fejlesztése. A vizuális élmény és a technikai precizitás találkozása.') ?>
            </p>
        
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="#projektek" class="px-8 py-4 rounded-full bg-cyan-600 text-white font-bold tracking-wide hover:bg-cyan-500 transition shadow-[0_0_40px_rgba(8,145,178,0.4)] hover:shadow-[0_0_60px_rgba(8,145,178,0.6)] hover:-translate-y-1 transform duration-300">
                    Munkáim
                </a>
                <a href="#kapcsolat" class="px-8 py-4 rounded-full border border-white/10 bg-white/5 text-white font-medium hover:bg-white/10 transition backdrop-blur-md hover:-translate-y-1 transform duration-300">
                    Kapcsolatfelvétel
                </a>
            </div>

            <div class="flex items-center justify-center lg:justify-start gap-8 text-sm text-slate-500 font-medium pt-8 border-t border-white/5">
                <div class="flex items-center gap-2">
                    <i class="bi bi-display text-cyan-400 text-lg"></i> 
                    <span>Reszponzív UI</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="bi bi-hdd-network text-cyan-400 text-lg"></i>
                    <span>Stabil Backend</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="bi bi-speedometer2 text-cyan-400 text-lg"></i>
                    <span>Gyorsaság</span>
                </div>
            </div>
        </div>

        <div class="relative order-1 lg:order-2 flex justify-center items-center">
            <div class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-[500px] lg:h-[500px]">
                
                <div class="absolute inset-0 rounded-full border border-cyan-500/20 animate-spin-slower"></div>
                <div class="absolute inset-4 rounded-full border border-emerald-500/20 animate-spin-reverse-slower"></div>
                
                <div class="absolute inset-10 bg-gradient-to-tr from-cyan-500/30 to-emerald-500/30 rounded-full blur-[60px] animate-pulse-slow"></div>

                <div class="absolute inset-8 sm:inset-10 lg:inset-12 rounded-full overflow-hidden border-2 border-white/10 shadow-2xl relative z-10 group">
                     <img src="<?= asset('assets/img/profile.jpg') ?>" alt="Profilkép" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                     <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                </div>

                <div class="absolute top-10 right-0 sm:right-4 lg:right-10 bg-slate-900/80 backdrop-blur-md border border-white/10 p-3 rounded-2xl shadow-xl animate-float z-20">
                     <i class="bi bi-code-slash text-2xl text-cyan-400"></i>
                </div>
                <div class="absolute bottom-10 left-0 sm:left-4 lg:left-10 bg-slate-900/80 backdrop-blur-md border border-white/10 p-3 rounded-2xl shadow-xl animate-float z-20" style="animation-delay: 1.5s">
                     <i class="bi bi-database text-2xl text-emerald-400"></i>
                </div>
                 <div class="absolute top-1/2 -left-4 sm:-left-8 lg:-left-12 bg-slate-900/80 backdrop-blur-md border border-white/10 px-4 py-2 rounded-full shadow-xl animate-float z-20 hidden sm:block" style="animation-delay: 2.5s">
                     <span class="text-xs font-bold text-slate-300">7+ Év Tapasztalat</span>
                </div>

            </div>
        </div>

    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce hidden lg:block">
        <a href="#projektek" class="text-slate-500 hover:text-white transition">
            <i class="bi bi-chevron-down text-2xl"></i>
        </a>
    </div>
</section>
