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
            } catch (e) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full min-h-screen adm-canvas font-sans antialiased flex flex-col md:flex-row overflow-x-hidden">

    <!-- Sidebar -->
    <aside class="w-full md:w-64 adm-sidebar border-r p-5 flex flex-col justify-between shrink-0 md:h-screen md:sticky md:top-0 z-40">
        <div>
            <!-- Brand -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 mb-8 px-2 group">
                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 flex items-center justify-center p-1.5 shadow-sm group-hover:border-indigo-500/50 transition">
                    <img src="/infinity-interns-logo.png" alt="Logo" class="h-full w-auto object-contain">
                </div>
                <div>
                    <span class="font-serif font-bold text-sm adm-text tracking-wider block">Infinity Interns</span>
                    <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-semibold tracking-wider uppercase block">
                        Admin Console
                    </span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-1.5 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Applications & Students</span>
                </a>

                <a href="{{ route('admin.certificate-generator') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.certificate-generator') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    <span>Certificate Generator</span>
                </a>

                <a href="{{ route('admin.streams') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.streams') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span>Manage Streams / Tracks</span>
                </a>

                <a href="{{ route('admin.track') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.track') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>Track Application</span>
                </a>

                <a href="{{ route('admin.inquiries') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.inquiries') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Inquiries & MOU Desks</span>
                </a>

                <div class="pt-4 pb-2 px-3 text-[10px] font-bold uppercase tracking-wider adm-text-muted">External Portals</div>

                <a href="{{ route('verify') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60 transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Public Verifier</span>
                    </div>
                    <span class="text-xs adm-text-muted">↗</span>
                </a>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60 transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>View Public Website</span>
                    </div>
                    <span class="text-xs adm-text-muted">↗</span>
                </a>
            </nav>
        </div>

        <!-- User / Logout -->
        <div class="pt-6 border-t border-slate-200 dark:border-slate-800/80 mt-6 space-y-3">
            <div class="flex items-center gap-3 px-2">
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

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen adm-canvas overflow-y-auto">
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

        <!-- Flash Messages -->
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
            localStorage.setItem('admin-theme', next);
            updateThemeUI(next);
        }

        // Initialize UI icon on load
        document.addEventListener('DOMContentLoaded', function() {
            const current = document.documentElement.getAttribute('data-admin-theme') || 'dark';
            updateThemeUI(current);
        });
    </script>

    @yield('scripts')
</body>
</html>
