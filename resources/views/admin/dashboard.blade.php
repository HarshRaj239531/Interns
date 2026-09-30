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

        <div class="relative z-10 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold mb-3 border border-white/20 backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>UGC-Focused Internship Management</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 tracking-tight">
                Administrator Command Center
            </h2>
            <p class="text-indigo-100 dark:text-slate-300 text-xs sm:text-sm leading-relaxed font-light">
                Manage student registrations, review verification workflows, track practical learning batches, and issue authentic UGC-compliant completion documentation.
            </p>

            <div class="mt-4 flex flex-wrap items-center gap-3 pt-2">
                <a href="{{ route('admin.inquiries') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 px-3.5 py-1.5 rounded-full transition shadow-xs">
                    <span>Institutional Inquiries ({{ $stats['total_inquiries'] }})</span>
                    <span>→</span>
                </a>
                <a href="{{ route('verify') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold text-white bg-indigo-500/30 hover:bg-indigo-500/40 border border-white/20 px-3.5 py-1.5 rounded-full transition">
                    <span>Open Public Verifier</span>
                    <span>↗</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
        <!-- Total Apps -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] adm-text-muted font-bold uppercase tracking-wider">Total Apps</span>
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="text-2xl font-bold adm-text tracking-tight">{{ $stats['total'] }}</div>
            <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-medium">Database Records</span>
        </div>

        <!-- Pending -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider">Pending</span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
            <div class="text-2xl font-bold text-amber-600 dark:text-amber-300 tracking-tight">{{ $stats['pending'] }}</div>
            <span class="text-[10px] adm-text-muted">Needs Review</span>
        </div>

        <!-- Approved -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">Approved</span>
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            </div>
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-300 tracking-tight">{{ $stats['approved'] }}</div>
            <span class="text-[10px] adm-text-muted">Offer Issued</span>
        </div>

        <!-- Active -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-wider">Active</span>
                <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
            </div>
            <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-300 tracking-tight">{{ $stats['active'] }}</div>
            <span class="text-[10px] adm-text-muted">In Training</span>
        </div>

        <!-- Certified -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider">Certified</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-300 tracking-tight">{{ $stats['certificates_issued'] }}</div>
            <span class="text-[10px] adm-text-muted">QR Generated</span>
        </div>

        <!-- Inquiries -->
        <div class="p-4 rounded-2xl adm-card">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-purple-600 dark:text-purple-400 font-bold uppercase tracking-wider">Inquiries</span>
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
            </div>
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-300 tracking-tight">{{ $stats['total_inquiries'] }}</div>
            <a href="{{ route('admin.inquiries') }}" class="text-[10px] text-indigo-600 dark:text-indigo-400 hover:underline">View Desks →</a>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="p-4 rounded-2xl adm-card">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-3 w-full">
            <div class="relative flex-1 w-full min-w-[220px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none adm-text-muted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name, college, email, or application ID..." class="w-full pl-10 pr-4 py-2.5 rounded-xl adm-input text-xs placeholder-slate-400">
            </div>

            <div class="flex items-center gap-2.5 w-full md:w-auto">
                <select name="status" class="px-3.5 py-2.5 rounded-xl adm-input text-xs">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                    <option value="APPROVED" {{ request('status') == 'APPROVED' ? 'selected' : '' }}>Approved</option>
                    <option value="ACTIVE" {{ request('status') == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                    <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                    <option value="REJECTED" {{ request('status') == 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                </select>

                <select name="degree" class="px-3.5 py-2.5 rounded-xl adm-input text-xs">
                    <option value="all" {{ request('degree') == 'all' ? 'selected' : '' }}>All Degrees</option>
                    <option value="BA" {{ request('degree') == 'BA' ? 'selected' : '' }}>BA</option>
                    <option value="BSc" {{ request('degree') == 'BSc' ? 'selected' : '' }}>BSc</option>
                    <option value="BBA" {{ request('degree') == 'BBA' ? 'selected' : '' }}>BBA</option>
                    <option value="BCA" {{ request('degree') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="BCom" {{ request('degree') == 'BCom' ? 'selected' : '' }}>BCom</option>
                </select>

                <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer">
                    Filter
                </button>

                @if(request('search') || (request('status') && request('status') !== 'all') || (request('degree') && request('degree') !== 'all'))
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Applications Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Applicant & ID</th>
                        <th class="py-3.5 px-4 font-bold">Degree & College</th>
                        <th class="py-3.5 px-4 font-bold">Domain Specialization</th>
                        <th class="py-3.5 px-4 font-bold">Status</th>
                        <th class="py-3.5 px-4 font-bold">Documents</th>
                        <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($applications as $app)
                    <tr class="adm-table-row transition">
                        <!-- Student Info -->
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 font-bold text-xs flex items-center justify-center shrink-0 border border-indigo-200 dark:border-indigo-500/30">
                                    {{ substr($app->user->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-bold adm-text text-sm block leading-tight">{{ $app->user->name ?? 'Candidate' }}</span>
                                    <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[11px] block">{{ $app->application_number }}</span>
                                    <span class="adm-text-muted text-[11px] block">{{ $app->user->email ?? 'N/A' }}</span>
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
                            <span class="text-indigo-700 dark:text-indigo-300 font-medium block max-w-xs">{{ $app->program_domain }}</span>
                            <span class="adm-text-muted text-[10px]">Attendance: <strong class="text-emerald-600 dark:text-emerald-400">{{ $app->attendance_rate }}%</strong></span>
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

                        <!-- Documents status -->
                        <td class="py-4 px-4 space-y-1">
                            <!-- Offer Letter -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->offer_letter_issued)
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold">●</span>
                                    <a href="{{ route('admin.application.view-offer-letter', $app->id) }}" target="_blank" class="text-emerald-600 dark:text-emerald-300 font-medium hover:underline">Offer Letter ↗</a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Offer Letter</span>
                                @endif
                            </div>

                            <!-- Certificate -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->certificate_issued)
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold">●</span>
                                    <a href="{{ route('admin.application.view-certificate', $app->id) }}" target="_blank" class="text-emerald-600 dark:text-emerald-300 font-medium hover:underline font-mono text-[10px]">
                                        {{ $app->certificate_number }} ↗
                                    </a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Certificate</span>
                                @endif
                            </div>

                            <!-- Marksheet -->
                            <div class="flex items-center gap-1.5 text-[11px]">
                                @if($app->marksheet_issued)
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold">●</span>
                                    <a href="{{ route('admin.application.view-marksheet', $app->id) }}" target="_blank" class="text-purple-600 dark:text-purple-300 font-medium hover:underline">
                                        Marksheet ({{ $app->marksheet_grade }} - {{ $app->marksheet_marks }}%) ↗
                                    </a>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">○</span>
                                    <span class="adm-text-muted">Marksheet</span>
                                @endif
                            </div>
                        </td>

                        <!-- Actions Dropdown / Modal Triggers -->
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5 flex-wrap">
                                <!-- Issue Offer Letter -->
                                @if(!$app->offer_letter_issued)
                                    <form action="{{ route('admin.application.offer-letter', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Issue Offer Letter" class="px-2.5 py-1 rounded-lg bg-blue-100 dark:bg-blue-900/40 hover:bg-blue-200 dark:hover:bg-blue-800 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700/50 text-[10px] font-semibold transition cursor-pointer">
                                            + Offer Letter
                                        </button>
                                    </form>
                                @endif

                                <!-- Issue Certificate -->
                                @if(!$app->certificate_issued)
                                    <form action="{{ route('admin.application.certificate', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Issue UGC Certificate" class="px-2.5 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 hover:bg-emerald-200 dark:hover:bg-emerald-800 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700/50 text-[10px] font-semibold transition cursor-pointer">
                                            + Certificate
                                        </button>
                                    </form>
                                @endif

                                <!-- Issue Marksheet Modal Trigger -->
                                @if(!$app->marksheet_issued)
                                    <button onclick="openMarksheetModal('{{ $app->id }}', '{{ $app->application_number }}')" title="Issue Marksheet" class="px-2.5 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/40 hover:bg-purple-200 dark:hover:bg-purple-800 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-700/50 text-[10px] font-semibold transition cursor-pointer">
                                        + Marksheet
                                    </button>
                                @endif

                                <!-- Delete -->
                                <form action="{{ route('admin.application.delete', $app->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student application and associated account?')" class="inline">
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
                            No student applications matched your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="p-4 border-t adm-table-head">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Issue Marksheet Modal -->
<div id="marksheetModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-3xl adm-card p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold adm-text">Generate Official Marksheet</h3>
            <button onclick="closeMarksheetModal()" class="adm-text-muted hover:adm-text font-bold text-lg cursor-pointer">&times;</button>
        </div>
        <p class="text-xs adm-text-muted" id="marksheetAppIdText"></p>

        <form id="marksheetForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Overall Grade</label>
                <select name="marksheet_grade" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                    <option value="A+">A+ (Outstanding)</option>
                    <option value="A">A (Excellent)</option>
                    <option value="B+">B+ (Very Good)</option>
                    <option value="B">B (Good)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Total Marks Evaluated (%)</label>
                <input type="number" name="marksheet_marks" value="94" min="0" max="100" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeMarksheetModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold transition shadow-lg shadow-purple-600/30 cursor-pointer">Generate Marksheet</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
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
