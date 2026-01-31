<section id="projektek" class="py-20 bg-slate-950/50 relative">
    <div class="max-w-6xl mx-auto px-4">
        <div class="mb-12 reveal">
            <h2 class="text-3xl font-bold text-white mb-4">Referenciák</h2>
            <p class="text-slate-400 max-w-2xl text-lg">Valós rendszerek és prototípusok — fókuszban a tiszta UI és stabil backend.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <?php foreach ($projects as $proj): ?>
            <div class="group relative bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-2xl hover:shadow-cyan-900/20 reveal">
                <div class="h-48 bg-slate-800 relative overflow-hidden group">
                    <?php 
                    $imagePath = 'assets/img/' . $proj['image']; 
                    if (strpos($proj['image'], 'assets/uploads/') === 0) {
                        $imagePath = $proj['image']; 
                    }
                    
                    $fullPath = __DIR__ . '/../../../public/' . $imagePath;
                    
                    if (!empty($proj['image']) && (file_exists($fullPath) || strpos($proj['image'], '/') !== false)): 
                    ?>
                        <img src="<?= asset($imagePath) ?>" alt="<?= e($proj['name']) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-slate-900/20 group-hover:bg-transparent transition-colors duration-300"></div>
                    <?php else: ?>
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center text-slate-700 font-bold text-4xl group-hover:scale-105 transition duration-500">
                            <?= substr($proj['name'], 0, 1) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-white group-hover:text-cyan-400 transition"><?= e($proj['name']) ?></h3>
                        <span class="px-2 py-0.5 rounded text-xs font-medium bg-white/5 text-slate-400 border border-white/10">
                            <?= e($proj['status']) ?>
                        </span>
                    </div>
                    
                    <p class="text-slate-400 text-sm mb-6 leading-relaxed">
                        <?= e($proj['description']) ?>
                    </p>

                    <div class="flex flex-wrap gap-2 mb-6">
                        <?php 
                        $techStack = json_decode($proj['tech_stack'], true) ?? [];
                        foreach ($techStack as $t): 
                        ?>
                            <span class="text-xs text-cyan-200/80 bg-cyan-950/50 px-2 py-1 rounded border border-cyan-500/20"><?= e($t) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <a href="<?= e($proj['url']) ?>" class="inline-flex items-center text-sm font-medium text-white hover:text-cyan-400 transition">
                        Részletek <span aria-hidden="true" class="ml-1">&rarr;</span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
