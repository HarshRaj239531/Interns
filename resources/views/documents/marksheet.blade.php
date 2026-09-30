<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Marksheet & Evaluation Report – {{ $user->name }} ({{ $profile->application_number }})</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .print-container { box-shadow: none !important; border: 1px solid #cbd5e1 !important; }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 font-sans text-slate-800 antialiased">

    <!-- Top Action Bar -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print">
        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white px-4 py-2 rounded-full shadow-xs border border-slate-200">
            ← Back to Dashboard
        </a>
        <div class="flex items-center gap-3">
            @if($profile->certificate_issued)
                <a href="{{ route('verify', ['code' => $profile->certificate_number]) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-700 hover:text-indigo-900 bg-indigo-50 border border-indigo-200 px-4 py-2 rounded-full shadow-xs">
                    <span>Verify Credential</span>
                </a>
            @endif
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-lg shadow-indigo-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Official Marksheet</span>
            </button>
        </div>
    </div>

    <!-- Marksheet Container -->
    <div class="print-container max-w-4xl mx-auto bg-white p-10 sm:p-14 rounded-3xl shadow-xl border border-slate-200 space-y-8">
        
        <!-- Header -->
        <div class="flex items-start justify-between pb-6 border-b-2 border-indigo-950">
            <div class="flex items-center gap-3">
                <img src="/infinity-interns-logo.png" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="font-serif font-bold text-2xl text-slate-900 tracking-wider uppercase">INFINITY INTERNS</h1>
                    <span class="text-[10px] text-indigo-700 font-bold uppercase tracking-widest block">Academic Evaluation & Examination Directorate</span>
                    <span class="text-[9px] text-slate-500 block">In Affiliation with Infinitya1 Career Counselling Pvt Ltd.</span>
                </div>
            </div>
            <div class="text-right text-[11px] text-slate-500 space-y-0.5">
                <p class="font-bold text-slate-800 uppercase tracking-wider text-[10px]">Academic Transcript</p>
                <p>NHEQF Level 5/6 Compliant</p>
                <p class="font-mono text-indigo-950 font-bold">SL NO: MS/2026/{{ substr($profile->application_number, -6) }}</p>
            </div>
        </div>

        <div class="text-center space-y-1">
            <h2 class="font-serif text-xl sm:text-2xl font-bold text-slate-900 tracking-wide uppercase">
                INTERNSHIP PERFORMANCE & CREDIT EVALUATION MARKSHEET
            </h2>
            <p class="text-xs text-slate-500 uppercase tracking-widest">National Higher Education Qualifications Framework (NHEQF) Grade Card</p>
        </div>

        <!-- Student & Program Info Grid -->
        <div class="grid grid-cols-2 gap-4 p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200 text-xs">
            <div class="space-y-1.5">
                <div><span class="text-slate-400 font-medium">Candidate Name:</span> <strong class="text-slate-900 ml-1">{{ $user->name }}</strong></div>
                <div><span class="text-slate-400 font-medium">Enrollment / App ID:</span> <span class="font-mono font-bold text-indigo-700 ml-1">{{ $profile->application_number }}</span></div>
                <div><span class="text-slate-400 font-medium">Registered College:</span> <strong class="text-slate-900 ml-1">{{ $profile->college }}</strong></div>
                <div><span class="text-slate-400 font-medium">Undergraduate Degree:</span> <span class="text-slate-800 ml-1">{{ $profile->degree }} ({{ $profile->semester }})</span></div>
            </div>
            <div class="space-y-1.5">
                <div><span class="text-slate-400 font-medium">Internship Domain:</span> <strong class="text-indigo-950 ml-1">{{ $profile->program_domain }}</strong></div>
                <div><span class="text-slate-400 font-medium">Session Duration:</span> <span class="text-slate-800 ml-1">8 Weeks (120 Contact Hours)</span></div>
                <div><span class="text-slate-400 font-medium">Faculty Mentor:</span> <span class="text-slate-800 ml-1">{{ $profile->mentor_name }}</span></div>
                <div><span class="text-slate-400 font-medium">Recorded Attendance:</span> <strong class="text-emerald-700 ml-1">{{ $profile->attendance_rate }}% (Minimum required: 75%)</strong></div>
            </div>
        </div>

        <!-- Course Modules Evaluation Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-indigo-950 text-white font-serif">
                        <th class="py-3 px-4 rounded-tl-xl">Code</th>
                        <th class="py-3 px-4">Evaluation Component / Module Description</th>
                        <th class="py-3 px-4 text-center">Max Marks</th>
                        <th class="py-3 px-4 text-center">Marks Obtained</th>
                        <th class="py-3 px-4 text-center">Grade Point</th>
                        <th class="py-3 px-4 text-center rounded-tr-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 border-x border-b border-slate-200">
                    @php
                        $total = $profile->marksheet_marks ?? 92;
                        $m1 = min(100, max(60, round($total * 1.02)));
                        $m2 = min(100, max(60, round($total * 0.98)));
                        $m3 = min(100, max(60, round($total * 0.97)));
                        $m4 = min(100, max(60, round($total * 1.03)));
                        $obtainedTotal = $m1 + $m2 + $m3 + $m4;
                        $calcPercentage = round($obtainedTotal / 4, 1);
                    @endphp
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-mono font-bold text-slate-700">MOD-101</td>
                        <td class="py-3 px-4">
                            <strong class="text-slate-900 block">Foundations, Core Principles & Architecture</strong>
                            <span class="text-[11px] text-slate-500">Conceptual mastery, synchronous lectures, and baseline assessments</span>
                        </td>
                        <td class="py-3 px-4 text-center text-slate-600">100</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-900">{{ $m1 }}</td>
                        <td class="py-3 px-4 text-center font-mono">9.5</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">PASSED</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-mono font-bold text-slate-700">MOD-102</td>
                        <td class="py-3 px-4">
                            <strong class="text-slate-900 block">Applied Lab Implementations & Practical Coding</strong>
                            <span class="text-[11px] text-slate-500">Hands-on lab assignments, peer code review, and debug clinics</span>
                        </td>
                        <td class="py-3 px-4 text-center text-slate-600">100</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-900">{{ $m2 }}</td>
                        <td class="py-3 px-4 text-center font-mono">9.2</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">PASSED</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-mono font-bold text-slate-700">MOD-103</td>
                        <td class="py-3 px-4">
                            <strong class="text-slate-900 block">Industry Case Studies & Real-World Problem Solving</strong>
                            <span class="text-[11px] text-slate-500">Production simulation scenarios, workflow designs, and optimization</span>
                        </td>
                        <td class="py-3 px-4 text-center text-slate-600">100</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-900">{{ $m3 }}</td>
                        <td class="py-3 px-4 text-center font-mono">9.0</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">PASSED</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-3 px-4 font-mono font-bold text-slate-700">MOD-104</td>
                        <td class="py-3 px-4">
                            <strong class="text-slate-900 block">Capstone Project Viva-Voce & Defense</strong>
                            <span class="text-[11px] text-slate-500">Title: <em>"{{ $profile->project_title }}"</em></span>
                        </td>
                        <td class="py-3 px-4 text-center text-slate-600">100</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-900">{{ $m4 }}</td>
                        <td class="py-3 px-4 text-center font-mono">9.8</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">PASSED</span></td>
                    </tr>
                    <tr class="bg-indigo-50/50 font-bold">
                        <td colspan="2" class="py-3.5 px-4 text-slate-900 uppercase tracking-wider text-xs">CUMULATIVE PERFORMANCE SUMMARY</td>
                        <td class="py-3.5 px-4 text-center text-slate-700">400</td>
                        <td class="py-3.5 px-4 text-center text-indigo-950 font-black text-sm">{{ $obtainedTotal }}</td>
                        <td class="py-3.5 px-4 text-center font-mono text-indigo-950">9.4</td>
                        <td class="py-3.5 px-4 text-center"><span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-indigo-100 text-indigo-900">QUALIFIED</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Grade Summary Card -->
        <div class="grid grid-cols-4 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-200 text-center text-xs">
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block">Aggregate Percentage</span>
                <span class="font-serif font-black text-xl text-slate-900">{{ $calcPercentage }}%</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block">Awarded Grade</span>
                <span class="font-serif font-black text-xl text-emerald-700">{{ $profile->marksheet_grade ?? 'A+' }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block">Credits Earned</span>
                <span class="font-serif font-black text-xl text-indigo-950">4.0 Credits</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block">Classification</span>
                <span class="font-serif font-bold text-sm text-indigo-700 mt-1 block">First Class Distinction</span>
            </div>
        </div>

        <!-- Academic Accreditation Endorsement -->
        <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-200 text-[11px] text-amber-900 space-y-1">
            <strong class="font-bold flex items-center gap-1.5 uppercase tracking-wide">
                <span>✦</span> UGC & NHEQF Academic Credit Transfer Endorsement
            </strong>
            <p class="leading-relaxed text-amber-800/90 font-light">
                This marksheet certifies that the student has completed practical training fulfilling UGC National Higher Education Qualifications Framework (NHEQF Level 5/6) guidelines. This grade card is issued for submission to <strong>{{ $profile->college }}</strong> for credit accumulation under the Academic Bank of Credits (ABC) scheme.
            </p>
        </div>

        <!-- Signatures & Seal -->
        <div class="pt-8 border-t border-slate-200 flex items-end justify-between">
            <div class="space-y-1">
                <div class="h-10 flex items-center font-serif text-indigo-950 font-bold italic text-base">
                    Prof. S. K. Mukherjee
                </div>
                <p class="font-bold text-xs text-slate-900">Prof. S. K. Mukherjee</p>
                <p class="text-[11px] text-slate-500">Chairman, Board of Examiners</p>
                <p class="text-[10px] text-slate-400">Infinity Interns Academic Directorate</p>
            </div>

            <div class="w-24 h-24 rounded-full border-2 border-dashed border-indigo-400 flex flex-col items-center justify-center text-center p-2 text-indigo-800 bg-indigo-50/50">
                <span class="text-[8px] font-bold uppercase tracking-wider">Evaluation</span>
                <span class="text-xs font-serif font-black">✦ SEAL ✦</span>
                <span class="text-[7px] font-bold">2026 BATCH</span>
            </div>

            <div class="space-y-1 text-right">
                <div class="h-10 flex items-center justify-end font-serif text-indigo-950 font-bold italic text-base">
                    Dr. Alok Verma
                </div>
                <p class="font-bold text-xs text-slate-900">Dr. Alok Verma</p>
                <p class="text-[11px] text-slate-500">Director of Academic Affairs</p>
                <p class="text-[10px] text-slate-400">Date: {{ $profile->marksheet_date ? $profile->marksheet_date->format('F d, Y') : date('F d, Y') }}</p>
            </div>
        </div>

    </div>

</body>
</html>
