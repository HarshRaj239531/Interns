@extends('layouts.admin')

@section('title', 'Track Application Lifecycle – Infinity Interns')

@section('content')
<div class="space-y-6">

    <!-- Top Header -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-4 motion-reveal">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 text-xs font-semibold mb-2 border border-indigo-200 dark:border-indigo-800">
                <span>✦ Visual Verification Timeline</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Track Application Lifecycle</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 max-w-2xl">
                Real-time milestone tracking for student enrollments: from initial registration to offer acceptance, attendance compliance, capstone audit, and final UGC certificate issuance.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-xl adm-card hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold transition self-start md:self-auto motion-btn-spring">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Search Bar -->
    <div class="p-4 rounded-2xl adm-card motion-reveal">
        <form action="{{ route('admin.track') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none adm-text-muted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Enter Application ID (e.g. INF-2026-9214), candidate name, or email..." class="w-full pl-10 pr-4 py-2.5 rounded-xl adm-input text-xs font-medium placeholder-slate-400">
            </div>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer w-full sm:w-auto motion-btn-spring">
                Trace Application
            </button>
        </form>
    </div>

    @if($profile)
    <!-- Main Tracking Dossier Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Candidate Info Summary (Col 4) -->
        <div class="lg:col-span-4 rounded-3xl adm-card p-6 shadow-xl space-y-6 motion-reveal motion-card-hover">
            <div class="flex items-center gap-3.5 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 font-bold text-base flex items-center justify-center shrink-0 border border-indigo-300 dark:border-indigo-700">
                    {{ substr($profile->user->name ?? 'C', 0, 1) }}
                </div>
                <div>
                    <h3 class="font-serif font-bold text-base adm-text">{{ $profile->user->name ?? 'Candidate' }}</h3>
                    <span class="font-mono text-xs font-bold text-indigo-600 dark:text-indigo-400">{{ $profile->application_number }}</span>
                </div>
            </div>

            <div class="space-y-3 text-xs">
                <div class="flex items-center justify-between">
                    <span class="adm-text-muted">Degree & Sem:</span>
                    <span class="adm-text font-bold">{{ $profile->degree }} ({{ $profile->semester }})</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="adm-text-muted">Enrolled College:</span>
                    <span class="adm-text font-semibold text-right max-w-[200px] truncate" title="{{ $profile->college }}">{{ $profile->college }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="adm-text-muted">Program Domain:</span>
                    <span class="text-indigo-600 dark:text-indigo-400 font-bold text-right max-w-[200px] truncate">{{ $profile->program_domain }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="adm-text-muted">Assigned Mentor:</span>
                    <span class="adm-text font-medium">{{ $profile->mentor_name }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="adm-text-muted">Attendance:</span>
                    <span class="px-2 py-0.5 rounded font-bold {{ $profile->attendance_rate >= 75 ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-rose-100 text-rose-800' }}">
                        {{ $profile->attendance_rate }}% (UGC Compliant)
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="adm-text-muted">Current Status:</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold
                        {{ $profile->status === 'COMPLETED' ? 'adm-badge-completed' : '' }}
                        {{ $profile->status === 'ACTIVE' ? 'adm-badge-active' : '' }}
                        {{ $profile->status === 'APPROVED' ? 'adm-badge-approved' : '' }}
                        {{ $profile->status === 'PENDING' ? 'adm-badge-pending' : '' }}
                    ">
                        {{ $profile->status }}
                    </span>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200 dark:border-slate-800 space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Available Documents</span>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    @if($profile->offer_letter_issued)
                        <a href="{{ route('admin.application.view-offer-letter', $profile->id) }}" target="_blank" class="p-2 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 font-semibold text-center hover:underline motion-btn-spring">
                            Offer Letter ↗
                        </a>
                    @endif
                    @if($profile->consent_letter_issued)
                        <a href="{{ route('admin.application.view-consent-letter', $profile->id) }}" target="_blank" class="p-2 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 font-semibold text-center hover:underline motion-btn-spring">
                            Consent Letter ↗
                        </a>
                    @endif
                    @if($profile->certificate_issued)
                        <a href="{{ route('admin.application.view-certificate', $profile->id) }}" target="_blank" class="p-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 font-semibold text-center hover:underline motion-btn-spring">
                            Certificate ↗
                        </a>
                    @endif
                    @if($profile->lor_issued)
                        <a href="{{ route('admin.application.view-lor', $profile->id) }}" target="_blank" class="p-2 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 font-semibold text-center hover:underline motion-btn-spring">
                            LOR ↗
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- 5-Step Visual Progress Stepper (Col 8) -->
        <div class="lg:col-span-8 rounded-3xl adm-card p-6 sm:p-8 shadow-xl space-y-6 motion-reveal">
            <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
                <h3 class="font-serif font-bold text-lg adm-text">Candidate Verification & Milestone Stepper</h3>
                <span class="text-xs font-mono text-indigo-600 dark:text-indigo-400 font-bold">5-Stage NEP Pipeline</span>
            </div>

            <div class="space-y-6 relative before:absolute before:inset-0 before:left-5 before:w-0.5 before:bg-slate-200 dark:before:bg-slate-800 before:z-0">

                <!-- Step 1: Registration & Application -->
                <div class="relative z-10 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-md shadow-emerald-500/30">
                        ✓
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex-1 space-y-1 motion-card-hover">
                        <div class="flex items-center justify-between">
                            <span class="font-bold adm-text text-sm">Step 1: Enrollment & Application Received</span>
                            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold">COMPLETED</span>
                        </div>
                        <p class="text-xs adm-text-muted">Student registered online. System assigned unique application identifier <strong class="font-mono">{{ $profile->application_number }}</strong>.</p>
                        <span class="text-[10px] adm-text-muted block">Recorded on: {{ $profile->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                </div>

                <!-- Step 2: Instant Offer & Consent Letters -->
                <div class="relative z-10 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full {{ ($profile->offer_letter_issued && $profile->consent_letter_issued) ? 'bg-emerald-500 text-white' : 'bg-blue-500 text-white' }} flex items-center justify-center font-bold text-sm shrink-0 shadow-md">
                        {{ ($profile->offer_letter_issued && $profile->consent_letter_issued) ? '✓' : '2' }}
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex-1 space-y-1.5 motion-card-hover">
                        <div class="flex items-center justify-between">
                            <span class="font-bold adm-text text-sm">Step 2: Instant Offer Letter & Consent Letter Issued</span>
                            <span class="text-[10px] {{ $profile->offer_letter_issued ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-amber-500 font-semibold' }}">
                                {{ $profile->offer_letter_issued ? 'ACTIVE & ISSUED' : 'IN PROGRESS' }}
                            </span>
                        </div>
                        <p class="text-xs adm-text-muted">Official enrollment acceptance confirmation and institutional compliance undertaking generated for university records.</p>
                        <div class="flex items-center gap-3 pt-1">
                            @if($profile->offer_letter_issued)
                                <a href="{{ route('admin.application.view-offer-letter', $profile->id) }}" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline motion-btn-spring">
                                    View Offer Letter ({{ $profile->offer_letter_date?->format('d M Y') ?? 'Instant' }}) ↗
                                </a>
                            @endif
                            @if($profile->consent_letter_issued)
                                <a href="{{ route('admin.application.view-consent-letter', $profile->id) }}" target="_blank" class="text-xs text-purple-600 dark:text-purple-400 font-bold hover:underline motion-btn-spring">
                                    View Consent Letter ({{ $profile->consent_letter_date?->format('d M Y') ?? 'Instant' }}) ↗
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Step 3: Mentor Assignment & Practical Contact Hours -->
                <div class="relative z-10 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full {{ in_array($profile->status, ['ACTIVE', 'COMPLETED']) ? 'bg-emerald-500 text-white' : 'bg-slate-300 dark:bg-slate-700 text-slate-800 dark:text-slate-200' }} flex items-center justify-center font-bold text-sm shrink-0 shadow-md">
                        {{ in_array($profile->status, ['ACTIVE', 'COMPLETED']) ? '✓' : '3' }}
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex-1 space-y-1 motion-card-hover">
                        <div class="flex items-center justify-between">
                            <span class="font-bold adm-text text-sm">Step 3: Faculty Mentor Alignment & 120 Contact Hours</span>
                            <span class="text-[10px] {{ in_array($profile->status, ['ACTIVE', 'COMPLETED']) ? 'text-emerald-600 font-bold' : 'adm-text-muted' }}">
                                {{ in_array($profile->status, ['ACTIVE', 'COMPLETED']) ? 'ACTIVE PROGRESS' : 'SCHEDULED' }}
                            </span>
                        </div>
                        <p class="text-xs adm-text-muted">Assigned to <strong class="adm-text">{{ $profile->mentor_name }}</strong> for hands-on project deliverables. Attendance: <strong class="text-emerald-600">{{ $profile->attendance_rate }}%</strong>.</p>
                    </div>
                </div>

                <!-- Step 4: Capstone Review & Evaluation Marksheet -->
                <div class="relative z-10 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full {{ $profile->marksheet_issued ? 'bg-emerald-500 text-white' : 'bg-slate-300 dark:bg-slate-700 text-slate-800 dark:text-slate-200' }} flex items-center justify-center font-bold text-sm shrink-0 shadow-md">
                        {{ $profile->marksheet_issued ? '✓' : '4' }}
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex-1 space-y-1 motion-card-hover">
                        <div class="flex items-center justify-between">
                            <span class="font-bold adm-text text-sm">Step 4: Capstone Evaluation & Academic Scorecard</span>
                            <span class="text-[10px] {{ $profile->marksheet_issued ? 'text-emerald-600 font-bold' : 'adm-text-muted' }}">
                                {{ $profile->marksheet_issued ? 'EVALUATED' : 'AWAITING AUDIT' }}
                            </span>
                        </div>
                        <p class="text-xs adm-text-muted">Project: "<strong class="adm-text">{{ $profile->project_title }}</strong>"</p>
                        @if($profile->marksheet_issued)
                            <div class="pt-1 flex items-center gap-3">
                                <span class="text-xs font-bold text-purple-600 dark:text-purple-400">Grade {{ $profile->marksheet_grade }} ({{ $profile->marksheet_marks }}%)</span>
                                <a href="{{ route('admin.application.view-marksheet', $profile->id) }}" target="_blank" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline motion-btn-spring">
                                    View Scorecard ↗
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Step 5: Official UGC Certificate & LOR -->
                <div class="relative z-10 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full {{ $profile->certificate_issued ? 'bg-emerald-500 text-white' : 'bg-slate-300 dark:bg-slate-700 text-slate-800 dark:text-slate-200' }} flex items-center justify-center font-bold text-sm shrink-0 shadow-md">
                        {{ $profile->certificate_issued ? '✓' : '5' }}
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex-1 space-y-1.5 motion-card-hover">
                        <div class="flex items-center justify-between">
                            <span class="font-bold adm-text text-sm">Step 5: Completion Certificate & Letter of Recommendation</span>
                            <span class="text-[10px] {{ $profile->certificate_issued ? 'text-emerald-600 font-bold' : 'adm-text-muted' }}">
                                {{ $profile->certificate_issued ? 'ISSUED & VERIFIABLE' : 'PENDING APPROVAL' }}
                            </span>
                        </div>
                        @if($profile->certificate_issued)
                            <p class="text-xs adm-text-muted">Certificate Serial: <strong class="font-mono text-emerald-600 dark:text-emerald-400">{{ $profile->certificate_number }}</strong></p>
                            <div class="flex flex-wrap items-center gap-3 pt-1">
                                <a href="{{ route('admin.application.view-certificate', $profile->id) }}" target="_blank" class="text-xs font-bold text-emerald-600 hover:underline motion-btn-spring">
                                    Print Certificate ↗
                                </a>
                                <a href="{{ route('verify', $profile->certificate_number) }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:underline motion-btn-spring">
                                    Public QR Verifier ↗
                                </a>
                                @if($profile->lor_issued)
                                    <a href="{{ route('admin.application.view-lor', $profile->id) }}" target="_blank" class="text-xs font-bold text-amber-600 hover:underline motion-btn-spring">
                                        View LOR ({{ $profile->lor_number }}) ↗
                                    </a>
                                @endif
                            </div>
                        @else
                            <p class="text-xs adm-text-muted">Awaiting final admin approval and certificate authorization from dashboard.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
    @endif

    <!-- Recent Applicants Quick Selector -->
    <div class="p-6 rounded-3xl adm-card shadow-xl space-y-3 motion-reveal">
        <h4 class="font-serif font-bold text-sm adm-text">Recently Enrolled Applicants (Quick Select)</h4>
        <div class="flex flex-wrap gap-2 text-xs">
            @foreach($recentStudents as $s)
                <a href="{{ route('admin.track', ['search' => $s->application_number]) }}" class="px-3 py-1.5 rounded-xl border {{ ($profile && $profile->id === $s->id) ? 'bg-indigo-600 text-white border-indigo-600 font-bold' : 'adm-card hover:border-indigo-500' }} transition motion-btn-spring">
                    {{ $s->user->name ?? 'Candidate' }} ({{ $s->application_number }})
                </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
