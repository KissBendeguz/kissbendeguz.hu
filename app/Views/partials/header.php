<header class="fixed top-0 w-full z-50 transition-all duration-300 backdrop-blur-md bg-slate-950/70 border-b border-white/10" id="main-header">
    <div class="max-w-6xl mx-auto px-4 lg:px-6">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="/" class="text-xl font-bold tracking-tight text-white flex items-center gap-2 group">
                <img src="<?= asset('assets/img/logo.png') ?>" alt="KB Logo" class="w-10 h-10 object-contain transition duration-300" 
                     style="filter: brightness(0) saturate(100%) invert(81%) sepia(29%) saturate(885%) hue-rotate(169deg) brightness(97%) contrast(98%);">
                <span class="hidden sm:inline group-hover:text-cyan-400 transition">Kiss Bendegúz</span>
                <style>
                    .group:hover img {
                         filter: none !important; /* Back to white on hover */
                    }
                </style>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#projektek" class="text-sm font-medium text-slate-300 hover:text-cyan-400 transition">Referenciák</a>
                <a href="#stack" class="text-sm font-medium text-slate-300 hover:text-cyan-400 transition">Stack</a>
                <a href="#tanulmanyok" class="text-sm font-medium text-slate-300 hover:text-cyan-400 transition">Tanulmányok</a>
                <a href="#velemenyek" class="text-sm font-medium text-slate-300 hover:text-cyan-400 transition">Vélemények</a>
                <a href="#kapcsolat" class="px-4 py-2 text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-500 rounded-lg transition shadow-lg shadow-cyan-500/20">
                    Dolgozzunk együtt
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-300 hover:text-white focus:outline-none" aria-label="Menü megnyitása">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="hidden absolute top-16 left-0 w-full bg-slate-900 border-b border-white/10 p-4 shadow-2xl md:hidden">
        <nav class="flex flex-col space-y-4">
            <a href="#projektek" class="block text-slate-300 hover:text-cyan-400 px-2 py-1">Referenciák</a>
            <a href="#stack" class="block text-slate-300 hover:text-cyan-400 px-2 py-1">Stack</a>
            <a href="#tanulmanyok" class="block text-slate-300 hover:text-cyan-400 px-2 py-1">Tanulmányok</a>
            <a href="#velemenyek" class="block text-slate-300 hover:text-cyan-400 px-2 py-1">Vélemények</a>
            <a href="#kapcsolat" class="block text-center px-4 py-3 bg-cyan-600 text-white rounded-lg font-medium">Dolgozzunk együtt</a>
        </nav>
    </div>
</header>
