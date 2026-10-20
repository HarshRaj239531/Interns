<!DOCTYPE html>
<html lang="en" class="h-full" data-admin-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal') – Infinity Interns</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    
    <!-- Instant Zero-FOUC Theme Initializer -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('admin-theme') || 'dark';
                document.documentElement.setAttribute('data-admin-theme', savedTheme);
                if (savedTheme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
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

                <!-- Interactive Dark / Light Mode Switcher Toggle Button -->
                <button type="button" onclick="toggleAdminTheme()" id="themeToggleBtn" title="Toggle Dark / Light Theme" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-semibold hover:border-indigo-500 transition cursor-pointer shadow-xs">
                    <span id="themeIcon">🌙</span>
                    <span id="themeLabel" class="hidden sm:inline">Dark</span>
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
    <script>
        function updateThemeUI(theme) {
            const icon = document.getElementById('themeIcon');
            const label = document.getElementById('themeLabel');
            if (!icon || !label) return;

            if (theme === 'light') {
                icon.textContent = '☀️';
                label.textContent = 'Light';
            } else {
                icon.textContent = '🌙';
                label.textContent = 'Dark';
            }
        }

        function toggleAdminTheme() {
            const current = document.documentElement.getAttribute('data-admin-theme') === 'light' ? 'light' : 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-admin-theme', next);
            if (next === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            localStorage.setItem('admin-theme', next);
            updateThemeUI(next);
        }

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
