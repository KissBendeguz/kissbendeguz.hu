<?php $title = 'Vélemény Szerkesztése'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/testimonials" class="text-slate-400 hover:text-white">&larr; Vissza</a>
        <h1 class="text-2xl font-bold text-white">Vélemény Szerkesztése</h1>
    </div>

    <form action="/admin/testimonials/update" method="POST" class="space-y-6 bg-slate-900 p-8 rounded-xl border border-white/5">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $item['id'] ?>">

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Szerző Neve</label>
                <input type="text" name="author" value="<?= e($item['author']) ?>" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
             <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Szerepkör (pl. Ügyfél)</label>
                <input type="text" name="role" value="<?= e($item['role']) ?>" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-400 mb-2">Vélemény Szövege</label>
            <textarea name="text" rows="4" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none"><?= e($item['text']) ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-400 mb-2">Sorrend</label>
            <input type="number" name="sort_order" value="<?= e($item['sort_order']) ?>" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
        </div>

        <div class="pt-4 border-t border-white/5 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold rounded hover:from-cyan-500 hover:to-teal-500 transition">Frissítés</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
