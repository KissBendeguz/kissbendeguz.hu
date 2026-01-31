document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            const isExpanded = !menu.classList.contains('hidden');
            btn.setAttribute('aria-expanded', isExpanded);
        });

        // Close on link click
        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    }

    // Scroll Spy & Reveal (Minimal Observer)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => {
        el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700', 'ease-out');
        observer.observe(el);
    });

    // Contact Form
    const form = document.getElementById('contact-form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const feedback = document.getElementById('form-feedback');
            const originalText = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = 'Küldés...';
            feedback.classList.add('hidden');

            try {
                const formData = new FormData(form);
                const response = await fetch('/contact', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                feedback.textContent = result.message;
                feedback.classList.remove('hidden');

                if (result.status === 'success') {
                    feedback.className = 'mt-4 p-3 rounded-lg bg-green-500/10 border border-green-500/20 text-green-200 text-sm';
                    form.reset();
                } else {
                    feedback.className = 'mt-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-200 text-sm';
                }
            } catch (err) {
                feedback.textContent = 'Hiba történt a küldés során.';
                feedback.className = 'mt-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-200 text-sm';
                feedback.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    }
});
