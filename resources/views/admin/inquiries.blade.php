@extends('layouts.admin')

@section('title', 'Institutional Inquiries & Requests – Infinity Interns')

@section('content')
<div class="space-y-6">
    <div class="p-6 md:p-8 rounded-2xl bg-gradient-to-r from-purple-950/40 via-slate-900 to-slate-900 border border-purple-500/20 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 text-purple-300 text-xs font-semibold mb-3 border border-purple-500/20">
                <span>College & Student Communications</span>
            </div>
            <h2 class="text-2xl font-bold text-white mb-1">Inquiries & Partnership Desks</h2>
            <p class="text-slate-300 text-xs sm:text-sm">Review institutional partnership proposals, Dean requests, and direct student inquiries.</p>
        </div>
        <div>
            <a href="https://wa.me/916204141971" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-2">
                <span>Open Helpline WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-800/60 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4">Sender / Coordinator</th>
                        <th class="py-3 px-4">Institution / Details</th>
                        <th class="py-3 px-4">Message / Requirements</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4 text-right">Status Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($inquiries as $inq)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="py-4 px-4">
                            @if($inq->type === 'COLLEGE')
                                <span class="px-2.5 py-1 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 text-[10px] font-bold">COLLEGE MOU</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/30 text-[10px] font-bold">STUDENT INQUIRY</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-bold text-white block">{{ $inq->name }}</span>
                            <span class="text-slate-400 text-[11px] block">{{ $inq->email }}</span>
                            <span class="text-indigo-400 text-[11px] block font-mono">{{ $inq->phone }}</span>
                        </td>
                        <td class="py-4 px-4">
                            @if($inq->type === 'COLLEGE')
                                <span class="font-semibold text-slate-200 block">{{ $inq->institution_name }}</span>
                                <span class="text-slate-400 text-[11px] block">{{ $inq->designation }} • {{ $inq->city }}</span>
                                <span class="text-emerald-400 text-[11px] font-semibold block">Cohort: {{ $inq->student_count }} students</span>
                            @else
                                <span class="font-semibold text-slate-200 block">{{ $inq->degree ?? 'Undergraduate' }}</span>
                                <span class="text-slate-400 text-[11px] block">{{ $inq->college ?? 'College Learner' }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 max-w-sm">
                            <p class="text-slate-300 text-xs font-light leading-relaxed">{{ $inq->message }}</p>
                        </td>
                        <td class="py-4 px-4 text-slate-400 text-[11px] whitespace-nowrap">
                            {{ $inq->created_at->format('M d, Y') }}
                        </td>
                        <td class="py-4 px-4 text-right">
                            <form action="{{ route('admin.inquiry.status', $inq->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-[11px] font-bold rounded-lg px-2.5 py-1 border transition cursor-pointer
                                    {{ $inq->status === 'CONTACTED' ? 'bg-emerald-950/80 text-emerald-300 border-emerald-500/40' :
                                      ($inq->status === 'REVIEWED' ? 'bg-blue-950/80 text-blue-300 border-blue-500/40' : 'bg-amber-950/80 text-amber-300 border-amber-500/40') }}">
                                    <option value="NEW" {{ $inq->status === 'NEW' ? 'selected' : '' }}>NEW</option>
                                    <option value="REVIEWED" {{ $inq->status === 'REVIEWED' ? 'selected' : '' }}>REVIEWED</option>
                                    <option value="CONTACTED" {{ $inq->status === 'CONTACTED' ? 'selected' : '' }}>CONTACTED</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-500 text-xs">
                            No inquiries recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
        <div class="p-4 bg-slate-900 border-t border-slate-800">
            {{ $inquiries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
