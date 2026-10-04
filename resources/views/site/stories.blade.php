@extends('layouts.app')

@section('title', 'Student Stories – Infinity Interns')

@section('content')
<!-- Hero -->
<section class="relative min-h-[45vh] flex items-center justify-center pt-24 pb-16 overflow-hidden bg-[#0A1128] text-white">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[500px] bg-indigo-500/15 rounded-full blur-[140px] motion-orb"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-indigo-400/30 bg-indigo-500/10 backdrop-blur-md mb-6 motion-hero-badge">
            <span class="text-indigo-400 text-xs">✦</span>
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Student Experiences</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6 motion-hero-title">
            Student Stories & <br>
            <span class="text-indigo-400 italic">Practical Transformations.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed motion-hero-sub">
            Read how undergraduate learners from BA, BSc, BBA, BCA, and BCom bridged the gap between theoretical classroom learning and verifiable workplace capabilities.
        </p>
    </div>
</section>

<!-- Stories Grid -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    @php
    $studentStories = [
        [
            'name' => 'Ritika Srivastava',
            'college' => 'Magadh Mahila College, Patna',
            'degree' => 'BA Political Science • 5th Semester',
            'title' => '“I finally understood how classroom concepts transform into public research.”',
            'quote' => 'Earlier, I thought internships were only meant for engineering students. Infinity Interns gave me a structured 6-week research project on rural education schemes in Bihar. The mentors taught me survey design and spreadsheet analysis. During my college external viva, my marksheet and report format were lauded by the examiners.',
            'outcomes' => ['Field Survey Design', 'Report Writing', 'Viva Score 92%'],
            'initials' => 'RS',
            'color' => 'text-indigo-700 bg-indigo-50 border-indigo-100',
        ],
        [
            'name' => 'Aditya Raj',
            'college' => 'Patna Science College, Patna University',
            'degree' => 'BSc Environmental Science • 6th Semester',
            'title' => '“Hands-on environmental impact assessments gave me real field confidence.”',
            'quote' => 'The hands-on data visualization modules and environmental audit templates gave me practical exposure that was completely missing in our theoretical syllabus. Having a certified marksheet and attendance log made college approval effortless.',
            'outcomes' => ['GIS Mapping Basics', 'EIA Compliance', 'Audit Documentation'],
            'initials' => 'AR',
            'color' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
        ],
        [
            'name' => 'Mohit Sharma',
            'college' => 'College of Commerce, Arts & Science, Patna',
            'degree' => 'BBA (Management) • 4th Semester',
            'title' => '“From memorizing business theory to building live pitch decks and financial models.”',
            'quote' => 'The finance track taught me how to read real corporate balance sheets, create cash flow projections, and understand GST filing fundamentals. The weekly live Q&A sessions cleared doubts that regular textbooks never addressed.',
            'outcomes' => ['Financial Modelling', 'Pitch Decks', 'Corporate Communication'],
            'initials' => 'MS',
            'color' => 'text-purple-700 bg-purple-50 border-purple-100',
        ],
        [
            'name' => 'Kavita Kumari',
            'college' => 'A.N. College, Patna',
            'degree' => 'BCA (Computer Applications) • 5th Semester',
            'title' => '“Built and deployed my first full-stack application with real databases.”',
            'quote' => 'The mentors pushed us to write clean code, use Git version control, and connect backend APIs. The capstone project was the main talking point during my job interviews, and the verified digital certificate made my resume stand out.',
            'outcomes' => ['Modern Web & APIs', 'SQL Queries', 'Live Deployment'],
            'initials' => 'KK',
            'color' => 'text-cyan-700 bg-cyan-50 border-cyan-100',
        ],
    ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 motion-stagger">
        @foreach($studentStories as $s)
        <article class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition flex flex-col justify-between motion-card-hover">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl font-serif font-bold text-base flex items-center justify-center border {{ $s['color'] }} shadow-xs">
                            {{ $s['initials'] }}
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 font-serif">{{ $s['name'] }}</h4>
                            <p class="text-[11px] text-slate-500">{{ $s['college'] }}</p>
                        </div>
                    </div>
                    <div class="text-amber-400 text-sm">★★★★★</div>
                </div>

                <span class="text-[10px] font-bold tracking-wider text-indigo-700 uppercase bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100 block w-fit mb-4">
                    {{ $s['degree'] }}
                </span>

                <h3 class="text-xl font-serif text-slate-900 mb-3 leading-snug">{{ $s['title'] }}</h3>
                <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">{{ $s['quote'] }}</p>
            </div>

            <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Outcomes:</span>
                @foreach($s['outcomes'] as $t)
                <span class="text-[11px] font-medium bg-[#F6F8F5] text-slate-700 px-3 py-1 rounded-full border border-slate-200">✓ {{ $t }}</span>
                @endforeach
            </div>
        </article>
        @endforeach
    </div>
</section>
@endsection
