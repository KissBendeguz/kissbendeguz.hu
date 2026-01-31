<!DOCTYPE html>
<html lang="hu" class="scroll-smooth dark">
<head>
    <?php require __DIR__ . '/../../partials/head.php'; ?>
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased selection:bg-cyan-500/20 selection:text-cyan-100 flex flex-col min-h-screen">
    <?php require __DIR__ . '/../../partials/header.php'; ?>

    <main class="flex-1 max-w-4xl mx-auto px-4 py-32 text-slate-300">
        <h1 class="text-4xl font-bold text-white mb-8">Süti (Cookie) Tájékoztató</h1>
        
        <div class="space-y-6 text-sm md:text-base leading-relaxed">
            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">1. Mik azok a sütik?</h2>
                <p>A sütik (cookie-k) kis méretű szöveges fájlok, amelyeket a weboldal helyez el az Ön böngészőjében. Ezek célja a felhasználói élmény javítása és az oldal működésének biztosítása.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">2. Milyen sütiket használunk?</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 text-white">
                                <th class="py-3 pr-4">Név</th>
                                <th class="py-3 pr-4">Típus</th>
                                <th class="py-3 pr-4">Cél</th>
                                <th class="py-3">Lejárat</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-400">
                            <tr class="border-b border-white/5">
                                <td class="py-3 pr-4 font-mono text-cyan-400">PHPSESSID</td>
                                <td class="py-3 pr-4">Szükséges</td>
                                <td class="py-3 pr-4">A felhasználói munkamenet azonosítása (pl. bejelentkezés, üzenetküldés).</td>
                                <td class="py-3">Böngésző bezárásakor</td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 font-mono text-cyan-400">cookie_consent</td>
                                <td class="py-3 pr-4">Funkcionális</td>
                                <td class="py-3 pr-4">Tárolja az Ön süti beállításait (elfogadás/elutasítás).</td>
                                <td class="py-3">1 év</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">3. Sütik kezelése</h2>
                <p>Ön a böngészője beállításaiban bármikor törölheti vagy tilthatja a sütiket, azonban ez az oldal egyes funkcióinak (pl. admin belépés) hibás működését okozhatja.</p>
            </section>

            <div class="pt-8 border-t border-white/10">
                <button onclick="CookieConsent.reset()" class="px-4 py-2 bg-slate-800 text-white rounded hover:bg-slate-700 transition">
                    Süti beállítások módosítása
                </button>
            </div>
        </div>
    </main>

    <?php require __DIR__ . '/../../partials/footer.php'; ?>
</body>
</html>
