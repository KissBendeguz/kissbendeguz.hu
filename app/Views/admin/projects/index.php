<?php $title = 'Projektek'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Projektek</h1>
    <a href="/admin/projects/create" class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500 transition flex items-center gap-2 shadow-lg shadow-cyan-900/20">
        <i class="bi bi-plus-lg"></i> <span class="hidden sm:inline">Új Projekt</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="projects-grid">
    <?php foreach ($projects as $p): ?>
    <div class="bg-slate-900 border border-white/5 rounded-2xl overflow-hidden group hover:border-cyan-500/30 transition flex flex-col project-card" data-id="<?= $p['id'] ?>">
        <!-- Image & Drag Handle Overlay -->
        <div class="h-48 bg-slate-800 relative overflow-hidden cursor-move handle">
             <?php 
                $imagePath = $p['image'];
                if (!empty($p['image']) && strpos($p['image'], 'assets/') === false) {
                        $imagePath = 'assets/img/' . $p['image'];
                }
            ?>
            <?php if (!empty($p['image'])): ?>
                <img src="<?= asset($imagePath) ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 pointer-events-none">
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center bg-slate-800 text-slate-700">
                    <i class="bi bi-image text-4xl"></i>
                </div>
            <?php endif; ?>
            
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">
                <i class="bi bi-grip-vertical text-white/50 opacity-0 group-hover:opacity-100 text-3xl drop-shadow-lg"></i>
            </div>
            
             <div class="absolute bottom-4 left-4">
                <span class="px-2 py-1 rounded text-xs font-bold uppercase tracking-wider bg-black/50 text-white backdrop-blur-md border border-white/10">
                    <?= e($p['status']) ?>
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 flex-1 flex flex-col">
            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-cyan-400 transition"><?= e($p['name']) ?></h3>
            
            <div class="flex flex-wrap gap-2 mb-6">
                <?php 
                $stack = json_decode($p['tech_stack'], true) ?? [];
                foreach (array_slice($stack, 0, 4) as $tech): 
                ?>
                    <span class="text-xs text-slate-400 bg-slate-800 px-2 py-1 rounded border border-white/5"><?= e($tech) ?></span>
                <?php endforeach; ?>
                <?php if (count($stack) > 4): ?>
                    <span class="text-xs text-slate-500 px-1">+<?= count($stack) - 4 ?></span>
                <?php endif; ?>
            </div>

            <!-- Mobile-Friendly Actions -->
            <div class="flex items-center gap-3 mt-auto pt-4 border-t border-white/5">
                <div class="text-xs text-slate-500 font-mono bg-slate-950 px-2 py-1 rounded mr-auto" title="Sorrend">#<?= e($p['sort_order']) ?></div>
                
                <a href="/admin/projects/edit?id=<?= $p['id'] ?>" class="flex-1 py-2 rounded bg-slate-800 text-cyan-400 font-bold text-sm flex items-center justify-center gap-2 hover:bg-cyan-500 hover:text-white transition">
                    <i class="bi bi-pencil-fill text-xs"></i> Szerkesztés
                </a>
                <a href="/admin/projects/delete?id=<?= $p['id'] ?>" onclick="return confirm('Biztosan törlöd?')" class="w-10 py-2 rounded bg-slate-800 text-red-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition" title="Törlés">
                    <i class="bi bi-trash-fill text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if (empty($projects)): ?>
<div class="text-center py-20 bg-slate-900 border border-white/5 rounded-xl">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6">
        <i class="bi bi-folder text-4xl opacity-30 text-white"></i>
    </div>
    <p class="text-slate-500 font-medium">Nincs még feltöltött projekt.</p>
</div>
<?php endif; ?>

<script>
    new Sortable(document.getElementById('projects-grid'), {
        animation: 150,
        handle: '.handle',
        ghostClass: 'opacity-50',
        onEnd: function (evt) {
            const order = [];
            document.querySelectorAll('.project-card').forEach((card, index) => {
                order.push({
                    id: card.dataset.id,
                    position: index
                });
            });

            fetch('/admin/projects/reorder', {
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
