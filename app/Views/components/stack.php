<!-- STACK -->
<section id="stack" class="py-32 bg-slate-950/30">
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-16 reveal text-center">
             <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold tracking-wide uppercase mb-4">
                <i class="bi bi-code-slash"></i> Tech Stack
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Általam használt <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">technológiák</span></h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg">
                Modern eszközök, keretrendszerek és könyvtárak, amelyekkel gyors, skálázható és stabil rendszereket építek.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $icons = [
                'Frontend' => 'bi-window-fullscreen',
                'Backend' => 'bi-server',
                'Frameworks' => 'bi-box-seam',
                'Tools' => 'bi-tools',
                'Egyéb' => 'bi-layers'
            ];
            $colors = [
                'Frontend' => 'cyan',
                'Backend' => 'emerald',
                'Frameworks' => 'indigo',
                'Tools' => 'amber',
                'Egyéb' => 'slate'
            ];
            ?>
            <?php foreach ($stack as $category => $items): 
                $icon = $icons[$category] ?? 'bi-code-square';
                $color = $colors[$category] ?? 'cyan';
                $bgClass = "bg-{$color}-500/10";
                $textClass = "text-{$color}-400";
                $borderClass = "group-hover:border-{$color}-500/30";
            ?>
            <div class="group bg-slate-900/50 backdrop-blur-sm border border-white/5 rounded-2xl p-8 hover:bg-slate-900 transition duration-300 reveal hover:-translate-y-1 hover:shadow-2xl hover:shadow-cyan-900/10 <?= $borderClass ?>">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl <?= $bgClass ?> flex items-center justify-center <?= $textClass ?> text-2xl group-hover:scale-110 transition duration-300">
                        <i class="bi <?= $icon ?>"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white"><?= e($category) ?></h3>
                </div>
                
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($items as $item): ?>
                        <span class="px-3 py-1.5 rounded-lg bg-slate-950/50 border border-white/5 text-slate-300 text-sm hover:border-white/20 hover:text-white hover:bg-white/5 transition cursor-default">
                            <?= e($item) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
