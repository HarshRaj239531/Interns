@extends('layouts.admin')

@section('title', 'Admin Command Center – Infinity Interns')

@section('content')
<div class="space-y-6">

    @if($tab === 'overview')
    <!-- Top Command Center Banner -->
    <div class="relative overflow-hidden rounded-3xl adm-banner p-6 md:p-8 shadow-xl motion-reveal">
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none motion-orb"></div>
        <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
            <span class="font-serif text-9xl text-white select-none">∞</span>
        </div>

        <div class="relative z-10 max-w-4xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold mb-3 border border-white/20 backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>UGC Internship Administration Hub</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 tracking-tight">
                Administrator Command Center
            </h2>
            <p class="text-indigo-100 dark:text-slate-300 text-xs sm:text-sm leading-relaxed font-light">
                Centralized dashboard for tracking student applications, managing active interns, reviewing certificate approvals, and issuing verifiable credentials.
            </p>

            <div class="mt-5 flex flex-wrap items-center gap-2.5 pt-1">
                <button type="button" onclick="openAddApplicantModal()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded-xl transition shadow-md shadow-indigo-900/30 cursor-pointer motion-btn-spring">
                    <span>+ Add New Applicant</span>
                </button>
                <a href="{{ route('admin.certificate-generator') }}" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded-xl transition shadow-md shadow-emerald-900/30 motion-btn-spring">
                    <span>⚡ Certificate Generator</span>
                </a>
                <a href="{{ route('admin.academic-setup', ['tab' => 'degrees']) }}" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 border border-indigo-400/40 px-3.5 py-2 rounded-xl transition shadow-md shadow-indigo-950/40 motion-btn-spring">
                    <span>🎓 Academic Setup (Degrees • Colleges)</span>
                </a>
                <a href="{{ route('admin.track') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/15 hover:bg-white/25 border border-white/20 px-3.5 py-2 rounded-xl transition motion-btn-spring">
                    <span>Track Lifecycle</span>
                </a>
                <a href="{{ route('admin.applications.export', request()->query()) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 px-3.5 py-2 rounded-xl transition motion-btn-spring" title="Export current dataset to CSV">
                    <span>📥 Export CSV</span>
                </a>
                <a href="{{ route('admin.inquiries') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 px-3.5 py-2 rounded-xl transition motion-btn-spring">
                    <span>Inquiries ({{ $stats['total_inquiries'] }})</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Overview Metric Cards Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4 motion-stagger">
        <!-- Total Applications -->
        <a href="{{ route('admin.dashboard', ['tab' => 'all']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition motion-card-hover group">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] adm-text-muted font-bold uppercase tracking-wider group-hover:text-indigo-600 transition">Applications</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="text-2xl font-bold adm-text tracking-tight motion-counter" data-target="{{ $stats['total'] }}">{{ $stats['total'] }}</div>
            <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-medium">Total Registered</span>
        </a>

        <!-- Enrolled Students -->
        <a href="{{ route('admin.dashboard', ['tab' => 'enrolled']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition motion-card-hover group">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">Enrolled</span>
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            </div>
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-300 tracking-tight motion-counter" data-target="{{ $stats['enrolled'] }}">{{ $stats['enrolled'] }}</div>
            <span class="text-[10px] adm-text-muted">Approved & Active</span>
        </a>

        <!-- Pending Review -->
        <a href="{{ route('admin.dashboard', ['tab' => 'all', 'status' => 'PENDING']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition motion-card-hover group">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider">Pending Review</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-2xl font-bold text-amber-600 dark:text-amber-300 tracking-tight motion-counter" data-target="{{ $stats['pending'] }}">{{ $stats['pending'] }}</div>
            <span class="text-[10px] adm-text-muted">New Applications</span>
        </a>

        <!-- Certificate Approval -->
        <a href="{{ route('admin.dashboard', ['tab' => 'pending_cert']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition motion-card-hover group">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider">Cert Approvals</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-2xl font-bold text-amber-600 dark:text-amber-300 tracking-tight motion-counter" data-target="{{ $stats['pending_cert'] }}">{{ $stats['pending_cert'] }}</div>
            <span class="text-[10px] text-amber-600 dark:text-amber-400 font-medium">Ready for Issue →</span>
        </a>

        <!-- Certificates Issued -->
        <a href="{{ route('admin.dashboard', ['tab' => 'issued_cert']) }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition motion-card-hover group">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider">Cert Issued</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-300 tracking-tight motion-counter" data-target="{{ $stats['certificates_issued'] }}">{{ $stats['certificates_issued'] }}</div>
            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium">QR Verifiable</span>
        </a>

        <!-- Streams / Tracks -->
        <a href="{{ route('admin.streams') }}" class="p-4 rounded-2xl adm-card block hover:scale-[1.02] transition motion-card-hover group">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-purple-600 dark:text-purple-400 font-bold uppercase tracking-wider">Streams</span>
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
            </div>
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-300 tracking-tight motion-counter" data-target="{{ $stats['total_streams'] }}">{{ $stats['total_streams'] }}</div>
            <span class="text-[10px] adm-text-muted">Dynamic Tracks</span>
        </a>
    </div>

    <!-- Overview Interactive Screen Body -->
    <div class="space-y-6 motion-reveal">
        <!-- Quick Action Dispatch Hub -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <button type="button" onclick="openAddApplicantModal()" class="p-5 rounded-2xl adm-card border border-indigo-200 dark:border-indigo-800/60 hover:border-indigo-500 text-left transition group shadow-md motion-card-hover cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 flex items-center justify-center text-lg font-bold mb-3 group-hover:scale-110 transition">
                    +
                </div>
                <h4 class="font-serif font-bold text-sm adm-text mb-1">Add Student Applicant</h4>
                <p class="text-[11px] adm-text-muted">Enroll a new student directly into any UGC specialization track.</p>
            </button>

            <a href="{{ route('admin.certificate-generator') }}" class="p-5 rounded-2xl adm-card border border-emerald-200 dark:border-emerald-800/60 hover:border-emerald-500 text-left transition group shadow-md motion-card-hover">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-lg font-bold mb-3 group-hover:scale-110 transition">
                    ⚡
                </div>
                <h4 class="font-serif font-bold text-sm adm-text mb-1">Manual Certificate Generator</h4>
                <p class="text-[11px] adm-text-muted">Authorize, customize, and print verifiable UGC completion certificates.</p>
            </a>

            <a href="{{ route('admin.streams') }}" class="p-5 rounded-2xl adm-card border border-purple-200 dark:border-purple-800/60 hover:border-purple-500 text-left transition group shadow-md motion-card-hover">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 flex items-center justify-center text-lg font-bold mb-3 group-hover:scale-110 transition">
                    📚
                </div>
                <h4 class="font-serif font-bold text-sm adm-text mb-1">Add / Manage Streams</h4>
                <p class="text-[11px] adm-text-muted">Configure academic domains, contact hours, and UGC credit weights.</p>
            </a>

            <a href="{{ route('admin.track') }}" class="p-5 rounded-2xl adm-card border border-blue-200 dark:border-blue-800/60 hover:border-blue-500 text-left transition group shadow-md motion-card-hover">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 flex items-center justify-center text-lg font-bold mb-3 group-hover:scale-110 transition">
                    🔍
                </div>
                <h4 class="font-serif font-bold text-sm adm-text mb-1">Track Application Lifecycle</h4>
                <p class="text-[11px] adm-text-muted">Visual 7-step milestone tracker for any candidate application or serial ID.</p>
            </a>
        </div>

        <!-- Dynamic Internship Streams & Specialization Tracks Grid -->
        <div class="rounded-3xl adm-card p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                        <h3 class="font-serif font-bold text-base adm-text">Specialization Tracks & Stream Enrollment Distribution</h3>
                    </div>
                    <p class="text-[11px] adm-text-muted">Dynamic internship specialization domains configured in the central catalog.</p>
                </div>
                <a href="{{ route('admin.streams') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                    Manage All Streams ({{ $stats['total_streams'] }}) →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($streamDistribution as $st)
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 space-y-2 hover:border-indigo-400 dark:hover:border-indigo-600 transition">
                    <div class="flex items-center justify-between">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300">
                            {{ $st->code }}
                        </span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $st->is_active ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300' : 'bg-slate-200 text-slate-600' }}">
                            {{ $st->is_active ? 'ACTIVE' : 'INACTIVE' }}
                        </span>
                    </div>
                    <h5 class="font-serif font-bold text-xs adm-text leading-snug line-clamp-1" title="{{ $st->title }}">
                        {{ $st->title }}
                    </h5>
                    <div class="flex items-center justify-between text-[11px] adm-text-muted">
                        <span>{{ $st->duration }}</span>
                        <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $st->credits }}</span>
                    </div>
                    <div class="pt-2 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between text-xs">
                        <span class="text-[11px] adm-text-muted">Enrolled Interns:</span>
                        <a href="{{ route('admin.dashboard', ['tab' => 'all', 'domain' => $st->title]) }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ $st->student_profiles_count }} Students →
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-8 text-center adm-text-muted text-xs">
                    No streams configured yet. Click "Manage Streams" to add internship specialization tracks.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Split Grid: Recent Applications & Recent Issued Certificates -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Col 7: Recent Applications Feed -->
            <div class="lg:col-span-7 rounded-3xl adm-card p-6 shadow-xl space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
                    <div>
                        <h4 class="font-serif font-bold text-sm adm-text">Recent Student Registrations</h4>
                        <p class="text-[11px] adm-text-muted">Latest applicant records received across participating colleges.</p>
                    </div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'all']) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                        View All ({{ $stats['total'] }}) →
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentApplications as $rapp)
                    <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex items-center justify-between gap-3 hover:border-slate-300 dark:hover:border-slate-700 transition">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 font-bold text-xs flex items-center justify-center shrink-0">
                                {{ substr($rapp->user->name ?? 'S', 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-xs adm-text truncate">{{ $rapp->user->name ?? 'Candidate' }}</span>
                                    <span class="font-mono text-[10px] text-indigo-600 dark:text-indigo-400 font-semibold">{{ $rapp->application_number }}</span>
                                </div>
                                <span class="text-[11px] adm-text-muted block truncate">{{ $rapp->college }} • {{ $rapp->program_domain }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                {{ $rapp->status === 'COMPLETED' ? 'adm-badge-completed' : '' }}
                                {{ $rapp->status === 'ACTIVE' ? 'adm-badge-active' : '' }}
                                {{ $rapp->status === 'APPROVED' ? 'adm-badge-approved' : '' }}
                                {{ $rapp->status === 'PENDING' ? 'adm-badge-pending' : '' }}
                                {{ $rapp->status === 'REJECTED' ? 'adm-badge-rejected' : '' }}
                            ">
                                {{ $rapp->status }}
                            </span>
                            <button type="button" onclick="openEditApplicantModal({{ json_encode($rapp) }}, {{ json_encode($rapp->user) }})" class="px-2 py-1 rounded-lg bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-[10px] font-bold transition cursor-pointer">
                                ✎ Manage
                            </button>
                        </div>
                    </div>
                    @empty
                    <p class="py-6 text-center text-xs adm-text-muted">No student applications recorded yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Col 5: Live Verifiable Issued Certificates -->
            <div class="lg:col-span-5 rounded-3xl adm-card p-6 shadow-xl space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
                    <div>
                        <h4 class="font-serif font-bold text-sm adm-text">Recent Verified Certificates</h4>
                        <p class="text-[11px] adm-text-muted">Live tamper-proof UGC completion records.</p>
                    </div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'issued_cert']) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                        View All ({{ $stats['certificates_issued'] }}) →
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentCertificates as $rcert)
                    <div class="p-3.5 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800/40 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <span class="font-bold text-xs adm-text block truncate">{{ $rcert->user->name ?? 'Candidate' }}</span>
                            <span class="font-mono text-emerald-700 dark:text-emerald-300 text-[11px] font-bold block">{{ $rcert->certificate_number }}</span>
                            <span class="text-[10px] text-slate-500 block truncate">{{ $rcert->program_domain }}</span>
                        </div>
                        <div class="flex flex-col items-end gap-1 shrink-0">
                            <a href="{{ route('admin.application.view-certificate', $rcert->id) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] transition shadow-xs">
                                View Cert ↗
                            </a>
                            <a href="{{ route('verify', $rcert->certificate_number) }}" target="_blank" class="text-[10px] text-indigo-600 dark:text-indigo-400 hover:underline">
                                Verify Online ↗
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="py-6 text-center text-xs adm-text-muted space-y-2">
                        <p>No certificates issued yet.</p>
                        <a href="{{ route('admin.certificate-generator') }}" class="inline-block text-emerald-600 dark:text-emerald-400 font-bold hover:underline">
                            Issue First Certificate →
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- ========================================================
         TABLE VIEW: TOTAL APPLICATIONS, ENROLLED STUDENTS, 
         CERTIFICATE APPROVAL ACCESS, CERTIFICATES ISSUED, MANAGE
         ======================================================== -->

    <!-- Dedicated Section Page Header -->
    <div class="p-5 sm:p-6 rounded-3xl adm-card border border-slate-200/80 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-sm">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0
                {{ $tab === 'pending_cert' ? 'bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400' : '' }}
                {{ $tab === 'enrolled' ? 'bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400' : '' }}
                {{ $tab === 'issued_cert' ? 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400' : '' }}
                {{ in_array($tab, ['all', 'manage']) ? 'bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400' : '' }}
            ">
                @if($tab === 'pending_cert')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif($tab === 'enrolled')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                @elseif($tab === 'issued_cert')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                @elseif($tab === 'manage')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                @endif
            </div>
            <div>
                <div class="flex items-center gap-2.5">
                    <h2 class="text-base sm:text-lg font-bold font-serif adm-text tracking-tight">
                        @if($tab === 'pending_cert')
                            Certificate Approvals
                        @elseif($tab === 'enrolled')
                            Enrolled Students
                        @elseif($tab === 'issued_cert')
                            Issued Certificates
                        @else
                            All Applications
                        @endif
                    </h2>
                    <span class="text-[11px] px-2.5 py-0.5 rounded-full font-bold
                        {{ $tab === 'pending_cert' ? 'bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300' : '' }}
                        {{ $tab === 'enrolled' ? 'bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300' : '' }}
                        {{ $tab === 'issued_cert' ? 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300' : '' }}
                        {{ !in_array($tab, ['pending_cert', 'enrolled', 'issued_cert']) ? 'bg-indigo-100 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300' : '' }}
                    ">
                        @if($tab === 'pending_cert')
                            {{ $stats['pending_cert'] }} Ready for Issuance
                        @elseif($tab === 'enrolled')
                            {{ $stats['enrolled'] }} Active Interns
                        @elseif($tab === 'issued_cert')
                            {{ $stats['certificates_issued'] }} Issued
                        @else
                            {{ $stats['total'] }} Applications @if($stats['pending'] > 0) ({{ $stats['pending'] }} Pending Review) @endif
                        @endif
                    </span>
                </div>
                <p class="text-xs adm-text-muted mt-0.5">
                    @if($tab === 'pending_cert')
                        Review candidates eligible for final completion certificate verification and authorized dispatch.
                    @elseif($tab === 'enrolled')
                        Active student interns currently undergoing training across colleges and specialization streams.
                    @elseif($tab === 'issued_cert')
                        Official verifiable completion certificates issued with public QR verification links.
                    @else
                        Review incoming student applications. Approve candidates to enroll them as active interns or reject them.
                    @endif
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <button type="button" onclick="openAddApplicantModal()" class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold transition shadow-sm motion-btn-spring cursor-pointer flex items-center gap-1.5">
                <span>+</span>
                <span>Add Applicant</span>
            </button>
            <a href="{{ route('admin.applications.export', request()->query()) }}" class="px-4 py-2.5 rounded-xl adm-card hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold adm-text transition flex items-center gap-1.5 motion-btn-spring">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <span>Export CSV</span>
            </a>
        </div>
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
                    @if(isset($degrees))
                        @foreach($degrees as $deg)
                            <option value="{{ $deg->code }}" {{ request('degree') == $deg->code ? 'selected' : '' }}>{{ $deg->code }} ({{ $deg->name }})</option>
                        @endforeach
                    @else
                        <option value="BA" {{ request('degree') == 'BA' ? 'selected' : '' }}>BA</option>
                        <option value="BSc" {{ request('degree') == 'BSc' ? 'selected' : '' }}>BSc</option>
                        <option value="BBA" {{ request('degree') == 'BBA' ? 'selected' : '' }}>BBA</option>
                        <option value="BCA" {{ request('degree') == 'BCA' ? 'selected' : '' }}>BCA</option>
                        <option value="BCom" {{ request('degree') == 'BCom' ? 'selected' : '' }}>BCom</option>
                    @endif
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

                @if(request('search') || (request('status') && request('status') !== 'all') || (request('degree') && request('degree') !== 'all') || (request('domain') && request('domain') !== 'all'))
                    <a href="{{ route('admin.dashboard', ['tab' => $tab]) }}" class="px-3.5 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-xs font-semibold transition cursor-pointer">
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
                <h3 class="font-serif font-bold text-base adm-text">
                    @if($tab === 'enrolled')
                        Enrolled Interns Registry
                    @elseif($tab === 'pending_cert')
                        Certificate Issuance Queue
                    @elseif($tab === 'issued_cert')
                        Issued Verifiable Credentials
                    @else
                        Student Applications Docket
                    @endif
                </h3>
                <p class="text-[11px] adm-text-muted">
                    @if($tab === 'enrolled')
                        Active student interns undergoing training. Audit attendance, assign mentors, and release certifications.
                    @elseif($tab === 'pending_cert')
                        Completed interns qualified for institutional verification and official certificate generation.
                    @elseif($tab === 'issued_cert')
                        Permanent public ledger of issued certificates with secure QR verification codes.
                    @else
                        Review incoming student applications. Approve candidates to enroll them as active interns or reject them.
                    @endif
                </p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-700/50">
                Showing {{ $applications->total() }} Records
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                @if(in_array($tab, ['enrolled', 'pending_cert', 'issued_cert']))
                {{-- ENROLLED INTERNS & CERTIFICATIONS TABLE --}}
                <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Intern & ID</th>
                        <th class="py-3.5 px-4 font-bold">Degree & Mentor</th>
                        <th class="py-3.5 px-4 font-bold">Stream & Attendance</th>
                        <th class="py-3.5 px-4 font-bold">Status</th>
                        <th class="py-3.5 px-4 font-bold">Issued Documents</th>
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

                        <!-- Degree & Mentor -->
                        <td class="py-4 px-4">
                            <span class="font-semibold adm-text-secondary block">{{ $app->degree }} • {{ $app->semester }}</span>
                            <span class="adm-text-muted text-[11px] block max-w-xs truncate" title="{{ $app->college }}">{{ $app->college }}</span>
                            <span class="text-[10px] adm-text-muted">Mentor: <strong class="adm-text-secondary">{{ $app->mentor_name }}</strong></span>
                        </td>

                        <!-- Domain & Attendance -->
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

                        <!-- Issued Documents -->
                        <td class="py-4 px-4">
                            <div class="flex flex-wrap items-center gap-1.5 max-w-xs">
                                @if($app->offer_letter_issued)
                                    <a href="{{ route('admin.application.view-offer-letter', $app->id) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50 dark:bg-blue-950/50 hover:bg-blue-100 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 text-[10px] font-semibold" title="View Offer Letter">
                                        <span>Offer ↗</span>
                                    </a>
                                @endif

                                @if($app->consent_letter_issued)
                                    <a href="{{ route('admin.application.view-consent-letter', $app->id) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-800 text-[10px] font-semibold" title="View Consent Letter">
                                        <span>Consent ↗</span>
                                    </a>
                                @endif

                                @if($app->certificate_issued)
                                    <a href="{{ route('admin.application.view-certificate', $app->id) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 dark:bg-emerald-950/50 hover:bg-emerald-100 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 text-[10px] font-semibold font-mono" title="View Certificate">
                                        <span>Cert ↗</span>
                                    </a>
                                @else
                                    <span class="text-[10px] text-slate-400 dark:text-slate-500 italic">Cert Pending</span>
                                @endif

                                @if($app->lor_issued)
                                    <a href="{{ route('admin.application.view-lor', $app->id) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-amber-50 dark:bg-amber-950/50 hover:bg-amber-100 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800 text-[10px] font-semibold font-mono" title="View LOR">
                                        <span>LOR ↗</span>
                                    </a>
                                @endif

                                @if($app->marksheet_issued)
                                    <a href="{{ route('admin.application.view-marksheet', $app->id) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 text-[10px] font-semibold" title="View Scorecard">
                                        <span>Scorecard ↗</span>
                                    </a>
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
                                    <button type="button" onclick="openCertApprovalModal('{{ $app->id }}', '{{ $app->application_number }}', '{{ addslashes($app->user->name ?? 'Candidate') }}')" class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-bold transition cursor-pointer shadow-xs">
                                        + Issue Cert
                                    </button>
                                @else
                                    <form action="{{ route('admin.application.revoke-certificate', $app->id) }}" method="POST" onsubmit="return confirm('Revoke certificate for {{ $app->application_number }}?')" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800/40 text-[10px] font-semibold transition cursor-pointer" title="Revoke Certificate">
                                            Revoke Cert
                                        </button>
                                    </form>
                                @endif

                                <!-- 3. Issue LOR Button -->
                                @if(!$app->lor_issued)
                                    <button type="button" onclick="openLorModal('{{ $app->id }}', '{{ $app->application_number }}', '{{ addslashes($app->user->name ?? 'Candidate') }}')" class="px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/40 hover:bg-amber-100 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800/50 text-[10px] font-bold transition cursor-pointer shadow-xs">
                                        + LOR
                                    </button>
                                @endif

                                <!-- 4. Issue Marksheet Modal Trigger -->
                                @if(!$app->marksheet_issued)
                                    <button type="button" onclick="openMarksheetModal('{{ $app->id }}', '{{ $app->application_number }}')" title="Issue Marksheet" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/40 hover:bg-indigo-100 text-indigo-800 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800/50 text-[10px] font-semibold transition cursor-pointer">
                                        + Scorecard
                                    </button>
                                @endif

                                <!-- 5. Track Application Link -->
                                <a href="{{ route('admin.track', ['search' => $app->application_number]) }}" class="px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 text-slate-700 dark:text-slate-300 hover:text-indigo-600 border border-slate-200 dark:border-slate-700 text-[10px] font-semibold transition" title="Track Lifecycle">
                                    Track
                                </a>

                                <!-- 6. Delete -->
                                <form action="{{ route('admin.application.delete', $app->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this student record?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-lg text-slate-500 dark:text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center adm-text-muted text-xs">
                            No enrolled student records match the selected criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @else
                {{-- ALL APPLICATIONS: CLEAN REVIEW & APPROVE / REJECT TABLE --}}
                <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Applicant & ID</th>
                        <th class="py-3.5 px-4 font-bold">Degree & Institute</th>
                        <th class="py-3.5 px-4 font-bold">Internship Stream</th>
                        <th class="py-3.5 px-4 font-bold">Status</th>
                        <th class="py-3.5 px-4 font-bold text-right">Review Decision & Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($applications as $app)
                    <tr class="adm-table-row transition {{ $app->status === 'PENDING' ? 'bg-amber-50/40 dark:bg-amber-950/15' : '' }}">
                        <!-- Applicant Info -->
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 font-bold text-xs flex items-center justify-center shrink-0 border border-indigo-200 dark:border-indigo-500/30 shadow-xs">
                                    {{ substr($app->user->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold adm-text text-sm block leading-tight">{{ $app->user->name ?? 'Candidate' }}</span>
                                        @if($app->status === 'PENDING')
                                            <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/30 uppercase tracking-wider">New</span>
                                        @endif
                                    </div>
                                    <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[11px] block font-semibold">{{ $app->application_number }}</span>
                                    <span class="adm-text-muted text-[11px] block">{{ $app->user->email ?? 'N/A' }} • {{ $app->user->phone ?? 'N/A' }}</span>
                                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">Applied {{ $app->created_at ? $app->created_at->format('d M Y') : 'N/A' }} {{-- Time commented out: , {{ $app->created_at?->format('h:i A') }} --}}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Degree & College -->
                        <td class="py-4 px-4">
                            <span class="font-semibold adm-text-secondary block">{{ $app->degree }} • {{ $app->semester }}</span>
                            <span class="adm-text-muted text-[11px] block max-w-xs truncate" title="{{ $app->college }}">{{ $app->college }}</span>
                        </td>

                        <!-- Domain -->
                        <td class="py-4 px-4">
                            <span class="text-indigo-700 dark:text-indigo-300 font-semibold block max-w-xs leading-snug">{{ $app->program_domain }}</span>
                            <span class="text-[10px] adm-text-muted block">UG Capstone Track</span>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4 px-4">
                            @if($app->status === 'PENDING')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 dark:bg-amber-950/70 text-amber-700 dark:text-amber-300 border border-amber-300 dark:border-amber-700/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending Review
                                </span>
                            @elseif(in_array($app->status, ['APPROVED', 'ACTIVE', 'COMPLETED']))
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $app->status === 'COMPLETED' ? 'Completed' : 'Enrolled Intern' }}
                                </span>
                            @elseif($app->status === 'REJECTED')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 dark:bg-rose-950/70 text-rose-700 dark:text-rose-300 border border-rose-300 dark:border-rose-700/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Rejected
                                </span>
                            @endif
                        </td>

                        <!-- Review Decision / Actions -->
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if($app->status === 'PENDING')
                                    <!-- 1. APPROVE BUTTON -->
                                    <form action="{{ route('admin.application.status', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="APPROVED">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition shadow-sm shadow-emerald-600/30 cursor-pointer motion-btn-spring" title="Approve application and enroll student as intern">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            <span>Approve</span>
                                        </button>
                                    </form>

                                    <!-- 2. REJECT BUTTON -->
                                    <form action="{{ route('admin.application.status', $app->id) }}" method="POST" class="inline" onsubmit="return confirm('Reject application {{ $app->application_number }} for {{ addslashes($app->user->name ?? 'Candidate') }}?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="REJECTED">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 dark:bg-rose-950/50 hover:bg-rose-100 dark:hover:bg-rose-900/50 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800 text-xs font-semibold transition cursor-pointer motion-btn-spring" title="Reject application">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                            <span>Reject</span>
                                        </button>
                                    </form>
                                @elseif(in_array($app->status, ['APPROVED', 'ACTIVE', 'COMPLETED']))
                                    <!-- Enrolled Intern Link -->
                                    <a href="{{ route('admin.dashboard', ['tab' => 'enrolled', 'search' => $app->application_number]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 text-xs font-bold transition shadow-xs motion-btn-spring" title="View Intern in Enrolled Students">
                                        <span>Enrolled Intern</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                @elseif($app->status === 'REJECTED')
                                    <!-- Re-Approve Option -->
                                    <form action="{{ route('admin.application.status', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="APPROVED">
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 hover:bg-emerald-100 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 text-xs font-semibold transition cursor-pointer" title="Re-Approve Application">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Re-Approve</span>
                                        </button>
                                    </form>
                                @endif

                                <!-- Subtle Edit Modal Trigger -->
                                <button type="button" onclick="openEditApplicantModal({{ json_encode($app) }}, {{ json_encode($app->user) }})" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition cursor-pointer" title="Edit Applicant Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>

                                <!-- Subtle Delete Trigger -->
                                <form action="{{ route('admin.application.delete', $app->id) }}" method="POST" onsubmit="return confirm('Permanently delete application {{ $app->application_number }}?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer" title="Delete Application">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center adm-text-muted text-xs">
                            No student applications match the selected criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @endif
            </table>
        </div>

        @if($applications->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-800 adm-table-head">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
    @endif

</div>

<!-- ========================================================
     MODALS SECTION
     ======================================================== -->

<!-- 1. Add New Applicant Modal -->
<div id="addApplicantModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
    <div class="relative w-full max-w-2xl my-8 rounded-3xl adm-card p-6 sm:p-8 shadow-2xl space-y-5">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-bold adm-text">+ Add & Enroll New Student Applicant</h3>
                <p class="text-xs adm-text-muted">Register a candidate directly into the UGC internship registry.</p>
            </div>
            <button onclick="closeAddApplicantModal()" class="adm-text-muted hover:adm-text font-bold text-xl cursor-pointer">&times;</button>
        </div>

        <form action="{{ route('admin.application.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Full Student Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Rahul Sharma" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Email Address *</label>
                    <input type="email" name="email" required placeholder="rahul@example.com" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Phone Number *</label>
                    <input type="text" name="phone" required placeholder="+91 9876543210" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
            </div>

            <!-- Student Portal Login & Password Credentials -->
            <div class="p-3.5 rounded-2xl bg-indigo-50/70 dark:bg-indigo-950/40 border border-indigo-200/80 dark:border-indigo-800/60 space-y-2.5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-bold text-indigo-700 dark:text-indigo-400">🔑 Student Login Password</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 font-normal">(Candidate will use this to sign in at /login)</span>
                    </div>
                    <button type="button" onclick="generateRandomStudentPassword('add_applicant_password')" class="text-[10px] font-bold text-indigo-700 dark:text-indigo-300 hover:text-indigo-900 bg-white dark:bg-slate-900 px-2.5 py-1 rounded-lg border border-indigo-200 dark:border-indigo-700 hover:shadow-xs transition cursor-pointer flex items-center gap-1">
                        <span>⚡ Auto-Generate</span>
                    </button>
                </div>
                <div class="relative">
                    <input type="text" name="password" id="add_applicant_password" placeholder="Enter password (e.g. Student@123 or click Auto-Generate)" class="w-full px-3.5 py-2 pr-20 rounded-xl adm-input text-xs font-mono font-medium">
                    <div class="absolute inset-y-0 right-1.5 flex items-center">
                        <button type="button" onclick="togglePasswordVisibility('add_applicant_password', this)" class="text-xs px-2 py-1 text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 font-medium cursor-pointer" title="Toggle visibility">
                            👁️
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between text-[10px] text-slate-500 dark:text-slate-400">
                    <span>💡 If left empty, default password <code class="px-1 py-0.5 rounded bg-white dark:bg-slate-900 border font-mono">Student@123</code> is assigned.</span>
                    <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Min 6 characters</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold adm-text-secondary">Degree Program *</label>
                        <a href="{{ route('admin.academic-setup', ['tab' => 'degrees']) }}" target="_blank" class="text-[10px] text-indigo-600 dark:text-indigo-400 hover:underline font-bold">+ New Degree</a>
                    </div>
                    <select name="degree" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        @if(isset($degrees))
                            @foreach($degrees as $deg)
                                <option value="{{ $deg->code }}">{{ $deg->name }} ({{ $deg->code }})</option>
                            @endforeach
                        @else
                            <option value="BSc">Bachelor of Science (BSc)</option>
                            <option value="BA">Bachelor of Arts (BA)</option>
                            <option value="BBA">Bachelor of Business Admin (BBA)</option>
                            <option value="BCA">Bachelor of Computer App (BCA)</option>
                            <option value="BCom">Bachelor of Commerce (BCom)</option>
                        @endif
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Current Semester *</label>
                    <select name="semester" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="3rd Semester">3rd Semester</option>
                        <option value="4th Semester">4th Semester</option>
                        <option value="5th Semester" selected>5th Semester</option>
                        <option value="6th Semester">6th Semester</option>
                        <option value="7th/8th Semester">7th/8th Semester</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Initial Status *</label>
                    <select name="status" required class="w-full px-3 py-2 rounded-xl adm-input text-xs font-bold">
                        <option value="APPROVED" selected>APPROVED</option>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="PENDING">PENDING</option>
                        <option value="COMPLETED">COMPLETED</option>
                    </select>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold adm-text-secondary">School / College / Institute Name *</label>
                    <a href="{{ route('admin.academic-setup', ['tab' => 'schools']) }}" target="_blank" class="text-[10px] text-indigo-600 dark:text-indigo-400 hover:underline font-bold">+ New College</a>
                </div>
                <input type="text" name="college" list="adminSchoolDatalist" required placeholder="Select or type e.g. Patna Science College, Patna University" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                <datalist id="adminSchoolDatalist">
                    @if(isset($schools))
                        @foreach($schools as $sch)
                            <option value="{{ $sch->name }}">{{ $sch->city ? ' (' . $sch->city . ')' : '' }}</option>
                        @endforeach
                    @endif
                </datalist>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Internship Stream Track *</label>
                <select name="program_domain" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                    @foreach($streams as $stream)
                        <option value="{{ $stream->title }}">{{ $stream->title }} ({{ $stream->code }})</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Assigned Faculty Mentor</label>
                    <input type="text" name="mentor_name" placeholder="Dr. S. K. Narayan" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Initial Attendance (%)</label>
                    <input type="number" name="attendance_rate" value="90" min="0" max="100" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Capstone Project Title</label>
                <input type="text" name="project_title" placeholder="Undergraduate Practical Capstone Project" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeAddApplicantModal()" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Enroll Applicant</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Edit Full Applicant Modal -->
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

            <!-- Reset Student Password (Optional) -->
            <div class="p-3.5 rounded-2xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/80 dark:border-amber-800/60 space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-bold text-amber-800 dark:text-amber-400">🔑 Reset Student Password (Optional)</span>
                    </div>
                    <button type="button" onclick="generateRandomStudentPassword('edit_new_password')" class="text-[10px] font-bold text-amber-700 dark:text-amber-300 hover:text-amber-900 bg-white dark:bg-slate-900 px-2.5 py-1 rounded-lg border border-amber-200 dark:border-amber-700 hover:shadow-xs transition cursor-pointer flex items-center gap-1">
                        <span>⚡ Auto-Generate New Password</span>
                    </button>
                </div>
                <div class="relative">
                    <input type="text" name="new_password" id="edit_new_password" placeholder="Leave blank to keep existing password, or enter new password..." class="w-full px-3.5 py-2 pr-20 rounded-xl adm-input text-xs font-mono font-medium">
                    <div class="absolute inset-y-0 right-1.5 flex items-center">
                        <button type="button" onclick="togglePasswordVisibility('edit_new_password', this)" class="text-xs px-2 py-1 text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 font-medium cursor-pointer" title="Toggle visibility">
                            👁️
                        </button>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 dark:text-slate-400">
                    If candidate forgot their password or requested a reset, enter a new password here.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Degree Program *</label>
                    <select name="degree" id="edit_degree" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        @if(isset($degrees))
                            @foreach($degrees as $deg)
                                <option value="{{ $deg->code }}">{{ $deg->name }} ({{ $deg->code }})</option>
                            @endforeach
                        @else
                            <option value="BA">Bachelor of Arts (BA)</option>
                            <option value="BSc">Bachelor of Science (BSc)</option>
                            <option value="BBA">Bachelor of Business Admin (BBA)</option>
                            <option value="BCA">Bachelor of Computer App (BCA)</option>
                            <option value="BCom">Bachelor of Commerce (BCom)</option>
                        @endif
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
                <input type="text" name="college" id="edit_college" list="adminSchoolDatalist" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
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
                <button type="button" onclick="closeEditApplicantModal()" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Save All Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. Certificate Approval Access Modal -->
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
                <p class="text-[10px] adm-text-muted mt-1">Leave as auto-generated or specify a custom UGC serial.</p>
            </div>
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Official Issue Date</label>
                <input type="date" name="certificate_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>
            <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/40 text-[11px] text-emerald-800 dark:text-emerald-200">
                Approving this certificate will automatically mark the student application status as <strong>COMPLETED</strong> and enable instant QR verification.
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeCertApprovalModal()" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-lg shadow-emerald-600/30 cursor-pointer">Approve & Issue Certificate</button>
            </div>
        </form>
    </div>
</div>

<!-- 4. Issue LOR Modal -->
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
                <button type="button" onclick="closeLorModal()" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition shadow-lg shadow-amber-600/30 cursor-pointer">Issue LOR</button>
            </div>
        </form>
    </div>
</div>

<!-- 5. Issue Marksheet Modal -->
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
                <button type="button" onclick="closeMarksheetModal()" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Generate Scorecard</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openAddApplicantModal() {
        const passInput = document.getElementById('add_applicant_password');
        if (passInput && !passInput.value) {
            generateRandomStudentPassword('add_applicant_password');
        }
        document.getElementById('addApplicantModal').classList.remove('hidden');
    }

    function closeAddApplicantModal() {
        document.getElementById('addApplicantModal').classList.add('hidden');
    }

    function generateRandomStudentPassword(inputId) {
        const prefixes = ['Student', 'Intern', 'Infinity', 'Learn', 'Bright', 'Ace'];
        const symbols = ['@', '#', '$', '!'];
        const prefix = prefixes[Math.floor(Math.random() * prefixes.length)];
        const symbol = symbols[Math.floor(Math.random() * symbols.length)];
        const num = Math.floor(1000 + Math.random() * 9000);
        const pass = `${prefix}${symbol}${num}`;
        
        const input = document.getElementById(inputId);
        if (input) {
            input.value = pass;
            input.type = 'text';
            if (window.gsap) {
                gsap.fromTo(input, { backgroundColor: 'rgba(99, 102, 241, 0.25)' }, { backgroundColor: '', duration: 0.8 });
            }
        }
    }

    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        if (!input) return;
        if (input.type === 'password') {
            input.type = 'text';
            btn.innerText = '🔒';
            btn.title = 'Hide password';
        } else {
            input.type = 'password';
            btn.innerText = '👁️';
            btn.title = 'Show password';
        }
    }

    function openEditApplicantModal(app, user) {
        document.getElementById('editAppNumberLabel').innerText = 'Application: ' + app.application_number;
        document.getElementById('editApplicantForm').action = '/admin/applications/' + app.id + '/update-full';
        const newPass = document.getElementById('edit_new_password');
        if (newPass) newPass.value = '';

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
