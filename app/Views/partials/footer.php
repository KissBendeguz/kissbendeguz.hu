<?php
use App\Core\Database;
// Fetch settings for footer
$db = Database::connect();
$stmt = $db->query("SELECT * FROM settings WHERE key LIKE 'social_%'");
$rows = $stmt->fetchAll();
$footerSettings = [];
foreach ($rows as $row) {
    $footerSettings[$row['key']] = $row['value'];
}
?>
<footer class="py-8 border-t border-white/5 bg-slate-950 text-center text-slate-500 text-sm">
    <div class="max-w-6xl mx-auto px-4">
        <p>&copy; <?= date('Y') ?> Kiss Bendegúz. Minden jog fenntartva.</p>
        <div class="mt-4 flex justify-center gap-6">
            <?php if (!empty($footerSettings['social_github'])): ?>
            <a href="<?= e($footerSettings['social_github']) ?>" target="_blank" rel="noopener noreferrer" class="hover:text-white transition flex items-center gap-2">
                <i class="bi bi-github text-lg"></i> <span class="hidden sm:inline">GitHub</span>
            </a>
            <?php endif; ?>

            <?php if (!empty($footerSettings['social_linkedin'])): ?>
            <a href="<?= e($footerSettings['social_linkedin']) ?>" target="_blank" rel="noopener noreferrer" class="hover:text-blue-400 transition flex items-center gap-2">
                <i class="bi bi-linkedin text-lg"></i> <span class="hidden sm:inline">LinkedIn</span>
            </a>
            <?php endif; ?>

            <?php if (!empty($footerSettings['social_facebook'])): ?>
            <a href="<?= e($footerSettings['social_facebook']) ?>" target="_blank" rel="noopener noreferrer" class="hover:text-blue-600 transition flex items-center gap-2">
                <i class="bi bi-facebook text-lg"></i> <span class="hidden sm:inline">Facebook</span>
            </a>
            <?php endif; ?>

            <?php if (!empty($footerSettings['social_email'])): ?>
            <a href="mailto:<?= e($footerSettings['social_email']) ?>" class="hover:text-cyan-400 transition flex items-center gap-2">
                <i class="bi bi-envelope text-lg"></i> <span class="hidden sm:inline">Email</span>
            </a>
            <?php endif; ?>
        </div>
        
        <div class="mt-4 pt-4 border-t border-white/5 flex flex-col md:flex-row justify-center items-center gap-4 text-xs font-mono opacity-50">
             <a href="/adatkezelesi-tajekoztato" class="hover:text-white transition">Adatkezelési Tájékoztató</a>
             <span class="hidden md:inline">&bullet;</span>
             <a href="/suti-kezeles" class="hover:text-white transition">Süti Tájékoztató</a>
             <span class="hidden md:inline">&bullet;</span>
             <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;" class="hover:text-white transition">Vissza a tetejére</a>
        </div>
    </div>
</footer>
<?php require __DIR__ . '/../components/cookie_consent.php'; ?>
