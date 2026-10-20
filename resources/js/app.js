/**
 * Infinity Interns – Full GSAP Advanced Motion Architecture
 * High-performance, GPU-accelerated GreenSock animation engine
 * registered with ScrollTrigger, ScrollToPlugin, and Interactive Physics.
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';

// Register standard GSAP plugins
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

// Make GSAP globally accessible across views and scripts
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Accessibility & Device detection
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isDesktop = () => window.matchMedia('(pointer: fine)').matches && window.innerWidth >= 1024;

/**
 * 1. Global High-Precision Scroll Progress Indicator
 */
function initScrollProgress() {
    try {
        const progressEl = document.getElementById('scrollProgress');
        if (!progressEl) return;

        gsap.set(progressEl, { scaleX: 0, transformOrigin: 'left center' });

        const adminScroller = document.getElementById('adminMainScroll');
        if (adminScroller && window.innerWidth >= 768) {
            adminScroller.addEventListener('scroll', () => {
                const max = adminScroller.scrollHeight - adminScroller.clientHeight;
                const ratio = max > 0 ? adminScroller.scrollTop / max : 0;
                gsap.to(progressEl, {
                    scaleX: Math.min(1, Math.max(0, ratio)),
                    duration: 0.1,
                    ease: 'none',
                    overwrite: 'auto'
                });
            }, { passive: true });
            return;
        }

        gsap.to(progressEl, {
            scaleX: 1,
            ease: 'none',
            scrollTrigger: {
                trigger: document.documentElement,
                start: 'top top',
                end: 'bottom bottom',
                scrub: 0.15,
                invalidateOnRefresh: true,
            }
        });
    } catch (e) {
        console.warn('GSAP ScrollProgress:', e);
    }
}

/**
 * 2. Floating Glassmorphism Navbar Motion & Elevation
 */
