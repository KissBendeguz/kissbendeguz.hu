<!DOCTYPE html>
<html lang="hu" class="scroll-smooth dark">
<head>
    <?php require __DIR__ . '/../partials/head.php'; ?>
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased selection:bg-cyan-500/20 selection:text-cyan-100">

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-cyan-500/10 rounded-full blur-[120px] mix-blend-screen opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] mix-blend-screen opacity-30"></div>
    </div>

    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main>
        <?php require __DIR__ . '/../components/hero.php'; ?>
        <?php require __DIR__ . '/../components/projects.php'; ?>
        <?php require __DIR__ . '/../components/stack.php'; ?>
        <?php require __DIR__ . '/../components/timeline.php'; ?>
        <?php require __DIR__ . '/../components/testimonials.php'; ?>
        <?php require __DIR__ . '/../components/contact.php'; ?>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
