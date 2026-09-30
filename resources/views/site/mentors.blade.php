@extends('layouts.app')

@section('title', 'Faculty & Mentors – Infinity Interns')

@section('content')
<!-- Hero -->
<section class="relative min-h-[45vh] flex items-center justify-center pt-24 pb-16 overflow-hidden bg-[#0A1128] text-white">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[500px] bg-indigo-500/15 rounded-full blur-[140px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-indigo-400/30 bg-indigo-500/10 backdrop-blur-md mb-6">
            <span class="text-indigo-400 text-xs">✦</span>
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Guidance & Instruction</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6">
            Learn with Guidance, <br>
            <span class="text-indigo-400 italic">Not in Isolation.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed">
            Behind every successful internship is experienced guidance. Our faculty and industry mentors ensure you navigate practical tasks with confidence, clarity, and constructive feedback.
        </p>
    </div>
</section>

<!-- Mentorship Pillars -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-xl">💬</div>
            <h3 class="text-2xl font-serif text-slate-900">Weekly Interactive Q&A</h3>
            <p class="text-xs text-slate-600 font-light leading-relaxed">
                Scheduled live doubt-clearing sessions where students can directly ask questions, share screen difficulties, and discuss assignment solutions in real time.
            </p>
        </div>

        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl">📝</div>
            <h3 class="text-2xl font-serif text-slate-900">Constructive Project Reviews</h3>
            <p class="text-xs text-slate-600 font-light leading-relaxed">
                Every milestone submission is evaluated with actionable suggestions, ensuring your project meets both university standards and prospective employer expectations.
            </p>
        </div>

        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center text-xl">🎓</div>
            <h3 class="text-2xl font-serif text-slate-900">Academic Viva Preparation</h3>
            <p class="text-xs text-slate-600 font-light leading-relaxed">
                Mock interview questions and presentation coaching designed to help students articulate their learnings confidently during college internal and external vivas.
            </p>
        </div>
    </div>

    <!-- Mentors Cards -->
    <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase mb-3 block">Advisory Council</span>
        <h2 class="text-3xl sm:text-4xl font-serif text-slate-900 leading-tight">Academic & Industry Mentors</h2>
        <p class="text-slate-600 text-sm font-light mt-2">Educators and industry veterans committed to making higher education practical.</p>
    </div>

    @php
    $advisors = [
        ['name' => 'Dr. Alok Verma', 'role' => 'Head of Academic Affairs & NEP Frameworks', 'desc' => 'Former Professor & Higher Ed Consultant with 18+ years mentoring university curricula across Bihar & UP.', 'skills' => ['Curriculum Mapping', 'UGC Compliance', 'Educational Research'], 'initials' => 'AV'],
        ['name' => 'Priyanka Sen', 'role' => 'Lead Mentor – Digital & Web Technologies', 'desc' => 'Senior Frontend Architect and technical writer specializing in modern web ecosystems and accessible UX.', 'skills' => ['Full-Stack Web', 'JavaScript / API', 'Cloud Architecture'], 'initials' => 'PS'],
        ['name' => 'Rajeshwar Kumar', 'role' => 'Lead Mentor – Social Sciences & Policy', 'desc' => 'Policy Analyst & Public Administration Specialist active in regional developmental research and survey projects.', 'skills' => ['Policy Evaluation', 'Survey Design', 'Governance Analysis'], 'initials' => 'RK'],
        ['name' => 'Ananya Roy, CFA', 'role' => 'Lead Mentor – Finance & Business Operations', 'desc' => 'Corporate Financial Analyst with extensive advisory experience in MSME growth, unit economics, and startup forecasting.', 'skills' => ['Financial Modelling', 'Startup Operations', 'Corporate Auditing'], 'initials' => 'AR'],
    ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($advisors as $adv)
        <div class="p-8 rounded-[2.2rem] bg-white border border-slate-200/80 shadow-xs hover:shadow-xl transition flex flex-col justify-between">
            <div>
                <div class="w-14 h-14 rounded-2xl bg-[#F6F8F5] border border-slate-200 text-indigo-700 font-serif font-bold text-xl flex items-center justify-center mb-6 shadow-xs">
                    {{ $adv['initials'] }}
                </div>
                <h3 class="text-xl font-serif text-slate-900 mb-1">{{ $adv['name'] }}</h3>
                <p class="text-xs text-indigo-600 font-semibold mb-3">{{ $adv['role'] }}</p>
                <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">{{ $adv['desc'] }}</p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-1.5">
                @foreach($adv['skills'] as $sk)
                <span class="text-[10px] font-medium bg-slate-50 text-slate-700 px-2.5 py-1 rounded-full border border-slate-200">{{ $sk }}</span>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