function initNavbarMotion() {
    try {
        const nav = document.getElementById('mainNav');
        if (!nav) return;

        // Entrance animation on page load
        if (!prefersReducedMotion) {
            gsap.fromTo(nav, 
                { y: -24, opacity: 0, scale: 0.98 },
                { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'power3.out', delay: 0.1 }
            );
        }

        // ScrollTrigger dynamic elevation
        ScrollTrigger.create({
            start: 'top -25',
            onUpdate: (self) => {
                const scrolled = self.scroll() > 25;
                gsap.to(nav, {
                    backgroundColor: scrolled ? 'rgba(255, 255, 255, 0.96)' : 'rgba(255, 255, 255, 0.90)',
                    boxShadow: scrolled 
                        ? '0 16px 36px -10px rgba(0, 0, 0, 0.12), 0 4px 6px -2px rgba(0, 0, 0, 0.04)' 
                        : '0 4px 6px -1px rgba(0, 0, 0, 0.05)',
                    borderColor: scrolled ? 'rgba(199, 210, 254, 0.95)' : 'rgba(226, 232, 240, 0.8)',
                    paddingTop: scrolled ? '0.45rem' : '0.625rem',
                    paddingBottom: scrolled ? '0.45rem' : '0.625rem',
                    duration: 0.25,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            }
        });
    } catch (e) {
        console.warn('GSAP NavbarMotion:', e);
    }
}

/**
 * 3. Page Hero Entrance Choreography (Master GSAP Timeline)
 */
function initHeroTimeline() {
    try {
        if (prefersReducedMotion) return;

        const badge = document.querySelector('.motion-hero-badge');
        const title = document.querySelector('.motion-hero-title');
        const sub = document.querySelector('.motion-hero-sub');
        const cards = document.querySelector('.motion-hero-cards');
        const cta = document.querySelector('.motion-hero-cta');

        if (!badge && !title && !sub) return;

        const tl = gsap.timeline({ defaults: { ease: 'power3.out' }, delay: 0.12 });

        if (badge) {
            tl.fromTo(badge, 
                { y: -18, opacity: 0, scale: 0.92 }, 
                { y: 0, opacity: 1, scale: 1, duration: 0.65, ease: 'back.out(1.8)' }
            );
        }

        if (title) {
            tl.fromTo(title, 
                { y: 32, opacity: 0, rotateX: 6, transformPerspective: 800 }, 
                { y: 0, opacity: 1, rotateX: 0, duration: 0.85 }, 
                badge ? '-=0.35' : 0
            );
        }

        if (sub) {
            tl.fromTo(sub, 
                { y: 22, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 0.7 }, 
                '-=0.5'
            );
        }

        if (cards && cards.children.length > 0) {
            tl.fromTo(cards.children, 
                { y: 24, opacity: 0, scale: 0.95 }, 
                { y: 0, opacity: 1, scale: 1, stagger: 0.08, duration: 0.6, ease: 'back.out(1.4)' }, 
                '-=0.45'
            );
        }

        if (cta) {
            const targets = cta.children.length > 0 ? cta.children : [cta];
            tl.fromTo(targets, 
                { y: 18, opacity: 0, scale: 0.94 }, 
                { y: 0, opacity: 1, scale: 1, stagger: 0.1, duration: 0.6, ease: 'back.out(1.6)' }, 
                '-=0.35'
            );
        }
    } catch (e) {
        console.warn('GSAP HeroTimeline:', e);
    }
}

/**
 * 4. Ambient Floating Parallax Orbs
 */
function initAmbientOrbs() {
    try {
        const orbs = document.querySelectorAll('.motion-orb');
        if (orbs.length === 0 || prefersReducedMotion) return;

        orbs.forEach((orb, i) => {
            const xDelta = (i % 2 === 0 ? 1 : -1) * (20 + (i * 8));
            const yDelta = (i % 2 === 0 ? -1 : 1) * (22 + (i * 6));
            const duration = 7 + (i * 2.5);

            // Fluid continuous float loop
            gsap.to(orb, {
                x: `+=${xDelta}`,
                y: `+=${yDelta}`,
                scale: 1.05,
                duration: duration,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut'
            });

            // Gentle scroll depth parallax
            gsap.to(orb, {
                yPercent: (i % 2 === 0 ? -15 : 15),
                ease: 'none',
                scrollTrigger: {
                    trigger: document.body,
                    start: 'top top',
                    end: 'bottom bottom',
                    scrub: 1.2
                }
            });
        });
    } catch (e) {
        console.warn('GSAP AmbientOrbs:', e);
    }
}

/**
 * 5. ScrollTrigger Batch Viewport Reveals
 */
function initScrollReveals() {
    try {
        if (prefersReducedMotion) return;

        // Elements with .motion-reveal (excluding hero elements already in master timeline)
        const reveals = document.querySelectorAll('.motion-reveal:not(.motion-hero-title):not(.motion-hero-badge):not(.motion-hero-sub):not(.motion-hero-cta)');
        reveals.forEach((el) => {
            gsap.fromTo(el, 
                { y: 30, opacity: 0 }, 
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.75,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 88%',
                        once: true,
                        invalidateOnRefresh: true,
                    }
                }
            );
        });

        // Stagger containers
        const staggerContainers = document.querySelectorAll('.motion-stagger');
        staggerContainers.forEach((container) => {
            const children = Array.from(container.children);
            if (children.length === 0) return;

            gsap.fromTo(children, 
                { y: 28, opacity: 0, scale: 0.98 }, 
                {
                    y: 0,
                    opacity: 1,
                    scale: 1,
                    duration: 0.7,
                    stagger: 0.08,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 86%',
                        once: true,
                        invalidateOnRefresh: true,
                    }
                }
            );
        });

        // Program cards & feature cards on subpages
        const programCards = document.querySelectorAll('.program-card');
        if (programCards.length > 0) {
            ScrollTrigger.batch(programCards, {
                start: 'top 85%',
                once: true,
                onEnter: (batch) => {
                    gsap.fromTo(batch, 
                        { y: 35, opacity: 0 }, 
                        { y: 0, opacity: 1, duration: 0.8, stagger: 0.12, ease: 'power3.out', overwrite: 'auto' }
                    );
                }
            });
        }
    } catch (e) {
        console.warn('GSAP ScrollReveals:', e);
    }
}

