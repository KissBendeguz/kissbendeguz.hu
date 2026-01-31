<?php $title = 'Média Könyvtár'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <h1 class="text-2xl font-bold text-white">Média Könyvtár</h1>
    <form action="/admin/media/upload" method="POST" enctype="multipart/form-data" class="flex gap-2 w-full sm:w-auto">
        <?= csrf_field() ?>
        <input type="file" name="file" required class="flex-1 sm:w-64 bg-slate-950 border border-white/10 rounded px-4 py-2 text-slate-400 focus:border-cyan-500 outline-none file:mr-4 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20">
        <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500 transition whitespace-nowrap">
            <i class="bi bi-upload"></i> <span class="hidden sm:inline">Feltöltés</span>
        </button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
    <?php foreach ($media as $m): ?>
    <div class="bg-slate-900 border border-white/5 rounded-lg overflow-hidden flex flex-col group">
        <!-- Image Container -->
        <div class="aspect-square w-full bg-slate-800 relative overflow-hidden">
            <img src="<?= asset($m['filepath']) ?>" loading="lazy" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
        </div>
        
        <!-- Info & Actions -->
        <div class="p-3 bg-slate-900 border-t border-white/5 flex flex-col gap-2">
            <p class="text-xs text-slate-400 truncate" title="<?= e($m['filename']) ?>">
                <?= e($m['filename']) ?>
            </p>
            <div class="flex justify-between items-center gap-2">
                <button onclick="navigator.clipboard.writeText('<?= asset($m['filepath']) ?>'); alert('Link másolva!')" class="flex-1 py-1.5 bg-slate-800 hover:bg-slate-700 text-cyan-400 text-xs rounded transition text-center" title="Link másolása">
                    <i class="bi bi-link-45deg text-sm"></i>
                </button>
                <a href="/admin/media/delete?id=<?= $m['id'] ?>" onclick="return confirm('Biztosan törlöd?')" class="flex-1 py-1.5 bg-slate-800 hover:bg-red-900/30 text-red-400 text-xs rounded transition text-center" title="Törlés">
                    <i class="bi bi-trash text-sm"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
