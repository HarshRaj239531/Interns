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

            <!-- Desktop Nav Links -->
            <div class="hidden xl:flex items-center gap-4 lg:gap-5">
                <a href="{{ route('home') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('home') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Home</a>
                <a href="{{ route('programs') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('programs') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Programs</a>
                <a href="{{ route('journey') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('journey') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Journey</a>
                <a href="{{ route('certification') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('certification') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Certification</a>
                <a href="{{ route('subjects') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('subjects') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Subjects</a>
                <a href="{{ route('mentors') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('mentors') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Mentors</a>
                <a href="{{ route('colleges') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('colleges') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">For Colleges</a>
                <a href="{{ route('stories') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('stories') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Stories</a>
                <a href="{{ route('faq') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('faq') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="nav-link-underline text-[11px] uppercase tracking-wider font-semibold transition-colors {{ request()->routeIs('contact') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }}">Contact</a>
            </div>

            <!-- Right Action Buttons -->
            <div class="hidden sm:flex items-center gap-2.5 shrink-0">
                <a href="{{ route('verify') }}" class="text-xs font-semibold text-slate-600 hover:text-indigo-600 px-3 py-1.5 rounded-full hover:bg-slate-100 transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Verify</span>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200 px-3.5 py-1.5 rounded-full hover:bg-indigo-100 transition">
                            Admin Portal
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200 px-3.5 py-1.5 rounded-full hover:bg-indigo-100 transition">
                            Student Portal
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-700 hover:text-slate-900 px-3 py-1.5 rounded-full hover:bg-slate-100 transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>Portal</span>
                    </a>
                @endauth

                <button onclick="openApplyModal()" class="px-5 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow-lg shadow-indigo-600/25 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center gap-1.5 cursor-pointer">
                    <span>Apply Now</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>

            <!-- Mobile Hamburger Toggle -->
            <div class="flex xl:hidden items-center gap-2">
                <button onclick="openApplyModal()" class="px-3.5 py-1.5 text-xs font-bold text-white bg-indigo-600 rounded-full">
                    Apply
                </button>
                <button onclick="toggleMobileNav()" class="p-2 text-slate-700 hover:text-slate-900 rounded-full hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Drawer -->
    <div id="mobileDrawer" class="hidden fixed inset-x-4 top-20 z-[95] xl:hidden bg-white/95 backdrop-blur-2xl rounded-3xl border border-slate-200/90 p-5 shadow-2xl space-y-4">
        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('home') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Home</a>
            <a href="{{ route('programs') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Programs</a>
            <a href="{{ route('journey') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Journey</a>
            <a href="{{ route('certification') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Certification</a>
            <a href="{{ route('subjects') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Subjects</a>
            <a href="{{ route('mentors') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Mentors</a>
            <a href="{{ route('colleges') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">For Colleges</a>
            <a href="{{ route('stories') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Stories</a>
            <a href="{{ route('faq') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">FAQ</a>
            <a href="{{ route('contact') }}" class="px-3.5 py-2 text-xs font-semibold rounded-2xl text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Contact</a>
        </div>
        <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
            <a href="{{ route('verify') }}" class="w-full text-center py-2.5 text-xs font-semibold text-slate-700 bg-slate-100 rounded-full">
                Verify Certificate
            </a>
            <a href="{{ route('login') }}" class="w-full text-center py-2.5 text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200 rounded-full">
                Portal Login
            </a>
            <button onclick="openApplyModal(); toggleMobileNav();" class="w-full text-center py-2.5 text-xs font-bold text-white bg-indigo-600 rounded-full shadow-lg shadow-indigo-600/30">
                Online Student Enrollment Form
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
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Preferred Program Domain *</label>
                    <select name="program_domain" required class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="Arts, Social Science & Communication">Arts, Social Science & Communication (BA)</option>
                        <option value="Science, Environment & Data Skills">Science, Environment & Data Skills (BSc)</option>
                        <option value="Business, Finance & Entrepreneurship">Business, Finance & Entrepreneurship (BBA/BCom)</option>
                        <option value="Technology, Digital & Web Skills">Technology, Digital & Web Skills (BCA/IT)</option>
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

    <!-- UI Scripts -->
    <script>
        function toggleMobileNav() {
            const drawer = document.getElementById('mobileDrawer');
            drawer.classList.toggle('hidden');
        }

        function openApplyModal() {
            document.getElementById('applyModal').classList.remove('hidden');
        }

        function closeApplyModal() {
            document.getElementById('applyModal').classList.add('hidden');
        }

        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeApplyModal();
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
