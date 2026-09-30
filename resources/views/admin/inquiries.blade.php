@extends('layouts.admin')

@section('title', 'Institutional Inquiries & Requests – Infinity Interns')

@section('content')
<div class="space-y-6">
    <!-- Header Banner -->
    <div class="relative overflow-hidden rounded-3xl adm-banner p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-xl">
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold mb-3 border border-white/20 backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>
                <span>College & Student Communications</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-1 tracking-tight">Inquiries & Partnership Desks</h2>
            <p class="text-indigo-100 dark:text-slate-300 text-xs sm:text-sm font-light">Review institutional partnership proposals, Dean requests, and direct student inquiries.</p>
        </div>
        <div class="relative z-10 shrink-0">
            <a href="https://wa.me/916204141971" target="_blank" rel="noopener noreferrer" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-emerald-600/30">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                <span>Direct WhatsApp Helpline</span>
            </a>
        </div>
    </div>

    <!-- Inquiries Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Type</th>
                        <th class="py-3.5 px-4 font-bold">Sender / Coordinator</th>
                        <th class="py-3.5 px-4 font-bold">Institution / Details</th>
                        <th class="py-3.5 px-4 font-bold">Message / Requirements</th>
                        <th class="py-3.5 px-4 font-bold">Date</th>
                        <th class="py-3.5 px-4 font-bold text-right">Status Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($inquiries as $inq)
                    <tr class="adm-table-row transition">
                        <td class="py-4 px-4">
                            @if($inq->type === 'COLLEGE')
                                <span class="px-2.5 py-1 rounded-full bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30 text-[10px] font-bold">COLLEGE MOU</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-500/30 text-[10px] font-bold">STUDENT INQUIRY</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-bold adm-text block">{{ $inq->name }}</span>
                            <span class="adm-text-muted text-[11px] block">{{ $inq->email }}</span>
                            <span class="text-indigo-600 dark:text-indigo-400 text-[11px] block font-mono">{{ $inq->phone }}</span>
                        </td>
                        <td class="py-4 px-4">
                            @if($inq->type === 'COLLEGE')
                                <span class="font-semibold adm-text-secondary block">{{ $inq->institution_name }}</span>
                                <span class="adm-text-muted text-[11px] block">{{ $inq->designation }} • {{ $inq->city }}</span>
                                <span class="text-emerald-600 dark:text-emerald-400 text-[11px] font-semibold block">Cohort: {{ $inq->student_count }} students</span>
                            @else
                                <span class="font-semibold adm-text-secondary block">{{ $inq->degree ?? 'Undergraduate' }}</span>
                                <span class="adm-text-muted text-[11px] block">{{ $inq->college ?? 'College Learner' }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 max-w-sm">
                            <p class="adm-text-secondary text-xs font-light leading-relaxed">{{ $inq->message }}</p>
                        </td>
                        <td class="py-4 px-4 adm-text-muted text-[11px] whitespace-nowrap">
                            {{ $inq->created_at->format('M d, Y') }}
                        </td>
                        <td class="py-4 px-4 text-right">
                            <form action="{{ route('admin.inquiry.status', $inq->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-[11px] font-bold rounded-lg px-2.5 py-1 transition cursor-pointer
                                    {{ $inq->status === 'CONTACTED' ? 'adm-badge-completed' :
                                      ($inq->status === 'REVIEWED' ? 'adm-badge-approved' : 'adm-badge-pending') }}">
                                    <option value="NEW" {{ $inq->status === 'NEW' ? 'selected' : '' }}>NEW</option>
                                    <option value="REVIEWED" {{ $inq->status === 'REVIEWED' ? 'selected' : '' }}>REVIEWED</option>
                                    <option value="CONTACTED" {{ $inq->status === 'CONTACTED' ? 'selected' : '' }}>CONTACTED</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center adm-text-muted text-xs">
                            No inquiries recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
        <div class="p-4 adm-table-head border-t">
            {{ $inquiries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
