<?php $title = 'Új Projekt'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/projects" class="text-slate-400 hover:text-white">&larr; Vissza</a>
        <h1 class="text-2xl font-bold text-white">Új Projekt</h1>
    </div>

    <form action="/admin/projects/store" method="POST" class="space-y-6 bg-slate-900 p-8 rounded-xl border border-white/5">
        <?= csrf_field() ?>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Projekt Neve</label>
                <input type="text" name="name" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Slug (URL barát név)</label>
                <input type="text" name="slug" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-400 mb-2">Leírás</label>
            <textarea name="description" rows="3" required class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none"></textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Státusz</label>
                <select name="status" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
                    <option value="Éles">Éles</option>
                    <option value="Fejlesztés alatt">Fejlesztés alatt</option>
                    <option value="Prototípus">Prototípus</option>
                    <option value="Egyetemi projekt">Egyetemi projekt</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Demo URL</label>
                <input type="text" name="url" value="#" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-400 mb-2">Technológiák (vesszővel elválasztva)</label>
            <input type="text" name="tech_stack" placeholder="PHP, Tailwind, MySQL" class="w-full bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none">
        </div>

        <div>
             <label class="block text-sm font-medium text-slate-400 mb-2">Kép</label>
             <div class="flex gap-4">
                 <input type="text" name="image" id="image_input" class="flex-1 bg-slate-950 border border-white/10 rounded px-4 py-2 text-white focus:border-cyan-500 outline-none" placeholder="assets/img/...">
                 <button type="button" onclick="openMediaModal('image_input', 'image_preview')" class="px-4 py-2 bg-slate-800 text-white rounded border border-white/10 hover:bg-slate-700">Kiválasztás</button>
             </div>
             <img id="image_preview" src="" class="mt-4 h-32 rounded border border-white/10 hidden object-cover">
        </div>

        <div class="pt-4 border-t border-white/5 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold rounded hover:from-cyan-500 hover:to-teal-500 transition">Mentés</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
