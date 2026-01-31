<?php $title = 'Üzenetek'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Üzenetek</h1>
</div>

<div class="space-y-4">
    <?php foreach ($messages as $msg): ?>
    <div onclick="window.location='/admin/messages/show?id=<?= $msg['id'] ?>'" 
        class="block bg-slate-900 border border-white/5 rounded-xl p-4 hover:border-cyan-500/30 transition cursor-pointer relative group <?= $msg['status'] === 'new' ? 'bg-slate-800/40 shadow-lg shadow-cyan-900/5' : '' ?>">
        
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
            
            <!-- Status Indicator -->
            <div class="flex-shrink-0">
                <?php if ($msg['status'] === 'new'): ?>
                    <div class="w-3 h-3 rounded-full bg-cyan-500 animate-pulse ring-4 ring-cyan-500/20"></div>
                <?php else: ?>
                     <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                <?php endif; ?>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0 grid sm:grid-cols-12 gap-2 sm:gap-6 items-center w-full">
                
                <!-- Sender -->
                <div class="sm:col-span-3">
                    <div class="text-white font-bold truncate pr-2 <?= $msg['status'] === 'new' ? 'text-lg sm:text-base' : '' ?>"><?= e($msg['name']) ?></div>
                    <div class="text-xs text-slate-500 truncate"><?= e($msg['email']) ?></div>
                </div>

                <!-- Subject & Preview -->
                <div class="sm:col-span-6">
                    <div class="text-slate-300 font-medium truncate mb-0.5 <?= $msg['status'] === 'new' ? 'text-white' : '' ?>">
                        <?= e($msg['subject'] ?? 'Nincs tárgy') ?>
                    </div>
                    <div class="text-sm text-slate-500 truncate">
                        <?= e(strip_tags($msg['message'] ?? '')) ?>
                    </div>
                </div>

                <!-- Date -->
                <div class="sm:col-span-3 text-left sm:text-right">
                    <div class="text-sm text-slate-400 font-mono">
                        <?= date('M d.', strtotime($msg['created_at'])) ?>
                        <span class="text-xs opacity-50 ml-1"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                    </div>
                </div>
            </div>

            <!-- Chevron (Desktop only) -->
            <div class="hidden sm:block text-slate-600 group-hover:text-cyan-400 transition">
                <i class="bi bi-chevron-right"></i>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($messages)): ?>
    <div class="text-center py-20 bg-slate-900 border border-white/5 rounded-xl">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6">
            <i class="bi bi-inbox text-4xl opacity-30 text-white"></i>
        </div>
        <p class="text-slate-500 font-medium">Nincs megjeleníthető üzenet.</p>
    </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
