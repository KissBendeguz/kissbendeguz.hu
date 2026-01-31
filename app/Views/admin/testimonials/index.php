<?php $title = 'Vélemények'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Vélemények</h1>
    <a href="/admin/testimonials/create" class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500 transition flex items-center gap-2 shadow-lg shadow-cyan-900/20">
        <i class="bi bi-plus-lg"></i> <span class="hidden sm:inline">Új Vélemény</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="testimonials-grid">
    <?php foreach ($testimonials as $t): ?>
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 relative group hover:border-amber-500/30 transition flex flex-col testimonial-card cursor-move handle" data-id="<?= $t['id'] ?>">
        
        <!-- Drag Handle Indicator -->
        <div class="absolute top-4 right-4 z-20">
             <i class="bi bi-grip-vertical text-slate-600 group-hover:text-amber-500 transition text-xl drop-shadow-md"></i>
        </div>

        <!-- Quote Icon -->
        <i class="bi bi-quote absolute top-6 right-8 text-4xl text-white/5 group-hover:text-amber-500/10 transition z-0"></i>

        <div class="flex-1 mb-6 relative z-10 pr-6">
            <p class="text-slate-300 italic text-sm leading-relaxed line-clamp-4 pointer-events-none">
                "<?= e($t['text']) ?>"
            </p>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-white/5 mt-auto relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center font-bold text-slate-500 border border-white/5 group-hover:text-amber-500 transition pointer-events-none">
                    <?= substr($t['author'], 0, 1) ?>
                </div>
                <div>
                    <div class="text-white font-bold text-sm group-hover:text-amber-400 transition pointer-events-none"><?= e($t['author']) ?></div>
                    <div class="text-slate-500 text-xs truncate max-w-[120px] pointer-events-none"><?= e($t['role']) ?></div>
                </div>
            </div>

            <div class="flex gap-1">
                 <a href="/admin/testimonials/edit?id=<?= $t['id'] ?>" class="w-8 h-8 rounded bg-slate-800 text-cyan-400 flex items-center justify-center hover:bg-cyan-500 hover:text-white transition" title="Szerkesztés">
                    <i class="bi bi-pencil-fill text-xs"></i>
                </a>
                <a href="/admin/testimonials/delete?id=<?= $t['id'] ?>" onclick="return confirm('Biztosan törlöd?')" class="w-8 h-8 rounded bg-slate-800 text-red-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition" title="Törlés">
                    <i class="bi bi-trash-fill text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if (empty($testimonials)): ?>
<div class="text-center py-20 bg-slate-900 border border-white/5 rounded-xl">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6">
        <i class="bi bi-chat-quote text-4xl opacity-30 text-white"></i>
    </div>
    <p class="text-slate-500 font-medium">Nincs még feltöltött vélemény.</p>
</div>
<?php endif; ?>

<script>
    new Sortable(document.getElementById('testimonials-grid'), {
        animation: 150,
        handle: '.handle',
        ghostClass: 'opacity-50',
        onEnd: function (evt) {
            const order = [];
            document.querySelectorAll('.testimonial-card').forEach((card, index) => {
                order.push({
                    id: card.dataset.id,
                    position: index
                });
            });

            fetch('/admin/testimonials/reorder', {
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
