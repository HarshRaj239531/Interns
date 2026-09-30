@extends('layouts.student')

@section('title', 'Student Workspace – Infinity Interns')

@section('content')
<div class="space-y-8">
    <!-- Top Welcome Banner -->
    <div class="p-8 rounded-[2.5rem] bg-gradient-to-r from-indigo-900 via-indigo-800 to-slate-900 text-white shadow-xl relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-indigo-200 text-xs font-semibold mb-3 border border-white/20">
                    <span>Undergraduate Internship Workspace</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-serif font-bold text-white mb-2">
                    Welcome, {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-indigo-100/90 font-light max-w-xl leading-relaxed">
                    Track your semester internship progress, manage your capstone project dossier, and download accredited UGC completion documents.
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/20 text-center shrink-0">
                <span class="text-[10px] text-indigo-200 uppercase font-bold tracking-widest block mb-1">Application Status</span>
                @if($profile->status === 'COMPLETED')
                    <span class="px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 font-bold text-xs border border-emerald-400/40 inline-block">
                        COMPLETED & CERTIFIED
                    </span>
                @elseif($profile->status === 'ACTIVE')
                    <span class="px-4 py-1.5 rounded-full bg-indigo-500/20 text-indigo-300 font-bold text-xs border border-indigo-400/40 inline-block">
                        ACTIVE IN PROGRESS
                    </span>
                @elseif($profile->status === 'APPROVED')
                    <span class="px-4 py-1.5 rounded-full bg-blue-500/20 text-blue-300 font-bold text-xs border border-blue-400/40 inline-block">
                        APPLICATION APPROVED
                    </span>
                @else
                    <span class="px-4 py-1.5 rounded-full bg-amber-500/20 text-amber-300 font-bold text-xs border border-amber-400/40 inline-block">
                        PENDING VERIFICATION
                    </span>
                @endif
                <span class="font-mono text-xs text-white block mt-2 font-bold">{{ $profile->application_number }}</span>
            </div>
        </div>
    </div>

    <!-- Academic Profile & Attendance Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Profile Info -->
        <div class="lg:col-span-8 p-8 rounded-[2.2rem] bg-white border border-slate-200/90 shadow-xs space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-xl font-serif font-bold text-slate-900">Academic Registration Details</h3>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-700">
                    {{ $profile->degree }} • {{ $profile->semester }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block mb-0.5">Enrolled College / Institute</span>
                    <span class="font-semibold text-slate-900 text-sm">{{ $profile->college }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block mb-0.5">Program Domain Track</span>
                    <span class="font-semibold text-indigo-700 text-sm">{{ $profile->program_domain }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block mb-0.5">Student Email</span>
                    <span class="font-semibold text-slate-900 text-sm">{{ $user->email }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block mb-0.5">Assigned Faculty Mentor</span>
                    <span class="font-semibold text-slate-900 text-sm">{{ $profile->mentor_name }}</span>
                </div>
            </div>

            <!-- Capstone Project Edit -->
            <div class="pt-4 border-t border-slate-100">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Capstone Project Title:</h4>
                <form action="{{ route('student.project.update') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input type="text" name="project_title" value="{{ $profile->project_title }}" required class="flex-1 px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shrink-0 cursor-pointer">
                        Update Project Title
                    </button>
                </form>
                <p class="text-[11px] text-slate-400 mt-1">This title appears on your official evaluation marksheet and project report cover dossier.</p>
            </div>
        </div>

        <!-- Attendance & Compliance Sidecard -->
        <div class="lg:col-span-4 p-8 rounded-[2.2rem] bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between space-y-6">
            <div>
                <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest block mb-1">Session Attendance</span>
                <h3 class="text-xl font-serif font-bold text-slate-900 mb-4">Mandatory Contact Hours</h3>

                <div class="flex items-center justify-between mb-2">
                    <span class="text-3xl font-serif font-bold text-slate-900">{{ $profile->attendance_rate }}%</span>
                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">UGC COMPLIANT</span>
                </div>

                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden mb-3">
                    <div class="bg-indigo-600 h-3 rounded-full transition-all duration-500" style="width: {{ $profile->attendance_rate }}%"></div>
                </div>
                <p class="text-xs text-slate-500 font-light leading-relaxed">
                    NEP-2020 requires a minimum of 75% verified contact hours and milestone check-ins for degree credit transfer.
                </p>
            </div>

            <div class="p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200 space-y-2 text-xs">
                <span class="font-bold text-slate-800 block">Mentor Check-ins:</span>
                <div class="flex items-center justify-between text-slate-600">
                    <span>Orientation & Syllabus:</span>
                    <span class="text-emerald-600 font-bold">Completed ✓</span>
                </div>
                <div class="flex items-center justify-between text-slate-600">
                    <span>Mid-term Review:</span>
                    <span class="text-emerald-600 font-bold">Completed ✓</span>
                </div>
                <div class="flex items-center justify-between text-slate-600">
                    <span>Final Capstone Audit:</span>
                    <span class="{{ $profile->status === 'COMPLETED' ? 'text-emerald-600 font-bold' : 'text-amber-600 font-semibold' }}">
                        {{ $profile->status === 'COMPLETED' ? 'Approved ✓' : 'In Review' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Official Documents Releases Section -->
    <div class="space-y-4">
        <h3 class="text-2xl font-serif font-bold text-slate-900">Your Official Internship Documents</h3>
        <p class="text-xs text-slate-500">View and print university-compliant documents as soon as they are approved by the academic board.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- 1. Offer Letter -->
            <div class="p-6 rounded-[2rem] bg-white border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl font-bold mb-4">
                        📄
                    </div>
                    <h4 class="text-lg font-serif font-bold text-slate-900 mb-1">Offer & Acceptance Letter</h4>
                    <p class="text-xs text-slate-600 mb-4 font-light">Official enrollment confirmation letter with program dates, domain mapping, and institutional sign-off.</p>
                </div>
                <div>
                    @if($profile->offer_letter_issued)
                        <span class="text-[10px] font-bold text-emerald-600 block mb-3">Released on {{ $profile->offer_letter_date?->format('M d, Y') }}</span>
                        <a href="{{ route('student.offer-letter') }}" target="_blank" class="w-full py-2.5 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-1.5 shadow-sm transition">
                            <span>View / Print Letter</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    @else
                        <span class="text-[11px] text-slate-400 block mb-3">Pending administrator dispatch</span>
                        <button disabled class="w-full py-2.5 rounded-full bg-slate-100 text-slate-400 font-bold text-xs uppercase tracking-wider cursor-not-allowed">
                            Not Yet Released
                        </button>
                    @endif
                </div>
            </div>

            <!-- 2. Completion Certificate -->
            <div class="p-6 rounded-[2rem] bg-white border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold mb-4">
                        🎖️
                    </div>
                    <h4 class="text-lg font-serif font-bold text-slate-900 mb-1">Completion Certificate</h4>
                    <p class="text-xs text-slate-600 mb-4 font-light">Official UGC-compliant certificate with unique tamper-proof verification serial and QR code.</p>
                </div>
                <div>
                    @if($profile->certificate_issued)
                        <span class="text-[10px] font-mono font-bold text-emerald-600 block mb-1">Serial: {{ $profile->certificate_number }}</span>
                        <span class="text-[10px] text-slate-400 block mb-3">Issued: {{ $profile->certificate_date?->format('M d, Y') }}</span>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('student.certificate') }}" target="_blank" class="w-full py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-1.5 shadow-sm transition">
                                <span>View / Print Certificate</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            <a href="{{ route('verify', $profile->certificate_number) }}" target="_blank" class="text-center text-[11px] font-bold text-indigo-600 hover:underline">
                                Online Verification Page ↗
                            </a>
                        </div>
                    @else
                        <span class="text-[11px] text-slate-400 block mb-3">Issued upon final capstone review</span>
                        <button disabled class="w-full py-2.5 rounded-full bg-slate-100 text-slate-400 font-bold text-xs uppercase tracking-wider cursor-not-allowed">
                            In Evaluation
                        </button>
                    @endif
                </div>
            </div>

            <!-- 3. Detailed Marksheet -->
            <div class="p-6 rounded-[2rem] bg-white border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-xl font-bold mb-4">
                        📊
                    </div>
                    <h4 class="text-lg font-serif font-bold text-slate-900 mb-1">Academic Marksheet</h4>
                    <p class="text-xs text-slate-600 mb-4 font-light">Performance evaluation scorecard with component-wise marks, overall grade, and credit conversion.</p>
                </div>
                <div>
                    @if($profile->marksheet_issued)
                        <span class="text-[10px] font-bold text-purple-700 block mb-1">Grade {{ $profile->marksheet_grade }} ({{ $profile->marksheet_marks }}%)</span>
                        <span class="text-[10px] text-slate-400 block mb-3">Issued: {{ $profile->marksheet_date?->format('M d, Y') }}</span>
                        <a href="{{ route('student.marksheet') }}" target="_blank" class="w-full py-2.5 rounded-full bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-1.5 shadow-sm transition">
                            <span>View / Print Marksheet</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    @else
                        <span class="text-[11px] text-slate-400 block mb-3">Generated alongside completion review</span>
                        <button disabled class="w-full py-2.5 rounded-full bg-slate-100 text-slate-400 font-bold text-xs uppercase tracking-wider cursor-not-allowed">
                            Not Yet Released
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