/**
 * 6. GSAP Smooth Animated Numerical Counters (Tween Proxy)
 */
function initCounters() {
    try {
        const counters = document.querySelectorAll('.motion-counter');
        if (counters.length === 0) return;

        counters.forEach((el) => {
            const rawText = el.innerText.trim();
            const targetVal = parseInt(el.getAttribute('data-target') || rawText.replace(/\D/g, ''), 10);
            if (isNaN(targetVal) || targetVal <= 0) return;

            const prefix = el.getAttribute('data-prefix') || '';
            const suffix = el.getAttribute('data-suffix') || (rawText.includes('+') ? '+' : (rawText.includes('%') ? '%' : ''));

            if (prefersReducedMotion) {
                el.innerText = `${prefix}${targetVal.toLocaleString()}${suffix}`;
                return;
            }

            const proxy = { value: 0 };
            gsap.to(proxy, {
                value: targetVal,
                duration: 1.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    once: true,
                },
                onUpdate: () => {
                    el.innerText = `${prefix}${Math.floor(proxy.value).toLocaleString()}${suffix}`;
                },
                onComplete: () => {
                    el.innerText = `${prefix}${targetVal.toLocaleString()}${suffix}`;
                }
            });
        });
    } catch (e) {
        console.warn('GSAP Counters:', e);
    }
}

/**
 * 7. Interactive 3D Card Tilt with GSAP (Desktop)
 */
