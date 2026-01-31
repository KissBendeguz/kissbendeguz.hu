<?php $title = 'Stack (Technológiák)'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <h1 class="text-2xl font-bold text-white">Technológiák (Stack)</h1>
    <button onclick="openModal('new-cat-modal')" class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500 transition w-full sm:w-auto flex items-center justify-center gap-2 shadow-lg shadow-cyan-900/20">
        <i class="bi bi-plus-lg"></i> Új Kategória
    </button>
</div>

<!-- Main Grid -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="categories-container">
    <?php foreach ($stack as $cat): ?>
    <div class="bg-slate-900 border border-white/5 rounded-2xl flex flex-col shadow-lg" data-cat-id="<?= $cat['id'] ?>">
        
        <!-- Category Header -->
        <div class="p-4 border-b border-white/5 flex justify-between items-center bg-slate-900/50 rounded-t-2xl handle-cat cursor-move group">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <i class="bi bi-grip-vertical text-slate-600 group-hover:text-cyan-500 transition"></i>
                <?= e($cat['name']) ?> 
            </h3>
            <a href="/admin/stack/delete-category?id=<?= $cat['id'] ?>" onclick="return confirm('Biztosan törlöd a kategóriát és minden elemet?')" class="w-8 h-8 rounded bg-slate-800 text-red-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition">
                <i class="bi bi-trash-fill text-xs"></i>
            </a>
        </div>
        
        <!-- Items List (Sortable) -->
        <div class="p-4 flex-1 space-y-2 items-container min-h-[50px]" data-cat-id="<?= $cat['id'] ?>">
            <?php foreach ($cat['items'] as $item): ?>
            <div class="flex justify-between items-center bg-slate-950 px-3 py-2.5 rounded-lg border border-white/5 hover:border-cyan-500/30 transition group cursor-move item-card" data-item-id="<?= $item['id'] ?>">
                <div class="flex items-center gap-2">
                    <i class="bi bi-grip-vertical text-slate-600 group-hover:text-cyan-500 transition"></i>
                    <span class="text-slate-300 font-medium"><?= e($item['name']) ?></span>
                </div>
                <a href="/admin/stack/delete-item?id=<?= $item['id'] ?>" class="text-slate-500 hover:text-red-400 opacity-0 group-hover:opacity-100 transition px-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Add Item Footer -->
        <div class="p-4 border-t border-white/5 bg-slate-900/50 rounded-b-2xl">
            <form action="/admin/stack/store-item" method="POST" class="flex gap-2 relative">
                <?= csrf_field() ?>
                <input type="hidden" name="category_id" value="<?= $cat['id'] ?>">
                <div class="relative flex-1">
                     <i class="bi bi-plus absolute left-3 top-1/2 -translate-y-1/2 text-slate-500"></i>
                     <input type="text" name="name" required placeholder="Új elem..." class="w-full bg-slate-950 border border-white/10 rounded-lg pl-8 pr-3 py-2 text-sm text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition">
                </div>
                <button type="submit" class="px-3 py-2 bg-slate-800 text-cyan-400 rounded-lg hover:bg-cyan-600 hover:text-white transition border border-white/5">
                    Hozzáad
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- New Category Modal -->
<div id="new-cat-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-slate-900 border border-white/10 rounded-2xl p-6 w-full max-w-sm shadow-2xl relative animate-scale-in">
        <button onclick="closeModal('new-cat-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-white">
            <i class="bi bi-x-lg"></i>
        </button>
        <h3 class="text-xl font-bold text-white mb-6">Új Kategória</h3>
        <form action="/admin/stack/store-category" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Kategória neve</label>
                <input type="text" name="name" required class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-500 outline-none">
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModal('new-cat-modal')" class="px-4 py-2 text-slate-400 hover:text-white transition font-medium">Mégse</button>
                <button type="submit" class="px-6 py-2 bg-cyan-600 text-white rounded-xl hover:bg-cyan-500 transition font-bold shadow-lg shadow-cyan-900/20">Létrehozás</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Utils
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

    // Init Sortable for Items (Drag & Drop)
    document.querySelectorAll('.items-container').forEach(el => {
        new Sortable(el, {
            group: 'items', // Allow moving between categories
            animation: 150,
            handle: '.item-card',
            ghostClass: 'opacity-50',
            onEnd: function (evt) {
                updateItemOrder();
            }
        });
    });

    // Init Sortable for Categories
    new Sortable(document.getElementById('categories-container'), {
         animation: 150,
         handle: '.handle-cat',
         ghostClass: 'opacity-50',
         onEnd: function (evt) {
             updateCategoryOrder();
         }
    });

    function updateItemOrder() {
        const order = [];
        document.querySelectorAll('.items-container').forEach(container => {
            const catId = container.dataset.catId;
            const items = container.querySelectorAll('.item-card');
            items.forEach((item, index) => {
                order.push({
                    id: item.dataset.itemId,
                    category_id: catId,
                    position: index
                });
            });
        });

        // Send to server
        fetch('/admin/stack/reorder-items', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ order, csrf_token: '<?= csrf_token() ?>' })
        }).then(res => res.json()).then(data => {
            if(!data.success) alert('Hiba a mentésnél!');
        });
    }

    function updateCategoryOrder() {
        const order = [];
        const cats = document.querySelectorAll('[data-cat-id]');
        cats.forEach((cat, index) => {
            order.push({
                id: cat.dataset.catId,
                position: index
            });
        });

         fetch('/admin/stack/reorder-categories', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ order, csrf_token: '<?= csrf_token() ?>' })
        }).then(res => res.json()).then(data => {
            if(!data.success) alert('Hiba a mentésnél!');
        });
    }
</script>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
