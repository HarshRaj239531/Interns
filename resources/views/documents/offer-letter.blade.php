<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Letter – {{ $user->name }} ({{ $profile->application_number }})</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .print-container { box-shadow: none !important; border: none !important; }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 font-sans text-slate-800 antialiased">

    <!-- Top Action Bar -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print">
        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white px-4 py-2 rounded-full shadow-xs border border-slate-200">
            ← Back to Dashboard
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-lg shadow-indigo-600/30 transition cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Print Official Letter</span>
        </button>
    </div>

    <!-- Letter Container -->
    <div class="print-container max-w-4xl mx-auto bg-white p-10 sm:p-14 rounded-3xl shadow-xl border border-slate-200 space-y-8">
        <!-- Letterhead Header -->
        <div class="flex items-start justify-between pb-6 border-b-2 border-indigo-900">
            <div class="flex items-center gap-3">
                <img src="/infinity-interns-logo.png" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="font-serif font-bold text-2xl text-slate-900 tracking-wider uppercase">INFINITY INTERNS</h1>
                    <span class="text-[10px] text-indigo-700 font-bold uppercase tracking-widest block">UGC-Accredited Internship Programs</span>
                    <span class="text-[9px] text-slate-500 block">A Unit of Infinitya1 Career Counselling Pvt Ltd.</span>
                </div>
            </div>
            <div class="text-right text-[11px] text-slate-500 space-y-0.5">
                <p class="font-semibold text-slate-800">Operational Directorate</p>
                <p>Bhub Patna, Bihar, India – 800001</p>
                <p>Email: info@infinityinterns.com</p>
                <p>Website: www.infinityinterns.com</p>
            </div>
        </div>

        <!-- Meta Line -->
        <div class="flex items-center justify-between text-xs text-slate-600">
            <div>
                <span class="font-bold text-slate-800">Ref No:</span>
                <span class="font-mono">INF/OL/2026/{{ substr($profile->application_number, -4) }}</span>
            </div>
            <div>
                <span class="font-bold text-slate-800">Date of Dispatch:</span>
                <span>{{ $profile->offer_letter_date ? $profile->offer_letter_date->format('F d, Y') : date('F d, Y') }}</span>
            </div>
        </div>

        <!-- Addressee -->
        <div class="text-xs space-y-1 text-slate-700">
            <p class="font-bold text-slate-900 text-sm">To,</p>
            <p class="font-bold text-slate-900">{{ $user->name }}</p>
            <p>Degree: {{ $profile->degree }} ({{ $profile->semester }})</p>
            <p>College / Institution: {{ $profile->college }}</p>
            <p>Application ID: <span class="font-mono font-bold text-indigo-700">{{ $profile->application_number }}</span></p>
        </div>

        <!-- Subject -->
        <div class="p-3 bg-[#FAFBF9] rounded-xl border border-slate-200 text-xs font-bold text-indigo-900">
            SUBJECT: OFFICIAL OFFER & ACCEPTANCE LETTER FOR UNDERGRADUATE UGC INTERNSHIP PROGRAM – BATCH 2026
        </div>

        <!-- Body -->
        <div class="space-y-4 text-xs leading-relaxed text-slate-700 font-light">
            <p>Dear <strong>{{ $user->name }}</strong>,</p>

            <p>
                Following the evaluation of your undergraduate academic profile, we are delighted to formally offer you an internship appointment under the <strong>{{ $profile->program_domain }}</strong> track with <strong>Infinity Interns</strong> (A Unit of Infinitya1 Career Counselling Pvt Ltd.).
            </p>

            <p>
                This internship program is structured in full compliance with the National Education Policy (NEP) 2020 and University Grants Commission (UGC) National Higher Education Qualifications Framework (NHEQF), designed to fulfill 2 to 4 academic credits required for your <strong>{{ $profile->degree }}</strong> degree at <strong>{{ $profile->college }}</strong>.
            </p>

            <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200 space-y-2 text-xs">
                <span class="font-bold text-slate-900 uppercase tracking-wider block">Key Terms of Internship:</span>
                <div class="grid grid-cols-2 gap-2 text-slate-800">
                    <div>• <strong>Assigned Track:</strong> {{ $profile->program_domain }}</div>
                    <div>• <strong>Duration:</strong> 6 to 8 Weeks (60 to 120 Contact Hours)</div>
                    <div>• <strong>Mode of Delivery:</strong> Hybrid (Self-paced + Live Mentor Clinics)</div>
                    <div>• <strong>Faculty Advisor:</strong> {{ $profile->mentor_name }}</div>
                </div>
            </div>

            <p>
                During your internship, you will be expected to complete all scheduled learning modules, participate in live mentor workshops, maintain a minimum attendance rate of 75%, and submit a domain capstone project. Upon successful completion and evaluation, you will be awarded an authenticated <strong>Internship Completion Certificate</strong> and <strong>Detailed Academic Marksheet</strong>.
            </p>

            <p>
                We congratulate you on your selection and wish you a rewarding, intellectually stimulating internship journey.
            </p>
        </div>

        <!-- Signatures & Official Stamp -->
        <div class="pt-8 border-t border-slate-200 flex items-end justify-between">
            <div class="space-y-1">
                <div class="h-12 flex items-center font-serif text-indigo-900 font-bold italic text-lg">
                    Dr. Alok Verma
                </div>
                <p class="font-bold text-xs text-slate-900">Dr. Alok Verma</p>
                <p class="text-[11px] text-slate-500">Director of Academic Affairs & Training</p>
                <p class="text-[10px] text-slate-400">Infinitya1 Career Counselling Pvt Ltd.</p>
            </div>

            <div class="w-24 h-24 rounded-full border-2 border-dashed border-indigo-300 flex flex-col items-center justify-center text-center p-2 text-indigo-700 bg-indigo-50/40">
                <span class="text-[9px] font-bold uppercase tracking-wider">Official Seal</span>
                <span class="text-xs">✦ 2026 ✦</span>
                <span class="text-[8px] font-bold">Infinity Interns</span>
            </div>
        </div>
    </div>
</body>
</html>
