<?php $title = 'Projekt Szerkesztése'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/projects" class="text-slate-400 hover:text-white flex items-center gap-2"><i class="bi bi-arrow-left"></i> Vissza</a>
        <h1 class="text-2xl font-bold text-white">Projekt Szerkesztése</h1>
    </div>

    <form action="/admin/projects/update" method="POST" class="space-y-6 bg-slate-900 p-6 md:p-8 rounded-xl border border-white/5">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $project['id'] ?>">

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Projekt Neve</label>
                <input type="text" name="name" value="<?= e($project['name']) ?>" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Slug</label>
                <input type="text" name="slug" value="<?= e($project['slug']) ?>" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-400 mb-2">Leírás</label>
            <textarea name="description" rows="3" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none"><?= e($project['description']) ?></textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Státusz</label>
                <select name="status" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
                    <option value="Éles" <?= $project['status'] === 'Éles' ? 'selected' : '' ?>>Éles</option>
                    <option value="Fejlesztés alatt" <?= $project['status'] === 'Fejlesztés alatt' ? 'selected' : '' ?>>Fejlesztés alatt</option>
                    <option value="Prototípus" <?= $project['status'] === 'Prototípus' ? 'selected' : '' ?>>Prototípus</option>
                    <option value="Egyetemi projekt" <?= $project['status'] === 'Egyetemi projekt' ? 'selected' : '' ?>>Egyetemi projekt</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Demo URL</label>
                <input type="text" name="url" value="<?= e($project['url']) ?>" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-400 mb-2">Technológiák (vesszővel elválasztva)</label>
            <?php 
            $stack = json_decode($project['tech_stack'], true) ?? [];
            $stackStr = implode(', ', $stack);
            ?>
            <input type="text" name="tech_stack" value="<?= e($stackStr) ?>" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
        </div>

        <div class="grid md:grid-cols-2 gap-6">
             <div>
                 <label class="block text-sm font-medium text-slate-400 mb-2">Kép</label>
                 <div class="flex gap-2">
                     <input type="text" name="image" id="image_input" value="<?= e($project['image']) ?>" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
                     <button type="button" onclick="openMediaModal('image_input', 'image_preview')" class="px-4 py-2 bg-slate-800 text-white rounded border border-white/10 hover:bg-slate-700 whitespace-nowrap">Kép +</button>
                 </div>
                 <?php 
                    $previewPath = $project['image'];
                    if (!empty($previewPath) && strpos($previewPath, 'assets/') === false) {
                        $previewPath = 'assets/img/' . $previewPath;
                    }
                 ?>
                 <img id="image_preview" src="<?= asset($previewPath) ?>" class="mt-4 h-32 rounded border border-white/10 <?= $project['image'] ? '' : 'hidden' ?> object-cover">
            </div>
             <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Sorrend</label>
                <input type="number" name="sort_order" value="<?= e($project['sort_order']) ?>" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div class="pt-4 border-t border-white/5 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold rounded hover:from-cyan-500 hover:to-teal-500 transition shadow-lg shadow-cyan-900/20">Frissítés</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
