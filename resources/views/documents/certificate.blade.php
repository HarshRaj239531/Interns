<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Completion Certificate – {{ $user->name }} ({{ $profile->certificate_number ?? 'CERT' }})</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .print-certificate { box-shadow: none !important; border: 4px solid #1e1b4b !important; }
            @page {
                size: landscape;
                margin: 0.5cm;
            }
        }
        .cert-border-outer {
            border: 8px solid #1e1b4b;
        }
        .cert-border-inner {
            border: 2px solid #ca8a04;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 font-sans text-slate-800 antialiased flex flex-col items-center justify-center">

    <!-- Top Action Bar -->
    <div class="w-full max-w-5xl mx-auto mb-6 flex items-center justify-between no-print">
        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white px-4 py-2 rounded-full shadow-xs border border-slate-200">
            ← Back to Dashboard
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('verify', ['code' => $profile->certificate_number]) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-700 hover:text-indigo-900 bg-indigo-50 border border-indigo-200 px-4 py-2 rounded-full shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Live Verification URL</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-lg shadow-indigo-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Official Certificate</span>
            </button>
        </div>
    </div>

    <!-- Certificate Container (Landscape Formal Document) -->
    <div class="print-certificate w-full max-w-5xl bg-[#FCFBF7] rounded-2xl shadow-2xl cert-border-outer p-3 relative overflow-hidden">
        <div class="cert-border-inner p-8 sm:p-12 relative flex flex-col justify-between min-h-[640px] bg-radial from-amber-50/20 via-transparent to-transparent">
            
            <!-- Corner Accents -->
            <div class="absolute top-2 left-2 text-amber-600 font-serif text-lg leading-none select-none">❖</div>
            <div class="absolute top-2 right-2 text-amber-600 font-serif text-lg leading-none select-none">❖</div>
            <div class="absolute bottom-2 left-2 text-amber-600 font-serif text-lg leading-none select-none">❖</div>
            <div class="absolute bottom-2 right-2 text-amber-600 font-serif text-lg leading-none select-none">❖</div>

            <!-- Top Header -->
            <div class="text-center space-y-2 pb-6 border-b border-amber-900/10 relative">
                <div class="flex items-center justify-center gap-3">
                    <img src="/infinity-interns-logo.png" alt="Logo" class="h-12 w-auto">
                    <div class="text-left">
                        <span class="font-serif font-black text-2xl text-slate-900 tracking-wider uppercase block">INFINITY INTERNS</span>
                        <span class="text-[9px] text-indigo-800 font-bold uppercase tracking-[0.25em] block">UGC-Accredited Undergraduate Training Framework</span>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100/60 rounded-full border border-amber-300 text-[10px] font-semibold text-amber-900 tracking-wider uppercase">
                    <span>NEP 2020 Compliant</span>
                    <span>•</span>
                    <span>NHEQF Credit Framework</span>
                    <span>•</span>
                    <span>ISO 9001:2015 Certified Partner</span>
                </div>
            </div>

            <!-- Certificate Title -->
            <div class="text-center my-6">
                <h1 class="font-serif text-3xl sm:text-4xl text-indigo-950 font-bold tracking-wide uppercase">
                    Certificate of Internship Completion
                </h1>
                <p class="text-xs text-slate-500 uppercase tracking-widest mt-1">This is proudly and formally awarded to</p>
            </div>

            <!-- Recipient Name -->
            <div class="text-center my-2">
                <div class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 border-b-2 border-amber-600 inline-block px-10 pb-2">
                    {{ $user->name }}
                </div>
                <p class="text-xs text-slate-600 font-medium mt-2">
                    of <strong class="text-slate-900">{{ $profile->college }}</strong> ({{ $profile->degree }}, {{ $profile->semester }})
                </p>
            </div>

            <!-- Citation Body -->
            <div class="max-w-3xl mx-auto text-center text-xs leading-relaxed text-slate-700 font-light my-4">
                <p>
                    for successfully completing the rigorous 8-week university-accredited experiential internship in
                    <strong class="font-semibold text-indigo-950 text-sm block my-1 uppercase tracking-wide">{{ $profile->program_domain }}</strong>
                    demonstrating an attendance rate of <strong class="text-slate-900 font-bold">{{ $profile->attendance_rate }}%</strong>, fulfilling all structured theoretical modules and hands-on lab evaluations, and satisfactorily defending the capstone project report titled
                    <em class="font-medium text-slate-800">"{{ $profile->project_title }}"</em>.
                </p>
            </div>

            <!-- Performance Ribbon & Details -->
            <div class="flex items-center justify-center gap-8 py-3 my-2 text-xs border-y border-amber-900/10">
                <div class="text-center">
                    <span class="text-[9px] uppercase tracking-wider text-slate-400 block font-bold">Grade Conferred</span>
                    <span class="font-bold text-base text-emerald-700">{{ $profile->marksheet_grade ?? 'A+' }}</span>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="text-center">
                    <span class="text-[9px] uppercase tracking-wider text-slate-400 block font-bold">Evaluation Score</span>
                    <span class="font-bold text-base text-indigo-950">{{ $profile->marksheet_marks ?? 92 }}%</span>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="text-center">
                    <span class="text-[9px] uppercase tracking-wider text-slate-400 block font-bold">Earned Credits</span>
                    <span class="font-bold text-base text-indigo-950">4.0 Credits</span>
                </div>
            </div>

            <!-- Signatures, QR Code & Official Seal -->
            <div class="pt-6 grid grid-cols-3 items-end justify-between gap-4">
                
                <!-- Signatory 1 -->
                <div class="text-center space-y-1">
                    <div class="h-10 flex items-center justify-center font-serif text-indigo-950 font-bold italic text-base">
                        Dr. Alok Verma
                    </div>
                    <div class="w-36 mx-auto border-t border-slate-400"></div>
                    <p class="font-bold text-[11px] text-slate-900">Dr. Alok Verma</p>
                    <p class="text-[9px] text-slate-500">Director of Academic Affairs</p>
                    <p class="text-[8px] text-slate-400">Infinitya1 Career Counselling Pvt Ltd.</p>
                </div>

                <!-- Center Seal & QR Block -->
                <div class="flex flex-col items-center justify-center text-center space-y-2">
                    <div class="w-20 h-20 rounded-full border-4 border-double border-amber-500 bg-amber-50/70 flex flex-col items-center justify-center shadow-inner relative">
                        <div class="w-16 h-16 rounded-full border border-amber-400 flex flex-col items-center justify-center text-amber-800">
                            <span class="text-[7px] font-black uppercase tracking-wider">OFFICIAL</span>
                            <span class="text-xs font-serif font-black">✦ SEAL ✦</span>
                            <span class="text-[6px] font-bold">UGC COMPLIANT</span>
                        </div>
                    </div>
                    <div class="text-[9px] font-mono text-slate-600">
                        Certificate ID: <strong class="text-indigo-950">{{ $profile->certificate_number }}</strong>
                    </div>
                    <div class="text-[9px] text-slate-500">
                        Date: {{ $profile->certificate_date ? $profile->certificate_date->format('F d, Y') : date('F d, Y') }}
                    </div>
                </div>

                <!-- Signatory 2 -->
                <div class="text-center space-y-1">
                    <div class="h-10 flex items-center justify-center font-serif text-indigo-950 font-bold italic text-base">
                        Prof. S. K. Mukherjee
                    </div>
                    <div class="w-36 mx-auto border-t border-slate-400"></div>
                    <p class="font-bold text-[11px] text-slate-900">Prof. S. K. Mukherjee</p>
                    <p class="text-[9px] text-slate-500">Chief Mentor & Industry Evaluator</p>
                    <p class="text-[8px] text-slate-400">Academic Advisory Board</p>
                </div>

            </div>

        </div>
    </div>

    <!-- Verification Notice -->
    <div class="mt-6 text-center text-xs text-slate-500 no-print">
        This is an electronically verifiable credential. Verify authenticity at <a href="{{ route('verify', ['code' => $profile->certificate_number]) }}" class="text-indigo-600 underline font-medium">{{ route('verify', ['code' => $profile->certificate_number]) }}</a>
    </div>

</body>
</html>
