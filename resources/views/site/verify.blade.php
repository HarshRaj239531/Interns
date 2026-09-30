@extends('layouts.app')

@section('title', 'Public Credential Verifier – Infinity Interns')

@section('content')
<!-- Hero -->
<section class="relative min-h-[45vh] flex items-center justify-center pt-24 pb-16 overflow-hidden bg-[#0A1128] text-white">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[500px] bg-indigo-500/15 rounded-full blur-[140px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-emerald-400/30 bg-emerald-500/10 backdrop-blur-md mb-6">
            <span class="text-emerald-400 text-xs">🛡️</span>
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-emerald-300">Central Verification Database</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6">
            Verify Internship <br>
            <span class="text-emerald-400 italic">Credentials & Records.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed mb-8">
            Colleges, employers, and academic institutions can verify the authenticity of Infinity Interns certificates and evaluation records.
        </p>

        <!-- Search Bar -->
        <form action="{{ route('verify') }}" method="GET" class="max-w-xl mx-auto relative flex items-center">
            <input type="text" name="certificate_number" value="{{ $searchCode }}" required placeholder="Enter Certificate No (e.g. UGC-INF-892144)..." class="w-full h-14 pl-6 pr-32 rounded-full bg-white text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-2xl">
            <button type="submit" class="absolute right-2 px-6 py-2.5 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs uppercase tracking-wider transition cursor-pointer">
                Verify
            </button>
        </form>

        <!-- Quick Demo Codes -->
        <div class="mt-4 flex flex-wrap items-center justify-center gap-2 text-xs text-indigo-200">
            <span>Try sample certificate numbers:</span>
            <a href="{{ route('verify', 'UGC-INF-892144') }}" class="px-2.5 py-0.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-mono border border-white/20">UGC-INF-892144</a>
            <a href="{{ route('verify', 'UGC-INF-771239') }}" class="px-2.5 py-0.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-mono border border-white/20">UGC-INF-771239</a>
        </div>
    </div>
</section>

<!-- Verification Result -->
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
    @if($searched)
        @if($profile)
            <div class="p-8 sm:p-12 rounded-[2.5rem] bg-white border border-emerald-500/40 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-indigo-600"></div>

                <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl font-bold">
                            ✓
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-widest text-emerald-600 uppercase block">Authentic & Verified Credential</span>
                            <h3 class="text-xl font-serif text-slate-900 font-bold">Infinity Interns Accredited Record</h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                        {{ $profile->certificate_number }}
                    </span>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Student Full Name</span>
                            <span class="font-serif font-bold text-base text-slate-900">{{ $profile->user->name }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Application ID</span>
                            <span class="font-mono font-bold text-indigo-700">{{ $profile->application_number }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Undergraduate Degree & Stream</span>
                            <span class="font-semibold text-slate-800">{{ $profile->degree }} ({{ $profile->semester }})</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">College / Institute</span>
                            <span class="font-semibold text-slate-800">{{ $profile->college }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-[#FAFBF9] border border-slate-200/80">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Domain Specialization</span>
                            <span class="font-semibold text-slate-800">{{ $profile->program_domain }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Issue Date & Completion</span>
                            <span class="font-semibold text-slate-800">{{ $profile->certificate_date?->format('F d, Y') }}</span>
                        </div>
                    </div>

                    @if($profile->marksheet_issued)
                    <div class="p-4 rounded-2xl bg-indigo-50/60 border border-indigo-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider block">Evaluated Academic Grade</span>
                            <span class="text-sm font-bold text-slate-900">Grade {{ $profile->marksheet_grade }} ({{ $profile->marksheet_marks }}% Total Evaluation)</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs">UGC COMPLIANT</span>
                    </div>
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                    <p class="text-center sm:text-left">
                        Verified by Infinitya1 Career Counselling Pvt Ltd. under UGC National Higher Education Qualifications Framework (NHEQF).
                    </p>
                    <a href="javascript:window.print()" class="px-4 py-2 rounded-full bg-slate-900 text-white font-bold text-xs uppercase tracking-wider hover:bg-slate-800 transition">
                        Print Verification Docket
                    </a>
                </div>
            </div>
        @else
            <div class="p-10 rounded-[2.5rem] bg-white border border-rose-200 text-center space-y-4 shadow-xl">
                <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center text-2xl font-bold mx-auto">
                    ✕
                </div>
                <h3 class="text-2xl font-serif text-slate-900 font-bold">Certificate Record Not Found</h3>
                <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">
                    No verified completion certificate was found matching code <strong class="font-mono text-slate-800">{{ $searchCode }}</strong>. Please check for typos or contact the issuing desk.
                </p>
                <div class="pt-2">
                    <a href="{{ route('contact') }}" class="inline-block px-6 py-2.5 rounded-full bg-indigo-600 text-white text-xs font-bold uppercase tracking-wider hover:bg-indigo-700 transition">
                        Contact Verification Helpdesk
                    </a>
                </div>
            </div>
        @endif
    @else
        <div class="p-10 rounded-[2.5rem] bg-white border border-slate-200/80 text-center space-y-3 shadow-xs">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-xl mx-auto">
                🔍
            </div>
            <h3 class="text-xl font-serif text-slate-900 font-bold">Ready to Verify</h3>
            <p class="text-xs text-slate-600 max-w-md mx-auto">
                Enter any <code>UGC-INF-XXXXXX</code> serial number above to query our live relational database and confirm student accreditation records.
            </p>
        </div>
    @endif
</section>
@endsection
