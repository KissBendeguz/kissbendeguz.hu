<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= asset('dist/app.css') ?>">
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm bg-slate-900 border border-white/10 rounded-2xl p-8 backdrop-blur-sm">
        <h1 class="text-2xl font-bold text-white mb-6 text-center">Admin Login</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-4 p-3 bg-red-500/10 border border-red-500/20 text-red-200 rounded-lg text-sm">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= url('admin/login') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Email</label>
                <input type="email" name="email" value="<?= e(old('email')) ?>" required 
                    class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Jelszó</label>
                <input type="password" name="password" required 
                    class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition">
            </div>

            <button type="submit" 
                class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-medium py-2 rounded-lg transition shadow-[0_0_20px_rgba(8,145,178,0.3)] hover:shadow-[0_0_25px_rgba(8,145,178,0.5)]">
                Belépés
            </button>
        </form>
    </div>

</body>
</html>
