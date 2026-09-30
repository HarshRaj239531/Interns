@extends('layouts.admin')

@section('title', 'Admin Command Center – Infinity Interns')

@section('content')
<div class="space-y-6">
    <!-- Top Welcome Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-900/40 via-purple-900/30 to-slate-900 border border-indigo-500/20 p-6 md:p-8">
        <div class="relative z-10 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-300 text-xs font-semibold mb-3 border border-indigo-500/30">
                <span>UGC-Focused Internship Management</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">
                Administrator Command Center
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Manage student registrations, review verification workflows, track practical learning batches, and issue authentic UGC-compliant completion documentation.
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
        <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Total Apps</span>
            <div class="text-2xl font-bold text-white">{{ $stats['total'] }}</div>
            <span class="text-[10px] text-indigo-400">Database Records</span>
        </div>
        <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
            <span class="text-[10px] text-amber-400 font-bold uppercase tracking-wider block mb-1">Pending</span>
            <div class="text-2xl font-bold text-amber-300">{{ $stats['pending'] }}</div>
            <span class="text-[10px] text-slate-400">Needs Review</span>
        </div>
        <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
            <span class="text-[10px] text-blue-400 font-bold uppercase tracking-wider block mb-1">Approved</span>
            <div class="text-2xl font-bold text-blue-300">{{ $stats['approved'] }}</div>
            <span class="text-[10px] text-slate-400">Offer Issued</span>
        </div>
        <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
            <span class="text-[10px] text-indigo-400 font-bold uppercase tracking-wider block mb-1">Active</span>
            <div class="text-2xl font-bold text-indigo-300">{{ $stats['active'] }}</div>
            <span class="text-[10px] text-slate-400">In Training</span>
        </div>
        <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
            <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider block mb-1">Certified</span>
            <div class="text-2xl font-bold text-emerald-300">{{ $stats['certificates_issued'] }}</div>
            <span class="text-[10px] text-slate-400">QR Generated</span>
        </div>
        <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
            <span class="text-[10px] text-purple-400 font-bold uppercase tracking-wider block mb-1">Inquiries</span>
            <div class="text-2xl font-bold text-purple-300">{{ $stats['total_inquiries'] }}</div>
            <a href="{{ route('admin.inquiries') }}" class="text-[10px] text-indigo-400 hover:underline">View Desks →</a>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="p-4 rounded-2xl bg-slate-900/70 border border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full">
            <div class="relative flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student, college, email, or application ID..." class="w-full px-3.5 py-2 rounded-xl bg-slate-800/80 border border-slate-700 text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="flex items-center gap-2">
                <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-xl bg-slate-800/80 border border-slate-700 text-xs text-slate-200 focus:outline-none">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                    <option value="APPROVED" {{ request('status') == 'APPROVED' ? 'selected' : '' }}>Approved</option>
                    <option value="ACTIVE" {{ request('status') == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                    <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                    <option value="REJECTED" {{ request('status') == 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                </select>

                <select name="degree" onchange="this.form.submit()" class="px-3 py-2 rounded-xl bg-slate-800/80 border border-slate-700 text-xs text-slate-200 focus:outline-none">
                    <option value="all" {{ request('degree') == 'all' ? 'selected' : '' }}>All Degrees</option>
                    <option value="BA" {{ request('degree') == 'BA' ? 'selected' : '' }}>BA</option>
                    <option value="BSc" {{ request('degree') == 'BSc' ? 'selected' : '' }}>BSc</option>
                    <option value="BBA" {{ request('degree') == 'BBA' ? 'selected' : '' }}>BBA</option>
                    <option value="BCA" {{ request('degree') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="BCom" {{ request('degree') == 'BCom' ? 'selected' : '' }}>BCom</option>
                </select>

                <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'status', 'degree']))
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-xl bg-slate-800 text-slate-400 hover:text-white text-xs">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Applications Table -->
    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-800/60 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="py-3 px-4">Applicant & ID</th>
                        <th class="py-3 px-4">Degree & College</th>
                        <th class="py-3 px-4">Domain Specialization</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Documents</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($applications as $app)
                    <tr class="hover:bg-slate-800/40 transition">
                        <!-- Student Info -->
                        <td class="py-4 px-4">
                            <span class="font-bold text-white text-sm block">{{ $app->user?->name ?? 'Student' }}</span>
                            <span class="font-mono text-indigo-400 text-[11px] block">{{ $app->application_number }}</span>
                            <span class="text-slate-400 text-[11px]">{{ $app->user?->email }}</span>
                        </td>

                        <!-- Degree & College -->
                        <td class="py-4 px-4">
                            <span class="font-semibold text-slate-200 block">{{ $app->degree }} • {{ $app->semester }}</span>
                            <span class="text-slate-400 text-[11px] block max-w-xs truncate">{{ $app->college }}</span>
                        </td>

                        <!-- Domain -->
                        <td class="py-4 px-4">
                            <span class="text-indigo-300 font-medium block max-w-xs">{{ $app->program_domain }}</span>
                            <span class="text-slate-500 text-[10px]">Att: {{ $app->attendance_rate }}%</span>
                        </td>

                        <!-- Status Badge & Quick Change -->
                        <td class="py-4 px-4">
                            <form action="{{ route('admin.application.status', $app->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-[11px] font-bold rounded-lg px-2.5 py-1 border transition cursor-pointer
                                    {{ $app->status === 'COMPLETED' ? 'bg-emerald-950/80 text-emerald-300 border-emerald-500/40' :
                                      ($app->status === 'ACTIVE' ? 'bg-indigo-950/80 text-indigo-300 border-indigo-500/40' :
                                      ($app->status === 'APPROVED' ? 'bg-blue-950/80 text-blue-300 border-blue-500/40' :
                                      ($app->status === 'REJECTED' ? 'bg-rose-950/80 text-rose-300 border-rose-500/40' : 'bg-amber-950/80 text-amber-300 border-amber-500/40'))) }}">
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
                            <div class="flex items-center gap-1.5 text-[11px]">
                                <span class="{{ $app->offer_letter_issued ? 'text-emerald-400' : 'text-slate-600' }}">●</span>
                                <span class="{{ $app->offer_letter_issued ? 'text-slate-200' : 'text-slate-500' }}">Offer Letter</span>
                                @if($app->offer_letter_issued)
                                    <a href="{{ route('admin.application.view-offer-letter', $app->id) }}" target="_blank" class="text-indigo-400 hover:underline">↗</a>
                                @endif
                            </div>
                            <div class="flex items-center gap-1.5 text-[11px]">
                                <span class="{{ $app->certificate_issued ? 'text-emerald-400' : 'text-slate-600' }}">●</span>
                                <span class="{{ $app->certificate_issued ? 'text-slate-200' : 'text-slate-500' }}">Certificate</span>
                                @if($app->certificate_issued)
                                    <a href="{{ route('admin.application.view-certificate', $app->id) }}" target="_blank" class="text-emerald-400 hover:underline font-mono">({{ $app->certificate_number }}) ↗</a>
                                @endif
                            </div>
                            <div class="flex items-center gap-1.5 text-[11px]">
                                <span class="{{ $app->marksheet_issued ? 'text-emerald-400' : 'text-slate-600' }}">●</span>
                                <span class="{{ $app->marksheet_issued ? 'text-slate-200' : 'text-slate-500' }}">Marksheet</span>
                                @if($app->marksheet_issued)
                                    <a href="{{ route('admin.application.view-marksheet', $app->id) }}" target="_blank" class="text-purple-400 hover:underline">({{ $app->marksheet_grade }} - {{ $app->marksheet_marks }}%) ↗</a>
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
                                        <button type="submit" title="Issue Offer Letter" class="px-2.5 py-1 rounded-lg bg-blue-900/40 hover:bg-blue-800 text-blue-300 border border-blue-700/50 text-[10px] font-semibold transition cursor-pointer">
                                            + Offer Letter
                                        </button>
                                    </form>
                                @endif

                                <!-- Issue Certificate -->
                                @if(!$app->certificate_issued)
                                    <form action="{{ route('admin.application.certificate', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Issue UGC Certificate" class="px-2.5 py-1 rounded-lg bg-emerald-900/40 hover:bg-emerald-800 text-emerald-300 border border-emerald-700/50 text-[10px] font-semibold transition cursor-pointer">
                                            + Certificate
                                        </button>
                                    </form>
                                @endif

                                <!-- Issue Marksheet Modal Trigger -->
                                @if(!$app->marksheet_issued)
                                    <button onclick="openMarksheetModal('{{ $app->id }}', '{{ $app->application_number }}')" title="Issue Marksheet" class="px-2.5 py-1 rounded-lg bg-purple-900/40 hover:bg-purple-800 text-purple-300 border border-purple-700/50 text-[10px] font-semibold transition cursor-pointer">
                                        + Marksheet
                                    </button>
                                @endif

                                <!-- Delete -->
                                <form action="{{ route('admin.application.delete', $app->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student application and associated account?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-lg text-slate-500 hover:text-rose-400 hover:bg-rose-950/40 transition cursor-pointer" title="Delete Application">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-500 text-xs">
                            No student applications matched your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
        <div class="p-4 bg-slate-900 border-t border-slate-800">
            {{ $applications->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Issue Marksheet Modal -->
<div id="marksheetModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-2xl bg-slate-900 border border-slate-800 p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
            <h3 class="text-base font-bold text-white">Generate Official Marksheet</h3>
            <button onclick="closeMarksheetModal()" class="text-slate-400 hover:text-white">&times;</button>
        </div>
        <p class="text-xs text-slate-400" id="marksheetAppIdText"></p>

        <form id="marksheetForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Overall Grade</label>
                <select name="marksheet_grade" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white">
                    <option value="A+">A+ (Outstanding)</option>
                    <option value="A">A (Excellent)</option>
                    <option value="B+">B+ (Very Good)</option>
                    <option value="B">B (Good)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Total Marks Evaluated (%)</label>
                <input type="number" name="marksheet_marks" value="94" min="0" max="100" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeMarksheetModal()" class="px-4 py-2 rounded-xl bg-slate-800 text-slate-300 text-xs font-semibold">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold">Generate Marksheet</button>
            </div>
        </form>
    </div>
</div>

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
@endsection
