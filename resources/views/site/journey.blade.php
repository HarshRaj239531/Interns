@extends('layouts.app')

@section('title', 'Internship Journey – Infinity Interns')

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
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Step-by-Step Pathway</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6">
            The Internship Journey <br>
            <span class="text-indigo-400 italic">from Day 1 to Certification.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed">
            A transparent, predictable process combining organized self-paced modules, interactive mentor webinars, practical project milestones, and UGC document dispatch.
        </p>
    </div>
</section>

<!-- 6 Stages Deep Dive -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto space-y-12">
    @php
    $stages = [
        [
            'num' => '01',
            'phase' => 'STAGE 1: REGISTRATION',
            'title' => 'Digital Profile & Stream Selection',
            'duration' => 'Takes 2 Minutes',
            'desc' => 'Submit your official student profile detailing your undergraduate university, degree stream (BA/BSc/BBA/BCA/BCom), current semester, and practical interest areas.',
            'items' => ['Instant confirmation receipt', 'Stream & batch mapping', 'Academic advisor assignment', 'Digital enrollment ID'],
            'tip' => 'Ensure your college name matches university records for seamless institutional verification.',
        ],
        [
            'num' => '02',
            'phase' => 'STAGE 2: ONBOARDING',
            'title' => 'Curriculum Access & Student Orientation',
            'duration' => 'Day 1 to 3',
            'desc' => 'Receive credentials to access your subject curriculum, orientation deck, schedule of live sessions, syllabus guide, and task templates.',
            'items' => ['Learning repository credentials', 'Session schedule & syllabus guide', 'Task workbook & project brief', 'Mentor chat channel access'],
            'tip' => 'Attend the inaugural welcome webinar to understand grading benchmarks and project deadlines.',
        ],
        [
            'num' => '03',
            'phase' => 'STAGE 3: ACTIVE LEARNING',
            'title' => 'Structured Skill Development & Exercises',
            'duration' => 'Weeks 1 to 4',
            'desc' => 'Follow modular concept explanations, case studies, hands-on activities, and weekly guided problem-solving assignments designed around real industry demands.',
            'items' => ['Weekly practical assignments', 'Self-paced concept modules', 'Skill assessments & quizzes', 'Interim progress check-ins'],
            'tip' => 'Spend 4-6 hours weekly to keep pace with practical activities without disrupting college classes.',
        ],
        [
            'num' => '04',
            'phase' => 'STAGE 4: INTERACTION',
            'title' => 'Live Mentorship, Reviews & Doubt Clearing',
            'duration' => 'Weekly Live Sessions',
            'desc' => 'Connect directly with subject experts and senior practitioners in scheduled live interactive workshops to clarify doubts, review code/reports, and get constructive feedback.',
            'items' => ['Live Q&A masterclasses', '1-on-1 project guidance clinics', 'Resume & interview habit coaching', 'Peer discussion forums'],
            'tip' => 'Prepare your questions in advance to make the most of live interactive mentor hours.',
        ],
        [
            'num' => '05',
            'phase' => 'STAGE 5: PROJECT & EVALUATION',
            'title' => 'Capstone Project Work & Final Assessment',
            'duration' => 'Weeks 5 to 7',
            'desc' => 'Apply your accumulated skills to create a comprehensive capstone project or case report. Undergo performance-based evaluation and grading review.',
            'items' => ['Capstone project submission', 'Plagiarism & originality review', 'Comprehensive performance evaluation', 'Internal marksheet grading'],
            'tip' => 'The capstone project serves as a cornerstone for both your college submission and portfolio.',
        ],
        [
            'num' => '06',
            'phase' => 'STAGE 6: CERTIFICATION',
            'title' => 'Receive UGC-Compliant Documents & Verification',
            'duration' => 'Completion Stage',
            'desc' => 'Upon fulfilling internship criteria, receive your authenticated completion packet including verified Certificate, Detailed Marksheet, Internship Report, and Attendance Log.',
            'items' => ['Authenticated Internship Certificate', 'Detailed Subject Marksheet', 'Structured Project Report Format', 'Official Attendance Record Log'],
            'tip' => 'Each certificate includes a tamper-proof verification ID for university audit verification.',
        ],
    ];
    @endphp

    @foreach($stages as $stage)
    <div class="p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-4">
                <span class="font-serif text-6xl sm:text-7xl font-extrabold text-indigo-700/80 block mb-2">{{ $stage['num'] }}</span>
                <span class="text-[10px] font-bold tracking-[0.2em] text-indigo-600 uppercase block mb-1">{{ $stage['phase'] }}</span>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-50 text-indigo-800 border border-indigo-100 inline-block mb-4">{{ $stage['duration'] }}</span>
            </div>
            <div class="lg:col-span-8 space-y-5">
                <h3 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">{{ $stage['title'] }}</h3>
                <p class="text-sm text-slate-600 font-light leading-relaxed">{{ $stage['desc'] }}</p>

                <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-3">
                    <h4 class="text-xs font-bold text-slate-800 tracking-wider uppercase">What You Complete in This Stage:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-700">
                        @foreach($stage['items'] as $item)
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 text-xs font-bold">✓</span>
                            <span>{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <p class="text-xs text-indigo-700 bg-indigo-50/70 px-4 py-2.5 rounded-xl border border-indigo-100 font-medium">
                    💡 <span class="font-bold">Student Tip:</span> {{ $stage['tip'] }}
                </p>
            </div>
        </div>
    </div>
    @endforeach

    <div class="p-10 rounded-[2.5rem] bg-indigo-900 text-white text-center space-y-4">
        <h3 class="text-2xl sm:text-3xl font-serif font-bold">Ready to take Step 01?</h3>
        <p class="text-xs sm:text-sm text-indigo-100/90 max-w-lg mx-auto">Registration takes less than 2 minutes and unlocks immediate student orientation instructions.</p>
        <button onclick="openApplyModal()" class="px-8 py-3.5 rounded-full bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs uppercase tracking-wider shadow-lg transition cursor-pointer">
            Start Your Journey Now
        </button>
    </div>
</section>
@endsection
