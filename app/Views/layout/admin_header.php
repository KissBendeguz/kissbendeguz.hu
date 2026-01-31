<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Admin') ?> | Kiss Bendegúz</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= asset('dist/app.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Header -->
    <header class="md:hidden fixed top-0 w-full bg-slate-900 border-b border-white/5 z-50 flex items-center justify-between px-4 h-16">
        <span class="text-xl font-bold tracking-tight text-white">Admin</span>
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-slate-400 hover:text-white">
            <i class="bi bi-list text-2xl"></i>
        </button>
    </header>

    <!-- Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
         class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed md:relative md:translate-x-0 inset-y-0 left-0 w-64 bg-slate-900 border-r border-white/5 flex flex-col transition-transform duration-300 z-50 pt-16 md:pt-0">
        
        <div class="h-16 hidden md:flex items-center px-6 border-b border-white/5 justify-between">
            <span class="text-xl font-bold tracking-tight text-white">Admin</span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="<?= url('admin') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= $_SERVER['REQUEST_URI'] === '/admin' ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            
            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tartalom</div>
            
            <a href="<?= url('admin/projects') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/projects') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-folder"></i> Projektek
            </a>
             <a href="<?= url('admin/stack') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/stack') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-code-slash"></i> Stack
            </a>
             <a href="<?= url('admin/timeline') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/timeline') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-calendar3"></i> Tanulmányok
            </a>
             <a href="<?= url('admin/testimonials') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/testimonials') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-chat-quote"></i> Vélemények
            </a>
            <a href="<?= url('admin/media') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/media') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-images"></i> Média Könyvtár
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Rendszer</div>

            <a href="<?= url('admin/messages') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/messages') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-envelope"></i> Üzenetek
            </a>
            <a href="<?= url('admin/settings') ?>" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/settings') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">
                <i class="bi bi-gear"></i> Beállítások
            </a>
        </nav>
        <div class="p-4 border-t border-white/5">
            <a href="<?= url('admin/logout') ?>" class="flex items-center gap-3 w-full px-4 py-2 text-sm text-left text-red-400 hover:bg-red-400/10 rounded-lg transition">
                <i class="bi bi-box-arrow-right"></i> Kijelentkezés
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden relative pt-16 md:pt-0">
        <div class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="mb-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-lg flex items-center justify-between">
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg flex items-center justify-between">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
