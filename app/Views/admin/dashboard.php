<?php $title = 'Dashboard'; require __DIR__ . '/../layout/admin_header.php'; ?>

<h1 class="text-3xl font-bold text-white mb-8">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card: Messages -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-cyan-500/30 transition">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition"></div>
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-slate-400 text-sm font-medium mb-1">Új üzenetek</h3>
                <p class="text-3xl font-bold text-white"><?= $newMessages ?></p>
            </div>
            <div class="p-3 bg-cyan-500/10 rounded-lg text-cyan-400">
                <i class="bi bi-envelope text-xl"></i>
            </div>
        </div>
        <div class="text-xs text-slate-500">Összesen: <?= $totalMessages ?></div>
    </div>

    <!-- Stat Card: Projects -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-emerald-500/30 transition">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition"></div>
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-slate-400 text-sm font-medium mb-1">Projektek</h3>
                <p class="text-3xl font-bold text-white"><?= $totalProjects ?></p>
            </div>
            <div class="p-3 bg-emerald-500/10 rounded-lg text-emerald-400">
                <i class="bi bi-folder text-xl"></i>
            </div>
        </div>
        <a href="/admin/projects" class="text-xs text-emerald-400 hover:underline">Kezelés &rarr;</a>
    </div>

    <!-- Stat Card: Stack -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-purple-500/30 transition">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition"></div>
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-slate-400 text-sm font-medium mb-1">Stack Elemek</h3>
                <p class="text-3xl font-bold text-white"><?= $totalStack ?></p>
            </div>
            <div class="p-3 bg-purple-500/10 rounded-lg text-purple-400">
                <i class="bi bi-code-slash text-xl"></i>
            </div>
        </div>
        <a href="/admin/stack" class="text-xs text-purple-400 hover:underline">Kezelés &rarr;</a>
    </div>

    <!-- Stat Card: Testimonials -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-amber-500/30 transition">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition"></div>
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-slate-400 text-sm font-medium mb-1">Vélemények</h3>
                <p class="text-3xl font-bold text-white"><?= $totalTestimonials ?></p>
            </div>
            <div class="p-3 bg-amber-500/10 rounded-lg text-amber-400">
                <i class="bi bi-chat-quote text-xl"></i>
            </div>
        </div>
        <a href="/admin/testimonials" class="text-xs text-amber-400 hover:underline">Kezelés &rarr;</a>
    </div>
</div>

<h2 class="text-xl font-bold text-white mb-4">Legutóbbi üzenetek</h2>
<div class="space-y-3">
    <?php foreach ($recentMessages as $msg): ?>
    <a href="/admin/messages/show?id=<?= $msg['id'] ?>" class="block bg-slate-900 border border-white/5 rounded-xl p-4 hover:bg-slate-800 transition group">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center font-bold text-slate-400 border border-white/5 group-hover:text-cyan-400 transition">
                     <?= strtoupper(substr($msg['name'], 0, 1)) ?>
                </div>
                <div>
                    <div class="text-white font-medium group-hover:text-cyan-400 transition"><?= e($msg['name']) ?></div>
                    <div class="text-xs text-slate-500"><?= e($msg['email']) ?></div>
                </div>
            </div>
            <div class="text-right">
                 <div class="text-sm text-slate-400"><?= date('M d.', strtotime($msg['created_at'])) ?></div>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
    
    <?php if (empty($recentMessages)): ?>
    <div class="text-center py-10 bg-slate-900 border border-white/5 rounded-xl">
        <p class="text-slate-500">Nincs legutóbbi üzenet.</p>
    </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/admin_footer.php'; ?>
