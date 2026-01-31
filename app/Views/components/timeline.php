<section id="tanulmanyok" class="py-20 bg-slate-900/30">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-12 text-center reveal">
            <h2 class="text-3xl font-bold text-white mb-4">Tanulmányok</h2>
            <p class="text-slate-400">Stabil alapok + folyamatos önfejlesztés.</p>
        </div>

        <div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:h-full before:w-0.5 before:-translate-x-px before:bg-gradient-to-b before:from-transparent before:via-slate-700 before:to-transparent md:before:mx-auto md:before:translate-x-0 reveal">
            <?php foreach ($timeline as $index => $item): ?>
            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                <div class="absolute left-0 h-10 w-10 rounded-full border-4 border-slate-900 bg-slate-800 shadow-md md:left-1/2 md:-translate-x-1/2 flex items-center justify-center z-10 group-first:ring-4 ring-cyan-500/20 group-first:bg-cyan-600">
                    <div class="h-2 w-2 rounded-full bg-white opacity-80"></div>
                </div>
                
                    <h3 class="text-lg font-bold text-white"><?= e($item['title']) ?></h3>
                    <div class="text-slate-400 text-sm font-medium mb-2"><?= e($item['place']) ?></div>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        <?= e($item['description']) ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