function init3DCardTilt() {
    try {
        if (prefersReducedMotion || !isDesktop()) return;

        const cards = document.querySelectorAll('.motion-card-hover, .program-card, .adm-card');
        cards.forEach((card) => {
            const handleMouseMove = (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * -6;
                const rotateY = ((x - centerX) / centerX) * 6;

                gsap.to(card, {
                    rotateX: rotateX,
                    rotateY: rotateY,
                    y: -5,
                    transformPerspective: 1000,
                    duration: 0.25,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            };

            const handleMouseLeave = () => {
                gsap.to(card, {
                    rotateX: 0,
                    rotateY: 0,
                    y: 0,
                    duration: 0.5,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            };

            card.addEventListener('mousemove', handleMouseMove);
            card.addEventListener('mouseleave', handleMouseLeave);
        });
    } catch (e) {
        console.warn('GSAP 3DCardTilt:', e);
    }
}

/**
 * 8. Magnetic Button Spring Feedback (Desktop)
 */
function initMagneticButtons() {
    try {
        if (prefersReducedMotion || !isDesktop()) return;

        const buttons = document.querySelectorAll('.motion-btn-spring, .gsap-magnetic');
        buttons.forEach((btn) => {
            const handleMouseMove = (e) => {
                const rect = btn.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const dx = (e.clientX - centerX) * 0.26;
                const dy = (e.clientY - centerY) * 0.26;

                gsap.to(btn, {
                    x: dx,
                    y: dy,
                    scale: 1.03,
                    duration: 0.22,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            };

            const handleMouseLeave = () => {
                gsap.to(btn, {
                    x: 0,
                    y: 0,
                    scale: 1,
                    duration: 0.6,
                    ease: 'elastic.out(1.1, 0.35)',
                    overwrite: 'auto'
                });
            };

            btn.addEventListener('mousemove', handleMouseMove);
            btn.addEventListener('mouseleave', handleMouseLeave);
        });
    } catch (e) {
        console.warn('GSAP MagneticButtons:', e);
    }
}

/**
 * 9. Spring Modals & Mobile Navigation Drawer
 */
function initModalMotion() {
    try {
        const modal = document.getElementById('applyModal');
        if (modal) {
            const card = modal.querySelector('div.relative.w-full.max-w-xl');

            window.openApplyModal = function() {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                gsap.fromTo(modal, 
                    { opacity: 0 }, 
                    { opacity: 1, duration: 0.25, ease: 'power2.out' }
                );

                if (card) {
                    gsap.fromTo(card, 
                        { scale: 0.88, y: 30, opacity: 0 }, 
                        { scale: 1, y: 0, opacity: 1, duration: 0.45, ease: 'back.out(1.6)' }
                    );
                }
            };

            window.closeApplyModal = function() {
                if (modal.classList.contains('hidden')) return;
                document.body.style.overflow = '';

                if (card) {
                    gsap.to(card, {
                        scale: 0.9,
                        y: 15,
                        opacity: 0,
                        duration: 0.2,
                        ease: 'power2.in'
                    });
                }

                gsap.to(modal, {
                    opacity: 0,
                    duration: 0.22,
                    ease: 'power2.in',
                    onComplete: () => {
                        modal.classList.add('hidden');
                    }
                });
            };

            modal.addEventListener('click', (e) => {
                if (e.target === modal) window.closeApplyModal();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    window.closeApplyModal();
                }
            });
        }

        // Mobile drawer toggle
        const drawer = document.getElementById('mobileDrawer');
        if (drawer) {
            window.toggleMobileNav = function() {
                const isHidden = drawer.classList.contains('hidden');
                if (isHidden) {
                    drawer.classList.remove('hidden');
                    gsap.fromTo(drawer, 
                        { y: -16, opacity: 0 }, 
                        { y: 0, opacity: 1, duration: 0.35, ease: 'power2.out' }
                    );
                    const links = drawer.querySelectorAll('a, button');
                    if (links.length > 0) {
                        gsap.fromTo(links, 
                            { x: -10, opacity: 0 }, 
                            { x: 0, opacity: 1, stagger: 0.04, duration: 0.3, ease: 'power2.out' }
                        );
                    }
                } else {
                    gsap.to(drawer, {
                        y: -12,
                        opacity: 0,
                        duration: 0.2,
                        ease: 'power2.in',
                        onComplete: () => drawer.classList.add('hidden')
                    });
                }
            };
        }
    } catch (e) {
        console.warn('GSAP ModalMotion:', e);
    }
}

/**
 * 10. Smooth In-Page Anchor Navigation (ScrollToPlugin)
 */
function initSmoothScroll() {
    try {
        document.querySelectorAll('a[href^="#"]:not([href="#"]):not([href="#0"])').forEach((anchor) => {
            anchor.addEventListener('click', (e) => {
                const hash = anchor.getAttribute('href');
                if (!hash || hash.length <= 1) return;
                const target = document.querySelector(hash);
                if (target) {
                    e.preventDefault();
                    gsap.to(window, {
                        duration: 0.85,
                        scrollTo: { y: target, offsetY: 80 },
                        ease: 'power3.inOut'
                    });
                }
            });
        });
    } catch (e) {
        console.warn('GSAP SmoothScroll:', e);
    }
}

/**
 * 11. Dashboard Progress Bars & Admin Table Stagger
 */
function initDashboardProgress() {
    try {
        const bars = document.querySelectorAll('.motion-progress-bar');
        bars.forEach((bar) => {
            const targetWidth = bar.getAttribute('data-width') || '100%';
            gsap.fromTo(bar, 
                { width: '0%' }, 
                {
                    width: targetWidth,
                    duration: 1.2,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: bar,
                        start: 'top 92%',
                        once: true,
                    }
                }
            );
        });

        // Stagger admin table rows
        const tableRows = document.querySelectorAll('tbody tr.adm-table-row');
        if (tableRows.length > 0 && !prefersReducedMotion) {
            gsap.fromTo(tableRows, 
                { opacity: 0, y: 12 }, 
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.03,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: tableRows[0].closest('table'),
                        start: 'top 85%',
                        once: true,
                    }
                }
            );
        }
    } catch (e) {
        console.warn('GSAP DashboardProgress:', e);
    }
}

/**
 * 12. Interactive Custom Magnetic Glow Cursor (Desktop)
 */
function initCustomCursor() {
    try {
        if (prefersReducedMotion || !isDesktop()) return;

        let dot = document.querySelector('.gsap-cursor-dot');
        let glow = document.querySelector('.gsap-cursor-glow');

        if (!dot) {
            dot = document.createElement('div');
            dot.className = 'gsap-cursor-dot';
            document.body.appendChild(dot);
        }

        if (!glow) {
            glow = document.createElement('div');
            glow.className = 'gsap-cursor-glow';
            document.body.appendChild(glow);
        }

        const setDotX = gsap.quickTo(dot, 'x', { duration: 0.08, ease: 'power3' });
        const setDotY = gsap.quickTo(dot, 'y', { duration: 0.08, ease: 'power3' });
        const setGlowX = gsap.quickTo(glow, 'x', { duration: 0.28, ease: 'power2.out' });
        const setGlowY = gsap.quickTo(glow, 'y', { duration: 0.28, ease: 'power2.out' });

        let isVisible = false;

        window.addEventListener('mousemove', (e) => {
            if (!isVisible) {
                isVisible = true;
                gsap.to([dot, glow], { opacity: 1, duration: 0.3 });
            }
            setDotX(e.clientX);
            setDotY(e.clientY);
            setGlowX(e.clientX);
            setGlowY(e.clientY);
        });

        document.addEventListener('mouseleave', () => {
            isVisible = false;
            gsap.to([dot, glow], { opacity: 0, duration: 0.3 });
        });

        const interactiveSelector = 'a, button, input, select, textarea, .motion-card-hover, .program-card, .adm-card, [role="button"]';
        
        document.addEventListener('mouseover', (e) => {
            if (e.target.closest(interactiveSelector)) {
                glow.classList.add('is-hovering');
                dot.classList.add('is-hovering');
            }
        });

        document.addEventListener('mouseout', (e) => {
            if (e.target.closest(interactiveSelector)) {
                glow.classList.remove('is-hovering');
                dot.classList.remove('is-hovering');
            }
        });
    } catch (e) {
        console.warn('GSAP CustomCursor:', e);
    }
}

/**
 * 13. Public Credential Verifier Page Entrance
 */
function initVerifyPageMotion() {
    try {
        const verifyCard = document.querySelector('.verification-result-card');
        if (verifyCard && !prefersReducedMotion) {
            gsap.fromTo(verifyCard, 
                { scale: 0.94, opacity: 0, y: 25 }, 
                { scale: 1, opacity: 1, y: 0, duration: 0.7, ease: 'back.out(1.5)' }
            );

            const badge = verifyCard.querySelector('.verify-check-icon');
            if (badge) {
                gsap.fromTo(badge, 
                    { scale: 0, rotate: -35 }, 
                    { scale: 1, rotate: 0, duration: 0.6, delay: 0.2, ease: 'back.out(2)' }
                );
            }
        }
    } catch (e) {
        console.warn('GSAP VerifyPageMotion:', e);
    }
}

/**
 * Master Bootstrap for GSAP
 */
function bootstrapGSAP() {
    initScrollProgress();
    initNavbarMotion();
    initHeroTimeline();
    initAmbientOrbs();
    initScrollReveals();
    initCounters();
    init3DCardTilt();
    initMagneticButtons();
    initModalMotion();
    initSmoothScroll();
    initDashboardProgress();
    initCustomCursor();
    initVerifyPageMotion();

    // Ensure ScrollTrigger positions are recalculated accurately after layout settles
    setTimeout(() => {
        ScrollTrigger.refresh();
    }, 250);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrapGSAP);
} else {
    bootstrapGSAP();
}

window.addEventListener('resize', () => {
    ScrollTrigger.refresh();
});
