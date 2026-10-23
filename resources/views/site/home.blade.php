@extends('layouts.app')

@section('title', 'Infinity Interns – UGC-Focused Internship & Skill Development')

@section('content')
<!-- Hero Section (Light Mode: Expansive 2-Column Showcase with Balanced Width & Zero Empty Space) -->
<section id="home" class="relative pt-20 sm:pt-24 pb-12 lg:pb-16 flex items-center justify-center overflow-hidden bg-[#FAFBF9] text-slate-900">
    <!-- Ambient Luminous Gradient Mesh & Orbs (Light Mode) -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <!-- Top Left Cyan-Teal Glow -->
        <div class="blob-anim-1 absolute -top-24 -left-24 w-[620px] h-[620px] bg-gradient-to-br from-cyan-200/50 via-teal-100/40 to-transparent rounded-full blur-[120px]"></div>
        <!-- Center Right Indigo-Purple Glow -->
        <div class="blob-anim-2 absolute top-1/4 right-0 w-[680px] h-[680px] bg-gradient-to-bl from-indigo-200/45 via-purple-100/35 to-sky-100/25 rounded-full blur-[130px]"></div>
        <!-- Bottom Left Emerald-Teal Glow -->
        <div class="blob-anim-3 absolute -bottom-20 left-1/4 w-[580px] h-[580px] bg-gradient-to-tr from-emerald-100/40 via-teal-100/30 to-transparent rounded-full blur-[140px]"></div>
        <!-- Subtle Animated Dot Grid for Depth -->
        <div class="absolute inset-0 opacity-40 pointer-events-none" style="background-image: radial-gradient(rgba(99, 102, 241, 0.15) 1.2px, transparent 1.2px); background-size: 26px 26px;"></div>
        <!-- Soft Bottom Vignette Fade -->
        <div class="absolute bottom-0 inset-x-0 h-24 bg-gradient-to-t from-[#FAFBF9] to-transparent"></div>
    </div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-1 pb-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- ==================== LEFT COLUMN: HEADLINE, CTA, BADGES & HIGHLIGHTS ==================== -->
            <div class="lg:col-span-6 flex flex-col items-start text-left">
                <!-- UGC Badge with Glowing Conic Border -->
                <div class="motion-hero-badge inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/95 backdrop-blur-md border border-teal-200/90 shadow-md shadow-teal-500/10 text-teal-800 mb-6 gradient-border-glow">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-600"></span>
                    </span>
                    <span class="text-xs font-bold tracking-[0.2em] uppercase">UGC-Accredited Internship Program 2026</span>
                </div>

                <!-- Headline with High-Contrast Typography & Iridescent Gradient -->
                <h1 class="motion-hero-title text-4xl sm:text-5xl lg:text-6xl font-sans font-extrabold tracking-tight text-slate-900 leading-[1.08] mb-6">
                    Unlock your potential with <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 via-indigo-600 to-cyan-600 animate-text-gradient font-extrabold italic">
                        world-class learning.
                    </span>
                </h1>

                <!-- Subheading -->
                <p class="motion-hero-sub text-base sm:text-lg text-slate-600 font-normal leading-relaxed mb-8 max-w-xl">
                    Access a wide range of UGC-aligned internship programs designed to help undergraduate students achieve their career goals, mentored by industry experts with verified academic credits.
                </p>

                <!-- CTA Buttons Row -->
                <div class="motion-hero-cta flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 mb-7 w-full sm:w-auto">
                    <button onclick="openApplyModal()" class="btn-animated-sheen btn-glow-pulse h-13 px-8 text-sm sm:text-base font-bold text-white bg-gradient-to-r from-teal-500 via-cyan-600 to-teal-500 hover:from-teal-400 hover:to-cyan-500 rounded-full shadow-lg shadow-teal-500/25 transition-all duration-300 flex items-center justify-center gap-2.5 cursor-pointer active:scale-95 group">
                        <span>Get Started for Free</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <a href="#programs" class="h-13 px-7 text-sm font-bold text-slate-700 hover:text-indigo-600 bg-white hover:bg-slate-50 border border-slate-200 hover:border-indigo-300 rounded-full shadow-2xs hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer active:scale-95">
                        <span>Explore Programs</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>

                <!-- Degree Stream Badges -->
                <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500 font-medium mb-8">
                    <span class="font-semibold text-slate-700">Programs For:</span>
                    @foreach(['BA', 'BSc', 'BBA', 'BCA', 'BCom'] as $deg)
                        <span class="px-3 py-1 rounded-full bg-white border border-slate-200 text-slate-800 font-bold shadow-2xs hover:border-teal-300 hover:text-teal-700 transition">{{ $deg }}</span>
                    @endforeach
                    <span class="text-slate-400">& related degrees</span>
                </div>

                <!-- 4 Value Pillar Highlights (Fills Left Side Beautifully) -->
                <div class="grid grid-cols-2 gap-3 pt-5 border-t border-slate-200/80 w-full">
                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-sm border border-slate-200/80 shadow-2xs hover:border-teal-300 transition">
                        <span class="text-xl">🎖️</span>
                        <div>
                            <div class="text-xs font-bold text-slate-900">UGC Aligned</div>
                            <div class="text-[11px] text-slate-500">NEP-2020 4-Credit Ready</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-sm border border-slate-200/80 shadow-2xs hover:border-teal-300 transition">
                        <span class="text-xl">⚡</span>
                        <div>
                            <div class="text-xs font-bold text-slate-900">Real Capstones</div>
                            <div class="text-[11px] text-slate-500">Hands-on Deliverables</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-sm border border-slate-200/80 shadow-2xs hover:border-teal-300 transition">
                        <span class="text-xl">📜</span>
                        <div>
                            <div class="text-xs font-bold text-slate-900">Verified Certificate</div>
                            <div class="text-[11px] text-slate-500">Tamper-Proof QR Code</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 backdrop-blur-sm border border-slate-200/80 shadow-2xs hover:border-teal-300 transition">
                        <span class="text-xl">🤝</span>
                        <div>
                            <div class="text-xs font-bold text-slate-900">1-on-1 Mentorship</div>
                            <div class="text-[11px] text-slate-500">4.9/5 Student Rating</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== RIGHT COLUMN: DIGITAL WORKSTATION SHOWCASE (ANIMATED WITH NO OVERLAY CARDS) ==================== -->
            <div class="lg:col-span-6 relative w-full pt-4 lg:pt-0">
                <!-- Vector Illustration: Modern Workstation Monitor, Foliage, Student Typing, and Stand -->
                <svg class="w-full h-auto drop-shadow-[0_20px_50px_rgba(15,23,42,0.15)]" viewBox="0 0 1000 620" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <!-- Inline CSS Animations for Silky-Smooth 60FPS Performance -->
                        <style>
                            @keyframes typingLeftHand {
                                0%, 100% { transform: translateY(0px) rotate(0deg); }
                                50% { transform: translateY(-4px) rotate(-3deg); }
                            }
                            @keyframes typingRightHand {
                                0%, 100% { transform: translateY(-3px) rotate(2deg); }
                                50% { transform: translateY(2px) rotate(-2deg); }
                            }
                            @keyframes studentBodySway {
                                0%, 100% { transform: translateY(0px); }
                                50% { transform: translateY(-1.5px); }
                            }
                            @keyframes laptopScreenPulse {
                                0%, 100% { opacity: 0.82; filter: drop-shadow(0 0 4px rgba(56,189,248,0.4)); }
                                50% { opacity: 1; filter: drop-shadow(0 0 14px rgba(56,189,248,0.95)); }
                            }
                            @keyframes keystrokeSpark1 {
                                0% { opacity: 0; transform: translateY(0) scale(0.6); }
                                50% { opacity: 0.9; transform: translateY(-8px) scale(1); }
                                100% { opacity: 0; transform: translateY(-16px) scale(0.2); }
                            }
                            @keyframes keystrokeSpark2 {
                                0% { opacity: 0; transform: translateY(0) scale(0.6); }
                                50% { opacity: 0.8; transform: translateY(-10px) scale(1.1); }
                                100% { opacity: 0; transform: translateY(-20px) scale(0.3); }
                            }
                            @keyframes gridScanAnim {
                                0% { transform: translateY(0px); opacity: 0; }
                                20% { opacity: 0.7; }
                                80% { opacity: 0.7; }
                                100% { transform: translateY(320px); opacity: 0; }
                            }
                            @keyframes cursorBlink {
                                0%, 49% { opacity: 1; }
                                50%, 100% { opacity: 0; }
                            }
                            @keyframes statusDotPulse {
                                0%, 100% { opacity: 1; transform: scale(1); }
                                50% { opacity: 0.45; transform: scale(0.8); }
                            }
                            @keyframes leafSwayL {
                                0%, 100% { transform: rotate(0deg); }
                                50% { transform: rotate(-2.5deg); }
                            }
                            @keyframes leafSwayR {
                                0%, 100% { transform: rotate(0deg); }
                                50% { transform: rotate(2.5deg); }
                            }

                            .anim-typing-l {
                                animation: typingLeftHand 0.22s ease-in-out infinite;
                                transform-origin: 295px 452px;
                            }
                            .anim-typing-r {
                                animation: typingRightHand 0.22s ease-in-out infinite;
                                transform-origin: 308px 454px;
                            }
                            .anim-student-body {
                                animation: studentBodySway 1.8s ease-in-out infinite;
                                transform-origin: 250px 530px;
                            }
                            .anim-laptop-pulse {
                                animation: laptopScreenPulse 1.6s ease-in-out infinite;
                            }
                            .anim-keystroke-1 {
                                animation: keystrokeSpark1 1.2s ease-out infinite;
                                transform-origin: 304px 448px;
                            }
                            .anim-keystroke-2 {
                                animation: keystrokeSpark2 1.4s ease-out infinite 0.5s;
                                transform-origin: 316px 449px;
                            }
                            .anim-grid-scan {
                                animation: gridScanAnim 4s ease-in-out infinite;
                            }
                            .anim-cursor {
                                animation: cursorBlink 0.8s infinite;
                            }
                            .anim-status-dot {
                                animation: statusDotPulse 1.5s ease-in-out infinite;
                                transform-origin: 704px 112px;
                            }
                            .anim-leaf-left {
                                animation: leafSwayL 5.5s ease-in-out infinite;
                                transform-origin: 170px 520px;
                            }
                            .anim-leaf-right {
                                animation: leafSwayR 6s ease-in-out infinite;
                                transform-origin: 830px 520px;
                            }
                        </style>

                        <!-- Screen Gradient (Cyan-Blue Workspace Matching Screenshot) -->
                        <linearGradient id="screenGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#2D7BB5"/>
                            <stop offset="50%" stop-color="#1B598A"/>
                            <stop offset="100%" stop-color="#0E3D63"/>
                        </linearGradient>

                        <!-- Monitor Coordinate Grid Pattern (Matching Screenshot) -->
                        <pattern id="monitorGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                            <rect width="60" height="60" fill="none"/>
                            <path d="M 60 0 L 0 0 0 60" fill="none" stroke="#38BDF8" stroke-width="0.9" stroke-opacity="0.22"/>
                        </pattern>

                        <!-- Monitor Outer Bezel (Sleek Slate-Navy) -->
                        <linearGradient id="bezelGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#1E293B"/>
                            <stop offset="50%" stop-color="#0F172A"/>
                            <stop offset="100%" stop-color="#020617"/>
                        </linearGradient>

                        <!-- Stand Gradient -->
                        <linearGradient id="standGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#64748B"/>
                            <stop offset="100%" stop-color="#334155"/>
                        </linearGradient>

                        <!-- Base Plate Gradient -->
                        <linearGradient id="baseGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#475569"/>
                            <stop offset="50%" stop-color="#94A3B8"/>
                            <stop offset="100%" stop-color="#475569"/>
                        </linearGradient>

                        <!-- Character Teal Sweatshirt Gradient -->
                        <linearGradient id="charTealGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#00C49F"/>
                            <stop offset="50%" stop-color="#00A887"/>
                            <stop offset="100%" stop-color="#007B65"/>
                        </linearGradient>

                        <!-- Character Laptop Screen Glow -->
                        <linearGradient id="laptopGlow" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#BAE6FD"/>
                            <stop offset="100%" stop-color="#38BDF8"/>
                        </linearGradient>

                        <!-- Foliage Gradients -->
                        <linearGradient id="leafCyanBlue" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#38BDF8"/>
                            <stop offset="50%" stop-color="#0284C7"/>
                            <stop offset="100%" stop-color="#0369A1"/>
                        </linearGradient>
                        <linearGradient id="leafLightCyan" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#7DD3FC"/>
                            <stop offset="70%" stop-color="#0EA5E9"/>
                            <stop offset="100%" stop-color="#0284C7"/>
                        </linearGradient>
                        <linearGradient id="leafDeepTeal" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#2DD4BF"/>
                            <stop offset="50%" stop-color="#0D9488"/>
                            <stop offset="100%" stop-color="#115E59"/>
                        </linearGradient>
                        <linearGradient id="leafCyanWash" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#A5F3FC"/>
                            <stop offset="60%" stop-color="#38BDF8"/>
                            <stop offset="100%" stop-color="#0284C7"/>
                        </linearGradient>

                        <!-- Desk Ambient Soft Shadow -->
                        <radialGradient id="deskGlow" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#0EA5E9" stop-opacity="0.25"/>
                            <stop offset="60%" stop-color="#0284C7" stop-opacity="0.08"/>
                            <stop offset="100%" stop-color="#FAFBF9" stop-opacity="0"/>
                        </radialGradient>
                    </defs>

                    <!-- Ambient Desk Reflection -->
                    <ellipse cx="500" cy="565" rx="380" ry="25" fill="url(#deskGlow)"/>

                    <!-- ==================== LEFT FOLIAGE BOTANICAL CLUSTER (SWAYING IN BREEZE) ==================== -->
                    <g id="left-foliage" class="anim-leaf-left">
                        <!-- Back Deep Leaf (Monstera Fan) -->
                        <path d="M 170 510 C 90 440 30 350 40 210 C 55 195 75 210 75 230 C 80 180 100 195 105 220 C 120 170 145 185 140 215 C 160 160 185 175 175 220 C 190 260 185 380 170 510 Z" fill="url(#leafDeepTeal)" opacity="0.95"/>
                        <path d="M 115 340 C 130 290 145 240 155 200" stroke="#5EEAD4" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <path d="M 125 320 C 105 300 80 295 65 300" stroke="#5EEAD4" stroke-width="1.5" stroke-linecap="round" opacity="0.4"/>
                        <path d="M 135 280 C 115 260 95 255 80 260" stroke="#5EEAD4" stroke-width="1.5" stroke-linecap="round" opacity="0.4"/>

                        <!-- Mid Leaf (Cyan-Blue Monstera) -->
                        <path d="M 190 520 C 100 450 35 370 45 280 C 65 270 85 285 85 305 C 85 250 110 265 115 290 C 125 240 150 255 145 285 C 165 235 190 250 185 295 C 195 360 195 440 190 520 Z" fill="url(#leafCyanBlue)"/>
                        <path d="M 130 380 C 150 320 165 280 175 250" stroke="#BAE6FD" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <path d="M 135 370 C 115 350 90 350 75 355" stroke="#BAE6FD" stroke-width="1.5" stroke-linecap="round" opacity="0.4"/>

                        <!-- Foreground Light Cyan Frond -->
                        <path d="M 210 530 C 130 480 80 430 90 350 C 110 340 125 360 120 375 C 125 330 150 345 150 365 C 165 320 190 335 185 375 C 195 425 205 470 210 530 Z" fill="url(#leafLightCyan)"/>

                        <!-- Small Accent Sprout Leaf -->
                        <path d="M 225 530 C 180 490 140 470 145 420 C 160 415 175 430 170 445 C 185 410 205 425 200 455 C 215 480 220 505 225 530 Z" fill="url(#leafCyanWash)"/>
                    </g>

                    <!-- ==================== RIGHT FOLIAGE BOTANICAL CLUSTER (SWAYING IN BREEZE) ==================== -->
                    <g id="right-foliage" class="anim-leaf-right">
                        <!-- Back Deep Leaf -->
                        <path d="M 830 510 C 910 440 970 350 960 210 C 945 195 925 210 925 230 C 920 180 900 195 895 220 C 880 170 855 185 860 215 C 840 160 815 175 825 220 C 810 260 815 380 830 510 Z" fill="url(#leafDeepTeal)" opacity="0.95"/>
                        <path d="M 885 340 C 870 290 855 240 845 200" stroke="#5EEAD4" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <path d="M 875 320 C 895 300 920 295 935 300" stroke="#5EEAD4" stroke-width="1.5" stroke-linecap="round" opacity="0.4"/>
                        <path d="M 865 280 C 885 260 905 255 920 260" stroke="#5EEAD4" stroke-width="1.5" stroke-linecap="round" opacity="0.4"/>

                        <!-- Mid Leaf (Tropical Green as in screenshot) -->
                        <path d="M 810 520 C 900 450 965 370 955 280 C 935 270 915 285 915 305 C 915 250 890 265 885 290 C 875 240 850 255 855 285 C 835 235 810 250 815 295 C 805 360 805 440 810 520 Z" fill="url(#leafCyanBlue)"/>
                        <path d="M 870 380 C 850 320 835 280 825 250" stroke="#BAE6FD" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <path d="M 865 370 C 885 350 910 350 925 355" stroke="#BAE6FD" stroke-width="1.5" stroke-linecap="round" opacity="0.4"/>

                        <!-- Foreground Light Cyan Frond -->
                        <path d="M 790 530 C 870 480 920 430 910 350 C 890 340 875 360 880 375 C 875 330 850 345 850 365 C 835 320 810 335 815 375 C 805 425 795 470 790 530 Z" fill="url(#leafLightCyan)"/>

                        <!-- Small Accent Sprout Leaf -->
                        <path d="M 775 530 C 820 490 860 470 855 420 C 840 415 825 430 830 445 C 815 410 795 425 800 455 C 785 480 780 505 775 530 Z" fill="url(#leafCyanWash)"/>

                        <!-- Desk Plant Base Element (Matching Screenshot at Bottom-Right) -->
                        <path d="M 765 540 C 765 490 790 480 820 480 C 850 480 875 490 875 540 Z" fill="url(#charTealGrad)" opacity="0.9"/>
                    </g>

                    <!-- ==================== MONITOR DISPLAY ==================== -->
                    <g id="monitor-unit">
                        <!-- Stand Neck -->
                        <path d="M 465 470 L 535 470 L 545 540 L 455 540 Z" fill="url(#standGrad)"/>
                        <path d="M 465 470 L 468 470 L 458 540 L 455 540 Z" fill="#94A3B8" opacity="0.5"/>

                        <!-- Stand Base Plate -->
                        <rect x="370" y="538" width="260" height="14" rx="7" fill="url(#baseGrad)" stroke="#CBD5E1" stroke-width="1"/>

                        <!-- Monitor Outer Chassis -->
                        <rect x="180" y="70" width="640" height="404" rx="26" fill="url(#bezelGrad)" stroke="#38BDF8" stroke-width="2" stroke-opacity="0.4"/>

                        <!-- Monitor Top Camera Dot & LED -->
                        <circle cx="500" cy="82" r="3.5" fill="#040916"/>
                        <circle cx="510" cy="82" r="1.5" fill="#34D399"/>

                        <!-- Inner Screen Area (Blue Background) -->
                        <rect x="194" y="94" width="612" height="364" rx="16" fill="url(#screenGrad)"/>

                        <!-- Coordinate Grid Pattern (Matching User Screenshot) -->
                        <rect x="194" y="128" width="612" height="330" fill="url(#monitorGrid)"/>

                        <!-- Ambient Grid Scanline Sweep -->
                        <line x1="194" y1="128" x2="806" y2="128" stroke="#38BDF8" stroke-width="2" stroke-opacity="0.4" class="anim-grid-scan"/>

                        <!-- Screen Browser Navigation Header (Matching Screenshot) -->
                        <rect x="194" y="94" width="612" height="34" rx="16" fill="#081E3B" opacity="0.95"/>
                        <rect x="194" y="112" width="612" height="16" fill="#081E3B" opacity="0.95"/>
                        <!-- 3 Window Control Dots -->
                        <circle cx="216" cy="111" r="4.5" fill="#EF4444"/>
                        <circle cx="230" cy="111" r="4.5" fill="#F59E0B"/>
                        <circle cx="244" cy="111" r="4.5" fill="#10B981"/>
                        <!-- URL Capsule -->
                        <rect x="290" y="103" width="280" height="18" rx="9" fill="#0D284D" stroke="#38BDF8" stroke-width="0.8" stroke-opacity="0.3"/>
                        <text x="315" y="116" fill="#BAE6FD" font-size="10" font-family="sans-serif" font-weight="500">infinityinterns.org/ugc-portal/workspace</text>
                        <path d="M 303 115 L 303 112 C 303 110.5 304 109.5 305.5 109.5 C 307 109.5 308 110.5 308 112 L 308 115 Z M 301.5 115 L 309.5 115 L 309.5 119 L 301.5 119 Z" fill="#38BDF8"/>
                        <!-- Active Status Chip (Matching Screenshot) -->
                        <rect x="690" y="103" width="100" height="18" rx="9" fill="#0D284D" stroke="#10B981" stroke-width="0.8" stroke-opacity="0.5"/>
                        <circle cx="704" cy="112" r="3" fill="#10B981" class="anim-status-dot"/>
                        <text x="714" y="116" fill="#6EE7B7" font-size="9" font-family="sans-serif" font-weight="700">UGC ACTIVE</text>

                        <!-- ==================== INSIDE SCREEN: LIVE TYPING CODE TERMINAL (ANIMATED) ==================== -->
                        <g id="screen-live-ide">
                            <!-- Code Window Frame Floating over Grid -->
                            <rect x="340" y="150" width="446" height="266" rx="12" fill="#061830" fill-opacity="0.85" stroke="#38BDF8" stroke-width="1" stroke-opacity="0.35"/>
                            
                            <!-- Window Header -->
                            <rect x="340" y="150" width="446" height="26" rx="12" fill="#030E20" fill-opacity="0.95"/>
                            <rect x="340" y="164" width="446" height="12" fill="#030E20" fill-opacity="0.95"/>
                            <circle cx="356" cy="163" r="3.5" fill="#64748B"/>
                            <circle cx="367" cy="163" r="3.5" fill="#64748B"/>
                            <circle cx="378" cy="163" r="3.5" fill="#64748B"/>
                            
                            <rect x="398" y="155" width="136" height="18" rx="5" fill="#0B264A"/>
                            <text x="410" y="167" fill="#7DD3FC" font-size="8.5" font-family="monospace" font-weight="bold">📄 CapstoneProject.tsx</text>
                            <rect x="542" y="155" width="85" height="18" rx="5" fill="#061830" fill-opacity="0.5"/>
                            <text x="552" y="167" fill="#64748B" font-size="8.5" font-family="monospace">terminal</text>

                            <!-- Syntax Highlighted Live Code -->
                            <g font-family="monospace" font-size="9">
                                <text x="358" y="196" fill="#64748B">// UGC Accredited Live Workspace • Active Typing</text>
                                
                                <text x="358" y="216" fill="#F472B6">import <tspan fill="#38BDF8">{ verifyMilestone }</tspan> <tspan fill="#F472B6">from</tspan> <tspan fill="#34D399">'@ugc/intern-nep'</tspan>;</text>
                                
                                <text x="358" y="236" fill="#F472B6">const <tspan fill="#FBBF24">internship</tspan> = <tspan fill="#60A5FA">new</tspan> <tspan fill="#38BDF8">CapstoneCohort</tspan>({</text>
                                <text x="372" y="254" fill="#94A3B8">candidate: <tspan fill="#34D399">"Undergraduate Scholar"</tspan>,</text>
                                <text x="372" y="272" fill="#94A3B8">framework: <tspan fill="#34D399">"NEP-2020 Aligned (4 Credits)"</tspan>,</text>
                                <text x="372" y="290" fill="#94A3B8">progress: <tspan fill="#34D399">"Week 4 of 6 • On Track"</tspan>,</text>
                                <text x="372" y="308" fill="#94A3B8">evaluation: <tspan fill="#10B981">"PASSED (94% Verified)"</tspan></text>
                                <text x="358" y="326" fill="#F472B6">});</text>

                                <!-- Live CLI Terminal Execution Box with Blinking Cursor -->
                                <rect x="352" y="342" width="422" height="58" rx="8" fill="#020A17" stroke="#1E3A5F" stroke-width="1"/>
                                <text x="366" y="362" fill="#38BDF8" font-weight="bold">> deploy --verified-cohort --generate-lor</text>
                                <!-- Blinking Terminal Cursor -->
                                <rect x="635" y="352" width="6.5" height="12" fill="#38BDF8" class="anim-cursor"/>
                                <text x="366" y="382" fill="#34D399" font-weight="bold">✓ Build Succeeded • 4 Academic Credits & QR LOR Issued</text>
                            </g>
                        </g>
                    </g>

                    <!-- ==================== STUDENT CHARACTER (WITH ACTIVE TYPING ANIMATION AS IN SCREENSHOT) ==================== -->
                    <g id="student-character" class="anim-student-body">
                        <!-- Body / Torso in Teal Sweater (Matching Screenshot Shape & Color) -->
                        <path d="M 195 530 C 195 435 215 390 250 385 C 285 390 305 435 305 530 Z" fill="url(#charTealGrad)"/>
                        <path d="M 240 432 C 250 450 260 450 270 432" stroke="#007B65" stroke-width="2" stroke-linecap="round"/>
                        <path d="M 220 482 C 245 492 275 492 300 482" stroke="#007B65" stroke-width="2" stroke-linecap="round"/>

                        <!-- Neck -->
                        <rect x="242" y="358" width="16" height="28" rx="4" fill="#FAD4C0"/>

                        <!-- Head / Face -->
                        <ellipse cx="250" cy="336" rx="20" ry="24" fill="#FAD4C0"/>

                        <!-- Modern Dark Hair -->
                        <path d="M 230 334 C 229 310 244 300 261 305 C 274 310 273 322 271 334 C 264 318 254 315 239 322 Z" fill="#0F172A"/>
                        <path d="M 227 335 C 225 322 231 312 239 310 C 234 320 232 330 232 340 Z" fill="#0F172A"/>

                        <!-- Eyes / Brow focused down toward laptop -->
                        <ellipse cx="257" cy="332" rx="2.2" ry="1.5" fill="#0F172A"/>
                        <path d="M 254 327 C 257 326 261 327 263 329" stroke="#0F172A" stroke-width="1.5" stroke-linecap="round"/>

                        <!-- White Mask / Collar (As in reference screenshot) -->
                        <path d="M 245 340 C 251 339 263 339 268 344 C 269 352 263 360 253 360 C 245 360 242 352 245 340 Z" fill="#FFFFFF" stroke="#CBD5E1" stroke-width="1"/>
                        <path d="M 245 346 C 239 344 235 342 233 340" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"/>

                        <!-- Right Arm angled to keyboard -->
                        <path d="M 220 425 C 235 450 265 465 295 460 C 305 458 310 450 305 440 C 285 440 260 430 245 410 Z" fill="#00A887"/>

                        <!-- Laptop tilted upwards (Matching Screenshot) -->
                        <g id="student-laptop">
                            <!-- Base / Keyboard Tray -->
                            <polygon points="274,453 335,453 326,462 265,462" fill="#475569"/>
                            <polygon points="278,454 328,454 322,460 272,460" fill="#0F172A"/>
                            <!-- Laptop Screen Lid -->
                            <polygon points="278,450 322,400 330,404 290,455" fill="#1E293B"/>
                            <!-- Glowing Screen Display (Pulsing with typing reflection) -->
                            <polygon points="281,448 320,403 327,406 290,452" fill="url(#laptopGlow)" class="anim-laptop-pulse"/>
                            <circle cx="304" cy="428" r="2.5" fill="#FFFFFF" opacity="0.95"/>
                            <!-- Keystroke Sparks floating up from keyboard -->
                            <circle cx="304" cy="448" r="2.5" fill="#38BDF8" class="anim-keystroke-1"/>
                            <circle cx="316" cy="449" r="2" fill="#A5F3FC" class="anim-keystroke-2"/>
                        </g>

                        <!-- ANIMATED TYPING HANDS (Realistic, energetic alternating typing motion!) -->
                        <g id="animated-typing-hands">
                            <!-- Left Hand Typing -->
                            <ellipse cx="295" cy="452" rx="7" ry="4.5" fill="#FAD4C0" class="anim-typing-l"/>
                            <!-- Right Hand Typing -->
                            <ellipse cx="308" cy="454" rx="6.5" ry="4" fill="#F3D5B5" class="anim-typing-r"/>
                        </g>
                    </g>
                </svg>
            </div>

        </div>
    </div>
