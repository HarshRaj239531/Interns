/**
 * Infinity Interns – Modern Frontend Animation Engine
 * Professional, resilient, and performant.
 */

// Check user accessibility preference
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * 1. Scroll Progress Bar at the top of the viewport
 */
function initScrollProgress() {
    try {
        const progressEl = document.getElementById('scrollProgress');
        if (!progressEl) return;

        const updateProgress = () => {
            const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (totalHeight <= 0) return;
            const progress = Math.min(1, Math.max(0, window.scrollY / totalHeight));
            progressEl.style.transform = `scaleX(${progress})`;
        };

        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();
    } catch (e) {
        console.warn('Scroll progress initialization:', e);
    }
}

/**
 * 2. Dynamic Floating Navbar Elevation and Glassmorphism on Scroll
 */
function initNavbarMotion() {
    try {
        const nav = document.getElementById('mainNav');
        if (!nav) return;
        let isScrolled = false;

        const handleNavScroll = () => {
            const y = window.scrollY;
            if (y > 30 && !isScrolled) {
                isScrolled = true;
                nav.style.backgroundColor = 'rgba(255, 255, 255, 0.96)';
                nav.style.boxShadow = '0 12px 30px -10px rgba(0, 0, 0, 0.12), 0 4px 6px -2px rgba(0, 0, 0, 0.04)';
                nav.style.borderColor = 'rgba(203, 213, 225, 0.95)';
                nav.style.paddingTop = '0.5rem';
                nav.style.paddingBottom = '0.5rem';
            } else if (y <= 30 && isScrolled) {
                isScrolled = false;
                nav.style.backgroundColor = 'rgba(255, 255, 255, 0.90)';
                nav.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.05)';
                nav.style.borderColor = 'rgba(226, 232, 240, 0.8)';
                nav.style.paddingTop = '0.625rem';
                nav.style.paddingBottom = '0.625rem';
            }
        };

        window.addEventListener('scroll', handleNavScroll, { passive: true });
        handleNavScroll();
    } catch (e) {
        console.warn('Navbar motion initialization:', e);
    }
}

/**
 * 3. Scroll-Triggered Viewport Reveals (IntersectionObserver)
 * Guaranteed fallback: elements are already visible in CSS!
 */
function initScrollReveals() {
    try {
        if (prefersReducedMotion || !('IntersectionObserver' in window)) return;

        const revealTargets = document.querySelectorAll('.motion-reveal, .motion-stagger');
        if (revealTargets.length === 0) return;

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('motion-inview');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.05
        });

        revealTargets.forEach((target) => {
            // If already in viewport on load, immediately activate
            const rect = target.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                target.classList.add('motion-inview');
            } else {
                revealObserver.observe(target);
            }
        });
    } catch (e) {
        console.warn('Scroll reveal initialization:', e);
    }
}

/**
 * 4. Smooth Animated Number Counters (Cubic Ease-Out)
 */
function initCounters() {
    try {
        const counters = document.querySelectorAll('.motion-counter');
        if (counters.length === 0) return;

        const animateCounter = (el) => {
            if (el.dataset.hasAnimated === 'true') return;
            el.dataset.hasAnimated = 'true';

            const rawText = el.innerText.trim();
            const targetVal = parseInt(el.getAttribute('data-target') || rawText.replace(/\D/g, ''), 10);
            const prefix = el.getAttribute('data-prefix') || '';
            const suffix = el.getAttribute('data-suffix') || (rawText.includes('+') ? '+' : (rawText.includes('%') ? '%' : ''));

            if (isNaN(targetVal) || targetVal <= 0) return;

            const duration = 1600; // ms
            const startTime = performance.now();

            const updateCount = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // Cubic ease-out curve
                const easeOut = 1 - Math.pow(1 - progress, 3);
                const currentVal = Math.floor(easeOut * targetVal);

                el.innerText = `${prefix}${currentVal.toLocaleString()}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(updateCount);
                } else {
                    el.innerText = `${prefix}${targetVal.toLocaleString()}${suffix}`;
                }
            };

            requestAnimationFrame(updateCount);
        };

        if ('IntersectionObserver' in window) {
            const counterObserver = new IntersectionObserver((entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        obs.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '0px 0px -40px 0px', threshold: 0.1 });

            counters.forEach((c) => counterObserver.observe(c));
        } else {
            // Fallback for older environments
            counters.forEach(animateCounter);
        }
    } catch (e) {
        console.warn('Counter initialization:', e);
    }
}

/**
 * 5. Application Modal Transitions (Open / Close)
 */
function initModalMotion() {
    try {
        const modal = document.getElementById('applyModal');
        if (!modal) return;
        const card = modal.querySelector('div.relative.w-full.max-w-xl');

        window.openApplyModal = function() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            modal.style.opacity = '1';
            if (card) {
                card.style.transform = 'scale(1)';
                card.style.opacity = '1';
            }
        };

        window.closeApplyModal = function() {
            if (modal.classList.contains('hidden')) return;
            document.body.style.overflow = '';
            modal.classList.add('hidden');
        };

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                window.closeApplyModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                window.closeApplyModal();
            }
        });

        // Mobile drawer toggle
        const drawer = document.getElementById('mobileDrawer');
        if (drawer) {
            window.toggleMobileNav = function() {
                drawer.classList.toggle('hidden');
            };
        }
    } catch (e) {
        console.warn('Modal initialization:', e);
    }
}

/**
 * 6. Dashboard Stat Progress Bars Animation
 */
function initDashboardMotion() {
    try {
        const progressBars = document.querySelectorAll('.motion-progress-bar');
        progressBars.forEach((bar) => {
            const targetWidth = bar.getAttribute('data-width') || '100%';
            setTimeout(() => {
                bar.style.width = targetWidth;
            }, 100);
        });
    } catch (e) {
        console.warn('Dashboard motion initialization:', e);
    }
}

// Global bootstrap
function bootstrapMotion() {
    initScrollProgress();
    initNavbarMotion();
    initScrollReveals();
    initCounters();
    initModalMotion();
    initDashboardMotion();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrapMotion);
} else {
    bootstrapMotion();
}
