@extends('layouts.app')

@section('title', 'Infinity Interns – UGC-Focused Internship & Skill Development')

@section('content')
<!-- Hero Section -->
<section id="home" class="relative min-h-[90vh] pt-24 pb-20 flex flex-col items-center justify-center overflow-hidden bg-[#F6F8F5]">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="motion-orb absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[500px] bg-indigo-100/50 rounded-full blur-[120px]"></div>
        <div class="motion-orb absolute top-1/3 right-10 w-[450px] h-[450px] bg-purple-100/40 rounded-full blur-[130px]"></div>
        <div class="motion-orb absolute bottom-10 left-10 w-[500px] h-[400px] bg-emerald-100/40 rounded-full blur-[140px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#94a3b8_1px,transparent_1px)] [background-size:28px_28px] opacity-15"></div>
    </div>

    <div class="relative z-10 text-center px-4 w-full max-w-5xl mx-auto">
        <!-- UGC Badge -->
        <div class="motion-hero-badge inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-indigo-100 shadow-xs text-indigo-700 mb-8">
            <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <span class="text-xs font-bold tracking-[0.2em] uppercase">UGC-Focused Internship Program</span>
        </div>

        <!-- Headline -->
        <h1 class="motion-hero-title text-4xl sm:text-6xl md:text-7xl font-serif leading-[1.08] tracking-tight mb-8 text-slate-900">
            Learn In-Demand Skills & <br class="hidden sm:block">
            <span class="text-indigo-700 italic pr-3 relative inline-block">
                Get Certified
                <svg class="absolute w-full h-3.5 -bottom-1.5 left-0 text-indigo-300" viewBox="0 0 200 9" fill="none">
                    <path d="M2.00018 7.37072C50.2989 -0.669527 122.956 -1.68412 198.057 7.37072" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </span>
            with Infinity Interns.
        </h1>

        <!-- Subheading -->
        <p class="motion-hero-sub max-w-3xl mx-auto text-base sm:text-lg text-slate-600 font-light mb-10 leading-relaxed px-4">
            <strong class="text-slate-800 font-semibold">Internships are an essential milestone in your college degree.</strong>
            Turn university requirements into a real career advantage with hands-on skill development and UGC-aligned internship programs designed for undergraduate students.
        </p>

        <!-- Highlights Grid -->
        <div class="motion-hero-cards grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-3xl mx-auto mb-10 text-left">
            <div class="motion-card-hover flex flex-col p-4 bg-white/95 backdrop-blur-sm rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <span class="text-indigo-600 mb-1 text-lg">🎖️</span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">UGC Focus</span>
                <span class="text-slate-900 font-semibold text-xs sm:text-sm">Undergraduate</span>
            </div>
            <div class="motion-card-hover flex flex-col p-4 bg-white/95 backdrop-blur-sm rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <span class="text-emerald-600 mb-1 text-lg">⚡</span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Methodology</span>
                <span class="text-slate-900 font-semibold text-xs sm:text-sm">Hands-on Projects</span>
            </div>
            <div class="motion-card-hover flex flex-col p-4 bg-white/95 backdrop-blur-sm rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <span class="text-purple-600 mb-1 text-lg">📜</span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Accreditation</span>
                <span class="text-slate-900 font-semibold text-xs sm:text-sm">Verified Certificate</span>
            </div>
            <div class="motion-card-hover flex flex-col p-4 bg-white/95 backdrop-blur-sm rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition">
                <span class="text-cyan-600 mb-1 text-lg">🤝</span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Support</span>
                <span class="text-slate-900 font-semibold text-xs sm:text-sm">Mentor Guided</span>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="motion-hero-cta flex flex-col sm:flex-row items-center justify-center gap-4">
            <button onclick="openApplyModal()" class="motion-btn-spring w-full sm:w-auto h-13 px-8 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow-xl shadow-indigo-600/25 hover:shadow-indigo-600/40 transition-all flex items-center justify-center gap-2 group cursor-pointer active:scale-95">
                <span>Start Your Journey</span>
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>

            <a href="#journey" class="motion-btn-spring w-full sm:w-auto h-13 px-8 text-sm font-semibold text-slate-700 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-full shadow-xs hover:shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-95">
                <span>How It Works</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </a>
        </div>

        <!-- Stream Badges -->
        <div class="motion-reveal pt-10 flex flex-wrap items-center justify-center gap-2 text-xs text-slate-500 font-medium">
            <span>Programs Tailored For:</span>
            @foreach(['BA', 'BSc', 'BBA', 'BCA', 'BCom'] as $deg)
                <span class="px-2.5 py-0.5 rounded-full bg-white border border-slate-200 text-slate-800 font-semibold shadow-xs">{{ $deg }}</span>
            @endforeach
            <span class="text-slate-400 font-normal">& related degrees</span>
        </div>
    </div>
</section>

