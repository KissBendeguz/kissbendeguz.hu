<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-slate-900/95 backdrop-blur-md border-t border-white/10 p-4 z-50 transform translate-y-full transition-transform duration-500 hidden text-sm">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="text-slate-300 text-center md:text-left">
            <p>
                Ez a weboldal sütiket használ a felhasználói élmény javítása érdekében. 
                <a href="/suti-kezeles" class="text-cyan-400 hover:underline">További információ</a>.
            </p>
        </div>
        <div class="flex gap-3">
            <button onclick="CookieConsent.showSettings()" class="px-4 py-2 text-slate-400 hover:text-white transition">
                Beállítások
            </button>
            <button onclick="CookieConsent.acceptAll()" class="px-6 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-500 transition font-bold shadow-lg shadow-cyan-900/20">
                Elfogadom
            </button>
        </div>
    </div>
</div>

<div id="cookie-settings-modal" class="fixed inset-0 z-[60] hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-slate-900 border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-2xl relative">
        <button onclick="CookieConsent.closeSettings()" class="absolute top-4 right-4 text-slate-400 hover:text-white">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <h3 class="text-xl font-bold text-white mb-4">Süti beállítások</h3>
        
        <div class="space-y-4 mb-6">
            <div class="flex items-start gap-3">
                <input type="checkbox" checked disabled class="mt-1 w-4 h-4 bg-slate-800 border-slate-600 rounded text-cyan-600">
                <div>
                    <div class="text-white font-medium">Szükséges működéshez</div>
                    <div class="text-xs text-slate-500">Az oldal alapvető működéséhez szükséges (pl. munkamenet). Nem kapcsolható ki.</div>
                </div>
            </div>
            
            <div class="flex items-start gap-3">
                <input type="checkbox" id="cookie-analytics" class="mt-1 w-4 h-4 bg-slate-800 border-slate-600 rounded text-cyan-600 focus:ring-cyan-500">
                <div>
                    <div class="text-white font-medium">Statisztika / Analitika</div>
                    <div class="text-xs text-slate-500">Névtelen látogatottsági adatok gyűjtése a felhasználói élmény javításához.</div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-white/5">
            <button onclick="CookieConsent.saveSettings()" class="px-6 py-2 bg-cyan-600 text-white rounded-xl hover:bg-cyan-500 transition font-bold">Mentés</button>
        </div>
    </div>
</div>

<script>
const CookieConsent = {
    init() {
        if (!localStorage.getItem('cookie_consent')) {
            setTimeout(() => {
                const banner = document.getElementById('cookie-banner');
                banner.classList.remove('hidden');
                void banner.offsetWidth;
                banner.classList.remove('translate-y-full');
            }, 1000);
        } else {
            this.loadScripts();
        }
    },

    acceptAll() {
        localStorage.setItem('cookie_consent', JSON.stringify({ required: true, analytics: true }));
        this.hideBanner();
        this.loadScripts();
    },

    showSettings() {
        document.getElementById('cookie-settings-modal').classList.remove('hidden');
        const settings = JSON.parse(localStorage.getItem('cookie_consent') || '{"analytics": false}');
        document.getElementById('cookie-analytics').checked = settings.analytics;
    },

    closeSettings() {
        document.getElementById('cookie-settings-modal').classList.add('hidden');
    },

    saveSettings() {
        const analytics = document.getElementById('cookie-analytics').checked;
        localStorage.setItem('cookie_consent', JSON.stringify({ required: true, analytics: analytics }));
        this.closeSettings();
        this.hideBanner();
        this.loadScripts();
    },

    hideBanner() {
        const banner = document.getElementById('cookie-banner');
        banner.classList.add('translate-y-full');
        setTimeout(() => banner.classList.add('hidden'), 500);
    },

    loadScripts() {
        const consent = JSON.parse(localStorage.getItem('cookie_consent'));
        if (consent && consent.analytics) {
            console.log('Analytics cookies accepted - Loading scripts...');
        }
    },

    reset() {
        localStorage.removeItem('cookie_consent');
        location.reload();
    }
};

document.addEventListener('DOMContentLoaded', () => CookieConsent.init());
</script>
