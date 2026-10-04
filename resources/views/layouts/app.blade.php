<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Infinity Interns') – UGC-Focused Internship & Skill Development</title>
    <meta name="description" content="Learn in-demand skills and earn accredited internship certificates designed for BA, BSc, BBA, BCA, BCom undergraduate students.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAFBF9] text-[#1E293B] flex flex-col min-h-screen font-sans selection:bg-indigo-600 selection:text-white">
    <!-- Top Scroll Progress Indicator (Framer Motion) -->
    <div id="scrollProgress" class="fixed top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-400 z-[999] origin-left scale-x-0 pointer-events-none"></div>

    <!-- Top Sticky Floating Navbar -->
    <div class="fixed top-0 inset-x-0 z-[100] flex justify-center px-3 sm:px-4 pt-3.5 pointer-events-none">
        <nav id="mainNav" class="pointer-events-auto flex items-center justify-between transition-all duration-300 ease-in-out w-full max-w-7xl bg-white/90 backdrop-blur-md py-2.5 px-4 md:px-7 rounded-full border border-slate-200/80 shadow-md">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <div class="relative w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-200 shadow-xs transition-transform group-hover:scale-105">
                    <img src="/infinity-interns-logo.png" alt="Infinity Interns Logo" class="h-7 w-auto object-contain">
                </div>
                <div class="flex flex-col">
                    <span class="font-serif tracking-wider uppercase text-slate-900 text-xs sm:text-sm font-bold">
                        Infinity Interns
                    </span>
                    <span class="text-[9px] sm:text-[10px] text-indigo-600 font-semibold tracking-wider uppercase">
                        UGC Internship Portal
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links (Clean, Curated & Organized) -->
            <div class="hidden lg:flex items-center gap-1 xl:gap-1.5">
                <a href="{{ route('home') }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:text-indigo-600 hover:bg-slate-100/70' }}">
                    Home
                </a>
                <a href="{{ route('programs') }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all {{ request()->routeIs('programs') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:text-indigo-600 hover:bg-slate-100/70' }}">
                    Programs
                </a>
                <a href="{{ route('certification') }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all {{ request()->routeIs('certification') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:text-indigo-600 hover:bg-slate-100/70' }}">
                    Certification
                </a>

                <!-- Explore Dropdown -->
                <div class="relative group" id="exploreDropdownContainer">
                    <button type="button" id="exploreDropdownBtn" class="flex items-center gap-1 px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all cursor-pointer {{ request()->routeIs(['journey', 'subjects', 'mentors', 'colleges', 'stories', 'faq']) ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:text-indigo-600 hover:bg-slate-100/70' }}" aria-expanded="false" aria-haspopup="true">
                        <span>Explore</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-indigo-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Dropdown Popover Card -->
                    <div id="exploreDropdownMenu" class="absolute top-full left-1/2 -translate-x-1/2 pt-2.5 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:pointer-events-auto transition-all duration-200 ease-out z-50">
                        <div class="w-[490px] bg-white/95 backdrop-blur-xl rounded-2xl border border-slate-200/90 shadow-2xl p-3.5 text-left">
                            <div class="grid grid-cols-2 gap-1.5">
                                <!-- Journey -->
                                <a href="{{ route('journey') }}" class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-indigo-50/70 transition group/item">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover/item:bg-indigo-600 group-hover/item:text-white transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-indigo-600 transition">Internship Journey</div>
                                        <div class="text-[11px] text-slate-500 leading-snug">4-step roadmap to certificate</div>
                                    </div>
                                </a>

                                <!-- Streams & Subjects -->
                                <a href="{{ route('subjects') }}" class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-indigo-50/70 transition group/item">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover/item:bg-indigo-600 group-hover/item:text-white transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-indigo-600 transition">Academic Streams</div>
                                        <div class="text-[11px] text-slate-500 leading-snug">BA, BSc, BBA, BCA domains</div>
                                    </div>
                                </a>

                                <!-- Mentors -->
                                <a href="{{ route('mentors') }}" class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-indigo-50/70 transition group/item">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover/item:bg-indigo-600 group-hover/item:text-white transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-indigo-600 transition">Mentors & Advisory</div>
                                        <div class="text-[11px] text-slate-500 leading-snug">Expert faculty & council</div>
                                    </div>
                                </a>

                                <!-- For Colleges -->
                                <a href="{{ route('colleges') }}" class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-indigo-50/70 transition group/item">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover/item:bg-indigo-600 group-hover/item:text-white transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-indigo-600 transition">For Colleges</div>
                                        <div class="text-[11px] text-slate-500 leading-snug">Campus MOUs & NEP 2020</div>
                                    </div>
                                </a>

                                <!-- Stories -->
                                <a href="{{ route('stories') }}" class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-indigo-50/70 transition group/item">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover/item:bg-indigo-600 group-hover/item:text-white transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-indigo-600 transition">Success Stories</div>
                                        <div class="text-[11px] text-slate-500 leading-snug">Student reviews & outcomes</div>
                                    </div>
                                </a>

                                <!-- FAQs -->
                                <a href="{{ route('faq') }}" class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-indigo-50/70 transition group/item">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover/item:bg-indigo-600 group-hover/item:text-white transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover/item:text-indigo-600 transition">Help & FAQs</div>
                                        <div class="text-[11px] text-slate-500 leading-snug">UGC compliance & answers</div>
                                    </div>
                                </a>
                            </div>

                            <!-- Dropdown Card Footer -->
                            <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-[11px] px-1 text-slate-500">
                                <span>Need guidance on your stream?</span>
                                <a href="https://wa.me/916204141971" target="_blank" rel="noopener noreferrer" class="font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 hover:underline">
                                    <span>Chat with Counselor</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all {{ request()->routeIs('contact') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:text-indigo-600 hover:bg-slate-100/70' }}">
                    Contact
                </a>
            </div>

            <!-- Right Action Buttons -->
            <div class="hidden sm:flex items-center gap-2 shrink-0">
                <a href="{{ route('verify') }}" class="text-xs font-semibold px-3 py-1.5 rounded-full transition flex items-center gap-1.5 {{ request()->routeIs('verify') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-100/80' }}" title="Verify Student Certificate">
                    <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Verify</span>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200/80 px-3.5 py-1.5 rounded-full hover:bg-indigo-100 transition flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Admin Portal</span>
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200/80 px-3.5 py-1.5 rounded-full hover:bg-indigo-100 transition flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Student Portal</span>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 px-3 py-1.5 rounded-full hover:bg-slate-100/80 transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>Portal</span>
                    </a>
                @endauth

                <button onclick="openApplyModal()" class="px-4 sm:px-5 py-2 text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 rounded-full shadow-md shadow-indigo-600/25 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center gap-1.5 cursor-pointer">
                    <span>Apply Now</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>

            <!-- Mobile Action & Hamburger Toggle -->
            <div class="flex lg:hidden items-center gap-2">
                <button onclick="openApplyModal()" class="px-3.5 py-1.5 text-xs font-bold text-white bg-indigo-600 rounded-full shadow-xs active:scale-95 transition">
                    Apply
                </button>
                <button onclick="toggleMobileNav()" id="mobileMenuBtn" aria-label="Toggle navigation menu" class="p-2 text-slate-700 hover:text-slate-900 rounded-full hover:bg-slate-100 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Drawer (Clean, Categorized & Non-Cluttered) -->
    <div id="mobileDrawer" class="hidden fixed inset-x-3 sm:inset-x-6 top-20 z-[95] lg:hidden bg-white/95 backdrop-blur-2xl rounded-3xl border border-slate-200/90 p-5 shadow-2xl space-y-4 max-h-[85vh] overflow-y-auto">
        <!-- Main Links -->
        <div class="space-y-1">
            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 pb-0.5">Quick Links</div>
            <div class="grid grid-cols-2 gap-1.5">
                <a href="{{ route('home') }}" class="px-3.5 py-2 text-xs font-semibold rounded-xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700 font-bold' : '' }}">Home</a>
                <a href="{{ route('programs') }}" class="px-3.5 py-2 text-xs font-semibold rounded-xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('programs') ? 'bg-indigo-50 text-indigo-700 font-bold' : '' }}">Programs</a>
                <a href="{{ route('certification') }}" class="px-3.5 py-2 text-xs font-semibold rounded-xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('certification') ? 'bg-indigo-50 text-indigo-700 font-bold' : '' }}">Certification</a>
                <a href="{{ route('contact') }}" class="px-3.5 py-2 text-xs font-semibold rounded-xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('contact') ? 'bg-indigo-50 text-indigo-700 font-bold' : '' }}">Contact</a>
            </div>
        </div>

        <!-- Explore More Links -->
        <div class="space-y-1 pt-2 border-t border-slate-100">
            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 pb-0.5">Explore Programs & Guidance</div>
            <div class="grid grid-cols-2 gap-1.5">
                <a href="{{ route('journey') }}" class="px-3.5 py-2 text-xs font-medium rounded-xl text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600">Internship Journey</a>
                <a href="{{ route('subjects') }}" class="px-3.5 py-2 text-xs font-medium rounded-xl text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600">Academic Streams</a>
                <a href="{{ route('mentors') }}" class="px-3.5 py-2 text-xs font-medium rounded-xl text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600">Mentors & Advisory</a>
                <a href="{{ route('colleges') }}" class="px-3.5 py-2 text-xs font-medium rounded-xl text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600">For Colleges & MOUs</a>
                <a href="{{ route('stories') }}" class="px-3.5 py-2 text-xs font-medium rounded-xl text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600">Success Stories</a>
                <a href="{{ route('faq') }}" class="px-3.5 py-2 text-xs font-medium rounded-xl text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600">Help & FAQs</a>
            </div>
        </div>

        <!-- Quick Actions & Auth -->
        <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('verify') }}" class="w-full text-center py-2.5 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-full transition flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Verify Certificate</span>
                </a>
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="w-full text-center py-2.5 text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200 rounded-full hover:bg-indigo-100 transition">
                        My Portal
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full text-center py-2.5 text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200 rounded-full hover:bg-indigo-100 transition">
                        Portal Login
                    </a>
                @endauth
            </div>
            <button onclick="openApplyModal(); toggleMobileNav();" class="w-full text-center py-2.5 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow-lg shadow-indigo-600/30 transition cursor-pointer">
                Apply For Internship →
            </button>
        </div>
    </div>

    <!-- Flash Notifications -->
    <div class="max-w-4xl mx-auto px-4 pt-24 pb-2 w-full">
        @if(session('success'))
            <div class="p-4 mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-medium flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold text-base">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-medium flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 font-bold text-base">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
                <div class="font-bold flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Please correct the errors below:</span>
                </div>
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Rich Footer -->
    <footer class="bg-white border-t border-slate-200/80 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 mb-12">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-4 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="/infinity-interns-logo.png" alt="Infinity Interns Logo" class="h-9 w-auto">
                        <span class="font-serif font-bold text-lg text-slate-900 tracking-wider uppercase">
                            Infinity Interns
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 font-light leading-relaxed">
                        Practical skill development and UGC-focused internship programs designed for BA, BSc, BBA, BCA, BCom undergraduate students across India.
                    </p>
                    <div class="p-3.5 rounded-2xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-600 font-medium">
                        <span class="font-bold text-indigo-700 block mb-0.5">A Unit of Infinitya1 Career Counselling Pvt Ltd.</span>
                        <span>Operational Center: Bhub Patna, Bihar, India</span>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="lg:col-span-2 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900">Explore</h4>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a></li>
                        <li><a href="{{ route('programs') }}" class="hover:text-indigo-600">Programs Catalog</a></li>
                        <li><a href="{{ route('journey') }}" class="hover:text-indigo-600">Training Journey</a></li>
                        <li><a href="{{ route('certification') }}" class="hover:text-indigo-600">UGC Documents</a></li>
                        <li><a href="{{ route('verify') }}" class="hover:text-indigo-600">Verify Credential</a></li>
                    </ul>
                </div>

                <!-- Col 3: Academic Domains -->
                <div class="lg:col-span-3 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900">Streams & Faculty</h4>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li><a href="{{ route('subjects') }}" class="hover:text-indigo-600">Arts & Social Sciences (BA)</a></li>
                        <li><a href="{{ route('subjects') }}" class="hover:text-indigo-600">Science & Applied Analytics (BSc)</a></li>
                        <li><a href="{{ route('subjects') }}" class="hover:text-indigo-600">Business & Entrepreneurship (BBA)</a></li>
                        <li><a href="{{ route('subjects') }}" class="hover:text-indigo-600">Web & Computer Applications (BCA)</a></li>
                        <li><a href="{{ route('mentors') }}" class="hover:text-indigo-600">Advisory Council Mentors</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Helpdesk -->
                <div class="lg:col-span-3 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900">Student Helpline</h4>
                    <div class="space-y-2 text-xs text-slate-600">
                        <p class="font-semibold text-slate-900">Phone: +91 6204141971</p>
                        <p>Alternate: +91 6204221832</p>
                        <p>Email: info@infinityinterns.com</p>
                        <p>Hours: Mon–Sat (9:30 AM – 6:30 PM)</p>
                        <div class="pt-2">
                            <a href="https://wa.me/916204141971" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-emerald-700 font-bold hover:underline">
                                <span>Direct WhatsApp Chat →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>© {{ date('Y') }} Infinity Interns. All rights reserved. A Unit of Infinitya1 Career Counselling Pvt Ltd.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('colleges') }}" class="hover:text-indigo-600">College MOU</a>
                    <a href="{{ route('faq') }}" class="hover:text-indigo-600">FAQs</a>
                    <a href="{{ route('verify') }}" class="hover:text-indigo-600">QR Verifier</a>
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Portal Access</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Action Button -->
    <a href="https://wa.me/916204141971?text=Hello%20Infinity%20Interns%2C%20I%20want%20to%20know%20more%20about%20the%20undergraduate%20internship%20program."
       target="_blank" rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 p-3.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full shadow-2xl shadow-emerald-600/40 hover:scale-110 active:scale-95 transition-all flex items-center justify-center cursor-pointer group"
       title="Chat on WhatsApp">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.54 1.961.828 3.123.828 3.18 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.767-5.768-5.767zm0 10.493c-.934 0-1.849-.251-2.65-.726l-.19-.113-1.573.412.42-1.533-.124-.197c-.522-.83-.798-1.785-.798-2.766 0-2.88 2.343-5.223 5.225-5.223 2.88 0 5.224 2.343 5.224 5.223 0 2.88-2.344 5.223-5.224 5.223zm6.758-13.665c-1.802-1.804-4.198-2.798-6.758-2.798-5.263 0-9.545 4.282-9.547 9.546 0 1.682.438 3.324 1.272 4.768l-1.35 4.931 5.045-1.323c1.393.76 2.96 1.161 4.58 1.161h.004c5.263 0 9.545-4.282 9.547-9.546 0-2.548-.992-4.945-2.793-6.739z"/>
        </svg>
    </a>

    <!-- Application / Enrollment Modal -->
    <div id="applyModal" class="hidden fixed inset-0 z-[120] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
        <div class="relative w-full max-w-xl my-8 rounded-3xl bg-white border border-slate-200 p-6 sm:p-8 shadow-2xl">
            <button onclick="closeApplyModal()" class="absolute top-5 right-5 p-2 text-slate-400 hover:text-slate-800 rounded-full hover:bg-slate-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="mb-5">
                <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100">
                    Official Student Application
                </span>
                <h3 class="text-2xl font-serif text-slate-900 mt-2 font-bold">
                    Enroll for Undergraduate Internship
                </h3>
                <p class="text-xs text-slate-600 mt-1">
                    Fill in your details below to register and create your Student Portal account instantly.
                </p>
            </div>

            <form action="{{ route('apply') }}" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Full Student Name *</label>
                        <input type="text" name="name" required placeholder="e.g. Rahul Sharma" class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Mobile / WhatsApp *</label>
                        <input type="tel" name="phone" required placeholder="+91 9876543210" class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email Address (Login) *</label>
                        <input type="email" name="email" required placeholder="rahul@example.com" class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Set Password *</label>
                        <input type="password" name="password" required placeholder="Min 6 characters" class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Undergraduate Degree *</label>
                        <select name="degree" required class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="BA">Bachelor of Arts (BA)</option>
                            <option value="BSc">Bachelor of Science (BSc)</option>
                            <option value="BBA">Bachelor of Business Admin (BBA)</option>
                            <option value="BCA">Bachelor of Computer App (BCA)</option>
                            <option value="BCom">Bachelor of Commerce (BCom)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Current Semester *</label>
                        <select name="semester" required class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                            <option value="3rd Semester">3rd Semester</option>
                            <option value="4th Semester">4th Semester</option>
                            <option value="5th Semester" selected>5th Semester</option>
                            <option value="6th Semester">6th Semester</option>
                            <option value="7th/8th Semester">7th/8th Semester</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">College / University Name *</label>
                    <input type="text" name="college" required placeholder="e.g. Patna Science College, Patna University" class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Preferred Program Domain Track *</label>
                    <select name="program_domain" required class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        @if(isset($activeStreams) && $activeStreams->count() > 0)
                            @foreach($activeStreams as $stream)
                                <option value="{{ $stream->title }}">{{ $stream->title }} ({{ $stream->code }})</option>
                            @endforeach
                        @else
                            <option value="Arts, Social Science & Communication">Arts, Social Science & Communication (BA)</option>
                            <option value="Science, Environment & Data Skills">Science, Environment & Data Skills (BSc)</option>
                            <option value="Business, Finance & Entrepreneurship">Business, Finance & Entrepreneurship (BBA/BCom)</option>
                            <option value="Technology, Digital & Web Skills">Technology, Digital & Web Skills (BCA/IT)</option>
                        @endif
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-indigo-600/25 cursor-pointer">
                        Submit & Create Student Portal Account
                    </button>
                </div>

                <div class="pt-2 text-center">
                    <span class="text-[11px] text-slate-500">Or submit via </span>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLScS-mCKWy7S_AlpGRE3QJQbno1Nbei1Xc22A8tOOsqq_L8WmQ/viewform?usp=header" target="_blank" rel="noopener noreferrer" class="text-[11px] font-bold text-indigo-600 hover:underline">
                        Google Form ↗
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- UI Fallback Scripts (Delegates to Framer Motion if initialized) -->
    <script>
        if (typeof window.openApplyModal === 'undefined') {
            window.openApplyModal = function() {
                const modal = document.getElementById('applyModal');
                if (modal) modal.classList.remove('hidden');
            };
        }
        if (typeof window.closeApplyModal === 'undefined') {
            window.closeApplyModal = function() {
                const modal = document.getElementById('applyModal');
                if (modal) modal.classList.add('hidden');
            };
        }
        if (typeof window.toggleMobileNav === 'undefined') {
            window.toggleMobileNav = function() {
                const drawer = document.getElementById('mobileDrawer');
                if (drawer) drawer.classList.toggle('hidden');
            };
        }

        // Interactive Dropdown & Accessibility
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.getElementById('exploreDropdownBtn');
            const dropdownMenu = document.getElementById('exploreDropdownMenu');
            if (dropdownBtn && dropdownMenu) {
                dropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isVisible = dropdownMenu.classList.contains('opacity-100');
                    if (isVisible) {
                        dropdownMenu.classList.remove('opacity-100', 'pointer-events-auto');
                        dropdownMenu.classList.add('opacity-0', 'pointer-events-none');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                    } else {
                        dropdownMenu.classList.remove('opacity-0', 'pointer-events-none');
                        dropdownMenu.classList.add('opacity-100', 'pointer-events-auto');
                        dropdownBtn.setAttribute('aria-expanded', 'true');
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!dropdownMenu.contains(e.target) && !dropdownBtn.contains(e.target)) {
                        dropdownMenu.classList.remove('opacity-100', 'pointer-events-auto');
                        dropdownMenu.classList.add('opacity-0', 'pointer-events-none');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        dropdownMenu.classList.remove('opacity-100', 'pointer-events-auto');
                        dropdownMenu.classList.add('opacity-0', 'pointer-events-none');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                        const drawer = document.getElementById('mobileDrawer');
                        if (drawer && !drawer.classList.contains('hidden')) {
                            drawer.classList.add('hidden');
                        }
                    }
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
