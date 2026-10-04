@extends('layouts.admin')

@section('title', 'Admin Command Center – Infinity Interns')

@section('content')
<div class="space-y-6">

    <!-- Top Command Center Banner -->
    <div class="relative overflow-hidden rounded-3xl adm-banner p-6 md:p-8 shadow-xl">
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
            <span class="font-serif text-9xl text-white select-none">∞</span>
        </div>

        <div class="relative z-10 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold mb-3 border border-white/20 backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Full Dynamic UGC Internship Control Hub</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 tracking-tight">
                Administrator Command Center & Dispatch Hub
            </h2>
            <p class="text-indigo-100 dark:text-slate-300 text-xs sm:text-sm leading-relaxed font-light">
                Complete dynamic management of student enrollments, instant offer letters, verified consent undertakings, capstone evaluation dockets, and tamper-proof UGC completion certificates.
            </p>

            <div class="mt-4 flex flex-wrap items-center gap-2.5 pt-2">
                <a href="{{ route('admin.certificate-generator') }}" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded-xl transition shadow-md shadow-emerald-900/20">
                    <span>⚡ Manual Certificate Generator</span>
                </a>
                <a href="{{ route('admin.streams') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/15 hover:bg-white/25 border border-white/20 px-3.5 py-2 rounded-xl transition">
                    <span>Manage Streams ({{ $stats['total_streams'] }})</span>
                </a>
                <a href="{{ route('admin.track') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/15 hover:bg-white/25 border border-white/20 px-3.5 py-2 rounded-xl transition">
                    <span>Track Application Lifecycle</span>
                </a>
                <a href="{{ route('admin.inquiries') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 px-3.5 py-2 rounded-xl transition">
                    <span>Inquiries Desk ({{ $stats['total_inquiries'] }})</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
        <!-- Total Applications -->
        <a href="{{ route('admin.dashboard', ['tab' => 'all']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition {{ $tab === 'all' ? 'ring-2 ring-indigo-500' : '' }}">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] adm-text-muted font-bold uppercase tracking-wider">Total Applications</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="text-2xl font-bold adm-text tracking-tight">{{ $stats['total'] }}</div>
            <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-medium">All Registrations</span>
        </a>

        <!-- Total Enrolled Students -->
        <a href="{{ route('admin.dashboard', ['tab' => 'enrolled']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition {{ $tab === 'enrolled' ? 'ring-2 ring-blue-500' : '' }}">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">Enrolled Students</span>
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            </div>
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-300 tracking-tight">{{ $stats['enrolled'] }}</div>
            <span class="text-[10px] adm-text-muted">Active & Approved</span>
        </a>

        <!-- Pending Approval -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider">Pending Review</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-2xl font-bold text-amber-600 dark:text-amber-300 tracking-tight">{{ $stats['pending'] }}</div>
            <span class="text-[10px] adm-text-muted">New Submissions</span>
        </div>

        <!-- Certificate Approval Access -->
        <a href="{{ route('admin.dashboard', ['tab' => 'pending_cert']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition {{ $tab === 'pending_cert' ? 'ring-2 ring-emerald-500' : '' }}">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider">Cert Pending</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-300 tracking-tight">{{ $stats['pending_cert'] }}</div>
            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium">Ready For Approval →</span>
        </a>

        <!-- Certificate Issued -->
        <a href="{{ route('admin.dashboard', ['tab' => 'issued_cert']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition {{ $tab === 'issued_cert' ? 'ring-2 ring-emerald-500' : '' }}">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider">Cert Issued</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-300 tracking-tight">{{ $stats['certificates_issued'] }}</div>
            <span class="text-[10px] adm-text-muted">QR Live & Verifiable</span>
        </a>

        <!-- LOR Issued -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-purple-600 dark:text-purple-400 font-bold uppercase tracking-wider">LOR Issued</span>
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
            </div>
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-300 tracking-tight">{{ $stats['lor_issued'] }}</div>
            <span class="text-[10px] adm-text-muted">Recommendation Letters</span>
        </div>
    </div>

    <!-- Navigation Tabs (Exact Handwritten Feature Tabs) -->
    <div class="flex items-center gap-2 border-b border-slate-200 dark:border-slate-800 pb-2 overflow-x-auto text-xs font-semibold">
        <a href="{{ route('admin.dashboard', ['tab' => 'all']) }}" class="px-4 py-2 rounded-xl transition whitespace-nowrap {{ $tab === 'all' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'adm-card text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
            <span>1. All Applications ({{ $stats['total'] }})</span>
        </a>

        <a href="{{ route('admin.dashboard', ['tab' => 'enrolled']) }}" class="px-4 py-2 rounded-xl transition whitespace-nowrap {{ $tab === 'enrolled' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'adm-card text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
            <span>2. Enrolled Students ({{ $stats['enrolled'] }})</span>
        </a>

        <a href="{{ route('admin.dashboard', ['tab' => 'pending_cert']) }}" class="px-4 py-2 rounded-xl transition whitespace-nowrap {{ $tab === 'pending_cert' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'adm-card text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
            <span>3. Certificate Approval Access ({{ $stats['pending_cert'] }})</span>
        </a>

        <a href="{{ route('admin.dashboard', ['tab' => 'issued_cert']) }}" class="px-4 py-2 rounded-xl transition whitespace-nowrap {{ $tab === 'issued_cert' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'adm-card text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
            <span>4. Certificates Issued ({{ $stats['certificates_issued'] }})</span>
        </a>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="p-4 rounded-2xl adm-card">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col lg:flex-row items-center justify-between gap-3 w-full">
            <input type="hidden" name="tab" value="{{ $tab }}">

            <div class="relative flex-1 w-full min-w-[240px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none adm-text-muted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name, college, email, phone, application ID, or certificate no..." class="w-full pl-10 pr-4 py-2.5 rounded-xl adm-input text-xs placeholder-slate-400">
            </div>

            <div class="flex items-center flex-wrap gap-2.5 w-full lg:w-auto">
                <select name="status" class="px-3 py-2.5 rounded-xl adm-input text-xs">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                    <option value="APPROVED" {{ request('status') == 'APPROVED' ? 'selected' : '' }}>Approved</option>
                    <option value="ACTIVE" {{ request('status') == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                    <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                    <option value="REJECTED" {{ request('status') == 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                </select>

                <select name="degree" class="px-3 py-2.5 rounded-xl adm-input text-xs">
                    <option value="all" {{ request('degree') == 'all' ? 'selected' : '' }}>All Degrees</option>
                    <option value="BA" {{ request('degree') == 'BA' ? 'selected' : '' }}>BA</option>
                    <option value="BSc" {{ request('degree') == 'BSc' ? 'selected' : '' }}>BSc</option>
                    <option value="BBA" {{ request('degree') == 'BBA' ? 'selected' : '' }}>BBA</option>
                    <option value="BCA" {{ request('degree') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="BCom" {{ request('degree') == 'BCom' ? 'selected' : '' }}>BCom</option>
                </select>

                <select name="domain" class="px-3 py-2.5 rounded-xl adm-input text-xs max-w-xs">
                    <option value="all" {{ request('domain') == 'all' ? 'selected' : '' }}>All Streams (Dynamic)</option>
                    @foreach($streams as $stream)
                        <option value="{{ $stream->title }}" {{ request('domain') == $stream->title ? 'selected' : '' }}>
                            {{ $stream->title }} ({{ $stream->code }})
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer">
                    Filter
                </button>

                @if(request('search') || (request('status') && request('status') !== 'all') || (request('degree') && request('degree') !== 'all') || (request('domain') && request('domain') !== 'all') || $tab !== 'all')
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Applications Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h3 class="font-serif font-bold text-base adm-text">Manage Student Applicants</h3>
                <p class="text-[11px] adm-text-muted">Full administrative editing of candidate records, dynamic domain mapping, attendance hours, and document releases.</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-700/50">
                Showing {{ $applications->total() }} Records
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Applicant & ID</th>
                        <th class="py-3.5 px-4 font-bold">Degree & Institute</th>
                        <th class="py-3.5 px-4 font-bold">Internship Stream</th>
                        <th class="py-3.5 px-4 font-bold">Status</th>
                        <th class="py-3.5 px-4 font-bold">Documents Suite</th>
                        <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($applications as $app)
                    <tr class="adm-table-row transition">
                        <!-- Student Info -->
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 font-bold text-xs flex items-center justify-center shrink-0 border border-indigo-200 dark:border-indigo-500/30 shadow-xs">
                                    {{ substr($app->user->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold adm-text text-sm block leading-tight">{{ $app->user->name ?? 'Candidate' }}</span>
                                    </div>
                                    <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[11px] block font-semibold">{{ $app->application_number }}</span>
                                    <span class="adm-text-muted text-[11px] block">{{ $app->user->email ?? 'N/A' }} • {{ $app->user->phone ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Degree & College -->
                        <td class="py-4 px-4">
                            <span class="font-semibold adm-text-secondary block">{{ $app->degree }} • {{ $app->semester }}</span>
                            <span class="adm-text-muted text-[11px] block max-w-xs truncate" title="{{ $app->college }}">{{ $app->college }}</span>
                            <span class="text-[10px] text-slate-400">Mentor: <strong>{{ $app->mentor_name }}</strong></span>
                        </td>

                        <!-- Domain -->
                        <td class="py-4 px-4">
                            <span class="text-indigo-700 dark:text-indigo-300 font-semibold block max-w-xs leading-snug">{{ $app->program_domain }}</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="adm-text-muted text-[10px]">Attendance:</span>
                                <span class="px-1.5 py-0.2 rounded font-bold text-[10px] {{ $app->attendance_rate >= 75 ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300' }}">
                                    {{ $app->attendance_rate }}%
                                </span>
                            </div>
                        </td>

                        <!-- Status Badge & Quick Change -->
                        <td class="py-4 px-4">
                            <form action="{{ route('admin.application.status', $app->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-[11px] font-bold rounded-lg px-2.5 py-1 transition cursor-pointer
                                    {{ $app->status === 'PENDING' ? 'adm-badge-pending' : '' }}
                                    {{ $app->status === 'APPROVED' ? 'adm-badge-approved' : '' }}
                                    {{ $app->status === 'ACTIVE' ? 'adm-badge-active' : '' }}
                                    {{ $app->status === 'COMPLETED' ? 'adm-badge-completed' : '' }}
                                    {{ $app->status === 'REJECTED' ? 'adm-badge-rejected' : '' }}
                                ">
                                    <option value="PENDING" {{ $app->status === 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                    <option value="APPROVED" {{ $app->status === 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="ACTIVE" {{ $app->status === 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                                    <option value="COMPLETED" {{ $app->status === 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
                                    <option value="REJECTED" {{ $app->status === 'REJECTED' ? 'selected' : '' }}>REJECTED</option>
                                </select>
                            </form>
                        </td>

                        <!-- Documents Suite -->
                        <td class="py-4 px-4 space-y-1">
                            <!-- 1. Offer Letter -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->offer_letter_issued)
                                    <span class="text-blue-600 dark:text-blue-400 font-bold">✓</span>
                                    <a href="{{ route('admin.application.view-offer-letter', $app->id) }}" target="_blank" class="text-blue-600 dark:text-blue-300 font-medium hover:underline">Offer Letter ↗</a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Offer Letter</span>
                                @endif
                            </div>

                            <!-- 2. Consent Letter -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->consent_letter_issued)
                                    <span class="text-purple-600 dark:text-purple-400 font-bold">✓</span>
                                    <a href="{{ route('admin.application.view-consent-letter', $app->id) }}" target="_blank" class="text-purple-600 dark:text-purple-300 font-medium hover:underline">Consent Letter ↗</a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Consent Letter</span>
                                @endif
                            </div>

                            <!-- 3. Completion Certificate -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->certificate_issued)
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold">✓</span>
                                    <a href="{{ route('admin.application.view-certificate', $app->id) }}" target="_blank" class="text-emerald-600 dark:text-emerald-300 font-medium hover:underline font-mono text-[10px]">
                                        {{ $app->certificate_number }} ↗
                                    </a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Certificate</span>
                                @endif
                            </div>

                            <!-- 4. LOR -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->lor_issued)
                                    <span class="text-amber-600 dark:text-amber-400 font-bold">✓</span>
                                    <a href="{{ route('admin.application.view-lor', $app->id) }}" target="_blank" class="text-amber-600 dark:text-amber-300 font-medium hover:underline font-mono text-[10px]">
                                        LOR ({{ $app->lor_number }}) ↗
                                    </a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">LOR</span>
                                @endif
                            </div>

                            <!-- 5. Marksheet -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->marksheet_issued)
                                    <span class="text-indigo-600 dark:text-indigo-400 font-bold">✓</span>
                                    <a href="{{ route('admin.application.view-marksheet', $app->id) }}" target="_blank" class="text-indigo-600 dark:text-indigo-300 font-medium hover:underline text-[10px]">
                                        Scorecard ({{ $app->marksheet_grade }} - {{ $app->marksheet_marks }}%) ↗
                                    </a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Scorecard</span>
                                @endif
                            </div>
                        </td>

                        <!-- Actions Dropdown / Modal Triggers -->
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5 flex-wrap">
                                <!-- 1. Edit Full Applicant Modal Trigger -->
                                <button type="button" onclick="openEditApplicantModal({{ json_encode($app) }}, {{ json_encode($app->user) }})" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700 text-[10px] font-bold transition cursor-pointer" title="Edit Student Record">
                                    ✎ Edit
                                </button>

                                <!-- 2. Certificate Approval Access Button -->
                                @if(!$app->certificate_issued)
                                    <button type="button" onclick="openCertApprovalModal('{{ $app->id }}', '{{ $app->application_number }}', '{{ addslashes($app->user->name ?? 'Candidate') }}')" class="px-2.5 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 hover:bg-emerald-200 dark:hover:bg-emerald-800 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 text-[10px] font-bold transition cursor-pointer shadow-xs">
                                        + Cert Approve
                                    </button>
                                @endif

                                <!-- 3. Issue LOR Button -->
                                @if(!$app->lor_issued)
                                    <button type="button" onclick="openLorModal('{{ $app->id }}', '{{ $app->application_number }}', '{{ addslashes($app->user->name ?? 'Candidate') }}')" class="px-2.5 py-1 rounded-lg bg-amber-100 dark:bg-amber-900/40 hover:bg-amber-200 dark:hover:bg-amber-800 text-amber-800 dark:text-amber-300 border border-amber-300 dark:border-amber-700/50 text-[10px] font-bold transition cursor-pointer shadow-xs">
                                        + Issue LOR
                                    </button>
                                @endif

                                <!-- 4. Issue Consent Letter Button -->
                                @if(!$app->consent_letter_issued)
                                    <form action="{{ route('admin.application.consent-letter', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Issue Consent Letter" class="px-2.5 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/40 hover:bg-purple-200 dark:hover:bg-purple-800 text-purple-800 dark:text-purple-300 border border-purple-300 dark:border-purple-700/50 text-[10px] font-semibold transition cursor-pointer">
                                            + Consent
                                        </button>
                                    </form>
                                @endif

                                <!-- 5. Issue Offer Letter Button -->
                                @if(!$app->offer_letter_issued)
                                    <form action="{{ route('admin.application.offer-letter', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Issue Offer Letter" class="px-2.5 py-1 rounded-lg bg-blue-100 dark:bg-blue-900/40 hover:bg-blue-200 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-300 border border-blue-300 dark:border-blue-700/50 text-[10px] font-semibold transition cursor-pointer">
                                            + Offer
                                        </button>
                                    </form>
                                @endif

                                <!-- 6. Issue Marksheet Modal Trigger -->
                                @if(!$app->marksheet_issued)
                                    <button type="button" onclick="openMarksheetModal('{{ $app->id }}', '{{ $app->application_number }}')" title="Issue Marksheet" class="px-2.5 py-1 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 hover:bg-indigo-200 dark:hover:bg-indigo-800 text-indigo-800 dark:text-indigo-300 border border-indigo-300 dark:border-indigo-700/50 text-[10px] font-semibold transition cursor-pointer">
                                        + Marksheet
                                    </button>
                                @endif

                                <!-- 7. Track Application Link -->
                                <a href="{{ route('admin.track', ['search' => $app->application_number]) }}" class="px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 text-slate-700 dark:text-slate-300 hover:text-indigo-600 border border-slate-200 dark:border-slate-700 text-[10px] font-semibold transition" title="Track Lifecycle">
                                    Track
                                </a>

                                <!-- 8. Delete -->
                                <form action="{{ route('admin.application.delete', $app->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this student application and credentials?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer" title="Delete Application">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center adm-text-muted text-xs">
                            No student applications match the selected criteria or filter tab.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-800 adm-table-head">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

</div>

<!-- ========================================================
     MODALS SECTION
     ======================================================== -->

<!-- 1. Edit Full Applicant Modal -->
<div id="editApplicantModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
    <div class="relative w-full max-w-2xl my-8 rounded-3xl adm-card p-6 sm:p-8 shadow-2xl space-y-5">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-bold adm-text">Edit Student Applicant & Documentation Record</h3>
                <p class="text-xs adm-text-muted" id="editAppNumberLabel"></p>
            </div>
            <button onclick="closeEditApplicantModal()" class="adm-text-muted hover:adm-text font-bold text-xl cursor-pointer">&times;</button>
        </div>

        <form id="editApplicantForm" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Full Student Name *</label>
                    <input type="text" name="name" id="edit_name" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Email Address *</label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Phone Number *</label>
                    <input type="text" name="phone" id="edit_phone" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Degree Program *</label>
                    <select name="degree" id="edit_degree" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        <option value="BA">Bachelor of Arts (BA)</option>
                        <option value="BSc">Bachelor of Science (BSc)</option>
                        <option value="BBA">Bachelor of Business Admin (BBA)</option>
                        <option value="BCA">Bachelor of Computer App (BCA)</option>
                        <option value="BCom">Bachelor of Commerce (BCom)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Current Semester *</label>
                    <select name="semester" id="edit_semester" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="3rd Semester">3rd Semester</option>
                        <option value="4th Semester">4th Semester</option>
                        <option value="5th Semester">5th Semester</option>
                        <option value="6th Semester">6th Semester</option>
                        <option value="7th/8th Semester">7th/8th Semester</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Application Status *</label>
                    <select name="status" id="edit_status" required class="w-full px-3 py-2 rounded-xl adm-input text-xs font-bold">
                        <option value="PENDING">PENDING</option>
                        <option value="APPROVED">APPROVED</option>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="COMPLETED">COMPLETED</option>
                        <option value="REJECTED">REJECTED</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">College / Institute Name *</label>
                <input type="text" name="college" id="edit_college" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Internship Stream Domain Track *</label>
                <select name="program_domain" id="edit_domain" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                    @foreach($streams as $stream)
                        <option value="{{ $stream->title }}">{{ $stream->title }} ({{ $stream->code }})</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Assigned Faculty Mentor *</label>
                    <input type="text" name="mentor_name" id="edit_mentor" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Verified Attendance (%) *</label>
                    <input type="number" name="attendance_rate" id="edit_attendance" min="0" max="100" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Capstone Project Title *</label>
                <input type="text" name="project_title" id="edit_project_title" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>

            <!-- Documents Release Checkboxes & Values -->
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 block">Controlled Official Documents</span>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="offer_letter_issued" id="edit_offer_letter" class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="adm-text font-medium">Offer & Acceptance Letter Released</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="consent_letter_issued" id="edit_consent_letter" class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="adm-text font-medium">Official Consent Undertaking Released</span>
                    </label>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer mb-1">
                            <input type="checkbox" name="certificate_issued" id="edit_certificate" class="rounded text-indigo-600 focus:ring-indigo-500">
                            <span class="adm-text font-medium">Completion Certificate Approved</span>
                        </label>
                        <input type="text" name="certificate_number" id="edit_cert_number" placeholder="Certificate Serial No" class="w-full px-2.5 py-1.5 rounded-lg adm-input text-[11px] font-mono">
                    </div>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer mb-1">
                            <input type="checkbox" name="lor_issued" id="edit_lor" class="rounded text-indigo-600 focus:ring-indigo-500">
                            <span class="adm-text font-medium">Letter of Recommendation (LOR)</span>
                        </label>
                        <input type="text" name="lor_number" id="edit_lor_number" placeholder="LOR Reference No" class="w-full px-2.5 py-1.5 rounded-lg adm-input text-[11px] font-mono">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeEditApplicantModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Save All Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Certificate Approval Access Modal -->
<div id="certApprovalModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-3xl adm-card p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold text-emerald-600 dark:text-emerald-400">Approve & Issue UGC Certificate</h3>
            <button onclick="closeCertApprovalModal()" class="adm-text-muted hover:adm-text font-bold text-lg cursor-pointer">&times;</button>
        </div>
        <p class="text-xs adm-text-muted" id="certApprovalCandidateText"></p>

        <form id="certApprovalForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Certificate Serial Number (Unique)</label>
                <input type="text" name="certificate_number" id="approval_cert_number" required class="w-full px-3 py-2 rounded-xl adm-input text-xs font-mono">
                <p class="text-[10px] text-slate-400 mt-1">Leave as auto-generated or specify a custom UGC serial.</p>
            </div>
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Official Issue Date</label>
                <input type="date" name="certificate_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>
            <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/40 text-[11px] text-emerald-800 dark:text-emerald-200">
                Approving this certificate will automatically mark the student application status as <strong>COMPLETED</strong> and enable instant QR verification.
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeCertApprovalModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-lg shadow-emerald-600/30 cursor-pointer">Approve & Issue Certificate</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. Issue LOR Modal -->
<div id="lorModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-3xl adm-card p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold text-amber-600 dark:text-amber-400">Issue Letter of Recommendation</h3>
            <button onclick="closeLorModal()" class="adm-text-muted hover:adm-text font-bold text-lg cursor-pointer">&times;</button>
        </div>
        <p class="text-xs adm-text-muted" id="lorCandidateText"></p>

        <form id="lorForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">LOR Reference Number</label>
                <input type="text" name="lor_number" id="lor_number_input" required class="w-full px-3 py-2 rounded-xl adm-input text-xs font-mono">
            </div>
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Issue Date</label>
                <input type="date" name="lor_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Faculty Commendation / Remarks</label>
                <textarea name="lor_remarks" rows="2" class="w-full px-3 py-2 rounded-xl adm-input text-xs">Demonstrated exceptional technical aptitude, exemplary teamwork, and consistent commitment to academic deliverables.</textarea>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeLorModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition shadow-lg shadow-amber-600/30 cursor-pointer">Issue LOR</button>
            </div>
        </form>
    </div>
</div>

<!-- 4. Issue Marksheet Modal -->
<div id="marksheetModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-3xl adm-card p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold adm-text">Generate Official Marksheet Scorecard</h3>
            <button onclick="closeMarksheetModal()" class="adm-text-muted hover:adm-text font-bold text-lg cursor-pointer">&times;</button>
        </div>
        <p class="text-xs adm-text-muted" id="marksheetAppIdText"></p>

        <form id="marksheetForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Overall Grade</label>
                <select name="marksheet_grade" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                    <option value="A+">A+ (Outstanding - 90%+)</option>
                    <option value="A">A (Excellent - 80-89%)</option>
                    <option value="B+">B+ (Very Good - 70-79%)</option>
                    <option value="B">B (Good - 60-69%)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Evaluated Total Marks (%)</label>
                <input type="number" name="marksheet_marks" value="94" min="0" max="100" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeMarksheetModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Generate Scorecard</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openEditApplicantModal(app, user) {
        document.getElementById('editAppNumberLabel').innerText = 'Application: ' + app.application_number;
        document.getElementById('editApplicantForm').action = '/admin/applications/' + app.id + '/update-full';

        document.getElementById('edit_name').value = user ? user.name : '';
        document.getElementById('edit_email').value = user ? user.email : '';
        document.getElementById('edit_phone').value = user ? (user.phone || '') : '';
        document.getElementById('edit_college').value = app.college || '';
        document.getElementById('edit_degree').value = app.degree || 'BSc';
        document.getElementById('edit_semester').value = app.semester || '5th Semester';
        document.getElementById('edit_status').value = app.status || 'PENDING';
        document.getElementById('edit_domain').value = app.program_domain || '';
        document.getElementById('edit_mentor').value = app.mentor_name || '';
        document.getElementById('edit_attendance').value = app.attendance_rate || 90;
        document.getElementById('edit_project_title').value = app.project_title || '';

        document.getElementById('edit_offer_letter').checked = !!app.offer_letter_issued;
        document.getElementById('edit_consent_letter').checked = !!app.consent_letter_issued;
        document.getElementById('edit_certificate').checked = !!app.certificate_issued;
        document.getElementById('edit_cert_number').value = app.certificate_number || '';
        document.getElementById('edit_lor').checked = !!app.lor_issued;
        document.getElementById('edit_lor_number').value = app.lor_number || '';

        document.getElementById('editApplicantModal').classList.remove('hidden');
    }

    function closeEditApplicantModal() {
        document.getElementById('editApplicantModal').classList.add('hidden');
    }

    function openCertApprovalModal(appId, appNumber, candidateName) {
        document.getElementById('certApprovalCandidateText').innerText = 'Approving completion certificate for candidate ' + candidateName + ' (' + appNumber + ')';
        document.getElementById('certApprovalForm').action = '/admin/applications/' + appId + '/issue-certificate';
        document.getElementById('approval_cert_number').value = 'UGC-INF-' + Math.floor(100000 + Math.random() * 900000);
        document.getElementById('certApprovalModal').classList.remove('hidden');
    }

    function closeCertApprovalModal() {
        document.getElementById('certApprovalModal').classList.add('hidden');
    }

    function openLorModal(appId, appNumber, candidateName) {
        document.getElementById('lorCandidateText').innerText = 'Issuing recommendation for ' + candidateName + ' (' + appNumber + ')';
        document.getElementById('lorForm').action = '/admin/applications/' + appId + '/issue-lor';
        document.getElementById('lor_number_input').value = 'INF-LOR-2026-' + Math.floor(1000 + Math.random() * 9000);
        document.getElementById('lorModal').classList.remove('hidden');
    }

    function closeLorModal() {
        document.getElementById('lorModal').classList.add('hidden');
    }

    function openMarksheetModal(appId, appNumber) {
        document.getElementById('marksheetAppIdText').innerText = 'Issuing evaluation scorecard for application ' + appNumber;
        document.getElementById('marksheetForm').action = '/admin/applications/' + appId + '/issue-marksheet';
        document.getElementById('marksheetModal').classList.remove('hidden');
    }

    function closeMarksheetModal() {
        document.getElementById('marksheetModal').classList.add('hidden');
    }
</script>
@endsection
