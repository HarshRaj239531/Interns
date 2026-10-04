@extends('layouts.app')

@section('title', 'Certification & Verification – Infinity Interns')

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
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Authenticated Documentation</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6 motion-hero-title">
            UGC-Aligned Internship <br>
            <span class="text-indigo-400 italic">Certification & Records.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed motion-hero-sub">
            College degrees require accredited proof. Infinity Interns provides verified certificates, evaluated marksheets, report dossiers, and attendance logs tailored for university submissions.
        </p>
    </div>
</section>

<!-- Deep Dive on 4 Documents -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 motion-stagger">
        <!-- Certificate -->
        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition flex flex-col justify-between motion-card-hover">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-indigo-700 bg-indigo-50 border-indigo-100 text-2xl font-bold">
                        🎖️
                    </div>
                    <span class="text-[10px] font-bold tracking-wider uppercase bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">
                        VERIFIED CREDENTIAL
                    </span>
                </div>
                <span class="text-[10px] font-bold tracking-[0.2em] text-indigo-600 uppercase block mb-1">OFFICIAL COMPLETION DOCUMENT</span>
                <h3 class="text-2xl font-serif text-slate-900 mb-3">Internship Certificate</h3>
                <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                    Issued upon successful completion of curriculum modules, quizzes, and project evaluation. Includes unique verification serial, program dates, degree alignment, and issuing authority seal.
                </p>
            </div>
            <div class="pt-6 border-t border-slate-100 space-y-2 text-xs text-slate-700">
                <h4 class="font-bold text-slate-800 uppercase tracking-wider mb-2">Key Features & Security:</h4>
                <div class="flex items-center gap-2">✓ Tamper-proof digital QR code for university verification</div>
                <div class="flex items-center gap-2">✓ Specific mention of student name, degree, and semester</div>
                <div class="flex items-center gap-2">✓ Details of practical skills and domain specialization</div>
                <div class="flex items-center gap-2">✓ Accredited by Infinitya1 Career Counselling Pvt Ltd.</div>
            </div>
        </div>

        <!-- Marksheet -->
        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition flex flex-col justify-between motion-card-hover">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-emerald-700 bg-emerald-50 border-emerald-100 text-2xl font-bold">
                        📊
                    </div>
                    <span class="text-[10px] font-bold tracking-wider uppercase bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">
                        ACADEMIC RECORD
                    </span>
                </div>
                <span class="text-[10px] font-bold tracking-[0.2em] text-emerald-600 uppercase block mb-1">PERFORMANCE SCORECARD</span>
                <h3 class="text-2xl font-serif text-slate-900 mb-3">Detailed Marksheet</h3>
                <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                    A comprehensive evaluation breakdown covering module assignments, quiz scores, project evaluation, mentor ratings, and final percentage or grade point average.
                </p>
            </div>
            <div class="pt-6 border-t border-slate-100 space-y-2 text-xs text-slate-700">
                <h4 class="font-bold text-slate-800 uppercase tracking-wider mb-2">Key Features & Security:</h4>
                <div class="flex items-center gap-2">✓ Component-wise scoring (Theory, Practice, Capstone)</div>
                <div class="flex items-center gap-2">✓ Overall grade / percentage calculation (A+, A, B+)</div>
                <div class="flex items-center gap-2">✓ Mentor remarks on analytical and soft skills</div>
                <div class="flex items-center gap-2">✓ Directly submittable to college exam departments</div>
            </div>
        </div>

        <!-- Report Format -->
        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-purple-700 bg-purple-50 border-purple-100 text-2xl font-bold">
                        📁
                    </div>
                    <span class="text-[10px] font-bold tracking-wider uppercase bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">
                        STUDENT RESOURCE
                    </span>
                </div>
                <span class="text-[10px] font-bold tracking-[0.2em] text-purple-600 uppercase block mb-1">PROJECT DOSSIER</span>
                <h3 class="text-2xl font-serif text-slate-900 mb-3">Structured Report Format</h3>
                <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                    An organized, university-compliant internship report framework designed to document problem statements, methodology, activities, and project outcomes.
                </p>
            </div>
            <div class="pt-6 border-t border-slate-100 space-y-2 text-xs text-slate-700">
                <h4 class="font-bold text-slate-800 uppercase tracking-wider mb-2">Key Features:</h4>
                <div class="flex items-center gap-2">✓ Standard cover page and certificate incorporation page</div>
                <div class="flex items-center gap-2">✓ Structured chapters: Introduction, Methodology, Findings</div>
                <div class="flex items-center gap-2">✓ Guidelines for screenshots, references, and appendices</div>
                <div class="flex items-center gap-2">✓ Ready for print binding and college viva submission</div>
            </div>
        </div>

        <!-- Attendance Record -->
        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-cyan-700 bg-cyan-50 border-cyan-100 text-2xl font-bold">
                        ⏱️
                    </div>
                    <span class="text-[10px] font-bold tracking-wider uppercase bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">
                        COMPLIANCE AUDIT
                    </span>
                </div>
                <span class="text-[10px] font-bold tracking-[0.2em] text-cyan-600 uppercase block mb-1">PARTICIPATION RECORD</span>
                <h3 class="text-2xl font-serif text-slate-900 mb-3">Attendance & Session Log</h3>
                <p class="text-xs text-slate-600 font-light leading-relaxed mb-6">
                    Official record certifying that the student completed mandatory training hours, live session attendance, and milestone deadlines required by NEP-2020 guidelines.
                </p>
            </div>
            <div class="pt-6 border-t border-slate-100 space-y-2 text-xs text-slate-700">
                <h4 class="font-bold text-slate-800 uppercase tracking-wider mb-2">Key Features:</h4>
                <div class="flex items-center gap-2">✓ Total contact hours and self-paced study log</div>
                <div class="flex items-center gap-2">✓ Timestamped attendance of live mentor sessions</div>
                <div class="flex items-center gap-2">✓ Milestone submission timestamps</div>
                <div class="flex items-center gap-2">✓ Authorized signature and official seal</div>
            </div>
        </div>
    </div>

    <!-- NEP-2020 Compliance Advisory Box -->
    <div class="p-8 sm:p-12 rounded-[2.5rem] bg-[#F6F8F5] border border-slate-200/90 space-y-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-bold">UGC</div>
            <div>
                <h3 class="text-xl font-serif text-slate-900 font-bold">NEP-2020 & University Credit Transfer Guidelines</h3>
                <p class="text-xs text-slate-500">National Higher Education Qualifications Framework (NHEQF)</p>
            </div>
        </div>

        <p class="text-xs text-slate-600 font-light leading-relaxed">
            Under the National Education Policy (NEP) 2020, undergraduate degree programs require practical internships, community engagement, or industry projects carrying 2 to 4 academic credits. The documentation packet issued by Infinity Interns is structured to fulfill university internal assessment requirements, HOD sign-offs, and external viva audits.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
            <div class="p-4 rounded-2xl bg-white border border-slate-200">
                <span class="text-indigo-600 font-bold text-xs uppercase block mb-1">Duration</span>
                <p class="text-slate-800 font-semibold text-sm">60 to 120 Total Hours</p>
                <span class="text-[11px] text-slate-500">Flexible over 6 to 8 weeks</span>
            </div>
            <div class="p-4 rounded-2xl bg-white border border-slate-200">
                <span class="text-indigo-600 font-bold text-xs uppercase block mb-1">Academic Credits</span>
                <p class="text-slate-800 font-semibold text-sm">2 to 4 UGC Credits</p>
                <span class="text-[11px] text-slate-500">Subject to university policy</span>
            </div>
            <div class="p-4 rounded-2xl bg-white border border-slate-200">
                <span class="text-indigo-600 font-bold text-xs uppercase block mb-1">Authenticity</span>
                <p class="text-slate-800 font-semibold text-sm">100% Verifiable</p>
                <a href="{{ route('verify') }}" class="text-[11px] text-indigo-600 font-bold hover:underline">Verify with Code ↗</a>
            </div>
        </div>
    </div>
</section>
@endsection