<!-- Live Impact Stats Strip with Framer Motion Animated Numbers -->
<section class="py-10 bg-white/90 backdrop-blur-md border-y border-slate-200/80 relative z-20 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="motion-stagger grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 text-center">
            <div class="p-5 rounded-3xl bg-[#FAFBF9] border border-slate-200/80 motion-card-hover shadow-xs">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-indigo-600 mb-1 motion-counter" data-target="{{ $stats['total_students'] ?? 1420 }}" data-suffix="+">
                    {{ number_format($stats['total_students'] ?? 1420) }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Undergraduate Learners</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">Enrolled Nationwide</div>
            </div>
            <div class="p-5 rounded-3xl bg-[#FAFBF9] border border-slate-200/80 motion-card-hover shadow-xs">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-emerald-600 mb-1 motion-counter" data-target="{{ $stats['active_interns'] ?? 890 }}" data-suffix="+">
                    {{ number_format($stats['active_interns'] ?? 890) }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Active Live Interns</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">Executing Capstones</div>
            </div>
            <div class="p-5 rounded-3xl bg-[#FAFBF9] border border-slate-200/80 motion-card-hover shadow-xs">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-purple-600 mb-1 motion-counter" data-target="{{ $stats['certificates_issued'] ?? 520 }}" data-suffix="+">
                    {{ number_format($stats['certificates_issued'] ?? 520) }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Verified Certificates</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">Issued & Accredited</div>
            </div>
            <div class="p-5 rounded-3xl bg-[#FAFBF9] border border-slate-200/80 motion-card-hover shadow-xs">
                <div class="text-3xl sm:text-4xl font-serif font-extrabold text-cyan-600 mb-1 motion-counter" data-target="{{ $stats['partner_colleges'] ?? 24 }}" data-suffix="+">
                    {{ $stats['partner_colleges'] ?? 24 }}+
                </div>
                <div class="text-xs font-bold text-slate-800">Partner Institutions</div>
                <div class="text-[10px] text-slate-500 uppercase tracking-wider mt-0.5">College & University MoUs</div>
            </div>
        </div>
    </div>
</section>

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
                    <button onclick="openApplyModal()" class="w-full py-2.5 px-4 rounded-full text-xs font-bold text-indigo-700 bg-indigo-50 hover:bg-indigo-600 hover:text-white border border-indigo-200/60 transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- BSc Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-slate-200/60 transition-all duration-300">
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
                    <button onclick="openApplyModal()" class="w-full py-2.5 px-4 rounded-full text-xs font-bold text-cyan-700 bg-cyan-50 hover:bg-cyan-600 hover:text-white border border-cyan-200/60 transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- BBA Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-slate-200/60 transition-all duration-300">
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
                    <button onclick="openApplyModal()" class="w-full py-2.5 px-4 rounded-full text-xs font-bold text-purple-700 bg-purple-50 hover:bg-purple-600 hover:text-white border border-purple-200/60 transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- BCA Card -->
            <div class="motion-card-hover group rounded-[2.2rem] bg-[#FAFBF9] border border-slate-200/80 p-7 flex flex-col justify-between hover:shadow-2xl hover:shadow-slate-200/60 transition-all duration-300">
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
                    <button onclick="openApplyModal()" class="w-full py-2.5 px-4 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white border border-emerald-200/60 transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <span>Explore & Register</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Journey Section -->
<section id="journey" class="py-24 px-4 sm:px-6 lg:px-8 bg-[#F6F8F5] border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto">
        <div class="motion-reveal text-center max-w-2xl mx-auto mb-16">
            <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Professional Training Journey</span>
            <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight mb-4">
                From Registration to <span class="text-indigo-700 italic">Completion.</span>
            </h2>
            <p class="text-slate-600 font-light text-base leading-relaxed">
                A clear, student-friendly journey combining organized learning modules, practical tasks, live mentor interaction, and certified internship documentation.
            </p>
        </div>

        <div class="motion-stagger grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
            <div class="motion-card-hover p-8 rounded-[2.2rem] bg-white border border-slate-200/80 hover:border-slate-300 shadow-xs hover:shadow-xl transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <span class="font-serif text-4xl font-extrabold text-indigo-600/70 group-hover:text-indigo-700 transition">{{ $s['step'] }}</span>
                        <span class="text-[11px] font-semibold px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">{{ $s['duration'] }}</span>
                    </div>
                    <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase block mb-1">STEP {{ (int)$s['step'] }}</span>
                    <h3 class="text-xl font-serif text-slate-900 mb-2.5">{{ $s['title'] }}</h3>
                    <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">{{ $s['desc'] }}</p>
                </div>
                <div class="pt-4 border-t border-slate-100">
                    <ul class="grid grid-cols-2 gap-2 text-[11px] text-slate-700">
                        @foreach($s['items'] as $item)
                        <li class="flex items-center gap-1.5 font-medium truncate">
                            <span class="w-3.5 h-3.5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 text-[10px]">✓</span>
                            <span class="truncate">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        <div class="motion-reveal mt-14 p-8 rounded-[2rem] bg-white border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
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
<section class="py-16 bg-gradient-to-r from-indigo-900 via-indigo-800 to-slate-900 text-white text-center px-4">
    <div class="motion-reveal max-w-4xl mx-auto space-y-4">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif">
            Turn Your College Requirement into a <span class="text-indigo-300 italic">Career Advantage.</span>
        </h2>
        <p class="text-xs sm:text-sm text-indigo-100/90 font-light max-w-xl mx-auto">
            Join thousands of undergraduate learners from BA, BSc, BBA, BCA, and BCom. Start your practical internship journey today.
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
            <button onclick="openApplyModal()" class="motion-btn-spring px-8 py-3.5 rounded-full bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs uppercase tracking-wider transition shadow-xl cursor-pointer">
                Enroll in Upcoming Cohort
            </button>
            <a href="https://wa.me/916204141971" target="_blank" rel="noopener noreferrer" class="motion-btn-spring px-7 py-3.5 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-xl flex items-center gap-2">
                <span>WhatsApp Counselor</span>
            </a>
        </div>
    </div>
</section>
@endsection
