@php
    $settings = $settings ?? \App\Models\ConsentLetterSetting::current();

    // Resolve date
    $consentDateObj = $profile->consent_letter_date ?? $profile->created_at ?? now();
    $consentDate = $consentDateObj->format('d/m/Y');
    $consentYear = $consentDateObj->format('Y');

    // Letter number
    $seq = substr($profile->application_number ?? '047', -3);
    if (! $seq || strlen($seq) < 3) {
        $seq = str_pad($profile->id ?? '47', 3, '0', STR_PAD_LEFT);
    }
    $letterNo = rtrim($settings->letter_no_prefix, '/') . '/' . $consentYear . '/' . $seq;

    // College display name (User requested: student ke hissab se dynamically lgega)
    $collegeName = !empty($profile->college) ? $profile->college : $settings->default_college;

    // Class with Semester
    $classSemester = trim(($profile->degree ?? '') . ' ' . ($profile->semester ?? ''));
    if (!empty($profile->semester) && !str_contains(strtolower($profile->semester), 'semester')) {
        $classSemester .= ' Semester';
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent & Institutional Undertaking Letter – {{ $user->name }} ({{ $profile->application_number }})</title>
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
                border: 1px solid #000 !important;
                padding: 30px !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 font-serif text-black antialiased selection:bg-purple-100">

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="max-w-4xl mx-auto mb-6 flex flex-wrap items-center justify-between gap-3 no-print font-sans">
        <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white px-4 py-2 rounded-full shadow-xs border border-slate-200 transition">
            ← Back to Dashboard
        </a>

        <div class="flex items-center gap-3">
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.consent-letter.settings') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100 border border-purple-200 px-3.5 py-2 rounded-full transition">
                    <span>⚙️ Letter Settings</span>
                </a>
            @endif

            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-purple-600 hover:bg-purple-700 px-6 py-2 rounded-full shadow-md shadow-purple-600/30 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Print / Download PDF</span>
            </button>
        </div>
    </div>

    <!-- Letter Container Sheet with Outer Frame Border -->
    <div class="print-container max-w-[820px] mx-auto bg-white p-10 sm:p-14 md:p-16 shadow-xl border-2 border-black text-black">
        
        <!-- Header: Dynamic College Name (Student Enrolled College) -->
        <div class="text-center mb-3">
            <h1 class="font-bold text-lg sm:text-xl md:text-2xl text-black uppercase tracking-wider">
                {{ strtoupper($collegeName) }}
            </h1>
            <span class="sr-only">Consent & Institutional Undertaking Letter</span>
        </div>

        <!-- Annexure Subtitle -->
        <div class="text-center font-bold text-xs sm:text-sm text-black uppercase tracking-widest mb-2">
            {{ $settings->annexure_text }}
        </div>

        <!-- Document Main Title Underlined -->
        <div class="text-center font-bold text-sm sm:text-base text-black uppercase tracking-wider mb-8">
            <u class="underline underline-offset-4 decoration-1">{{ $settings->letter_title }}</u>
        </div>

        <!-- Meta Line: Letter No & Date with Underline Rule -->
        <div class="flex items-center justify-between text-xs sm:text-sm text-black my-5">
            <div class="flex items-baseline gap-1">
                <span class="font-normal">Letter No:</span>
                <span class="inline-block border-b border-black min-w-[180px] sm:min-w-[220px] px-2 text-center font-mono font-medium">
                    {{ $letterNo }}
                </span>
            </div>
            <div class="flex items-baseline gap-1">
                <span class="font-normal">Date:</span>
                <span class="inline-block border-b border-black min-w-[160px] sm:min-w-[190px] px-2 text-center font-normal">
                    {{ $consentDate }}
                </span>
            </div>
        </div>

        <!-- Subject Line: TO WHOM IT MAY CONCERN -->
        <div class="text-center font-bold text-xs sm:text-sm text-black uppercase tracking-wider my-7">
            <u class="underline underline-offset-4 decoration-1">{{ $settings->letter_subject }}</u>
        </div>

        <!-- Introduction Paragraph -->
        <p class="text-xs sm:text-[13px] text-black leading-relaxed text-justify mb-6 font-normal">
            {{ $settings->intro_text ?: ("As part of the curriculum of CBCS UG the students are required to undertake internship of " . $settings->credits_text . " in an organization. In this regard, I am introducing the below mentioned student with the following details for the purpose of internship:") }}
        </p>

        <!-- 8-Row Bordered Details Table (Exact Reference Matching) -->
        <div class="mb-12 overflow-hidden">
            <table class="w-full border-collapse border border-black text-xs sm:text-sm text-black">
                <tbody>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold w-[45%]">Name of the Student</td>
                        <td class="border border-black px-4 py-2 font-medium">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">Gender</td>
                        <td class="border border-black px-4 py-2 font-medium">{{ $profile->gender ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">Father's Name</td>
                        <td class="border border-black px-4 py-2 font-medium">{{ $profile->father_name ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">University Registration Number</td>
                        <td class="border border-black px-4 py-2 font-mono font-medium">{{ $profile->university_reg_no ?: $profile->application_number }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">University Roll Number</td>
                        <td class="border border-black px-4 py-2 font-mono font-medium">{{ $profile->university_roll_no ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">Class with Semester</td>
                        <td class="border border-black px-4 py-2 font-medium">{{ $classSemester }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">Mobile Number</td>
                        <td class="border border-black px-4 py-2 font-mono font-medium">{{ $user->phone ?: '—' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 font-bold">Email ID</td>
                        <td class="border border-black px-4 py-2 font-medium">{{ $user->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Lower Section: Institutional Endorsement & Signatures -->
        <div class="pt-16 mt-8 flex items-end justify-between">
            <!-- Left Side: Official College Stamp -->
            <div class="flex flex-col items-center">
                @if($settings->seal_path && file_exists(public_path($settings->seal_path)))
                    <img src="{{ asset($settings->seal_path) }}" alt="College Seal" class="h-20 w-20 object-contain mb-2">
                @else
                    <div class="w-20 h-20 rounded-full border border-dashed border-slate-400 flex flex-col items-center justify-center text-center p-1 text-slate-400 select-none mb-2">
                        <span class="text-[7px] font-bold uppercase tracking-wider">OFFICIAL</span>
                        <span class="text-[8px]">✦ SEAL ✦</span>
                    </div>
                @endif
                <span class="text-[10px] text-slate-600 uppercase tracking-wider font-sans">College Seal</span>
            </div>

            <!-- Right Side: Principal / HOD Signature -->
            <div class="flex flex-col items-center text-center">
                <div class="h-16 flex items-end justify-center mb-1">
                    @if($settings->signature_path && file_exists(public_path($settings->signature_path)))
                        <img src="{{ asset($settings->signature_path) }}" alt="Signature" class="max-h-16 max-w-[180px] object-contain">
                    @endif
                </div>

                @if($settings->show_signature_line)
                    <div class="w-60 border-t border-black mb-1.5"></div>
                @endif

                <p class="font-bold text-xs sm:text-sm text-black">
                    {{ $settings->authority_designation }}
                </p>
                <p class="text-[11px] text-slate-700 font-sans mt-0.5">
                    {{ $collegeName }}
                </p>
            </div>
        </div>

    </div>

</body>
</html>
