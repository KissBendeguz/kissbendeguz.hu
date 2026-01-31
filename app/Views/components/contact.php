<section id="kapcsolat" class="py-20 relative overflow-hidden">
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-cyan-900/20 rounded-full blur-[100px] -z-10"></div>
    
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-slate-900/80 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-12 reveal">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-white mb-4">Dolgozzunk együtt</h2>
                <p class="text-slate-400">Ha van egy ötleted vagy kész specifikációd, szívesen segítek.</p>
            </div>

            <form id="contact-form" class="space-y-6">
                <?= csrf_field() ?>
                <div class="hidden">
                    <input type="text" name="honey_pot" value="">
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Név</label>
                        <input type="text" name="name" required class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-cyan-500 outline-none transition placeholder-slate-600" placeholder="Kormos Vivien">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Email</label>
                        <input type="email" name="email" required class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-cyan-500 outline-none transition placeholder-slate-600" placeholder="vivien@pelda.hu">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Tárgy <span class="text-slate-600">(opcionális)</span></label>
                    <input type="text" name="subject" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-cyan-500 outline-none transition" placeholder="Projekt ötlet">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Üzenet</label>
                    <textarea name="message" rows="4" required class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-cyan-500 outline-none transition placeholder-slate-600" placeholder="Szia! Szeretnék egy weboldalt..."></textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-500 hover:to-teal-500 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-cyan-900/20 transform active:scale-[0.99]">
                    Üzenet küldése
                </button>

                <div id="form-feedback" class="hidden text-center"></div>
            </form>
        </div>
    </div>
</section>