</section>

<!-- Live Impact Stats Strip with Animated Numbers (Luminous Light Mode Glass Styling) -->
<section class="py-10 bg-white/90 backdrop-blur-xl border-y border-slate-200/80 relative z-20 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="motion-stagger grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 text-center">
            <div class="p-5 rounded-3xl bg-[#FAFBF9]/90 border border-slate-200/80 hover:border-indigo-300 hover:shadow-md transition-all duration-300 shadow-2xs glass-interactive-card group">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-indigo-600 mb-1 motion-counter" data-target="{{ $stats['total_students'] ?? 1420 }}" data-suffix="+">
                    {{ number_format($stats['total_students'] ?? 1420) }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Undergraduate Learners</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">Enrolled Nationwide</div>
            </div>
            <div class="p-5 rounded-3xl bg-[#FAFBF9]/90 border border-slate-200/80 hover:border-emerald-300 hover:shadow-md transition-all duration-300 shadow-2xs glass-interactive-card group">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-emerald-600 mb-1 motion-counter" data-target="{{ $stats['active_interns'] ?? 890 }}" data-suffix="+">
                    {{ number_format($stats['active_interns'] ?? 890) }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Active Live Interns</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">Executing Capstones</div>
            </div>
            <div class="p-5 rounded-3xl bg-[#FAFBF9]/90 border border-slate-200/80 hover:border-purple-300 hover:shadow-md transition-all duration-300 shadow-2xs glass-interactive-card group">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-purple-600 mb-1 motion-counter" data-target="{{ $stats['certificates_issued'] ?? 520 }}" data-suffix="+">
                    {{ number_format($stats['certificates_issued'] ?? 520) }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Verified Certificates</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">Issued & Accredited</div>
            </div>
            <div class="p-5 rounded-3xl bg-[#FAFBF9]/90 border border-slate-200/80 hover:border-cyan-300 hover:shadow-md transition-all duration-300 shadow-2xs glass-interactive-card group">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-cyan-600 mb-1 motion-counter" data-target="{{ $stats['partner_colleges'] ?? 24 }}" data-suffix="+">
                    {{ $stats['partner_colleges'] ?? 24 }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Partner Institutions</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">College & University MoUs</div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Infinite Institutional Marquee Ribbon -->
<div class="py-3.5 bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 text-white overflow-hidden relative z-20 shadow-md">
    <div class="marquee-container">
        <div class="marquee-track flex items-center gap-8 text-xs font-semibold tracking-wider uppercase text-indigo-200">
            <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span> UGC Guidelines 2026 Compliant</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">🎓 NEP-2020 Semester Credit Aligned</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">🏛️ Patna University Affiliated Colleges</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">⚡ 4 to 8 Weeks Hands-on Research Capstone</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">🔒 Tamper-Proof QR Public Verification</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">📜 Official Letter of Recommendation (LOR)</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">⭐ 100% Academic Semester Recognition</span>
            <span class="text-indigo-400">•</span>
            <!-- Repeated loop for infinite smoothness -->
            <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span> UGC Guidelines 2026 Compliant</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">🎓 NEP-2020 Semester Credit Aligned</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">🏛️ Patna University Affiliated Colleges</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">⚡ 4 to 8 Weeks Hands-on Research Capstone</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">🔒 Tamper-Proof QR Public Verification</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">📜 Official Letter of Recommendation (LOR)</span>
            <span class="text-indigo-400">•</span>
            <span class="flex items-center gap-2">⭐ 100% Academic Semester Recognition</span>
            <span class="text-indigo-400">•</span>
        </div>
    </div>
</div>

<!-- Values / Pillars Section -->
<section class="py-16 bg-[#FAFBF9] border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="motion-stagger grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-3xl bg-white border border-slate-200/70 hover:border-slate-300 shadow-xs hover:shadow-md transition motion-card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-3 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 text-xl font-bold">UGC</div>
                    <h3 class="text-base font-bold text-slate-900 font-serif">UGC Focused</h3>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed font-light">
                    Designed strictly around undergraduate college guidelines and NEP-2020 semester credit requirements.
                </p>
            </div>
            <div class="p-6 rounded-3xl bg-white border border-slate-200/70 hover:border-slate-300 shadow-xs hover:shadow-md transition motion-card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-3 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 text-xl font-bold">PR</div>
                    <h3 class="text-base font-bold text-slate-900 font-serif">Practical Work</h3>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed font-light">
                    Hands-on activities, real deliverables, and domain-specific capstone projects for verifiable competency.
                </p>
            </div>
            <div class="p-6 rounded-3xl bg-white border border-slate-200/70 hover:border-slate-300 shadow-xs hover:shadow-md transition motion-card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-3 rounded-2xl bg-purple-50 border border-purple-100 text-purple-600 text-xl font-bold">06</div>
                    <h3 class="text-base font-bold text-slate-900 font-serif">Structured Journey</h3>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed font-light">
                    Predictable 6-step roadmap from simple registration to certified completion and marksheet issuance.
                </p>
            </div>
            <div class="p-6 rounded-3xl bg-white border border-slate-200/70 hover:border-slate-300 shadow-xs hover:shadow-md transition motion-card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-3 rounded-2xl bg-cyan-50 border border-cyan-100 text-cyan-600 text-xl font-bold">24h</div>
                    <h3 class="text-base font-bold text-slate-900 font-serif">Student First</h3>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed font-light">
                    Dedicated student assistance, accessible faculty mentors, and clear guidance throughout every milestone.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="programs" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="motion-reveal mb-16 md:mb-20 md:flex justify-between items-end gap-8 border-b border-slate-100 pb-8">
            <div>
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Program Categories</span>
                <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">
                    One Platform. <br>
                    <span class="text-indigo-700 italic">Many Career Paths.</span>
                </h2>
            </div>
            <p class="text-slate-600 max-w-md mt-4 md:mt-0 font-light text-base leading-relaxed">
                Choose a practical learning direction that complements your undergraduate stream and equips you with actionable skills beyond your college syllabus.
            </p>
        </div>

        <div class="motion-stagger grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- BA Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-slate-200/60 transition-all duration-300">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center font-extrabold text-sm text-indigo-700 shadow-xs">
                            BA
                        </div>
                        <span class="text-[10px] font-bold tracking-wider text-indigo-800 uppercase bg-indigo-50 border border-indigo-100 px-3 py-1 rounded-full">
                            ARTS & HUMANITIES
                        </span>
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 leading-snug group-hover:text-indigo-700 transition">
                        Arts, Social Science & Communication
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        For BA and related learners interested in social research, governance, public communication, community development, and editorial strategy.
                    </p>
                </div>
                <div>
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Political Science</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Public Survey</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Content</span>
                    </div>
                    <button onclick="openApplyModal()" class="btn-animated-sheen w-full py-2.5 px-4 rounded-full text-xs font-bold text-indigo-700 bg-indigo-50 hover:bg-indigo-600 hover:text-white border border-indigo-200/60 hover:shadow-lg hover:shadow-indigo-600/25 transition-all duration-300 flex items-center justify-center gap-1.5 cursor-pointer group/btn active:scale-95">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- BSc Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-cyan-500/10 transition-all duration-300">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center font-extrabold text-sm text-cyan-700 shadow-xs">
                            BS
                        </div>
                        <span class="text-[10px] font-bold tracking-wider text-cyan-800 uppercase bg-cyan-50 border border-cyan-100 px-3 py-1 rounded-full">
                            SCIENCE & DATA
                        </span>
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 leading-snug group-hover:text-cyan-700 transition">
                        Science, Environment & Data Skills
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        For BSc students exploring quantitative analysis, spreadsheet modelling, environment impact metrics, and lab documentation.
                    </p>
                </div>
                <div>
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Data Analytics</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">EIA Eco-Audit</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">GIS Basics</span>
                    </div>
                    <button onclick="openApplyModal()" class="btn-animated-sheen w-full py-2.5 px-4 rounded-full text-xs font-bold text-cyan-700 bg-cyan-50 hover:bg-cyan-600 hover:text-white border border-cyan-200/60 hover:shadow-lg hover:shadow-cyan-600/25 transition-all duration-300 flex items-center justify-center gap-1.5 cursor-pointer group/btn active:scale-95">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- BBA Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-300">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center font-extrabold text-sm text-purple-700 shadow-xs">
                            BB
                        </div>
                        <span class="text-[10px] font-bold tracking-wider text-purple-800 uppercase bg-purple-50 border border-purple-100 px-3 py-1 rounded-full">
                            BUSINESS & FINANCE
                        </span>
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 leading-snug group-hover:text-purple-700 transition">
                        Business, Finance & Entrepreneurship
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        For BBA and BCom undergraduates developing business communication, financial modelling, startup operations, and growth marketing.
                    </p>
                </div>
                <div>
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Cash Flow</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Pitch Decks</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Marketing</span>
                    </div>
                    <button onclick="openApplyModal()" class="btn-animated-sheen w-full py-2.5 px-4 rounded-full text-xs font-bold text-purple-700 bg-purple-50 hover:bg-purple-600 hover:text-white border border-purple-200/60 hover:shadow-lg hover:shadow-purple-600/25 transition-all duration-300 flex items-center justify-center gap-1.5 cursor-pointer group/btn active:scale-95">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- BCA Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-300">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center font-extrabold text-sm text-emerald-700 shadow-xs">
                            IT
                        </div>
                        <span class="text-[10px] font-bold tracking-wider text-emerald-800 uppercase bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full">
                            COMPUTER & WEB
                        </span>
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 leading-snug group-hover:text-emerald-700 transition">
                        Technology, Digital & Web Skills
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        For BCA and IT students seeking hands-on experience building full-stack web applications, databases, and defensive cybersecurity habits.
                    </p>
                </div>
                <div>
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Modern Web</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">SQL Database</span>
                        <span class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-white text-slate-700 border border-slate-200">Cyber Hygiene</span>
                    </div>
                    <button onclick="openApplyModal()" class="btn-animated-sheen w-full py-2.5 px-4 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white border border-emerald-200/60 hover:shadow-lg hover:shadow-emerald-600/25 transition-all duration-300 flex items-center justify-center gap-1.5 cursor-pointer group/btn active:scale-95">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Journey Section (Modern Horizontal Scrolling Experience) -->
<section id="journey" class="py-24 px-4 sm:px-6 lg:px-8 bg-[#F6F8F5] border-y border-slate-200/80 overflow-hidden relative">
    <div class="max-w-7xl mx-auto">
        <!-- Top Section Header with Controls -->
        <div class="motion-reveal flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div class="max-w-2xl">
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-3 block">Professional Training Journey</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-slate-900 leading-tight mb-3">
                    From Registration to <span class="text-indigo-700 italic">Completion.</span>
                </h2>
                <p class="text-slate-600 font-light text-sm sm:text-base leading-relaxed">
                    A clear, student-friendly journey combining organized learning modules, practical tasks, live mentor interaction, and certified internship documentation.
                </p>
            </div>

            <!-- Horizontal Slider Controls (Counter + Navigation Arrows) -->
            <div class="flex items-center gap-3 shrink-0 self-start md:self-end">
                <!-- Live Stage Counter Badge -->
                <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 shadow-xs flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>Stage <strong id="journeyStageNumber" class="text-indigo-700 font-bold text-sm">01</strong> of 06</span>
                </div>

                <!-- Prev Button -->
                <button type="button" id="journeyPrevBtn" class="w-11 h-11 rounded-2xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 hover:text-indigo-600 flex items-center justify-center transition shadow-xs hover:shadow-md cursor-pointer motion-btn-spring" title="Previous Stage" aria-label="Previous Stage">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <!-- Next Button -->
                <button type="button" id="journeyNextBtn" class="w-11 h-11 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white flex items-center justify-center transition shadow-md shadow-indigo-600/30 hover:shadow-lg cursor-pointer motion-btn-spring" title="Next Stage" aria-label="Next Stage">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- Quick-Jump Step Pills Navigation Bar -->
        <div class="mb-8 overflow-x-auto no-scrollbar pb-2">
            <div class="inline-flex items-center gap-2 p-1.5 rounded-2xl bg-white/80 border border-slate-200/90 shadow-xs">
                @php
                $stepPillTitles = [
                    '01' => 'Quick Registration',
                    '02' => 'Enrollment & Access',
                    '03' => 'Structured Learning',
                    '04' => 'Live Interaction',
                    '05' => 'Assessment & Project',
                    '06' => 'Receive Documents',
                ];
                @endphp
                @foreach($stepPillTitles as $idx => $stitle)
                <button type="button" onclick="scrollToJourneyStep({{ (int)$idx - 1 }})" class="journey-pill-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold transition cursor-pointer flex items-center gap-1.5 shrink-0 {{ $idx === '01' ? 'bg-indigo-600 text-white shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}" data-step-index="{{ (int)$idx - 1 }}">
                    <span class="text-[10px] opacity-75 font-mono">{{ $idx }}</span>
                    <span>{{ $stitle }}</span>
                </button>
                @endforeach
            </div>
        </div>

        <!-- Horizontal Scrollable Container with Edge Gradient Fades -->
        <div class="relative -mx-4 sm:-mx-6 lg:-mx-8">
            <!-- Left Edge Soft Fade Mask -->
            <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 sm:w-16 bg-gradient-to-r from-[#F6F8F5] to-transparent z-10"></div>

            <!-- Right Edge Soft Fade Mask -->
            <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 sm:w-16 bg-gradient-to-l from-[#F6F8F5] to-transparent z-10"></div>

            <!-- Horizontal Track -->
            <div id="journeyTrack" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth snap-x snap-mandatory py-4 px-4 sm:px-6 lg:px-8 cursor-grab select-none">
                @php
                $steps = [
                    ['step' => '01', 'title' => 'Quick Registration', 'duration' => '2 minutes', 'desc' => 'Complete your student profile with basic and academic details and choose your preferred area.', 'items' => ['Profile creation', 'Basic details', 'Course selection', 'Digital enrollment']],
                    ['step' => '02', 'title' => 'Enrollment & Access', 'duration' => 'Simple', 'desc' => 'Get the next onboarding instructions and access information for your selected internship journey.', 'items' => ['Program confirmation', 'Learning access', 'Student guidance', 'Orientation deck']],
                    ['step' => '03', 'title' => 'Structured Learning', 'duration' => 'Guided', 'desc' => 'Follow specialized subjects and organized learning materials designed around practical skill development.', 'items' => ['Learning modules', 'Study material', 'Activity guidance', 'Concept checks']],
                    ['step' => '04', 'title' => 'Live Interaction', 'duration' => 'Interactive', 'desc' => 'Join scheduled sessions and connect with faculty or mentors for explanations, questions and guidance.', 'items' => ['Live masterclasses', 'Student support', 'Live Q&A clinics', 'Peer forum']],
                    ['step' => '05', 'title' => 'Assessment & Project', 'duration' => 'Flexible', 'desc' => 'Complete assignments, quizzes and practical project work with performance-focused evaluation.', 'items' => ['Online assessment', 'Capstone project', 'Originality review', 'Scoring']],
                    ['step' => '06', 'title' => 'Receive Documents', 'duration' => 'Completion', 'desc' => 'Complete the internship requirements and receive the applicable accredited documentation.', 'items' => ['UGC Certificate', 'Detailed Marksheet', 'Report Format', 'Attendance Log']],
                ];
                @endphp

                @foreach($steps as $s)
                <div class="journey-card w-[86vw] sm:w-[380px] md:w-[410px] shrink-0 snap-start motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/90 hover:border-indigo-300 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                    <!-- Top Gradient Accent Bar -->
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 opacity-75 group-hover:opacity-100 transition"></div>

                    <div>
                        <div class="flex items-center justify-between mb-5 mt-1">
                            <span class="font-serif text-4xl sm:text-5xl font-extrabold text-indigo-600/70 group-hover:text-indigo-600 transition">{{ $s['step'] }}</span>
                            <span class="text-[11px] font-semibold px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100/80 shadow-xs">{{ $s['duration'] }}</span>
                        </div>
                        <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase block mb-1">STAGE {{ (int)$s['step'] }} OF 06</span>
                        <h3 class="text-xl font-serif text-slate-900 mb-2.5 group-hover:text-indigo-900 transition">{{ $s['title'] }}</h3>
                        <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">{{ $s['desc'] }}</p>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <ul class="grid grid-cols-2 gap-2 text-[11px] text-slate-700">
                            @foreach($s['items'] as $item)
                            <li class="flex items-center gap-1.5 font-medium truncate">
                                <span class="w-3.5 h-3.5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 text-[10px] font-bold">✓</span>
                                <span class="truncate">{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Dynamic Horizontal Progress Bar & Gesture Hint -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Progress Line Indicator -->
            <div class="w-full sm:w-72 bg-slate-200/80 rounded-full h-1.5 overflow-hidden">
                <div id="journeyProgressBar" class="bg-indigo-600 h-1.5 rounded-full transition-all duration-200" style="width: 16.66%;"></div>
            </div>

            <!-- Interactive Scroll Hint -->
            <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-indigo-500 animate-ping"></span>
                <span>Scroll or drag horizontally to view all 6 stages</span>
                <span class="text-indigo-600 font-bold">→</span>
            </div>
        </div>

        <!-- Registration CTA Card -->
        <div class="motion-reveal mt-12 p-8 rounded-[2rem] bg-white border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div>
                <h4 class="text-xl font-serif text-slate-900">Ready to start your undergraduate internship?</h4>
                <p class="text-xs text-slate-600 mt-1 font-light">Registration takes less than 2 minutes through our online portal.</p>
            </div>
            <button onclick="openApplyModal()" class="motion-btn-spring px-8 py-3.5 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/25 shrink-0 flex items-center gap-2 cursor-pointer active:scale-95">
                <span>Register Now</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- Journey Interactive Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('journeyTrack');
        const prevBtn = document.getElementById('journeyPrevBtn');
        const nextBtn = document.getElementById('journeyNextBtn');
        const progressBar = document.getElementById('journeyProgressBar');
        const stageNumber = document.getElementById('journeyStageNumber');
        const pillButtons = document.querySelectorAll('.journey-pill-btn');

        if (!track) return;

        // 1. Mouse wheel horizontal scroll handler
        track.addEventListener('wheel', function (e) {
            const maxScrollLeft = track.scrollWidth - track.clientWidth;
            const atStart = track.scrollLeft <= 5 && e.deltaY < 0;
            const atEnd = track.scrollLeft >= maxScrollLeft - 5 && e.deltaY > 0;

            // If user has room to scroll inside the track, hijack the wheel to scroll horizontally
            if (!atStart && !atEnd) {
                e.preventDefault();
                track.scrollBy({
                    left: e.deltaY * 1.6,
                    behavior: 'auto'
                });
            }
        }, { passive: false });

        // 2. Click & Drag to Scroll Handler
        let isDown = false;
        let startX;
        let scrollLeft;

        track.addEventListener('mousedown', function (e) {
            isDown = true;
            track.classList.add('cursor-grabbing');
            track.classList.remove('cursor-grab');
            startX = e.pageX - track.offsetLeft;
            scrollLeft = track.scrollLeft;
        });

        track.addEventListener('mouseleave', function () {
            isDown = false;
            track.classList.remove('cursor-grabbing');
            track.classList.add('cursor-grab');
        });

        track.addEventListener('mouseup', function () {
            isDown = false;
            track.classList.remove('cursor-grabbing');
            track.classList.add('cursor-grab');
        });

        track.addEventListener('mousemove', function (e) {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - track.offsetLeft;
            const walk = (x - startX) * 1.5;
            track.scrollLeft = scrollLeft - walk;
        });

        // 3. Arrow Navigation Buttons
        function getCardStepWidth() {
            const firstCard = track.querySelector('.journey-card');
            return firstCard ? firstCard.offsetWidth + 24 : 400; // card width + gap
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                track.scrollBy({ left: -getCardStepWidth(), behavior: 'smooth' });
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                track.scrollBy({ left: getCardStepWidth(), behavior: 'smooth' });
            });
        }

        // 4. Update Indicators on Scroll
        function updateJourneyUI() {
            const scrollWidth = track.scrollWidth - track.clientWidth;
            const currentScroll = track.scrollLeft;
            const progress = scrollWidth > 0 ? (currentScroll / scrollWidth) : 0;

            // Update Progress Line (min 16% to 100%)
            if (progressBar) {
                const percent = Math.min(100, Math.max(16.66, 16.66 + (progress * 83.34)));
                progressBar.style.width = percent + '%';
            }

            // Calculate active index (0 to 5)
            const cardWidth = getCardStepWidth();
            const activeIdx = Math.min(5, Math.max(0, Math.round(currentScroll / cardWidth)));

            if (stageNumber) {
                stageNumber.textContent = String(activeIdx + 1).padStart(2, '0');
            }

            // Update Stage Pills Active Style
            pillButtons.forEach(function (pill, idx) {
                if (idx === activeIdx) {
                    pill.classList.add('bg-indigo-600', 'text-white', 'shadow-xs', 'font-bold');
                    pill.classList.remove('text-slate-600', 'hover:text-slate-900', 'hover:bg-slate-100');
                } else {
                    pill.classList.remove('bg-indigo-600', 'text-white', 'shadow-xs', 'font-bold');
                    pill.classList.add('text-slate-600', 'hover:text-slate-900', 'hover:bg-slate-100');
                }
            });
        }

        track.addEventListener('scroll', updateJourneyUI, { passive: true });
        window.addEventListener('resize', updateJourneyUI, { passive: true });
        updateJourneyUI();

        // 5. Global helper to scroll to specific step
        window.scrollToJourneyStep = function (stepIdx) {
            const cardWidth = getCardStepWidth();
            track.scrollTo({
                left: stepIdx * cardWidth,
                behavior: 'smooth'
            });
        };
    });
</script>

<!-- Documents Section -->
<section id="documents" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="motion-reveal mb-16 md:mb-20 md:flex justify-between items-end gap-8 border-b border-slate-100 pb-8">
            <div>
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Internship Documentation</span>
                <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">
                    Everything You Need <br>
                    <span class="text-indigo-700 italic">to Document Your Journey.</span>
                </h2>
            </div>
            <p class="text-slate-600 max-w-md mt-4 md:mt-0 font-light text-base leading-relaxed">
                University UGC compliance requires verifiable records. Receive authentic certificates, evaluated marksheets, structured project reports, and session attendance logs.
            </p>
        </div>

        <div class="motion-stagger grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 hover:shadow-xl transition flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-indigo-700 text-2xl font-bold mb-6 shadow-xs group-hover:scale-105 transition">
                        ✦
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 group-hover:text-indigo-700 transition">Internship Certificate</h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        Completion documentation for your internship journey, subject to applicable program requirements and tamper-proof verification serials.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <span class="text-[10px] font-bold tracking-wider text-indigo-700 uppercase flex items-center gap-1.5">
                        <span>🛡️</span>
                        <span>COMPLETION DOCUMENT</span>
                    </span>
                </div>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 hover:shadow-xl transition flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-emerald-700 text-2xl font-bold mb-6 shadow-xs group-hover:scale-105 transition">
                        ▤
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 group-hover:text-emerald-700 transition">Detailed Marksheet</h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        Performance-oriented documentation covering applicable evaluation, percentage, component marks, and semester grade point breakdown.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <span class="text-[10px] font-bold tracking-wider text-emerald-700 uppercase flex items-center gap-1.5">
                        <span>📊</span>
                        <span>PERFORMANCE RECORD</span>
                    </span>
                </div>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 hover:shadow-xl transition flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-purple-700 text-2xl font-bold mb-6 shadow-xs group-hover:scale-105 transition">
                        ▣
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 group-hover:text-purple-700 transition">Project Report Format</h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        A structured dossier format to help students document their problem statements, methodologies, practical activities, and capstone results.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <span class="text-[10px] font-bold tracking-wider text-purple-700 uppercase flex items-center gap-1.5">
                        <span>📁</span>
                        <span>STUDENT RESOURCE</span>
                    </span>
                </div>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 hover:shadow-xl transition flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-cyan-700 text-2xl font-bold mb-6 shadow-xs group-hover:scale-105 transition">
                        □
                    </div>
                    <h3 class="text-xl font-serif text-slate-900 mb-3 group-hover:text-cyan-700 transition">Attendance Record</h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        Participation record certifying that the student logged required hours, milestone reviews, and live interactive webinars.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <span class="text-[10px] font-bold tracking-wider text-cyan-700 uppercase flex items-center gap-1.5">
                        <span>⏱️</span>
                        <span>PARTICIPATION RECORD</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Subjects Section -->
<section id="subjects" class="py-24 px-4 sm:px-6 lg:px-8 bg-[#F6F8F5] border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto">
        <div class="motion-reveal text-center max-w-2xl mx-auto mb-16">
            <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Multidisciplinary Learning</span>
            <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight mb-4">
                Specialized Learning <span class="text-indigo-700 italic">Domains.</span>
            </h2>
            <p class="text-slate-600 font-light text-base leading-relaxed">
                Select your focus area from four curated domains designed around real employer demands and semester curricula.
            </p>
        </div>

        <div class="motion-stagger grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/80 shadow-xs">
                <h3 class="text-lg font-serif font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Technology & Digital</h3>
                <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> Web Development & Design</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> Cyber Security Essentials</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> Digital Literacy & Office Suite</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> Graphics & Content Creation</li>
                </ul>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/80 shadow-xs">
                <h3 class="text-lg font-serif font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Social Sciences & Policy</h3>
                <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span> Political Science & Policy</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span> Community & Rural Development</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span> Social Research & Field Surveys</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span> Demographics & Census Studies</li>
                </ul>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/80 shadow-xs">
                <h3 class="text-lg font-serif font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Professional & Business</h3>
                <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Personality & Soft Skills</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Financial Literacy & Budgeting</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Entrepreneurship & Startups</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Modern Pedagogy & Teaching</li>
                </ul>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/80 shadow-xs">
                <h3 class="text-lg font-serif font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Environment & Agri</h3>
                <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-cyan-600"></span> Environmental Science & Audits</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-cyan-600"></span> Sustainable Agro-Tech</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-cyan-600"></span> Eco-Tourism & Hospitality</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-cyan-600"></span> Disaster Risk Management</li>
                </ul>
            </div>
        </div>

        <div class="motion-reveal text-center mt-10">
            <a href="{{ route('subjects') }}" class="inline-flex items-center gap-2 text-xs font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-wider">
                <span>View Full Syllabus for all 16 Subjects →</span>
            </a>
        </div>
    </div>
</section>

<!-- Mentors Section -->
<section id="mentors" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <div class="motion-reveal-left lg:col-span-7 p-8 md:p-12 rounded-[2.5rem] bg-[#FAFBF9] border border-slate-200/80 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-700 font-serif text-2xl font-bold flex items-center justify-center shadow-xs">
                            M
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-indigo-600 tracking-[0.2em] uppercase block">Continuous Mentorship</span>
                            <h3 class="text-2xl font-serif text-slate-900">Practical guidance for every stage.</h3>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 font-light leading-relaxed mb-8">
                        From understanding complex concepts to submitting your final capstone project, our mentors help you overcome obstacles, clarify doubts, and meet all university internship criteria with confidence.
                    </p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-6 border-t border-slate-200/60">
                    <div class="motion-card-hover p-3.5 rounded-2xl bg-white border border-slate-200">
                        <span class="font-serif text-xs font-bold text-indigo-700 block mb-1">01</span>
                        <span class="text-xs font-semibold text-slate-800 block">Concept Guidance</span>
                    </div>
                    <div class="motion-card-hover p-3.5 rounded-2xl bg-white border border-slate-200">
                        <span class="font-serif text-xs font-bold text-indigo-700 block mb-1">02</span>
                        <span class="text-xs font-semibold text-slate-800 block">Activity Support</span>
                    </div>
                    <div class="motion-card-hover p-3.5 rounded-2xl bg-white border border-slate-200">
                        <span class="font-serif text-xs font-bold text-indigo-700 block mb-1">03</span>
                        <span class="text-xs font-semibold text-slate-800 block">Project Feedback</span>
                    </div>
                    <div class="motion-card-hover p-3.5 rounded-2xl bg-white border border-slate-200">
                        <span class="font-serif text-xs font-bold text-indigo-700 block mb-1">04</span>
                        <span class="text-xs font-semibold text-slate-800 block">Completion Review</span>
                    </div>
                </div>
            </div>

            <div class="motion-reveal-right lg:col-span-5 flex flex-col gap-6">
                <div class="motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/80 shadow-xs flex-1 flex flex-col justify-center">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center mb-4 text-xl">💬</div>
                    <h4 class="text-xl font-serif text-slate-900 mb-2">Ask. Understand. Improve.</h4>
                    <p class="text-xs text-slate-600 font-light leading-relaxed">
                        Live interactive Q&A and doubt-clearing sessions empower you to grasp practical methods and execute tasks smoothly.
                    </p>
                </div>
                <div class="motion-card-hover p-8 rounded-[2.2rem] bg-indigo-900 text-white shadow-xl shadow-indigo-900/10 flex-1 flex flex-col justify-center">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 text-white flex items-center justify-center mb-4 text-xl">🚀</div>
                    <h4 class="text-xl font-serif text-white mb-2">Career-Minded Learning</h4>
                    <p class="text-xs text-indigo-100/90 font-light leading-relaxed">
                        Build professional habits, articulate your work in interviews, and gain real-world confidence alongside your academic degree.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- For Colleges Section -->
<section id="colleges" class="py-24 px-4 sm:px-6 lg:px-8 bg-[#F6F8F5] border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="motion-reveal-left lg:col-span-7 space-y-6">
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase block">For Colleges & Institutions</span>
                <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">
                    Make Student Internship Coordination <span class="text-indigo-700 italic">Simpler.</span>
                </h2>
                <p class="text-slate-600 font-light text-base leading-relaxed">
                    Infinity Interns is designed with a college-friendly workflow in mind: bulk student onboarding, structured tracking, university compliance documentation, and dedicated coordinator support.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-2 text-xs text-slate-700 font-medium">
                    <div class="flex items-center gap-2"><span class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs">✓</span> Bulk student onboarding support</div>
                    <div class="flex items-center gap-2"><span class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs">✓</span> Progress & milestone tracking</div>
                    <div class="flex items-center gap-2"><span class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs">✓</span> UGC marksheet & certificate issuance</div>
                    <div class="flex items-center gap-2"><span class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs">✓</span> Formal institutional MOU desk</div>
                </div>
                <div class="pt-4">
                    <a href="{{ route('colleges') }}" class="motion-btn-spring inline-flex items-center gap-2 h-13 px-8 rounded-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs tracking-wider uppercase shadow-md transition cursor-pointer">
                        <span>Request Institutional Partnership</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <div class="motion-reveal-right lg:col-span-5">
                <div class="motion-card-hover p-8 md:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xl">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-700 font-bold flex items-center justify-center">∞</div>
                            <span class="font-serif font-bold text-sm text-slate-900">Partner Desk</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Active Support</span>
                    </div>
                    <h3 class="text-2xl font-serif text-slate-900 mb-2">Student → College → Career</h3>
                    <p class="text-xs text-slate-600 font-light mb-6">A seamless institutional framework for NEP-2020 alignment.</p>
                    <div class="space-y-3 text-xs">
                        <div class="p-3.5 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center justify-between">
                            <span class="text-slate-700 font-medium">Batch-wise student registration</span>
                            <span class="text-emerald-600 font-bold">✓</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center justify-between">
                            <span class="text-slate-700 font-medium">Attendance & capstone evaluation logs</span>
                            <span class="text-emerald-600 font-bold">✓</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center justify-between">
                            <span class="text-slate-700 font-medium">Tamper-proof verifiable completion documents</span>
                            <span class="text-emerald-600 font-bold">✓</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center justify-between">
                            <span class="text-slate-700 font-medium">Semester credit fulfillment records</span>
                            <span class="text-emerald-600 font-bold">✓</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Student Stories Section -->
<section id="stories" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="motion-reveal mb-16 md:mb-20 md:flex justify-between items-end gap-8 border-b border-slate-100 pb-8">
            <div>
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Student Stories</span>
                <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">
                    Small Steps. <br>
                    <span class="text-indigo-700 italic">Big Confidence.</span>
                </h2>
            </div>
            <p class="text-slate-600 max-w-md mt-4 md:mt-0 font-light text-base leading-relaxed">
                Internship is not just about completing a formality. It is about building hands-on competence and taking your first step towards employment.
            </p>
        </div>

        <div class="motion-stagger grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 shadow-xs hover:shadow-xl transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl font-serif font-bold text-sm flex items-center justify-center border text-indigo-700 bg-indigo-50 border-indigo-100 shadow-xs">
                            BA
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase bg-white border border-slate-200 px-3 py-1 rounded-full">
                            BA • POL SCIENCE
                        </span>
                    </div>
                    <h3 class="text-lg font-serif text-slate-900 mb-4 leading-snug">
                        “I finally understood how classroom concepts become practical work.”
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        “The structured activities helped me move from studying theory to conducting field surveys. The certificate and marksheet made college approval effortless.”
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <p class="text-xs font-bold text-slate-900">Ritika Srivastava</p>
                    <p class="text-[11px] text-indigo-600 font-medium">Magadh Mahila College, Patna</p>
                </div>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 shadow-xs hover:shadow-xl transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl font-serif font-bold text-sm flex items-center justify-center border text-emerald-700 bg-emerald-50 border-emerald-100 shadow-xs">
                            BSc
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase bg-white border border-slate-200 px-3 py-1 rounded-full">
                            BSc • ENVIRONMENT
                        </span>
                    </div>
                    <h3 class="text-lg font-serif text-slate-900 mb-4 leading-snug">
                        “Hands-on environmental impact assessments gave me field confidence.”
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        “Having a clear journey, activities, and completion requirements made it easier to stay focused and understand my progress.”
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <p class="text-xs font-bold text-slate-900">Aditya Raj</p>
                    <p class="text-[11px] text-emerald-600 font-medium">Patna Science College</p>
                </div>
            </div>

            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 shadow-xs hover:shadow-xl transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl font-serif font-bold text-sm flex items-center justify-center border text-purple-700 bg-purple-50 border-purple-100 shadow-xs">
                            BBA
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase bg-white border border-slate-200 px-3 py-1 rounded-full">
                            BBA • MANAGEMENT
                        </span>
                    </div>
                    <h3 class="text-lg font-serif text-slate-900 mb-4 leading-snug">
                        “From theory to workplace thinking and real financial models.”
                    </h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                        “The practical approach helped me understand corporate communication, pitch decks, and cash flow forecasting in a much clearer way.”
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-200/60">
                    <p class="text-xs font-bold text-slate-900">Mohit Sharma</p>
                    <p class="text-[11px] text-purple-600 font-medium">College of Commerce, Arts & Science</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-24 px-4 sm:px-6 lg:px-8 bg-[#F6F8F5] border-y border-slate-200/80">
    <div class="max-w-4xl mx-auto">
        <div class="motion-reveal text-center mb-16">
            <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Knowledge Base</span>
            <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight mb-4">
                Frequently Asked <span class="text-indigo-700 italic">Questions.</span>
            </h2>
        </div>

        <div class="motion-reveal space-y-4">
            <details class="group p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs [&_summary::-webkit-details-marker]:none">
                <summary class="flex items-center justify-between cursor-pointer font-serif text-base sm:text-lg text-slate-900 hover:text-indigo-700 font-medium">
                    <span>Who can apply for Infinity Interns?</span>
                    <span class="ml-4 shrink-0 rounded-full bg-slate-100 p-1.5 text-slate-900 group-open:-rotate-180 transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </summary>
                <p class="mt-4 text-xs text-slate-600 leading-relaxed pt-3 border-t border-slate-100">
                    Our programs are primarily designed for undergraduate students such as BA, BSc, BBA, BCA, BCom and related courses. Eligibility can vary by program and university semester requirements.
                </p>
            </details>

            <details class="group p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs [&_summary::-webkit-details-marker]:none">
                <summary class="flex items-center justify-between cursor-pointer font-serif text-base sm:text-lg text-slate-900 hover:text-indigo-700 font-medium">
                    <span>Are the certificates and marksheets UGC & NEP-2020 compliant?</span>
                    <span class="ml-4 shrink-0 rounded-full bg-slate-100 p-1.5 text-slate-900 group-open:-rotate-180 transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </summary>
                <p class="mt-4 text-xs text-slate-600 leading-relaxed pt-3 border-t border-slate-100">
                    Yes. All programs adhere to UGC National Higher Education Qualifications Framework (NHEQF) guidelines covering contact hours (60 to 120 hours), evaluated capstone deliverables, and 2 to 4 semester academic credit fulfillment.
                </p>
            </details>

            <details class="group p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs [&_summary::-webkit-details-marker]:none">
                <summary class="flex items-center justify-between cursor-pointer font-serif text-base sm:text-lg text-slate-900 hover:text-indigo-700 font-medium">
                    <span>How can colleges or employers verify my completion credentials?</span>
                    <span class="ml-4 shrink-0 rounded-full bg-slate-100 p-1.5 text-slate-900 group-open:-rotate-180 transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </summary>
                <p class="mt-4 text-xs text-slate-600 leading-relaxed pt-3 border-t border-slate-100">
                    Each certificate issued includes a secure QR code and unique serial number (e.g. <code>UGC-INF-XXXXXX</code>) which can be instantly verified on our <a href="{{ route('verify') }}" class="text-indigo-600 font-bold hover:underline">public certificate verification portal</a>.
                </p>
            </details>

            <details class="group p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs [&_summary::-webkit-details-marker]:none">
                <summary class="flex items-center justify-between cursor-pointer font-serif text-base sm:text-lg text-slate-900 hover:text-indigo-700 font-medium">
                    <span>How do I register for the upcoming cohort?</span>
                    <span class="ml-4 shrink-0 rounded-full bg-slate-100 p-1.5 text-slate-900 group-open:-rotate-180 transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </summary>
                <p class="mt-4 text-xs text-slate-600 leading-relaxed pt-3 border-t border-slate-100">
                    Click any “Apply Now” or “Register” button on our website. You can fill our instant online portal registration form or open the official Google Form in a new tab.
                </p>
            </details>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="motion-reveal-left lg:col-span-7 space-y-6">
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase block">Get in Touch</span>
                <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">
                    We're Here to <br>
                    <span class="text-indigo-700 italic">Help You Get Started.</span>
                </h2>
                <p class="text-slate-600 font-light text-base leading-relaxed max-w-lg">
                    Have questions regarding undergraduate degree eligibility, program duration, or institutional MoUs? Reach out to our student helpline directly.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <a href="mailto:info@infinityinterns.com" class="motion-card-hover p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 transition flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-white text-indigo-700 flex items-center justify-center shrink-0 border border-slate-200 text-xl shadow-xs">✉️</div>
                        <div class="overflow-hidden">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Email Desk</span>
                            <span class="text-xs font-bold text-slate-900 truncate block">info@infinityinterns.com</span>
                        </div>
                    </a>
                    <a href="tel:+916204141971" class="motion-card-hover p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 transition flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-white text-emerald-700 flex items-center justify-center shrink-0 border border-slate-200 text-xl shadow-xs">📞</div>
                        <div class="overflow-hidden">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Helpline & WhatsApp</span>
                            <span class="text-xs font-bold text-slate-900 truncate block">+91 6204141971</span>
                        </div>
                    </a>
                    <a href="tel:+916204221832" class="motion-card-hover p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 hover:border-slate-300 transition flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-white text-emerald-700 flex items-center justify-center shrink-0 border border-slate-200 text-xl shadow-xs">📞</div>
                        <div class="overflow-hidden">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Alternate Line</span>
                            <span class="text-xs font-bold text-slate-900 truncate block">+91 6204221832</span>
                        </div>
                    </a>
                    <div class="motion-card-hover p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl bg-white text-rose-600 flex items-center justify-center shrink-0 border border-slate-200 text-xl shadow-xs">📍</div>
                        <div class="overflow-hidden">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Operational Center</span>
                            <span class="text-xs font-bold text-slate-900 truncate block">Patna, Bihar, India</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Direct Inquiry Form -->
            <div class="motion-reveal-right lg:col-span-5">
                <div class="motion-card-hover p-8 md:p-10 rounded-[2.5rem] bg-gradient-to-b from-indigo-900 to-slate-900 text-white shadow-2xl">
                    <span class="text-[10px] font-bold tracking-widest text-indigo-300 uppercase block mb-1">Instant Support</span>
                    <h3 class="text-2xl font-serif text-white mb-2 font-bold">Send Direct Inquiry</h3>
                    <p class="text-xs text-indigo-200/80 mb-6 font-light">Have a quick question? Send it to our student advisory desk.</p>

                    <form action="{{ route('inquiry.contact') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <input type="text" name="name" required placeholder="Your Name *" class="w-full px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="email" name="email" required placeholder="Email *" class="w-full px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <input type="tel" name="phone" required placeholder="Phone / WhatsApp *" class="w-full px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="degree" placeholder="Degree (BA, BSc..)" class="w-full px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <input type="text" name="college" placeholder="College Name" class="w-full px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div>
                            <textarea name="message" required rows="3" placeholder="Your Query / Requirements..." class="w-full px-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>
                        <button type="submit" class="motion-btn-spring w-full py-3 rounded-full bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs uppercase tracking-wider transition shadow-md cursor-pointer">
                            Submit Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA Strip -->
<section class="py-20 bg-gradient-to-r from-indigo-950 via-slate-900 to-indigo-900 text-white text-center px-4 relative overflow-hidden">
    <!-- Floating background glow inside CTA -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="blob-anim-1 absolute -top-20 left-1/4 w-96 h-96 bg-indigo-500/20 rounded-full blur-[100px]"></div>
        <div class="blob-anim-2 absolute -bottom-20 right-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-[100px]"></div>
        <div class="absolute inset-0 site-animated-grid opacity-20"></div>
    </div>

    <div class="motion-reveal max-w-4xl mx-auto space-y-5 relative z-10">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-indigo-200 text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span>UGC Cohort 2026 Admissions Open</span>
        </div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif leading-tight">
            Turn Your College Requirement into a <br class="hidden sm:block">
            <span class="bg-gradient-to-r from-indigo-300 via-purple-300 to-emerald-300 bg-clip-text text-transparent animate-text-gradient italic font-bold">Career Advantage.</span>
        </h2>
        <p class="text-xs sm:text-sm text-indigo-100/90 font-light max-w-xl mx-auto leading-relaxed">
            Join thousands of undergraduate learners from BA, BSc, BBA, BCA, and BCom. Start your practical internship journey today with accredited certifications.
        </p>
        <div class="pt-4 flex flex-wrap justify-center items-center gap-3.5">
            <button onclick="openApplyModal()" class="btn-animated-sheen btn-glow-pulse motion-btn-spring px-8 py-4 rounded-full bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-2xl hover:scale-105 active:scale-95 cursor-pointer flex items-center gap-2 group">
                <span>Enroll in Upcoming Cohort</span>
                <svg class="w-4 h-4 text-indigo-600 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <a href="https://wa.me/916204141971" target="_blank" rel="noopener noreferrer" class="btn-animated-sheen motion-btn-spring px-7 py-4 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xl shadow-emerald-600/30 hover:scale-105 active:scale-95 flex items-center gap-2 group">
                <span>WhatsApp Counselor</span>
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
