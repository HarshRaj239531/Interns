@php
    $settings = $settings ?? \App\Models\OfferLetterSetting::current();
    
    // Resolve offer letter date
    $offerDateObj = $profile->offer_letter_date ?? now();
    $offerDate = $offerDateObj->format('d F Y');
    $offerYear = $offerDateObj->format('Y');

    // Resolve acceptance deadline
    $acceptanceDays = $settings->acceptance_days ?? 5;
    $acceptanceDate = (clone $offerDateObj)->addDays($acceptanceDays)->format('d F Y');

    // Reference number
    $seq = substr($profile->application_number ?? '047', -3);
    if (! $seq || strlen($seq) < 3) {
        $seq = str_pad($profile->id ?? '47', 3, '0', STR_PAD_LEFT);
    }
    $refNo = rtrim($settings->ref_prefix, '/') . '/' . $offerYear . '/' . $seq;

    // Table values resolution
    $role = $settings->default_role;
    if (!empty($profile->program_domain)) {
        $role = str_contains(strtolower($profile->program_domain), 'intern')
            ? $profile->program_domain
            : $profile->program_domain . ' Intern';
    }
    
    $department = !empty($profile->program_domain) ? $profile->program_domain : $settings->default_department;
    $reportingManager = (!empty($profile->mentor_name) && $profile->mentor_name !== 'Faculty Advisory Board')
        ? $profile->mentor_name
        : $settings->default_reporting_manager;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->letter_title }} - OFFER & ACCEPTANCE LETTER – {{ $user->name }} ({{ $profile->application_number }})</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm;
        }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; color: #000 !important; }
            .print-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 font-sans text-slate-800 antialiased selection:bg-blue-100">

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="max-w-4xl mx-auto mb-6 flex flex-wrap items-center justify-between gap-3 no-print">
        <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white px-4 py-2 rounded-full shadow-xs border border-slate-200 transition">
            ← Back to Dashboard
        </a>

        <div class="flex items-center gap-3">
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.offer-letter.settings') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 px-3.5 py-2 rounded-full transition">
                    <span>⚙️ Letter Settings</span>
                </a>
            @endif

            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-full shadow-md shadow-indigo-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print / Download PDF</span>
            </button>
        </div>
    </div>

    <!-- Letter Container Sheet -->
    <div class="print-container max-w-[820px] mx-auto bg-white p-10 sm:p-14 md:p-16 rounded-2xl shadow-xl border border-slate-200 text-slate-800">
        
        <!-- Header Letterhead -->
        <div class="flex items-start justify-between gap-4">
            <!-- Left Header: Logo -->
            <div class="flex items-center">
                <img src="{{ $settings->logo_path ? asset($settings->logo_path) : '/infinity-interns-logo.png' }}" alt="{{ $settings->company_name }}" class="h-16 sm:h-20 w-auto object-contain">
            </div>

            <!-- Right Header: Company Info -->
            <div class="text-right text-[11px] leading-tight text-slate-600 space-y-0.5">
                <div class="font-extrabold text-slate-900 text-xs tracking-wider uppercase">{{ $settings->company_name }}</div>
                @if($settings->cin_number)
                    <div class="text-[10px] text-slate-500 font-medium">CIN No.: {{ $settings->cin_number }}</div>
                @endif
                <div class="text-[10px] text-slate-600">{{ $settings->address }}</div>
                <div class="text-[10px] text-slate-600">{{ $settings->email }} | {{ $settings->website }}</div>
            </div>
        </div>

        <!-- Solid Ocean Blue Dividing Line -->
        <div class="w-full h-[2.5px] bg-[#1e3a8a] my-5"></div>

        <!-- Document Heading -->
        <div class="text-center my-5">
            <h1 class="text-xl sm:text-2xl font-bold tracking-wide text-[#1e3a8a] uppercase">{{ $settings->letter_title }}</h1>
            <span class="sr-only">OFFER & ACCEPTANCE LETTER</span>
        </div>

        <!-- Ref Number and Date Row -->
        <div class="flex items-center justify-between text-xs sm:text-sm text-slate-800 my-4 font-normal">
            <div>
                <strong class="font-bold text-slate-900">Ref No:</strong> <span>{{ $refNo }}</span>
            </div>
            <div>
                <strong class="font-bold text-slate-900">Date:</strong> <span>{{ $offerDate }}</span>
            </div>
        </div>

        <!-- Recipient Addressee -->
        <div class="text-xs sm:text-sm text-slate-900 space-y-3 mt-5 mb-4">
            <p class="font-bold">To,</p>
            <p class="font-bold">Dear {{ $user->name }},</p>
        </div>

        <!-- Opening Paragraph -->
        <p class="text-xs sm:text-[13px] text-slate-700 leading-relaxed text-justify mb-4">
            {{ $settings->intro_text ?: ("We are pleased to offer you an internship with " . $settings->company_name . " (" . $settings->company_subtitle . "). We believe that your skills and interests align well with our mission, and we are confident that this internship will be a valuable opportunity for your professional growth and development.") }}
        </p>

        <!-- Details Heading -->
        <p class="text-xs sm:text-[13px] font-bold text-slate-900 mb-2">
            Your internship details are as follows:
        </p>

        <!-- 7-Row Bordered Details Table -->
        <div class="mb-5 overflow-hidden">
            <table class="w-full border-collapse border border-slate-300 text-xs sm:text-sm">
                <tbody>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 w-[35%] bg-slate-50/40">Internship Role</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800">{{ $role }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 bg-slate-50/40">Department</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800">{{ $department }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 bg-slate-50/40">Location</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800 uppercase">{{ $settings->default_location }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 bg-slate-50/40">Duration</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800">{{ $settings->default_duration }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 bg-slate-50/40">Stipend</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800">{{ $settings->default_stipend }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 bg-slate-50/40">Reporting Manager</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800">{{ $reportingManager }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 px-3.5 py-2 font-bold text-slate-900 bg-slate-50/40">Mode of Internship</td>
                        <td class="border border-slate-300 px-3.5 py-2 text-slate-800">{{ $settings->default_mode }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Post-Table Policies -->
        <p class="text-xs sm:text-[13px] text-slate-700 leading-relaxed text-justify mb-3">
            {{ $settings->terms_text ?: "You will be expected to maintain professionalism, meet the assigned objectives, and abide by the policies and confidentiality terms of the organization." }}
        </p>

        <!-- Acceptance Deadline -->
        <p class="text-xs sm:text-[13px] text-slate-700 leading-relaxed text-justify mb-3">
            Please confirm your acceptance of this offer by signing and returning a copy of this letter by <strong class="font-bold text-slate-900">{{ $acceptanceDate }}</strong>.
        </p>

        <!-- Closing Line -->
        <p class="text-xs sm:text-[13px] text-slate-700 leading-relaxed text-justify mb-6">
            {{ $settings->closing_text ?: ("We look forward to having you as part of our team and wish you a fruitful learning journey with " . $settings->company_name . ".") }}
        </p>

        <!-- Sign-Off Header -->
        <div class="space-y-0.5 text-xs sm:text-sm text-slate-900 mb-4">
            <p class="font-bold">Best Regards,</p>
            <p class="font-bold">For {{ $settings->company_name }}</p>
            @if($settings->company_subtitle)
                <p class="text-[11px] text-slate-500 font-normal">({{ $settings->company_subtitle }})</p>
            @endif
        </div>

        <!-- Signatures & Seal Impression Row -->
        <div class="pt-2 flex items-end justify-between gap-4">
            <!-- Left Side: Signatory Signature & Details -->
            <div class="space-y-1">
                <div class="h-16 flex items-end">
                    @if($settings->signature_path && file_exists(public_path($settings->signature_path)))
                        <img src="{{ asset($settings->signature_path) }}" alt="Signature" class="max-h-16 max-w-[180px] object-contain">
                    @else
                        <!-- Elegant script signature placeholder -->
                        <span class="font-serif italic text-lg text-slate-800 font-bold opacity-80 select-none">
                            {{ $settings->signatory_name }}
                        </span>
                    @endif
                </div>
                <p class="font-bold text-xs sm:text-sm text-slate-900">{{ $settings->signatory_name }}</p>
                <p class="text-[11px] text-slate-500 font-medium">{{ $settings->signatory_designation }}</p>
            </div>

            <!-- Right Side: Official Stamp / Seal -->
            <div class="flex flex-col items-end">
                <div class="h-24 w-28 flex items-center justify-center mb-1">
                    @if($settings->seal_path && file_exists(public_path($settings->seal_path)))
                        <img src="{{ asset($settings->seal_path) }}" alt="Official Seal" class="h-24 w-24 object-contain">
                    @else
                        <!-- Subtle official stamp watermark if no image uploaded yet -->
                        <div class="w-16 h-16 rounded-full border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-center p-1 text-slate-400 select-none">
                            <span class="text-[7px] font-bold uppercase tracking-wider">OFFICIAL</span>
                            <span class="text-[8px]">✦ SEAL ✦</span>
                        </div>
                    @endif
                </div>
                <span class="text-[11px] text-slate-500 font-medium">Official Seal / Signature</span>
            </div>
        </div>

    </div>

</body>
</html>
