<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion – {{ $user->name }} ({{ $profile->certificate_number ?? 'CERT' }})</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { 
                background: white !important; 
                padding: 0 !important; 
                margin: 0 !important; 
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .cert-sheet { 
                box-shadow: none !important; 
                border-radius: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                min-height: 100vh !important;
                margin: 0 !important;
                page-break-inside: avoid !important;
            }
            @page {
                size: landscape;
                margin: 0.8cm;
            }
        }

        /* Certificate Colors & Typography matching official spec */
        .cert-navy {
            color: #0c2340;
        }
        .cert-gold {
            color: #b58726;
        }
        .cert-border-navy {
            border-color: #0c2340;
        }
        .cert-border-gold {
            border-color: #c59b27;
        }

        /* Decorative Corner Lines */
        .corner-bracket-tl {
            position: absolute;
            top: -2px;
            left: -2px;
            width: 32px;
            height: 32px;
            border-top: 2.5px solid #c59b27;
            border-left: 2.5px solid #c59b27;
        }
        .corner-bracket-tr {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 32px;
            height: 32px;
            border-top: 2.5px solid #c59b27;
            border-right: 2.5px solid #c59b27;
        }
        .corner-bracket-bl {
            position: absolute;
            bottom: -2px;
            left: -2px;
            width: 32px;
            height: 32px;
            border-bottom: 2.5px solid #c59b27;
            border-left: 2.5px solid #c59b27;
        }
        .corner-bracket-br {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 32px;
            height: 32px;
            border-bottom: 2.5px solid #c59b27;
            border-right: 2.5px solid #c59b27;
        }
    </style>
