<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FAFBF9] text-slate-800">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal') – Infinity Interns</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-[#FAFBF9] text-slate-800 font-sans antialiased flex flex-col">

    <!-- Top Student Navigation -->
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <img src="/infinity-interns-logo.png" alt="Logo" class="h-8 w-auto">
                    <div>
                        <span class="font-serif font-bold text-sm text-slate-900 tracking-wider block">Infinity Interns</span>
                        <span class="text-[9px] text-indigo-600 font-semibold tracking-wider uppercase block">Student Workspace</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-600 hover:text-indigo-600 hidden sm:inline">
                    Main Site
                </a>

                <div class="h-4 w-px bg-slate-200 hidden sm:block"></div>

                <div class="text-right hidden sm:block">
                    <span class="text-xs font-bold text-slate-900 block">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-slate-500 font-mono block">{{ auth()->user()->studentProfile?->application_number }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3.5 py-1.5 rounded-full bg-slate-100 hover:bg-rose-50 text-slate-700 hover:text-rose-700 border border-slate-200 text-xs font-semibold transition cursor-pointer">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
        @if(session('success'))
            <div class="p-4 mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-medium flex items-center justify-between shadow-xs">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-700 font-bold">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-medium flex items-center justify-between shadow-xs">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-rose-700 font-bold">&times;</button>
            </div>
        @endif
    </div>

    <!-- Student Body -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @yield('content')
    </main>

    <!-- Student Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        <p>© {{ date('Y') }} Infinity Interns – A Unit of Infinitya1 Career Counselling Pvt Ltd. Patna, Bihar, India.</p>
    </footer>

    @yield('scripts')
</body>
</html>
