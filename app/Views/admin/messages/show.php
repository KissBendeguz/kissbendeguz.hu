<?php $title = 'Üzenet Megtekintése'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="max-w-4xl mx-auto">
    
    <!-- Actions Toolbar -->
    <div class="flex items-center gap-4 mb-6">
        <a href="/admin/messages" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white transition" title="Vissza">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        
        <div class="flex-1"></div>
        
        <a href="mailto:<?= e($message['email']) ?>" class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-500 transition flex items-center gap-2 font-medium">
            <i class="bi bi-reply-fill"></i> Válasz
        </a>
        
        <button onclick="alert('TODO: Törlés funckió implementálása')" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-800 text-red-400 hover:bg-red-400/10 transition" title="Törlés">
            <i class="bi bi-trash"></i>
        </button>
    </div>

    <!-- Message Content -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <!-- Header -->
        <div class="p-6 md:p-8 border-b border-white/5 bg-slate-800/20">
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-6 leading-tight"><?= e($message['subject'] ?? 'Nincs tárgy') ?></h1>
            
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-600 to-teal-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        <?= strtoupper(substr($message['name'], 0, 1)) ?>
                    </div>
                    <div>
                        <div class="font-bold text-white text-lg"><?= e($message['name']) ?></div>
                        <div class="text-slate-400 text-sm flex items-center gap-1">
                            &lt;<a href="mailto:<?= e($message['email']) ?>" class="hover:text-cyan-400 transition"><?= e($message['email']) ?></a>&gt;
                        </div>
                    </div>
                </div>
                
                <div class="text-right hidden sm:block">
                    <div class="text-slate-300 font-medium"><?= date('Y. M d.', strtotime($message['created_at'])) ?></div>
                    <div class="text-slate-500 text-sm"><?= date('H:i', strtotime($message['created_at'])) ?></div>
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="p-6 md:p-10 text-slate-300 leading-relaxed text-lg whitespace-pre-wrap font-light tracking-wide min-h-[300px]">
            <?= e($message['message']) ?>
        </div>

    </div>

</div>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
