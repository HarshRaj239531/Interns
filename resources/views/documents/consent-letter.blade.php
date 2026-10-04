<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent & Institutional Undertaking Letter – {{ $user->name }} ({{ $profile->application_number }})</title>
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
            <span class="text-xs text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200 font-semibold flex items-center gap-1">
                <span>●</span> Instant Registration Document
            </span>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-lg shadow-indigo-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Official Consent Letter</span>
            </button>
        </div>
    </div>

    <!-- Document Container -->
    <div class="print-container max-w-4xl mx-auto bg-white p-10 sm:p-14 rounded-3xl shadow-xl border border-slate-200 space-y-8">
        
        <!-- Header Letterhead -->
        <div class="flex items-start justify-between pb-6 border-b-2 border-indigo-950">
            <div class="flex items-center gap-3">
                <img src="/infinity-interns-logo.png" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="font-serif font-bold text-2xl text-slate-900 tracking-wider uppercase">INFINITY INTERNS</h1>
                    <span class="text-[10px] text-indigo-700 font-bold uppercase tracking-widest block">UGC-Accredited Undergraduate Training Framework</span>
                    <span class="text-[9px] text-slate-500 block">Affiliated with Infinitya1 Career Counselling Pvt Ltd.</span>
                </div>
            </div>
            <div class="text-right text-[11px] text-slate-500 space-y-0.5">
                <p class="font-bold text-slate-800 uppercase tracking-wider text-[10px]">Academic Operations Desk</p>
                <p>NHEQF Level 5/6 Compliance</p>
                <p class="font-mono text-indigo-950 font-bold">DOC REF: INF/CL/2026/{{ substr($profile->application_number, -4) }}</p>
            </div>
        </div>

        <!-- Meta Line -->
        <div class="flex items-center justify-between text-xs text-slate-600">
            <div>
                <span class="font-bold text-slate-800">Application ID:</span>
                <span class="font-mono font-bold text-indigo-700">{{ $profile->application_number }}</span>
            </div>
            <div>
                <span class="font-bold text-slate-800">Date of Registration:</span>
                <span>{{ $profile->created_at ? $profile->created_at->format('F d, Y') : date('F d, Y') }}</span>
            </div>
        </div>

        <!-- Title -->
        <div class="text-center space-y-1">
            <h2 class="font-serif text-xl sm:text-2xl font-bold text-slate-900 tracking-wide uppercase">
                STUDENT UNDERTAKING & INSTITUTIONAL CONSENT LETTER
            </h2>
            <p class="text-xs text-slate-500 uppercase tracking-widest">For College Academic Bank of Credits (ABC) & UGC Internship Credit Transfer</p>
        </div>

        <!-- Candidate Profile Grid -->
        <div class="grid grid-cols-2 gap-4 p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200 text-xs">
            <div class="space-y-1.5">
                <div><span class="text-slate-400 font-medium">Candidate Name:</span> <strong class="text-slate-900 ml-1">{{ $user->name }}</strong></div>
                <div><span class="text-slate-400 font-medium">Contact Mobile:</span> <span class="font-mono ml-1">{{ $user->phone }}</span></div>
                <div><span class="text-slate-400 font-medium">Registered College:</span> <strong class="text-slate-900 ml-1">{{ $profile->college }}</strong></div>
                <div><span class="text-slate-400 font-medium">Degree & Semester:</span> <span class="text-slate-800 ml-1">{{ $profile->degree }} ({{ $profile->semester }})</span></div>
            </div>
            <div class="space-y-1.5">
                <div><span class="text-slate-400 font-medium">Enrolled Stream:</span> <strong class="text-indigo-950 ml-1">{{ $profile->program_domain }}</strong></div>
                <div><span class="text-slate-400 font-medium">Expected Contact Hours:</span> <span class="text-slate-800 ml-1">60 to 120 Hours (8 Weeks)</span></div>
                <div><span class="text-slate-400 font-medium">Academic Credits:</span> <span class="text-slate-800 ml-1">4.0 NHEQF Eligible Credits</span></div>
                <div><span class="text-slate-400 font-medium">Assigned Mentor:</span> <span class="text-emerald-700 font-semibold ml-1">{{ $profile->mentor_name }}</span></div>
            </div>
        </div>

        <!-- Declaration Clauses -->
        <div class="space-y-4 text-xs leading-relaxed text-slate-700 font-light">
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                <strong class="font-bold text-slate-900 uppercase tracking-wider block text-[11px]">Section A: Student Commitment & Code of Conduct</strong>
                <p>
                    I, <strong>{{ $user->name }}</strong>, an undergraduate student of <strong>{{ $profile->college }}</strong>, hereby confirm my voluntary enrollment in the <strong>{{ $profile->program_domain }}</strong> internship organized by <strong>Infinity Interns</strong>. I undertake to:
                </p>
                <ul class="list-disc list-inside space-y-1 text-slate-600 pl-2">
                    <li>Maintain a minimum cumulative attendance rate of <strong>75%</strong> across all synchronous learning modules and mentor clinics.</li>
                    <li>Independently research, build, and submit the domain Capstone Project report prior to final evaluation.</li>
                    <li>Uphold complete academic integrity, intellectual property ethics, and organizational confidentiality during the internship tenure.</li>
                </ul>
            </div>

            <div class="p-4 rounded-xl bg-indigo-50/50 border border-indigo-100 space-y-2">
                <strong class="font-bold text-indigo-950 uppercase tracking-wider block text-[11px]">Section B: College / Institutional Endorsement for Credit Transfer</strong>
                <p class="text-indigo-950/80">
                    This consent letter serves as formal notification to the Principal / Dean / Head of Department (HOD) of <strong>{{ $profile->college }}</strong> that the student is engaged in UGC-aligned practical training. Upon completion, official evaluation grade sheets and certificates will be directly dispatachable for inclusion in the student's Academic Bank of Credits (ABC) portal under NEP 2020 guidelines.
                </p>
            </div>
        </div>

        <!-- Signatures & Verification Block -->
        <div class="pt-8 border-t border-slate-200 grid grid-cols-3 items-end gap-4 text-center">
            
            <!-- Student Signature -->
            <div class="space-y-1">
                <div class="h-10 flex items-center justify-center font-serif text-slate-900 italic font-bold">
                    {{ $user->name }}
                </div>
                <div class="w-36 mx-auto border-t border-slate-300"></div>
                <p class="font-bold text-[11px] text-slate-900">Student Signature</p>
                <p class="text-[9px] text-slate-500">Date: {{ date('M d, Y') }}</p>
            </div>

            <!-- Official Seal -->
            <div class="flex flex-col items-center justify-center text-center space-y-1">
                <div class="w-20 h-20 rounded-full border-2 border-dashed border-indigo-400 flex flex-col items-center justify-center text-center p-2 text-indigo-800 bg-indigo-50/50">
                    <span class="text-[8px] font-bold uppercase tracking-wider">OFFICIAL</span>
                    <span class="text-xs font-serif font-black">✦ CONSENT ✦</span>
                    <span class="text-[7px] font-bold">NEP 2020</span>
                </div>
                <span class="text-[9px] font-mono text-slate-500">UGC-NEP-2026</span>
            </div>

            <!-- Authorized Directorate Signature -->
            <div class="space-y-1">
                <div class="h-10 flex items-center justify-center font-serif text-indigo-950 font-bold italic">
                    Dr. Alok Verma
                </div>
                <div class="w-36 mx-auto border-t border-slate-300"></div>
                <p class="font-bold text-[11px] text-slate-900">Director of Academic Affairs</p>
                <p class="text-[9px] text-slate-500">Infinity Interns Directorate</p>
            </div>

        </div>

    </div>

</body>
</html>
