<!DOCTYPE html>
<html lang="en" class="h-full" data-admin-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal') – Infinity Interns</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    
    <!-- Instant Zero-FOUC Theme & Appearance Studio Initializer -->
    <script>
        (function() {
            try {
                let studio = {};
                try {
                    studio = JSON.parse(localStorage.getItem('admin-theme-studio') || '{}');
                } catch (e) { studio = {}; }

                const theme = studio.theme || localStorage.getItem('admin-theme') || 'dark';
                const font = studio.font || 'jakarta';
                const scale = studio.scale || 'standard';
                const radius = studio.radius || 'curved';
                const pattern = !!studio.pattern;
                const accent = studio.accent || '#4f46e5';

                const docEl = document.documentElement;
                docEl.setAttribute('data-admin-theme', theme);
                
                if (theme === 'light') {
                    docEl.classList.remove('dark');
                } else {
                    docEl.classList.add('dark');
                }

                // Apply Font, Scale, Radius, Pattern classes
                docEl.classList.remove('font-jakarta', 'font-inter', 'font-outfit', 'font-space', 'font-poppins', 'font-serif-lux', 'font-system');
                docEl.classList.add('font-' + font);

                docEl.classList.remove('scale-compact', 'scale-standard', 'scale-relaxed');
                docEl.classList.add('scale-' + scale);

                docEl.classList.remove('radius-sharp', 'radius-subtle', 'radius-curved', 'radius-pill');
                docEl.classList.add('radius-' + radius);

                if (pattern) {
                    docEl.classList.add('pattern-grid');
                } else {
                    docEl.classList.remove('pattern-grid');
                }

                if (accent) {
                    let accentStyle = document.getElementById('admin-custom-accent-style');
                    if (!accentStyle) {
                        accentStyle = document.createElement('style');
                        accentStyle.id = 'admin-custom-accent-style';
                        document.head.appendChild(accentStyle);
                    }
                    accentStyle.textContent = `
                        :root {
                            --adm-accent: ${accent} !important;
                            --adm-accent-hover: ${accent} !important;
                            --adm-accent-light: ${accent}1a !important;
                        }
                        .bg-indigo-600, .bg-indigo-700 { background-color: ${accent} !important; }
                        .text-indigo-600, .dark\\:text-indigo-400 { color: ${accent} !important; }
                        .border-indigo-500, .border-indigo-600 { border-color: ${accent} !important; }
                        .hover\\:border-indigo-500\\/50:hover { border-color: ${accent}80 !important; }
                        .focus\\:ring-indigo-500:focus, .focus\\:ring-indigo-600:focus { --tw-ring-color: ${accent} !important; }
                    `;
                }
            } catch (e) {
                console.error('Zero-FOUC init error:', e);
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full min-h-screen md:h-screen md:overflow-hidden adm-canvas font-sans antialiased flex flex-col md:flex-row">
    <!-- Top Scroll Progress Indicator (Framer Motion) -->
    <div id="scrollProgress" class="fixed top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-400 z-[999] origin-left scale-x-0 pointer-events-none"></div>

    <!-- Sidebar (Independent Fixed-Height Split Container) -->
    <aside class="w-full md:w-64 adm-sidebar border-r flex flex-col shrink-0 md:h-screen md:max-h-screen z-40 select-none">
        <!-- Brand (Pinned Header) -->
        <div class="p-5 pb-4 shrink-0 border-b border-slate-200/70 dark:border-slate-800/70">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-1 group">
                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 flex items-center justify-center p-1.5 shadow-sm group-hover:border-indigo-500/50 transition">
                    <img src="/infinity-interns-logo.png" alt="Logo" class="h-full w-auto object-contain">
                </div>
                <div>
                    <span class="font-serif font-bold text-sm adm-text tracking-wider block">Infinity Interns</span>
                    <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-semibold tracking-wider uppercase block">
                        Administrator Command Center
                    </span>
                </div>
            </a>
        </div>

        <!-- Scrollable Navigation (Independent Isolated Scroll Container) -->
        <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-1 overscroll-contain adm-sidebar-scroll">
            <nav class="space-y-1 text-xs font-semibold">
                <!-- Dashboard Overview -->
                <a href="{{ route('admin.dashboard', ['tab' => 'overview']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ (request()->routeIs('admin.dashboard') && (request('tab', 'overview') === 'overview' || !request('tab'))) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard Overview</span>
                    </div>
                </a>

                <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Students & Applications
                </div>

                <!-- All Applications -->
                <a href="{{ route('admin.dashboard', ['tab' => 'all']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ (request()->routeIs('admin.dashboard') && request('tab') === 'all') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>All Applications</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        @if(($adminNavStats['pending'] ?? 0) > 0)
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ (request()->routeIs('admin.dashboard') && request('tab') === 'all') ? 'bg-amber-400 text-slate-900 font-extrabold' : 'bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-300 border border-amber-300 dark:border-amber-700/60' }}" title="{{ $adminNavStats['pending'] }} Pending Review">
                                {{ $adminNavStats['pending'] }} Pending
                            </span>
                        @else
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ (request()->routeIs('admin.dashboard') && request('tab') === 'all') ? 'bg-white/20 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700' }}">
                                {{ $adminNavStats['total'] ?? 0 }}
                            </span>
                        @endif
                    </div>
                </a>

                <!-- Enrolled Students -->
                <a href="{{ route('admin.dashboard', ['tab' => 'enrolled']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ (request()->routeIs('admin.dashboard') && request('tab') === 'enrolled') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        <span>Enrolled Students</span>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full {{ (request()->routeIs('admin.dashboard') && request('tab') === 'enrolled') ? 'bg-white/20 text-white' : 'bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300' }}">
                        {{ $adminNavStats['enrolled'] ?? 0 }}
                    </span>
                </a>

                {{-- CERTIFICATIONS SECTION COMMENTED OUT
                <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Certifications
                </div>

                <!-- Certificate Approval Access -->
                <a href="{{ route('admin.dashboard', ['tab' => 'pending_cert']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ (request()->routeIs('admin.dashboard') && request('tab') === 'pending_cert') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Certificate Approvals</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ (request()->routeIs('admin.dashboard') && request('tab') === 'pending_cert') ? 'bg-white/20 text-white' : 'bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300' }}">
                        {{ $adminNavStats['pending_cert'] ?? 0 }}
                    </span>
                </a>

                <!-- Certificates Issued -->
                <a href="{{ route('admin.dashboard', ['tab' => 'issued_cert']) }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ (request()->routeIs('admin.dashboard') && request('tab') === 'issued_cert') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        <span>Issued Certificates</span>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full {{ (request()->routeIs('admin.dashboard') && request('tab') === 'issued_cert') ? 'bg-white/20 text-white' : 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300' }}">
                        {{ $adminNavStats['certificates_issued'] ?? 0 }}
                    </span>
                </a>

                <!-- Certificate Generator -->
                <a href="{{ route('admin.certificate-generator') }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request()->routeIs('admin.certificate-generator*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Certificate Generator</span>
                    </div>
                    <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 font-bold uppercase">Manual</span>
                </a>
                --}}

                <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Academic Configuration
                </div>

                <!-- Academic Setup (Degrees, Schools & Domains) -->
                <div class="space-y-1">
                    <a href="{{ route('admin.academic-setup') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ (request()->routeIs('admin.academic-setup*') || request()->routeIs('admin.streams*')) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                            <div class="flex flex-col text-left">
                                <span>Academic Setup</span>
                                <span class="text-[9px] font-normal opacity-80">Catalog Master</span>
                            </div>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full {{ (request()->routeIs('admin.academic-setup*') || request()->routeIs('admin.streams*')) ? 'bg-white/20 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700' }}">
                            {{ $adminNavStats['total_academic_setup'] ?? 0 }}
                        </span>
                    </a>

                    <!-- Direct Sub-links to Dedicated Separate Pages -->
                    <div class="pl-4 pr-1 py-1 space-y-0.5 border-l-2 border-indigo-200 dark:border-indigo-900/60 ml-4">
                        <a href="{{ route('admin.degrees') }}" class="flex items-center justify-between px-2.5 py-1.5 rounded-lg text-xs font-semibold transition {{ (request()->routeIs('admin.degrees*') || (request()->routeIs('admin.academic-setup*') && request('tab', 'degrees') === 'degrees')) ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 font-bold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white' }}">
                            <span class="flex items-center gap-1.5"><span>🎓</span><span>Degrees &amp; Programs</span></span>
                            <span class="text-[9px] font-bold text-indigo-500">+ Add</span>
                        </a>
                        <a href="{{ route('admin.schools') }}" class="flex items-center justify-between px-2.5 py-1.5 rounded-lg text-xs font-semibold transition {{ (request()->routeIs('admin.schools*') || (request()->routeIs('admin.academic-setup*') && request('tab') === 'schools')) ? 'text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-950/60 font-bold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white' }}">
                            <span class="flex items-center gap-1.5"><span>🏫</span><span>Schools &amp; Colleges</span></span>
                            <span class="text-[9px] font-bold text-purple-500">+ Add</span>
                        </a>
                        <a href="{{ route('admin.streams') }}" class="flex items-center justify-between px-2.5 py-1.5 rounded-lg text-xs font-semibold transition {{ (request()->routeIs('admin.streams*') || request()->routeIs('admin.domains*') || (request()->routeIs('admin.academic-setup*') && request('tab') === 'domains')) ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 font-bold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white' }}">
                            <span class="flex items-center gap-1.5"><span>🚀</span><span>Internship Domains</span></span>
                            <span class="text-[9px] font-bold text-amber-500">+ Add</span>
                        </a>
                    </div>
                </div>

                <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Operations
                </div>

                <!-- Track Application -->
                <a href="{{ route('admin.track') }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request()->routeIs('admin.track*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Track Application</span>
                    </div>
                </a>

                <!-- Inquiries Desk -->
                <a href="{{ route('admin.inquiries') }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request()->routeIs('admin.inquiries*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <span>Inquiries Desk</span>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full {{ request()->routeIs('admin.inquiries*') ? 'bg-white/20 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700' }}">
                        {{ $adminNavStats['total_inquiries'] ?? 0 }}
                    </span>
                </a>

                <div class="pt-3 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Document Settings
                </div>

                <!-- Offer Letter Settings -->
                <a href="{{ route('admin.offer-letter.settings') }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request()->routeIs('admin.offer-letter*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Offer Letter Settings</span>
                    </div>
                    <span class="text-[9px] px-1.5 py-0.5 rounded {{ request()->routeIs('admin.offer-letter*') ? 'bg-white/20 text-white' : 'bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 font-bold' }} uppercase">Customize</span>
                </a>

                <!-- Consent Letter Settings -->
                <a href="{{ route('admin.consent-letter.settings') }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request()->routeIs('admin.consent-letter*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Consent Letter Settings</span>
                    </div>
                    <span class="text-[9px] px-1.5 py-0.5 rounded {{ request()->routeIs('admin.consent-letter*') ? 'bg-white/20 text-white' : 'bg-purple-500/10 text-purple-700 dark:text-purple-400 font-bold' }} uppercase">Annexure</span>
                </a>

                <!-- Certificate Settings -->
                <a href="{{ route('admin.certificate.settings') }}" class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request()->routeIs('admin.certificate.settings*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        <span>Certificate Settings</span>
                    </div>
                    <span class="text-[9px] px-1.5 py-0.5 rounded {{ request()->routeIs('admin.certificate.settings*') ? 'bg-white/20 text-white' : 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 font-bold' }} uppercase">Official</span>
                </a>
            </nav>
        </div>

        <!-- User / Logout (Pinned Footer) -->
        <div class="p-4 border-t border-slate-200 dark:border-slate-800/80 shrink-0 space-y-3 bg-slate-50/50 dark:bg-slate-900/40">
            <div class="flex items-center gap-3 px-1">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold text-xs flex items-center justify-center shadow-md shadow-indigo-600/20 shrink-0">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold adm-text block truncate">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] adm-text-muted block truncate">{{ auth()->user()->email }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-slate-100 dark:bg-slate-800/60 hover:bg-rose-100 dark:hover:bg-rose-950/40 text-slate-700 dark:text-slate-300 hover:text-rose-700 dark:hover:text-rose-300 border border-slate-200 dark:border-slate-700/60 text-xs font-semibold transition cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area (Independent Isolated Scroll Container) -->
    <div id="adminMainScroll" class="flex-1 flex flex-col min-w-0 md:h-screen md:max-h-screen overflow-y-auto overscroll-contain adm-canvas adm-main-scroll">
        <!-- Top App Bar -->
        <header class="h-16 adm-header border-b px-6 md:px-8 flex items-center justify-between shrink-0 sticky top-0 z-30">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs adm-text-secondary font-medium">UGC Central Dispatch System • Active</span>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-xs adm-text-muted hidden sm:inline">{{ date('l, d M Y') }}</span>

                <!-- Quick Dark / Light Switcher -->
                <button type="button" onclick="quickToggleAdminTheme()" id="themeToggleBtn" title="Quick Theme Switch" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-slate-200 dark:border-slate-700/80 bg-slate-100 dark:bg-slate-800/90 text-slate-700 dark:text-slate-200 text-xs font-semibold hover:border-indigo-500/50 transition cursor-pointer shadow-xs">
                    <span id="themeIcon">🌙</span>
                    <span id="themeLabel" class="hidden sm:inline">Theme</span>
                </button>

                <!-- Continuously Animated Spinning Cog / Appearance Studio Trigger Button -->
                <button type="button" onclick="openAdminCustomizer()" id="adminThemeStudioBtn" title="Open Admin Theme & Appearance Studio" class="relative group flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-indigo-500/30 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10 hover:from-indigo-500/20 hover:to-purple-500/20 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer shadow-xs overflow-hidden">
                    <span class="absolute inset-0 bg-indigo-500/5 group-hover:bg-indigo-500/10 transition"></span>
                    <!-- Continuous Smooth 360-degree Rotating Cog Icon (Always spins) -->
                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400 animate-spin-continuous transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="relative z-10 flex items-center gap-1.5">
                        <span class="font-semibold">Customize</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    </span>
                </button>

                <!-- Role Badge -->
                <span class="text-[10px] px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-500/20 font-bold uppercase tracking-wider">
                    ADMIN
                </span>
            </div>
        </header>

        <!-- Flash Messages & Credentials Dispatch Card -->
        @if(session('created_student_credentials'))
            @php $cred = session('created_student_credentials'); @endphp
            <div id="studentCredAlert" class="mx-6 md:mx-8 mt-4 p-5 rounded-2xl bg-indigo-50 dark:bg-indigo-950/80 border border-indigo-200 dark:border-indigo-500/40 text-xs shadow-lg space-y-3 motion-reveal">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-indigo-600 text-white font-bold text-[10px] uppercase tracking-wider">
                                🎓 Student Portal Access Issued
                            </span>
                            <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $cred['name'] }}</span>
                            <span class="font-mono text-xs text-indigo-600 dark:text-indigo-400 font-bold">({{ $cred['app_number'] }})</span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-300 text-xs">
                            Candidate can now log in at <a href="{{ route('login') }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 font-bold underline">Infinity Interns Portal ({{ route('login') }})</a>.
                        </p>
                    </div>
                    <button onclick="document.getElementById('studentCredAlert').remove()" class="text-slate-400 hover:text-slate-600 dark:hover:text-white font-bold text-xl cursor-pointer">&times;</button>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <div class="px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 font-mono text-slate-800 dark:text-slate-200 flex items-center gap-2 shadow-xs">
                        <span class="text-slate-400 select-none">Login Email:</span>
                        <strong class="text-indigo-600 dark:text-indigo-400">{{ $cred['email'] }}</strong>
                    </div>
                    <div class="px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 font-mono text-slate-800 dark:text-slate-200 flex items-center gap-2 shadow-xs">
                        <span class="text-slate-400 select-none">Password:</span>
                        <strong class="text-emerald-600 dark:text-emerald-400 font-bold tracking-wide">{{ $cred['password'] }}</strong>
                    </div>
                    <button type="button" onclick="copyStudentCredentials('{{ $cred['email'] }}', '{{ $cred['password'] }}', '{{ addslashes($cred['name']) }}', '{{ $cred['app_number'] }}')" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-600/30 flex items-center gap-1.5 cursor-pointer motion-btn-spring transition">
                        <span>📋 Copy Login Message</span>
                    </button>
                    @if(!empty($cred['phone']))
                        @php
                            $waNumber = preg_replace('/\D/', '', $cred['phone']);
                            if(strlen($waNumber) === 10) $waNumber = '91' . $waNumber;
                            $waText = urlencode("Hello {$cred['name']}, your Infinity Interns Student Portal account is active!\n\nPortal: " . route('login') . "\nApplication ID: {$cred['app_number']}\nEmail: {$cred['email']}\nPassword: {$cred['password']}\n\nPlease log in to access your orientation curriculum and Capstone project.");
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/30 flex items-center gap-1.5 cursor-pointer motion-btn-spring transition">
                            <span>💬 Send to Student via WhatsApp</span>
                        </a>
                    @endif
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="mx-6 md:mx-8 mt-4 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/70 border border-emerald-200 dark:border-emerald-500/40 text-emerald-800 dark:text-emerald-200 text-xs font-medium flex items-center justify-between shadow-md">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 dark:text-emerald-400 hover:opacity-80 font-bold p-1 cursor-pointer">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 md:mx-8 mt-4 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/70 border border-rose-200 dark:border-rose-500/40 text-rose-800 dark:text-rose-200 text-xs font-medium flex items-center justify-between shadow-md">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-full bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center font-bold text-xs">✕</span>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 dark:text-rose-400 hover:opacity-80 font-bold p-1 cursor-pointer">&times;</button>
            </div>
        @endif

        <!-- Page View Body -->
        <main class="flex-1 p-6 md:p-8 adm-canvas">
            @yield('content')
        </main>
    </div>

    <!-- Theme Controller JavaScript -->
    <!-- =========================================================
         ADMIN THEME & APPEARANCE STUDIO SLIDE-OVER DRAWER
         ========================================================= -->
    <!-- Backdrop Overlay -->
    <div id="adminCustomizerBackdrop" onclick="closeAdminCustomizer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-[100] transition-opacity duration-300 opacity-0 pointer-events-none"></div>

    <!-- Drawer Panel -->
    <div id="adminCustomizerDrawer" class="fixed top-0 right-0 bottom-0 w-full sm:w-[480px] bg-slate-900 text-slate-100 border-l border-slate-800 z-[101] flex flex-col shadow-2xl transition-transform duration-300 ease-out translate-x-full select-none">
        <!-- Drawer Header -->
        <div class="p-5 border-b border-slate-800 flex items-center justify-between shrink-0 bg-slate-950/60 backdrop-blur-md">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                    <!-- Spinning Cog Icon in Drawer Title -->
                    <svg class="w-5 h-5 animate-spin-continuous" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-white flex items-center gap-2">
                        Appearance & Theme Studio
                        <span class="text-[9px] px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 font-mono font-semibold">LIVE</span>
                    </h3>
                    <p class="text-[11px] text-slate-400">Personalize colors, typography, scale & atmosphere</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="resetStudioDefaults()" title="Reset to Factory Defaults" class="px-2.5 py-1.5 text-[11px] font-semibold text-slate-400 hover:text-white rounded-lg hover:bg-slate-800 transition cursor-pointer">
                    Reset
                </button>
                <button type="button" onclick="closeAdminCustomizer()" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 transition text-lg cursor-pointer">
                    &times;
                </button>
            </div>
        </div>

        <!-- Drawer Content (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-5 space-y-6 adm-sidebar-scroll">
            <!-- 1-Click Master Presets -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider flex items-center justify-between">
                    <span>⚡ 1-Click Master Presets</span>
                    <span class="text-[10px] text-slate-500 normal-case">Fast instant switch</span>
                </label>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <button type="button" onclick="applyMasterPreset('midnight')" class="p-2.5 rounded-xl border border-slate-800 bg-slate-800/60 hover:border-indigo-500 text-left transition cursor-pointer group flex items-center gap-2.5">
                        <span class="w-3.5 h-3.5 rounded-full bg-indigo-500 shrink-0"></span>
                        <div>
                            <span class="font-semibold text-slate-200 block group-hover:text-white">Deep Midnight</span>
                            <span class="text-[10px] text-slate-400 block">Default Slate</span>
                        </div>
                    </button>
                    <button type="button" onclick="applyMasterPreset('cyberpunk')" class="p-2.5 rounded-xl border border-slate-800 bg-slate-800/60 hover:border-cyan-400 text-left transition cursor-pointer group flex items-center gap-2.5">
                        <span class="w-3.5 h-3.5 rounded-full bg-cyan-400 shrink-0 shadow-[0_0_8px_rgba(6,182,212,0.8)]"></span>
                        <div>
                            <span class="font-semibold text-cyan-300 block group-hover:text-white">Cyberpunk 2077</span>
                            <span class="text-[10px] text-slate-400 block">Neon Glow</span>
                        </div>
                    </button>
                    <button type="button" onclick="applyMasterPreset('oled')" class="p-2.5 rounded-xl border border-slate-800 bg-slate-800/60 hover:border-slate-500 text-left transition cursor-pointer group flex items-center gap-2.5">
                        <span class="w-3.5 h-3.5 rounded-full bg-neutral-900 border border-neutral-700 shrink-0"></span>
                        <div>
                            <span class="font-semibold text-slate-200 block group-hover:text-white">OLED Obsidian</span>
                            <span class="text-[10px] text-slate-400 block">Pitch Black</span>
                        </div>
                    </button>
                    <button type="button" onclick="applyMasterPreset('nordic')" class="p-2.5 rounded-xl border border-slate-800 bg-slate-800/60 hover:border-emerald-500 text-left transition cursor-pointer group flex items-center gap-2.5">
                        <span class="w-3.5 h-3.5 rounded-full bg-emerald-500 shrink-0"></span>
                        <div>
                            <span class="font-semibold text-emerald-300 block group-hover:text-white">Nordic Forest</span>
                            <span class="text-[10px] text-slate-400 block">Deep Emerald</span>
                        </div>
                    </button>
                    <button type="button" onclick="applyMasterPreset('sepia')" class="p-2.5 rounded-xl border border-slate-800 bg-slate-800/60 hover:border-amber-500 text-left transition cursor-pointer group flex items-center gap-2.5">
                        <span class="w-3.5 h-3.5 rounded-full bg-amber-500 shrink-0"></span>
                        <div>
                            <span class="font-semibold text-amber-300 block group-hover:text-white">Warm Sepia</span>
                            <span class="text-[10px] text-slate-400 block">Espresso Tone</span>
                        </div>
                    </button>
                    <button type="button" onclick="applyMasterPreset('light')" class="p-2.5 rounded-xl border border-slate-800 bg-slate-800/60 hover:border-indigo-400 text-left transition cursor-pointer group flex items-center gap-2.5">
                        <span class="w-3.5 h-3.5 rounded-full bg-white border border-slate-300 shrink-0"></span>
                        <div>
                            <span class="font-semibold text-slate-200 block group-hover:text-white">Paper White</span>
                            <span class="text-[10px] text-slate-400 block">Crisp Light</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Base Theme Environment Selection -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider block">
                    🎨 Workspace Theme Base
                </label>
                <div class="grid grid-cols-3 gap-2" id="themeBaseSelector">
                    <button type="button" onclick="setAdminTheme('dark')" data-theme-val="dark" class="theme-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/50 hover:bg-slate-800 text-center transition cursor-pointer flex flex-col items-center gap-1.5">
                        <span class="text-base">🌙</span>
                        <span class="text-xs font-semibold text-slate-200">Dark Slate</span>
                    </button>
                    <button type="button" onclick="setAdminTheme('oled')" data-theme-val="oled" class="theme-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/50 hover:bg-slate-800 text-center transition cursor-pointer flex flex-col items-center gap-1.5">
                        <span class="text-base">⚫</span>
                        <span class="text-xs font-semibold text-slate-200">OLED Black</span>
                    </button>
                    <button type="button" onclick="setAdminTheme('light')" data-theme-val="light" class="theme-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/50 hover:bg-slate-800 text-center transition cursor-pointer flex flex-col items-center gap-1.5">
                        <span class="text-base">☀️</span>
                        <span class="text-xs font-semibold text-slate-200">Pure Light</span>
                    </button>
                    <button type="button" onclick="setAdminTheme('cyberpunk')" data-theme-val="cyberpunk" class="theme-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/50 hover:bg-slate-800 text-center transition cursor-pointer flex flex-col items-center gap-1.5">
                        <span class="text-base">🔮</span>
                        <span class="text-xs font-semibold text-slate-200">Cyberpunk</span>
                    </button>
                    <button type="button" onclick="setAdminTheme('nordic')" data-theme-val="nordic" class="theme-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/50 hover:bg-slate-800 text-center transition cursor-pointer flex flex-col items-center gap-1.5">
                        <span class="text-base">🌲</span>
                        <span class="text-xs font-semibold text-slate-200">Nordic Pine</span>
                    </button>
                    <button type="button" onclick="setAdminTheme('sepia')" data-theme-val="sepia" class="theme-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/50 hover:bg-slate-800 text-center transition cursor-pointer flex flex-col items-center gap-1.5">
                        <span class="text-base">☕</span>
                        <span class="text-xs font-semibold text-slate-200">Warm Sepia</span>
                    </button>
                </div>
            </div>

            <!-- Primary Accent Color Studio & Custom Color Picker -->
            <div class="space-y-2.5">
                <div class="flex items-center justify-between">
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-wider">
                        🌈 Primary Accent Color
                    </label>
                    <span id="activeAccentLabel" class="text-xs font-mono font-bold text-indigo-400">#4f46e5</span>
                </div>
                
                <!-- Preset Color Circles -->
                <div class="flex flex-wrap items-center gap-2.5 pt-1">
                    <button type="button" onclick="setAdminAccent('#4f46e5')" data-color="#4f46e5" title="Indigo Classic" class="accent-circle w-8 h-8 rounded-full bg-[#4f46e5] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#8b5cf6')" data-color="#8b5cf6" title="Electric Violet" class="accent-circle w-8 h-8 rounded-full bg-[#8b5cf6] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#10b981')" data-color="#10b981" title="Emerald Green" class="accent-circle w-8 h-8 rounded-full bg-[#10b981] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#f43f5e')" data-color="#f43f5e" title="Crimson Rose" class="accent-circle w-8 h-8 rounded-full bg-[#f43f5e] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#06b6d4')" data-color="#06b6d4" title="Cyan Aqua" class="accent-circle w-8 h-8 rounded-full bg-[#06b6d4] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#f59e0b')" data-color="#f59e0b" title="Amber Gold" class="accent-circle w-8 h-8 rounded-full bg-[#f59e0b] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#f97316')" data-color="#f97316" title="Tangerine Orange" class="accent-circle w-8 h-8 rounded-full bg-[#f97316] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#0284c7')" data-color="#0284c7" title="Sky Blue" class="accent-circle w-8 h-8 rounded-full bg-[#0284c7] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                    <button type="button" onclick="setAdminAccent('#ec4899')" data-color="#ec4899" title="Neon Pink" class="accent-circle w-8 h-8 rounded-full bg-[#ec4899] border-2 border-transparent hover:scale-110 transition cursor-pointer shadow-sm"></button>
                </div>

                <!-- Custom Hex & HTML5 Color Picker -->
                <div class="mt-3 p-3 rounded-xl border border-slate-800 bg-slate-800/40 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <input type="color" id="studioColorPicker" oninput="setAdminAccent(this.value)" value="#4f46e5" class="w-8 h-8 rounded-lg cursor-pointer border border-slate-700 bg-transparent p-0.5">
                        <div>
                            <span class="text-xs font-semibold text-slate-200 block">Custom Color Picker</span>
                            <span class="text-[10px] text-slate-400 block">Pick any arbitrary color</span>
                        </div>
                    </div>
                    <input type="text" id="studioHexInput" onchange="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)){ setAdminAccent(this.value); }" value="#4f46e5" class="w-24 px-2.5 py-1 rounded-lg border border-slate-700 bg-slate-900 text-xs font-mono font-bold text-center text-slate-200 focus:border-indigo-500 focus:outline-hidden">
                </div>
            </div>

            <!-- Typography & Font Family -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider block">
                    ✍️ Typography & Font Family
                </label>
                <div class="space-y-1.5" id="fontSelector">
                    <button type="button" onclick="setAdminFont('jakarta')" data-font-val="jakarta" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: 'Plus Jakarta Sans', sans-serif;">Plus Jakarta Sans</span>
                            <span class="text-[10px] text-slate-400">Modern, geometric and clean (Default)</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator">✓</span>
                    </button>
                    <button type="button" onclick="setAdminFont('inter')" data-font-val="inter" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: 'Inter', sans-serif;">Inter</span>
                            <span class="text-[10px] text-slate-400">Silicon valley precision interface standard</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator hidden">✓</span>
                    </button>
                    <button type="button" onclick="setAdminFont('outfit')" data-font-val="outfit" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: 'Outfit', sans-serif;">Outfit</span>
                            <span class="text-[10px] text-slate-400">Dynamic display font with stylish curves</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator hidden">✓</span>
                    </button>
                    <button type="button" onclick="setAdminFont('space')" data-font-val="space" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: 'Space Grotesk', sans-serif;">Space Grotesk</span>
                            <span class="text-[10px] text-slate-400">Cyber & tech brutalist monospace feel</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator hidden">✓</span>
                    </button>
                    <button type="button" onclick="setAdminFont('poppins')" data-font-val="poppins" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: 'Poppins', sans-serif;">Poppins</span>
                            <span class="text-[10px] text-slate-400">Soft geometric rounded letterforms</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator hidden">✓</span>
                    </button>
                    <button type="button" onclick="setAdminFont('serif-lux')" data-font-val="serif-lux" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: 'Playfair Display', serif;">Playfair Display</span>
                            <span class="text-[10px] text-slate-400">Luxury editorial serif typography</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator hidden">✓</span>
                    </button>
                    <button type="button" onclick="setAdminFont('system')" data-font-val="system" class="font-chip w-full p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-left transition cursor-pointer flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-200 block" style="font-family: system-ui, sans-serif;">System Native</span>
                            <span class="text-[10px] text-slate-400">Fastest zero-network OS system UI</span>
                        </div>
                        <span class="text-xs text-indigo-400 font-mono check-indicator hidden">✓</span>
                    </button>
                </div>
            </div>

            <!-- UI Scale & Density -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider block">
                    📏 UI Scale & Information Density
                </label>
                <div class="grid grid-cols-3 gap-2" id="scaleSelector">
                    <button type="button" onclick="setAdminScale('compact')" data-scale-val="compact" class="scale-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <span class="text-xs font-bold text-slate-200 block">Compact</span>
                        <span class="text-[10px] text-slate-400 block">Dense (88%)</span>
                    </button>
                    <button type="button" onclick="setAdminScale('standard')" data-scale-val="standard" class="scale-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <span class="text-xs font-bold text-slate-200 block">Standard</span>
                        <span class="text-[10px] text-slate-400 block">Normal (100%)</span>
                    </button>
                    <button type="button" onclick="setAdminScale('relaxed')" data-scale-val="relaxed" class="scale-chip p-2.5 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <span class="text-xs font-bold text-slate-200 block">Relaxed</span>
                        <span class="text-[10px] text-slate-400 block">Large (112%)</span>
                    </button>
                </div>
            </div>

            <!-- Corner Smoothness / Radius -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider block">
                    📐 Corner Curvature / Radius
                </label>
                <div class="grid grid-cols-4 gap-2" id="radiusSelector">
                    <button type="button" onclick="setAdminRadius('sharp')" data-radius-val="sharp" class="radius-chip p-2 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <div class="w-6 h-6 border-t-2 border-l-2 border-indigo-400 mx-auto mb-1"></div>
                        <span class="text-[11px] font-semibold text-slate-200 block">Sharp</span>
                    </button>
                    <button type="button" onclick="setAdminRadius('subtle')" data-radius-val="subtle" class="radius-chip p-2 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <div class="w-6 h-6 border-t-2 border-l-2 border-indigo-400 rounded-tl-sm mx-auto mb-1"></div>
                        <span class="text-[11px] font-semibold text-slate-200 block">Subtle</span>
                    </button>
                    <button type="button" onclick="setAdminRadius('curved')" data-radius-val="curved" class="radius-chip p-2 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <div class="w-6 h-6 border-t-2 border-l-2 border-indigo-400 rounded-tl-xl mx-auto mb-1"></div>
                        <span class="text-[11px] font-semibold text-slate-200 block">Curved</span>
                    </button>
                    <button type="button" onclick="setAdminRadius('pill')" data-radius-val="pill" class="radius-chip p-2 rounded-xl border border-slate-800 bg-slate-800/40 hover:bg-slate-800 text-center transition cursor-pointer">
                        <div class="w-6 h-6 border-t-2 border-l-2 border-indigo-400 rounded-tl-full mx-auto mb-1"></div>
                        <span class="text-[11px] font-semibold text-slate-200 block">Pill</span>
                    </button>
                </div>
            </div>

            <!-- Atmosphere Toggles -->
            <div class="space-y-2.5">
                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider block">
                    ✨ Visual Atmosphere
                </label>
                <div class="p-3 rounded-xl border border-slate-800 bg-slate-800/40 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-200 block">Tech Dot-Matrix Background</span>
                        <span class="text-[10px] text-slate-400 block">Subtle geometric grid backdrop</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="patternToggle" onchange="toggleAdminPattern(this.checked)" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-700 peer-focus:outline-hidden rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Drawer Footer -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/80 backdrop-blur-md flex items-center justify-between shrink-0">
            <span class="text-[11px] text-slate-400 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Auto-saved to your profile</span>
            </span>
            <button type="button" onclick="closeAdminCustomizer()" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs shadow-md transition cursor-pointer">
                Done
            </button>
        </div>
    </div>

    <!-- Scripts Section -->
    <script>
        // State Store
        let adminStudio = {
            theme: 'dark',
            accent: '#4f46e5',
            font: 'jakarta',
            scale: 'standard',
            radius: 'curved',
            pattern: false
        };

        // Initialize state from localStorage
        (function loadStudioState() {
            try {
                const saved = JSON.parse(localStorage.getItem('admin-theme-studio') || '{}');
                adminStudio = Object.assign(adminStudio, saved);
                // Also respect legacy admin-theme if available and no studio theme set
                if (!saved.theme && localStorage.getItem('admin-theme')) {
                    adminStudio.theme = localStorage.getItem('admin-theme');
                }
            } catch (e) {
                console.error(e);
            }
        })();

        function saveStudioState() {
            try {
                localStorage.setItem('admin-theme-studio', JSON.stringify(adminStudio));
                localStorage.setItem('admin-theme', adminStudio.theme);
            } catch (e) {}
        }

        function updateThemeUI(theme) {
            const icon = document.getElementById('themeIcon');
            const label = document.getElementById('themeLabel');
            if (icon && label) {
                if (theme === 'light') {
                    icon.textContent = '☀️';
                    label.textContent = 'Light';
                } else if (theme === 'oled') {
                    icon.textContent = '⚫';
                    label.textContent = 'OLED';
                } else if (theme === 'cyberpunk') {
                    icon.textContent = '🔮';
                    label.textContent = 'Cyber';
                } else if (theme === 'nordic') {
                    icon.textContent = '🌲';
                    label.textContent = 'Nordic';
                } else if (theme === 'sepia') {
                    icon.textContent = '☕';
                    label.textContent = 'Sepia';
                } else {
                    icon.textContent = '🌙';
                    label.textContent = 'Dark';
                }
            }

            // Update Theme Chips in Drawer
            document.querySelectorAll('#themeBaseSelector button').forEach(btn => {
                const val = btn.getAttribute('data-theme-val');
                if (val === theme) {
                    btn.classList.add('border-indigo-500', 'bg-indigo-600/20');
                    btn.classList.remove('border-slate-800', 'bg-slate-800/50');
                } else {
                    btn.classList.remove('border-indigo-500', 'bg-indigo-600/20');
                    btn.classList.add('border-slate-800', 'bg-slate-800/50');
                }
            });
        }

        function setAdminTheme(theme) {
            adminStudio.theme = theme;
            const docEl = document.documentElement;
            docEl.setAttribute('data-admin-theme', theme);
            if (theme === 'light') {
                docEl.classList.remove('dark');
            } else {
                docEl.classList.add('dark');
            }
            saveStudioState();
            updateThemeUI(theme);
        }

        function quickToggleAdminTheme() {
            const current = adminStudio.theme;
            const next = current === 'dark' ? 'light' : 'dark';
            setAdminTheme(next);
        }

        function setAdminAccent(hex) {
            if (!hex) return;
            adminStudio.accent = hex;
            
            let accentStyle = document.getElementById('admin-custom-accent-style');
            if (!accentStyle) {
                accentStyle = document.createElement('style');
                accentStyle.id = 'admin-custom-accent-style';
                document.head.appendChild(accentStyle);
            }

            accentStyle.textContent = `
                :root {
                    --adm-accent: ${hex} !important;
                    --adm-accent-hover: ${hex} !important;
                    --adm-accent-light: ${hex}1a !important;
                }
                .bg-indigo-600, .bg-indigo-700 { background-color: ${hex} !important; }
                .text-indigo-600, .dark\\:text-indigo-400 { color: ${hex} !important; }
                .border-indigo-500, .border-indigo-600 { border-color: ${hex} !important; }
                .hover\\:border-indigo-500\\/50:hover { border-color: ${hex}80 !important; }
                .focus\\:ring-indigo-500:focus, .focus\\:ring-indigo-600:focus { --tw-ring-color: ${hex} !important; }
            `;

            const label = document.getElementById('activeAccentLabel');
            if (label) label.textContent = hex;

            const picker = document.getElementById('studioColorPicker');
            if (picker && picker.value !== hex) picker.value = hex;

            const hexInput = document.getElementById('studioHexInput');
            if (hexInput && hexInput.value !== hex) hexInput.value = hex;

            // Highlight matching preset swatch
            document.querySelectorAll('.accent-circle').forEach(btn => {
                if (btn.getAttribute('data-color') === hex) {
                    btn.classList.add('ring-2', 'ring-white', 'ring-offset-2', 'ring-offset-slate-900');
                } else {
                    btn.classList.remove('ring-2', 'ring-white', 'ring-offset-2', 'ring-offset-slate-900');
                }
            });

            saveStudioState();
        }

        function setAdminFont(font) {
            adminStudio.font = font;
            const docEl = document.documentElement;
            docEl.classList.remove('font-jakarta', 'font-inter', 'font-outfit', 'font-space', 'font-poppins', 'font-serif-lux', 'font-system');
            docEl.classList.add('font-' + font);

            document.querySelectorAll('#fontSelector button').forEach(btn => {
                const val = btn.getAttribute('data-font-val');
                const check = btn.querySelector('.check-indicator');
                if (val === font) {
                    btn.classList.add('border-indigo-500', 'bg-indigo-600/10');
                    if (check) check.classList.remove('hidden');
                } else {
                    btn.classList.remove('border-indigo-500', 'bg-indigo-600/10');
                    if (check) check.classList.add('hidden');
                }
            });

            saveStudioState();
        }

        function setAdminScale(scale) {
            adminStudio.scale = scale;
            const docEl = document.documentElement;
            docEl.classList.remove('scale-compact', 'scale-standard', 'scale-relaxed');
            docEl.classList.add('scale-' + scale);

            document.querySelectorAll('#scaleSelector button').forEach(btn => {
                const val = btn.getAttribute('data-scale-val');
                if (val === scale) {
                    btn.classList.add('border-indigo-500', 'bg-indigo-600/20');
                    btn.classList.remove('border-slate-800', 'bg-slate-800/40');
                } else {
                    btn.classList.remove('border-indigo-500', 'bg-indigo-600/20');
                    btn.classList.add('border-slate-800', 'bg-slate-800/40');
                }
            });

            saveStudioState();
        }

        function setAdminRadius(radius) {
            adminStudio.radius = radius;
            const docEl = document.documentElement;
            docEl.classList.remove('radius-sharp', 'radius-subtle', 'radius-curved', 'radius-pill');
            docEl.classList.add('radius-' + radius);

            document.querySelectorAll('#radiusSelector button').forEach(btn => {
                const val = btn.getAttribute('data-radius-val');
                if (val === radius) {
                    btn.classList.add('border-indigo-500', 'bg-indigo-600/20');
                    btn.classList.remove('border-slate-800', 'bg-slate-800/40');
                } else {
                    btn.classList.remove('border-indigo-500', 'bg-indigo-600/20');
                    btn.classList.add('border-slate-800', 'bg-slate-800/40');
                }
            });

            saveStudioState();
        }

        function toggleAdminPattern(enabled) {
            adminStudio.pattern = !!enabled;
            const docEl = document.documentElement;
            if (adminStudio.pattern) {
                docEl.classList.add('pattern-grid');
            } else {
                docEl.classList.remove('pattern-grid');
            }
            const toggle = document.getElementById('patternToggle');
            if (toggle) toggle.checked = adminStudio.pattern;
            saveStudioState();
        }

        function applyMasterPreset(preset) {
            if (preset === 'midnight') {
                setAdminTheme('dark');
                setAdminAccent('#4f46e5');
                setAdminFont('jakarta');
                setAdminScale('standard');
                setAdminRadius('curved');
                toggleAdminPattern(false);
            } else if (preset === 'cyberpunk') {
                setAdminTheme('cyberpunk');
                setAdminAccent('#06b6d4');
                setAdminFont('space');
                setAdminScale('compact');
                setAdminRadius('sharp');
                toggleAdminPattern(true);
            } else if (preset === 'oled') {
                setAdminTheme('oled');
                setAdminAccent('#3b82f6');
                setAdminFont('inter');
                setAdminScale('standard');
                setAdminRadius('subtle');
                toggleAdminPattern(false);
            } else if (preset === 'nordic') {
                setAdminTheme('nordic');
                setAdminAccent('#10b981');
                setAdminFont('outfit');
                setAdminScale('standard');
                setAdminRadius('curved');
                toggleAdminPattern(false);
            } else if (preset === 'sepia') {
                setAdminTheme('sepia');
                setAdminAccent('#f59e0b');
                setAdminFont('serif-lux');
                setAdminScale('relaxed');
                setAdminRadius('subtle');
                toggleAdminPattern(false);
            } else if (preset === 'light') {
                setAdminTheme('light');
                setAdminAccent('#4f46e5');
                setAdminFont('jakarta');
                setAdminScale('standard');
                setAdminRadius('curved');
                toggleAdminPattern(false);
            }
        }

        function resetStudioDefaults() {
            applyMasterPreset('midnight');
            localStorage.removeItem('admin-theme-studio');
            localStorage.removeItem('admin-theme');
        }

        function openAdminCustomizer() {
            const drawer = document.getElementById('adminCustomizerDrawer');
            const backdrop = document.getElementById('adminCustomizerBackdrop');
            if (!drawer || !backdrop) return;

            // Sync UI state before showing
            updateThemeUI(adminStudio.theme);
            setAdminAccent(adminStudio.accent);
            setAdminFont(adminStudio.font);
            setAdminScale(adminStudio.scale);
            setAdminRadius(adminStudio.radius);
            toggleAdminPattern(adminStudio.pattern);

            backdrop.classList.remove('pointer-events-none');
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');

            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
            document.body.classList.add('overflow-hidden');
        }

        function closeAdminCustomizer() {
            const drawer = document.getElementById('adminCustomizerDrawer');
            const backdrop = document.getElementById('adminCustomizerBackdrop');
            if (!drawer || !backdrop) return;

            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');

            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            backdrop.classList.add('pointer-events-none');
            document.body.classList.remove('overflow-hidden');
        }

        // Initialize UI labels on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateThemeUI(adminStudio.theme);
            setAdminAccent(adminStudio.accent);
            setAdminFont(adminStudio.font);
            setAdminScale(adminStudio.scale);
            setAdminRadius(adminStudio.radius);
            toggleAdminPattern(adminStudio.pattern);
        });

        // Close drawer on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAdminCustomizer();
            }
        });

        // Copy Student Credentials to Clipboard
        function copyStudentCredentials(email, password, name, appNumber) {
            const portalUrl = "{{ route('login') }}";
            const text = `🎓 Infinity Interns – Student Portal Credentials\n\nStudent Name: ${name}\nApplication No: ${appNumber}\nLogin Portal: ${portalUrl}\nEmail: ${email}\nPassword: ${password}\n\nPlease sign in to view your offer letter, orientation materials, and project records.`;
            
            navigator.clipboard.writeText(text).then(() => {
                alert("✓ Login credentials copied to clipboard! You can paste and send them to the student via WhatsApp or Email.");
            }).catch(() => {
                prompt("Copy credentials manually:", text);
            });
        }

        // Strict Isolated Sidebar Scroll Controller
        (function() {
            const aside = document.querySelector('aside.adm-sidebar');
            const navScroll = document.querySelector('.adm-sidebar-scroll');
            if (!aside) return;

            aside.addEventListener('wheel', function(e) {
                if (window.innerWidth < 768) return; // Do not restrict on mobile

                // If mouse is on header, footer, or any non-scrollable area of sidebar
                if (!navScroll || !navScroll.contains(e.target)) {
                    e.preventDefault();
                    return;
                }

                // Inside nav scroll: allow internal scroll, but block wheel bubbling at top/bottom edges
                const delta = e.deltaY;
                const atTop = navScroll.scrollTop <= 0;
                const atBottom = Math.ceil(navScroll.scrollTop + navScroll.clientHeight) >= (navScroll.scrollHeight - 1);

                if ((delta < 0 && atTop) || (delta > 0 && atBottom)) {
                    e.preventDefault();
                }
            }, { passive: false });
        })();
    </script>

    @yield('scripts')
</body>
</html>
