<!DOCTYPE html>
<html lang="hu" class="scroll-smooth dark">
<head>
    <?php require __DIR__ . '/../../partials/head.php'; ?>
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased selection:bg-cyan-500/20 selection:text-cyan-100 flex flex-col min-h-screen">
    <?php require __DIR__ . '/../../partials/header.php'; ?>

    <main class="flex-1 max-w-4xl mx-auto px-4 py-32 text-slate-300">
        <h1 class="text-4xl font-bold text-white mb-8">Adatkezelési Tájékoztató</h1>
        
        <div class="space-y-6 text-sm md:text-base leading-relaxed">
            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">1. Bevezetés</h2>
                <p>Kiss Bendegúz (a továbbiakban: Adatkezelő) elkötelezett a felhasználók személyes adatainak védelme iránt. Jelen tájékoztató célja, hogy a weboldal látogatói megismerjék az adatkezelés elveit és gyakorlatát.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">2. Az Adatkezelő adatai</h2>
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Név:</strong> Kiss Bendegúz</li>
                    <li><strong>Email:</strong> <?= e($settings['site_email'] ?? 'kapcsolat@kissbendeguz.hu') ?></li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">3. Kezelt adatok köre</h2>
                
                <h3 class="text-xl font-bold text-white mt-4 mb-2">3.1 Kapcsolatfelvételi űrlap</h3>
                <p>Amikor Ön üzenetet küld a weboldalon található űrlapon keresztül, az alábbi adatokat kezeljük:</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>Név</li>
                    <li>Email cím</li>
                    <li>Üzenet tárgya és szövege</li>
                </ul>
                <p class="mt-2"><strong>Jogalap:</strong> Az Érintett önkéntes hozzájárulása.</p>
                <p><strong>Cél:</strong> Kapcsolattartás, válaszadás az üzenetre.</p>
                <p><strong>Időtartam:</strong> Az ügy elintézéséig, vagy a hozzájárulás visszavonásáig.</p>

                <h3 class="text-xl font-bold text-white mt-4 mb-2">3.2 Sütik (Cookies)</h3>
                <p>A weboldal működéséhez elengedhetetlen sütiket (session cookie) használ, amelyek a böngésző bezárásakor törlődnek. Részletek a <a href="/suti-kezeles" class="text-cyan-400 hover:underline">Süti Tájékoztatóban</a>.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">4. Adattovábbítás</h2>
                <p>A kezelt adatokat harmadik félnek nem adjuk át, kivéve, ha arra törvény kötelez minket.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-cyan-400 mb-4">5. Az Ön jogai</h2>
                <p>Ön bármikor kérheti adatai törlését, helyesbítését vagy zárolását a fenti elérhetőségeken. Jogorvoslattal a NAIH-nál (www.naih.hu) élhet.</p>
            </section>

            <div class="pt-8 border-t border-white/10 text-slate-500 text-xs">
                Utolsó frissítés: <?= date('Y. m. d.') ?>
            </div>
        </div>
    </main>

    <?php require __DIR__ . '/../../partials/footer.php'; ?>
</body>
</html>