</head>
<body class="bg-slate-200/80 min-h-screen py-8 px-4 font-sans text-slate-800 antialiased flex flex-col items-center justify-center">

    @php
        $settings = $settings ?? \App\Models\CertificateSetting::current();

        // Calculate Start Date and End Date
        $startDate = $profile->offer_letter_date ? $profile->offer_letter_date->format('d F Y') : '06 June 2026';
        $endDate = $profile->certificate_date ? $profile->certificate_date->format('d F Y') : '21 July 2026';
        $issueDate = $profile->certificate_date ? $profile->certificate_date->format('d F Y') : ($profile->created_at ? $profile->created_at->format('d F Y') : date('d F Y'));

        $score = $profile->marksheet_marks ?? 96;
        $grade = $profile->marksheet_grade ?? 'Excellent';
        $certNumber = $profile->certificate_number ?? 'II-00012';
        $regNumber = $profile->university_reg_no ?? $profile->application_number ?? '151103001616';
        $collegeName = $profile->college ?? 'MAGADH UNIVERSITY, BODH GAYA';
        $degreeDomain = trim(($profile->degree ?? 'MBA') . ' ' . ($profile->program_domain ?? 'Marketing Management'));
    @endphp

    <!-- Top Action Bar (Print / Back) -->
    <div class="w-full max-w-[1040px] mx-auto mb-5 flex items-center justify-between no-print">
        <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 hover:text-slate-900 bg-white px-4 py-2 rounded-xl shadow-xs border border-slate-300 transition">
            ← Back to Dashboard
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('verify', ['code' => $certNumber]) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-700 hover:text-indigo-900 bg-white border border-indigo-200 px-4 py-2 rounded-xl shadow-xs">
                <span>Verifiable QR URL ↗</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-xl shadow-md shadow-indigo-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print Official Certificate</span>
            </button>
        </div>
    </div>

    <!-- Official Certificate Canvas (Exact Pixel Representation) -->
    <div class="cert-sheet w-full max-w-[1040px] bg-white shadow-2xl p-4 sm:p-5 relative select-none">
        
        <!-- Outer Dark Navy Border -->
        <div class="border-[2.5px] border-[#0c2340] p-2 relative">
            
            <!-- Corner Golden Brackets (Outside inner border) -->
            <div class="corner-bracket-tl"></div>
            <div class="corner-bracket-tr"></div>
            <div class="corner-bracket-bl"></div>
            <div class="corner-bracket-br"></div>

            <!-- Inner Thin Dark Navy Border -->
            <div class="border border-[#0c2340] px-8 sm:px-12 py-8 sm:py-9 relative min-h-[660px] flex flex-col justify-between overflow-hidden bg-white">

                <!-- Side Diamond Accent Markers (Left & Right) -->
                <div class="absolute left-[-22px] top-[148px] text-[#c59b27] text-sm select-none">◆</div>
                <div class="absolute right-[-22px] top-[148px] text-[#c59b27] text-sm select-none">◆</div>

                <!-- Subtle Central Watermark Crest (Opacity ~ 0.05) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0">
                    <div class="w-80 h-80 rounded-full border-[10px] border-[#0c2340]/5 flex items-center justify-center p-8">
                        <img src="/infinity-interns-logo.png" alt="" class="w-48 h-auto opacity-[0.05] grayscale">
                    </div>
                </div>

                <!-- Header: Logo, Company Name & Slogan -->
                <div class="text-center relative z-10">
                    <img src="/infinity-interns-logo.png" alt="Infinity Interns Logo" class="h-10 sm:h-11 w-auto object-contain mx-auto mb-1">
                    <h2 class="font-serif font-black text-xl sm:text-2xl text-[#0c2340] tracking-[0.18em] uppercase">
                        {{ $settings->company_name ?? 'INFINITY INTERNS' }}
                    </h2>
                    <div class="text-[9.5px] sm:text-[10px] font-semibold text-[#b58726] tracking-[0.35em] uppercase mt-0.5">
                        {{ $settings->tagline ?? 'LEARN • GROW • SUCCEED' }}
                    </div>
                </div>

                <!-- Certificate Main Title -->
                <div class="text-center my-3 relative z-10">
                    <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[#0c2340] tracking-[0.05em] uppercase">
                        {{ $settings->title ?? 'CERTIFICATE OF COMPLETION' }}
                    </h1>
                </div>

                <!-- Recipient Declaration -->
                <div class="text-center space-y-1 relative z-10">
                    <p class="font-serif italic text-slate-500 text-xs sm:text-sm tracking-wide">
                        This is to certify that
                    </p>
                    <h3 class="font-serif font-extrabold text-2xl sm:text-3xl text-[#0c2340] tracking-wider uppercase pt-1 pb-1">
                        {{ strtoupper($user->name) }}
                    </h3>

                    <!-- Registration & College Information -->
                    <div class="space-y-0.5 pt-1 text-xs text-slate-800">
                        <p class="font-semibold text-slate-800">
                            Reg. No. {{ $regNumber }}
                        </p>
                        <p class="font-medium text-slate-800 uppercase">
                            from {{ strtoupper($collegeName) }}
                        </p>
                        <p class="text-slate-800">
                            <strong>Studying in</strong> {{ $degreeDomain }}
                        </p>
                    </div>
                </div>

                <!-- Program Completion Citation Paragraph -->
                <div class="text-center text-xs sm:text-[13px] text-slate-800 leading-relaxed my-2 relative z-10">
                    <p>
                        has successfully completed the <strong>{{ $settings->default_duration ?? '45 Days' }}</strong> Internship program in <strong>{{ $profile->program_domain ?? 'Marketing Management' }}</strong> at <strong>Infinity Interns</strong>.
                    </p>
                    <p class="mt-0.5">
                        The internship was conducted in <strong>{{ $settings->default_mode ?? 'Offline' }}</strong> mode
                    </p>
                </div>

                <!-- Highlight Box: Dates, Score & Grade -->
                <div class="my-2 relative z-10 flex justify-center">
                    <div class="inline-block border border-[#c59b27] px-6 sm:px-10 py-2 rounded-xs bg-[#fffdfa] shadow-xs text-center text-xs sm:text-[13px] text-slate-800">
                        From <strong>{{ $startDate }}</strong> to <strong>{{ $endDate }}</strong> with <span class="font-bold text-[#b58726]">{{ $score }}% Score</span> and Grade <span class="font-bold text-[#b58726]">{{ $grade }}</span>
                    </div>
                </div>

                <!-- Bottom Accreditation & Signatures Row (4 Sections) -->
                <div class="pt-4 relative z-10 flex flex-row items-end justify-between gap-2 border-t border-transparent">
                    
                    <!-- Left: Official Stamp, Signature & Director -->
                    <div class="w-1/3 text-left space-y-1">
                        <!-- Stamp Box with Signature -->
                        <div class="mb-1">
                            @if($settings->stamp_signature_path && file_exists(public_path($settings->stamp_signature_path)))
                                <img src="{{ asset($settings->stamp_signature_path) }}" alt="Official Stamp & Signature" class="h-14 sm:h-15 w-auto object-contain">
                            @else
                                <img src="/images/certificate/stamp_signature.png" alt="Official Stamp & Signature" class="h-14 sm:h-15 w-auto object-contain">
                            @endif
                        </div>
                        <p class="font-bold text-xs text-slate-900 leading-none">
                            {{ $settings->director_name ?? 'Rahul Kumar' }}
                        </p>
                        <p class="text-[10px] text-slate-500 leading-none">
                            {{ $settings->director_title ?? 'Director, Infinity Interns' }}
                        </p>
                        <p class="text-[9.5px] text-slate-800 pt-4 leading-tight">
                            a unit of <strong>{{ $settings->company_unit ?? 'Infinity A1 Career Counselling Pvt. Ltd.' }}</strong>
                        </p>
                    </div>

                    <!-- Center: MSME & AICTE Official Logos -->
                    <div class="flex items-center justify-center gap-5 pb-1">
                        <!-- MSME Logo -->
                        <div class="flex flex-col items-center">
                            @if($settings->msme_logo_path && file_exists(public_path($settings->msme_logo_path)))
                                <img src="{{ asset($settings->msme_logo_path) }}" alt="MSME Logo" class="h-13 sm:h-14 w-auto object-contain">
                            @else
                                <img src="/images/certificate/msme_logo.png" alt="MSME Logo" class="h-13 sm:h-14 w-auto object-contain">
                            @endif
                        </div>

                        <!-- AICTE Logo -->
                        <div class="flex flex-col items-center">
                            @if($settings->aicte_logo_path && file_exists(public_path($settings->aicte_logo_path)))
                                <img src="{{ asset($settings->aicte_logo_path) }}" alt="AICTE Logo" class="h-13 sm:h-14 w-auto object-contain">
                            @else
                                <img src="/images/certificate/aicte_logo.png" alt="AICTE Logo" class="h-13 sm:h-14 w-auto object-contain">
                            @endif
                        </div>
                    </div>

                    <!-- Right: Certificate ID, Date & Dynamic Verification QR Code -->
                    <div class="w-1/3 text-right flex flex-col items-end space-y-1">
                        <div class="text-[11px] text-slate-800">
                            Certificate ID: <strong class="text-[#0c2340]">{{ $certNumber }}</strong>
                        </div>
                        <div class="text-[11px] text-slate-800 mb-1">
                            Issue Date: <strong>{{ $issueDate }}</strong>
                        </div>

                        <!-- Dynamic Live QR Code -->
                        <div class="flex flex-col items-center mt-1">
                            <div class="p-1 bg-white border border-slate-200 shadow-2xs">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('verify', ['code' => $certNumber])) }}" alt="Scan to Verify" class="w-16 h-16 sm:w-18 sm:h-18 object-contain">
                            </div>
                            <span class="text-[8.5px] font-bold text-slate-500 uppercase tracking-widest mt-1">
                                SCAN TO VERIFY
                            </span>
                        </div>

                        <div class="text-[9.5px] text-slate-800 pt-2 leading-tight">
                            visite: <a href="{{ $settings->website_url ?? 'https://infinityinterns.com/' }}" target="_blank" class="text-teal-700 hover:underline">{{ $settings->website_url ?? 'https://infinityinterns.com/' }}</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>
</html>
