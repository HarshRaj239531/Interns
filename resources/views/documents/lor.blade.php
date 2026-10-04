<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter of Recommendation (LOR) – {{ $user->name }} ({{ $profile->lor_number ?? 'LOR' }})</title>
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
            <span class="text-xs text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200 font-semibold flex items-center gap-1">
                <span>✦</span> Verified Academic Credential
            </span>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-lg shadow-indigo-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Official LOR</span>
            </button>
        </div>
    </div>

    <!-- Letter Container -->
    <div class="print-container max-w-4xl mx-auto bg-white p-10 sm:p-14 rounded-3xl shadow-xl border border-slate-200 space-y-8">
        
        <!-- Header Letterhead -->
        <div class="flex items-start justify-between pb-6 border-b-2 border-indigo-950">
            <div class="flex items-center gap-3">
                <img src="/infinity-interns-logo.png" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="font-serif font-bold text-2xl text-slate-900 tracking-wider uppercase">INFINITY INTERNS</h1>
                    <span class="text-[10px] text-indigo-700 font-bold uppercase tracking-widest block">Academic Evaluation & Faculty Advisory Board</span>
                    <span class="text-[9px] text-slate-500 block">Affiliated with Infinitya1 Career Counselling Pvt Ltd.</span>
                </div>
            </div>
            <div class="text-right text-[11px] text-slate-500 space-y-0.5">
                <p class="font-bold text-slate-800 uppercase tracking-wider text-[10px]">Academic Endorsement Directorate</p>
                <p>NHEQF Level 5/6 Certification Framework</p>
                <p class="font-mono text-indigo-950 font-bold">LOR REF: {{ $profile->lor_number ?? 'INF-LOR-2026-' . substr($profile->application_number, -4) }}</p>
            </div>
        </div>

        <!-- Meta Line -->
        <div class="flex items-center justify-between text-xs text-slate-600">
            <div>
                <span class="font-bold text-slate-800">Candidate Enrollment:</span>
                <span class="font-mono font-bold text-indigo-700">{{ $profile->application_number }}</span>
            </div>
            <div>
                <span class="font-bold text-slate-800">Date of Recommendation:</span>
                <span>{{ $profile->lor_date ? $profile->lor_date->format('F d, Y') : date('F d, Y') }}</span>
            </div>
        </div>

        <!-- Addressee -->
        <div class="text-xs space-y-1 text-slate-700">
            <p class="font-bold text-slate-900 text-sm">To,</p>
            <p class="font-bold text-slate-900">The Admissions Committee / Hiring Directorate</p>
            <p class="text-slate-500">Subject: Letter of Recommendation for Higher Studies / Employment</p>
        </div>

        <!-- Subject Badge -->
        <div class="p-3 bg-[#FAFBF9] rounded-xl border border-slate-200 text-xs font-bold text-indigo-900 uppercase">
            CONFIDENTIAL LETTER OF RECOMMENDATION & ACADEMIC MERIT ENDORSEMENT
        </div>

        <!-- Body -->
        <div class="space-y-4 text-xs leading-relaxed text-slate-700 font-light">
            <p>Dear Committee Members,</p>

            <p>
                It is my profound privilege to write this formal Letter of Recommendation for <strong>{{ $user->name }}</strong>, an undergraduate scholar from <strong>{{ $profile->college }}</strong> pursuing <strong>{{ $profile->degree }} ({{ $profile->semester }})</strong>, who has completed an intensive 8-week professional experiential internship under the <strong>{{ $profile->program_domain }}</strong> specialization track with <strong>Infinity Interns</strong>.
            </p>

            <p>
                During the internship tenure, {{ $user->name }} exhibited exemplary commitment, recording a remarkable attendance rate of <strong>{{ $profile->attendance_rate }}%</strong> across interactive mentor clinics, live system architecture reviews, and rigorous domain assessments. The candidate demonstrated keen analytical reasoning, proactive intellectual curiosity, and high collaborative ethics.
            </p>

            <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200 space-y-2">
                <span class="font-bold text-slate-900 uppercase tracking-wider block text-[11px]">Faculty & Mentor Assessment:</span>
                <p class="italic text-slate-800 font-normal">
                    "{{ $profile->lor_remarks ?? 'The candidate demonstrated remarkable proficiency, proactive problem solving, and architectural clarity in their domain projects. Their dedication to software craft and industry workflows is commendable.' }}"
                </p>
                <div class="pt-2 text-[11px] text-slate-600">
                    <strong>Capstone Research Defense:</strong> <em>"{{ $profile->project_title }}"</em> (Evaluation Score: <strong>{{ $profile->marksheet_marks ?? 92 }}%</strong> • Grade: <strong>{{ $profile->marksheet_grade ?? 'A+' }}</strong>)
                </div>
            </div>

            <p>
                {{ $user->name }} has substantiated both theoretical grounding and hands-on applied mastery, meeting all standards prescribed by the University Grants Commission (UGC) and National Higher Education Qualifications Framework (NHEQF).
            </p>

            <p>
                I recommend <strong>{{ $user->name }}</strong> with the highest conviction for upcoming graduate admissions, corporate fellowships, and professional engineering or management roles. I am confident they will prove to be an invaluable asset to any prospective team or academic department.
            </p>
        </div>

        <!-- Signatures & Official Stamp -->
        <div class="pt-8 border-t border-slate-200 grid grid-cols-3 items-end gap-4">
            
            <!-- Chief Academic Director -->
            <div class="space-y-1">
                <div class="h-10 flex items-center font-serif text-indigo-950 font-bold italic text-base">
                    Dr. Alok Verma
                </div>
                <div class="w-36 border-t border-slate-400"></div>
                <p class="font-bold text-[11px] text-slate-900">Dr. Alok Verma</p>
                <p class="text-[9px] text-slate-500">Director of Academic Affairs</p>
                <p class="text-[8px] text-slate-400">Infinitya1 Career Counselling Pvt Ltd.</p>
            </div>

            <!-- Official Seal -->
            <div class="flex flex-col items-center justify-center text-center space-y-1">
                <div class="w-20 h-20 rounded-full border-4 border-double border-indigo-400 bg-indigo-50/70 flex flex-col items-center justify-center text-indigo-800 shadow-inner">
                    <span class="text-[7px] font-black uppercase tracking-wider">OFFICIAL</span>
                    <span class="text-xs font-serif font-black">✦ LOR ✦</span>
                    <span class="text-[6px] font-bold">MERIT SEAL</span>
                </div>
                <span class="text-[9px] font-mono text-slate-500">{{ $profile->lor_number ?? 'INF-LOR-2026' }}</span>
            </div>

            <!-- Faculty Lead -->
            <div class="space-y-1 text-right">
                <div class="h-10 flex items-center justify-end font-serif text-indigo-950 font-bold italic text-base">
                    {{ $profile->mentor_name }}
                </div>
                <div class="w-36 ml-auto border-t border-slate-400"></div>
                <p class="font-bold text-[11px] text-slate-900">{{ $profile->mentor_name }}</p>
                <p class="text-[9px] text-slate-500">Lead Domain Advisor & Evaluator</p>
                <p class="text-[8px] text-slate-400">Infinity Interns Directorate</p>
            </div>

        </div>

    </div>

</body>
</html>
