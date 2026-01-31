<?php $title = 'Tanulmányok / Munka'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Idővonal (Tanulmányok)</h1>
    <a href="/admin/timeline/create" class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500 transition flex items-center gap-2 shadow-lg shadow-cyan-900/20">
        <i class="bi bi-plus-lg"></i> <span class="hidden sm:inline">Új Bejegyzés</span>
    </a>
</div>

<div class="space-y-4" id="timeline-container">
    <?php foreach ($timeline as $t): ?>
    <div class="bg-slate-900 border border-white/5 rounded-xl p-4 sm:p-6 hover:border-cyan-500/30 transition group relative timeline-card cursor-move" data-id="<?= $t['id'] ?>">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            
            <!-- Drag Handle & Year -->
            <div class="flex items-center gap-3 flex-shrink-0">
                <i class="bi bi-grip-vertical text-slate-600 group-hover:text-cyan-500 transition text-xl"></i>
                <span class="inline-block px-3 py-1 rounded text-sm font-bold bg-slate-800 text-cyan-400 border border-white/5 group-hover:border-cyan-500/30 transition">
                    <?= e($t['year']) ?>
                </span>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0 pl-2 sm:pl-0 border-l sm:border-l-0 border-slate-800">
                <div class="pl-3 sm:pl-0">
                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-400 transition"><?= e($t['title']) ?></h3>
                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                        <i class="bi bi-geo-alt"></i>
                        <?= e($t['place']) ?>
                    </div>
                    <?php if (!empty($t['description'])): ?>
                        <p class="text-slate-500 text-sm mt-2 line-clamp-2"><?= e($t['description']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mobile Actions -->
            <div class="flex items-center gap-2 mt-4 sm:mt-0 pt-4 sm:pt-0 border-t sm:border-t-0 border-white/5 sm:ml-auto">
                <div class="text-xs text-slate-500 font-mono bg-slate-950 px-2 py-1 rounded mr-auto sm:mr-4" title="Sorrend">#<?= e($t['sort_order']) ?></div>
                
                <a href="/admin/timeline/edit?id=<?= $t['id'] ?>" class="flex-1 sm:flex-none py-2 sm:py-0 w-auto sm:w-8 h-8 rounded bg-slate-800 text-cyan-400 flex items-center justify-center hover:bg-cyan-500 hover:text-white transition gap-2 sm:gap-0 font-bold sm:font-normal text-sm sm:text-base">
                    <i class="bi bi-pencil-fill text-xs"></i> <span class="sm:hidden">Szerkesztés</span>
                </a>
                <a href="/admin/timeline/delete?id=<?= $t['id'] ?>" onclick="return confirm('Biztosan törlöd?')" class="w-10 sm:w-8 h-8 rounded bg-slate-800 text-red-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition" title="Törlés">
                    <i class="bi bi-trash-fill text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if (empty($timeline)): ?>
<div class="text-center py-20 bg-slate-900 border border-white/5 rounded-xl">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6">
        <i class="bi bi-calendar3 text-4xl opacity-30 text-white"></i>
    </div>
    <p class="text-slate-500 font-medium">Nincs még feltöltött bejegyzés.</p>
</div>
<?php endif; ?>

<script>
    new Sortable(document.getElementById('timeline-container'), {
        animation: 150,
        ghostClass: 'opacity-50',
        onEnd: function (evt) {
            const order = [];
            document.querySelectorAll('.timeline-card').forEach((card, index) => {
                order.push({
                    id: card.dataset.id,
                    position: index
                });
            });

            fetch('/admin/timeline/reorder', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ order, csrf_token: '<?= csrf_token() ?>' })
            }).then(res => res.json()).then(data => {
                if(!data.success) alert('Hiba a mentésnél!');
            });
        }
    });
</script>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
