<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Process | Kiss Bendegúz</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= asset('dist/app.css') ?>">
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 border-r border-white/5 flex-shrink-0 flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-white/5">
            <span class="text-xl font-bold tracking-tight text-white">Admin</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="<?= url('admin') ?>" class="block px-4 py-2 rounded-lg hover:bg-white/5 <?= $_SERVER['REQUEST_URI'] === '/admin' || $_SERVER['REQUEST_URI'] === '/admin/' ? 'bg-white/5 text-cyan-400' : '' ?>">Dashboard</a>
            <a href="<?= url('admin/messages') ?>" class="block px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/messages') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">Üzenetek</a>
            <a href="<?= url('admin/settings') ?>" class="block px-4 py-2 rounded-lg hover:bg-white/5 <?= strpos($_SERVER['REQUEST_URI'], '/admin/settings') !== false ? 'bg-white/5 text-cyan-400' : '' ?>">Beállítások</a>
        </nav>
        <div class="p-4 border-t border-white/5">
            <form action="<?= url('admin/logout') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" class="w-full px-4 py-2 text-sm text-left text-red-400 hover:bg-red-400/10 rounded-lg">Kijelentkezés</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <div class="flex-1 overflow-y-auto p-8">
            <?= $content ?? '' ?>
        </div>
    </main>

</body>
</html>
