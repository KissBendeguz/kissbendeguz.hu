<?php $title = 'Beállítások'; require __DIR__ . '/../../layout/admin_header.php'; ?>

<h1 class="text-3xl font-bold text-white mb-8">Beállítások</h1>

<?php if (isset($_SESSION['success'])): ?>
    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-200 rounded-lg">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<form action="<?= url('admin/settings') ?>" method="POST" class="space-y-8 max-w-4xl">
    <?= csrf_field() ?>

    <!-- Global Settings -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 space-y-6">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <i class="bi bi-globe"></i> Globális
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Oldal neve</label>
                <input type="text" name="site_name" value="<?= e($settings['site_name'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Tagline</label>
                <input type="text" name="site_tagline" value="<?= e($settings['site_tagline'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Kapcsolat Email</label>
                <input type="email" name="site_email" value="<?= e($settings['site_email'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
            </div>
        </div>
    </div>

    <!-- Social Media Settings -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 space-y-6">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <i class="bi bi-share"></i> Közösségi Média
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">GitHub URL</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-slate-500"><i class="bi bi-github"></i></span>
                    <input type="url" name="social_github" value="<?= e($settings['social_github'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg pl-10 pr-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="https://github.com/..." >
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">LinkedIn URL</label>
                <div class="relative">
                     <span class="absolute left-3 top-2.5 text-slate-500"><i class="bi bi-linkedin"></i></span>
                    <input type="url" name="social_linkedin" value="<?= e($settings['social_linkedin'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg pl-10 pr-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="https://linkedin.com/in/...">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Facebook URL</label>
                <div class="relative">
                     <span class="absolute left-3 top-2.5 text-slate-500"><i class="bi bi-facebook"></i></span>
                    <input type="url" name="social_facebook" value="<?= e($settings['social_facebook'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg pl-10 pr-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="https://facebook.com/...">
                </div>
            </div>
             <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Publikus Email (Lábléchez)</label>
                <div class="relative">
                     <span class="absolute left-3 top-2.5 text-slate-500"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="social_email" value="<?= e($settings['social_email'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg pl-10 pr-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="email@example.com">
                </div>
            </div>
        </div>
    </div>

    <!-- SEO Settings -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 space-y-6">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <i class="bi bi-search"></i> SEO
        </h2>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Meta Title</label>
                <input type="text" name="seo_title" value="<?= e($settings['seo_title'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Meta Description</label>
                <textarea name="seo_description" rows="3" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500"><?= e($settings['seo_description'] ?? '') ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Robots</label>
                <select name="seo_robots" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
                    <option value="index, follow" <?= ($settings['seo_robots'] ?? '') === 'index, follow' ? 'selected' : '' ?>>Index, Follow</option>
                    <option value="noindex, nofollow" <?= ($settings['seo_robots'] ?? '') === 'noindex, nofollow' ? 'selected' : '' ?>>Noindex, Nofollow</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Open Graph Settings -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 space-y-6">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <i class="bi bi-share-fill"></i> Open Graph (Facebook, LinkedIn)
        </h2>
        <p class="text-sm text-slate-500">Ezek a beállítások határozzák meg, hogyan jelenik meg az oldal, ha valaki megosztja közösségi médiában.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">og:site_name</label>
                <input type="text" name="og_site_name" value="<?= e($settings['og_site_name'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="<?= e($settings['site_name'] ?? 'Oldal neve') ?>">
                <p class="text-xs text-slate-600 mt-1">Oldal neve (ha üres, a globális site_name lesz használva)</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">og:type</label>
                <select name="og_type" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
                    <option value="website" <?= ($settings['og_type'] ?? 'website') === 'website' ? 'selected' : '' ?>>website</option>
                    <option value="article" <?= ($settings['og_type'] ?? '') === 'article' ? 'selected' : '' ?>>article</option>
                    <option value="profile" <?= ($settings['og_type'] ?? '') === 'profile' ? 'selected' : '' ?>>profile</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">og:locale</label>
                <input type="text" name="og_locale" value="<?= e($settings['og_locale'] ?? 'hu_HU') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="hu_HU">
                <p class="text-xs text-slate-600 mt-1">Nyelvi kód (pl. hu_HU, en_US)</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-400 mb-1">og:image</label>
                <div class="flex gap-3 items-start">
                    <div class="flex-1">
                        <div class="flex gap-2">
                            <input type="text" id="og_image_input" name="og_image" value="<?= e($settings['og_image'] ?? '') ?>" class="flex-1 bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="Válassz képet a médiatárból">
                            <button type="button" onclick="openMediaModal('og_image_input', 'og_image_preview')" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg transition flex items-center gap-2">
                                <i class="bi bi-image"></i> Tallózás
                            </button>
                        </div>
                        <p class="text-xs text-slate-600 mt-1">Megosztási kép (ajánlott: 1200x630px)</p>
                    </div>
                    <img id="og_image_preview" src="<?= !empty($settings['og_image']) ? '/' . e($settings['og_image']) : '' ?>" class="w-24 h-16 object-cover rounded border border-white/10 <?= empty($settings['og_image']) ? 'hidden' : '' ?>" alt="OG Preview">
                </div>
            </div>
        </div>
    </div>

    <!-- Twitter Card Settings -->
    <div class="bg-slate-900 border border-white/5 rounded-2xl p-6 space-y-6">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <i class="bi bi-twitter-x"></i> Twitter Card
        </h2>
        <p class="text-sm text-slate-500">Hogyan jelenjen meg az oldal, ha Twitteren/X-en osztják meg.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">twitter:card</label>
                <select name="twitter_card" class="w-full bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500">
                    <option value="summary_large_image" <?= ($settings['twitter_card'] ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' ?>>summary_large_image (nagy kép)</option>
                    <option value="summary" <?= ($settings['twitter_card'] ?? '') === 'summary' ? 'selected' : '' ?>>summary (kis kép)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">twitter:site</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-slate-500">@</span>
                    <input type="text" name="twitter_site" value="<?= e($settings['twitter_site'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg pl-8 pr-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="oldalfelhasznalonev">
                </div>
                <p class="text-xs text-slate-600 mt-1">Oldal Twitter fiókja</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">twitter:creator</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-slate-500">@</span>
                    <input type="text" name="twitter_creator" value="<?= e($settings['twitter_creator'] ?? '') ?>" class="w-full bg-slate-950 border border-white/10 rounded-lg pl-8 pr-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="szerzőfelhasznalonev">
                </div>
                <p class="text-xs text-slate-600 mt-1">Tartalom szerzőjének Twitter fiókja</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-400 mb-1">twitter:image</label>
                <div class="flex gap-3 items-start">
                    <div class="flex-1">
                        <div class="flex gap-2">
                            <input type="text" id="twitter_image_input" name="twitter_image" value="<?= e($settings['twitter_image'] ?? '') ?>" class="flex-1 bg-slate-950 border border-white/10 rounded-lg px-4 py-2 text-white outline-none focus:ring-2 focus:ring-cyan-500" placeholder="Ha üres, az og:image lesz használva">
                            <button type="button" onclick="openMediaModal('twitter_image_input', 'twitter_image_preview')" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg transition flex items-center gap-2">
                                <i class="bi bi-image"></i> Tallózás
                            </button>
                        </div>
                        <p class="text-xs text-slate-600 mt-1">Egyedi Twitter kép (opcionális, ha üres az og:image-t használja)</p>
                    </div>
                    <img id="twitter_image_preview" src="<?= !empty($settings['twitter_image']) ? '/' . e($settings['twitter_image']) : '' ?>" class="w-24 h-16 object-cover rounded border border-white/10 <?= empty($settings['twitter_image']) ? 'hidden' : '' ?>" alt="Twitter Preview">
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-cyan-600 hover:bg-cyan-500 text-white font-medium py-3 px-8 rounded-xl transition shadow-lg shadow-cyan-500/20 flex items-center gap-2">
            <i class="bi bi-save"></i> Beállítások Mentése
        </button>
    </div>
</form>

<?php require __DIR__ . '/../../layout/admin_footer.php'; ?>
