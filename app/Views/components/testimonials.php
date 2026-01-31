<section id="velemenyek" class="py-32 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-slate-900 to-transparent opacity-50 z-0 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-500/5 rounded-full blur-[100px] z-0 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="mb-16 reveal text-center">
             <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-semibold tracking-wide uppercase mb-4">
                <i class="bi bi-star-fill"></i> Visszajelzések
            </div>
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Mások mondták <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500">rólam</span></h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($testimonials as $t): ?>
            <div class="group bg-slate-900 border border-white/5 rounded-2xl p-8 relative hover:border-amber-500/30 transition duration-500 hover:shadow-[0_10px_40px_-10px_rgba(251,191,36,0.1)] reveal flex flex-col">    
                <div class="absolute top-6 right-8 text-6xl text-white/5 font-serif leading-none group-hover:text-amber-500/10 transition duration-500">”</div>
                
                <div class="flex-1 mb-8 relative z-10">
                    <div class="flex gap-1 text-amber-500 mb-4 text-sm">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-slate-300 leading-relaxed italic text-lg">
                        <?= e($t['text']) ?>
                    </p>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-white/5">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center font-bold text-slate-400 border border-white/10 group-hover:border-amber-500/30 group-hover:text-amber-400 transition duration-300">
                        <?= substr($t['author'], 0, 1) ?>
                    </div>
                    <div>
                        <div class="text-white font-bold group-hover:text-amber-400 transition duration-300"><?= e($t['author']) ?></div>
                        <div class="text-slate-500 text-xs font-medium uppercase tracking-wider"><?= e($t['role']) ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
