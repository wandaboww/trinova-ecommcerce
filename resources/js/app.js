import './bootstrap';

/**
 * TRINOVA DIGITAL — Main JavaScript
 * Handles reveal animations, counter, and smooth scroll
 */

// ============================================================
// 1. INTERSECTION OBSERVER — Reveal animations
// ============================================================
document.addEventListener('DOMContentLoaded', () => {

    // Reveal on scroll
    const reveals = document.querySelectorAll('[data-reveal]');
    if (reveals.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.getAttribute('data-delay') || 0;
                    setTimeout(() => {
                        entry.target.classList.add('is-visible');
                    }, parseInt(delay));
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        reveals.forEach(el => {
            el.classList.add('reveal');
            observer.observe(el);
        });
    }

    // ============================================================
    // 2. COUNTER ANIMATION
    // ============================================================
    const counters = document.querySelectorAll('[data-counter]');
    if (counters.length) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el     = entry.target;
                    const target = parseInt(el.getAttribute('data-counter'), 10);
                    const suffix = el.getAttribute('data-suffix') || '';
                    animateCounter(el, target, 2000, suffix);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(el => counterObserver.observe(el));
    }

    function animateCounter(el, target, duration, suffix) {
        const start = performance.now();
        const step = (now) => {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3); // ease out cubic
            el.textContent = Math.floor(eased * target) + suffix;
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    }

    // ============================================================
    // 3. SMOOTH SCROLL for anchor links
    // ============================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (!target) return;
            e.preventDefault();
            const top = target.getBoundingClientRect().top + window.scrollY - 80;
            window.scrollTo({ top, behavior: 'smooth' });
        });
    });

    // ============================================================
    // 4. FAQ ACCORDION (vanilla fallback if Livewire not loaded)
    // ============================================================
    document.querySelectorAll('.faq-trigger').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const item   = trigger.closest('.faq-item');
            const answer = item?.querySelector('.faq-answer');
            const icon   = trigger.querySelector('.faq-icon');
            if (!answer) return;

            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item.open').forEach(openItem => {
                openItem.classList.remove('open');
                const a = openItem.querySelector('.faq-answer');
                if (a) a.style.maxHeight = '0';
            });

            if (!isOpen) {
                item.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });

    console.log('%c🚀 Trinova Digital', 'font-size:16px; font-weight:bold; color:#6C63FF;');
    console.log('%cMarketing Engine — Built for Growth', 'color:#8B92A5;');
});
