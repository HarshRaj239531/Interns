@extends('layouts.app')

@section('title', 'For Colleges & Institutions – Infinity Interns')

@section('content')
<!-- Hero -->
<section class="relative min-h-[45vh] flex items-center justify-center pt-24 pb-16 overflow-hidden bg-[#0A1128] text-white">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[500px] bg-indigo-500/15 rounded-full blur-[140px] motion-orb"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-indigo-400/30 bg-indigo-500/10 backdrop-blur-md mb-6 motion-hero-badge">
            <span class="text-indigo-400 text-xs">✦</span>
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Institutional Partnership Desk</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6 motion-hero-title">
            College & University <br>
            <span class="text-indigo-400 italic">Internship Coordination.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed motion-hero-sub">
            Streamline semester internship requirements for your undergraduate departments. We partner with colleges across Bihar, UP, and Jharkhand to deliver structured, verifiable training.
        </p>
    </div>
</section>

<!-- Institutional Overview & Working Inquiry Form -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20 motion-stagger">
        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs space-y-4 motion-card-hover">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-xl">👥</div>
            <h3 class="text-2xl font-serif text-slate-900">Bulk Student Onboarding</h3>
            <p class="text-xs text-slate-600 font-light leading-relaxed">
                Eliminate administrative chaos. Provide a single student list, and our coordination team handles verification, curriculum orientation, and batch management.
            </p>
        </div>

        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs space-y-4 motion-card-hover">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl">📋</div>
            <h3 class="text-2xl font-serif text-slate-900">HOD Attendance & Progress Logs</h3>
            <p class="text-xs text-slate-600 font-light leading-relaxed">
                We provide periodic milestone reports and session attendance records directly to department heads for internal assessment scoring and viva compliance.
            </p>
        </div>

        <div class="p-8 sm:p-10 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs space-y-4 motion-card-hover">
            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center text-xl">🤝</div>
            <h3 class="text-2xl font-serif text-slate-900">Formal MOU Agreements</h3>
            <p class="text-xs text-slate-600 font-light leading-relaxed">
                Establish formal institutional Memorandums of Understanding (MOU) to satisfy NAAC accreditation metrics, NIRF ranking data, and NEP internship guidelines.
            </p>
        </div>
    </div>

    <!-- Partnership Request Form -->
    <div class="p-8 sm:p-12 rounded-[2.8rem] bg-white border border-slate-200/90 shadow-xl motion-reveal">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 space-y-6">
                <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase block">Direct Partnership Desk</span>
                <h2 class="text-3xl sm:text-4xl font-serif text-slate-900 leading-tight">
                    Request an Institutional <br>
                    <span class="text-indigo-700 italic">Discussion / MOU.</span>
                </h2>
                <p class="text-sm text-slate-600 font-light leading-relaxed">
                    Whether you are a College Principal, Dean, HOD, or Training & Placement Officer, connect with our institutional desk to explore custom cohort dates and domain mappings.
                </p>
                <div class="p-6 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-3">
                    <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Direct Institutional Hotline:</h4>
                    <div class="space-y-1.5 text-xs text-slate-700">
                        <p class="font-semibold text-slate-900">Phone: +91 6204141971</p>
                        <p>Email: info@infinityinterns.com</p>
                        <p>Center: Patna, Bihar, India</p>
                    </div>
                    <div class="pt-2">
                        <a href="https://wa.me/916204141971?text=Hello%20Infinity%20Interns%2C%20we%20want%20to%20discuss%20a%20college%20partnership." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            <span>Instant WhatsApp Message for Deans/HODs →</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-7 bg-[#F6F8F5] p-6 sm:p-10 rounded-[2.2rem] border border-slate-200/80">
                <form action="{{ route('inquiry.college') }}" method="POST" class="space-y-4">
                    @csrf
                    <h3 class="text-xl font-serif text-slate-900 font-bold">College Partnership Inquiry</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Institution / College Name *</label>
                            <input required type="text" name="institution_name" placeholder="e.g. Patna Science College" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Coordinator / Dean Name *</label>
                            <input required type="text" name="coordinator_name" placeholder="e.g. Dr. Rajesh Kumar" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Designation *</label>
                            <input required type="text" name="designation" placeholder="e.g. HOD / Principal / TPO" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Official Phone / WhatsApp *</label>
                            <input required type="tel" name="phone" placeholder="+91 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Official Email *</label>
                            <input required type="email" name="email" placeholder="dean@college.edu" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">City & State *</label>
                            <input required type="text" name="city" placeholder="e.g. Patna, Bihar" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Expected Student Cohort Size</label>
                        <select name="student_count" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="25-50">25 - 50 Students</option>
                            <option value="50-100" selected>50 - 100 Students</option>
                            <option value="100-250">100 - 250 Students</option>
                            <option value="250+">250+ Students (College-wide)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Additional Notes</label>
                        <textarea name="notes" rows="2" placeholder="Any specific requirements regarding semester timeline or stream mappings..." class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <button type="submit" class="w-full h-12 rounded-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider transition shadow-md cursor-pointer motion-btn-spring">
                        Submit Institutional Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
