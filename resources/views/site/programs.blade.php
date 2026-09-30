@extends('layouts.app')

@section('title', 'Programs Catalog – Infinity Interns')

@section('content')
<!-- Hero -->
<section class="relative min-h-[45vh] flex items-center justify-center pt-24 pb-16 overflow-hidden bg-[#0A1128] text-white">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[500px] bg-indigo-500/15 rounded-full blur-[140px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-indigo-400/30 bg-indigo-500/10 backdrop-blur-md mb-6">
            <span class="text-indigo-400 text-xs">✦</span>
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Curriculum & Programs</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6">
            Undergraduate Internship <br>
            <span class="text-indigo-400 italic">Programs Catalog.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed">
            Explore our specialized UGC-aligned internship tracks crafted for BA, BSc, BBA, BCA, and BCom students. Learn practical tools, execute live projects, and earn accredited certification.
        </p>
    </div>
</section>

<!-- Programs Catalog -->
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Stream Filter Controls -->
    <div class="flex flex-wrap items-center justify-center gap-2 mb-14" id="catFilter">
        <button onclick="filterPrograms('all')" class="cat-btn px-5 py-2.5 rounded-full text-xs font-bold transition bg-indigo-600 text-white shadow-md">All Streams</button>
        <button onclick="filterPrograms('arts')" class="cat-btn px-5 py-2.5 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100">BA & Humanities</button>
        <button onclick="filterPrograms('science')" class="cat-btn px-5 py-2.5 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100">BSc & Environment</button>
        <button onclick="filterPrograms('business')" class="cat-btn px-5 py-2.5 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100">BBA & Commerce</button>
        <button onclick="filterPrograms('tech')" class="cat-btn px-5 py-2.5 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100">BCA & Computer Tech</button>
    </div>

    <div class="space-y-12">
        <!-- BA -->
        <div class="program-card arts p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-7 space-y-5">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 font-serif font-bold text-indigo-700 flex items-center justify-center text-sm">BA</span>
                        <span class="text-[10px] font-bold tracking-wider text-indigo-800 uppercase bg-indigo-50 border border-indigo-100 px-3 py-1 rounded-full">ARTS & SOCIAL SCIENCES</span>
                        <span class="text-xs text-slate-500">⏱️ 6 to 8 Weeks</span>
                        <span class="text-xs text-slate-500">🎖️ 2 to 4 UGC Credits</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">
                        Social Research, Public Communication & Content Strategy
                    </h2>
                    <p class="text-sm text-slate-600 font-light leading-relaxed">
                        Designed for BA students across Political Science, History, Sociology, and Literature to gain applied capabilities in public research, field surveys, policy analysis, and digital media writing.
                    </p>
                    <div class="pt-2">
                        <h4 class="text-xs font-bold text-slate-900 tracking-wider uppercase mb-3">Key Curriculum Modules:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-700">
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Social Research Methodologies & Field Surveys</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Public Policy & Governance Analysis</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Professional Writing & Editorial Strategy</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Community Outreach & NGO Coordination</div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 bg-[#F6F8F5] p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Tools & Skills:</h4>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Field Research</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Policy Review</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Content Strategy</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Public Speaking</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Target Career Roles:</h4>
                        <ul class="space-y-1.5 text-xs text-slate-600">
                            <li>• Research Associate</li>
                            <li>• Content Strategist</li>
                            <li>• Public Relations Executive</li>
                            <li>• Policy Analyst</li>
                        </ul>
                    </div>
                    <button onclick="openApplyModal()" class="w-full h-12 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md cursor-pointer">
                        <span>Enroll in BA Track</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- BSc -->
        <div class="program-card science p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-7 space-y-5">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="w-12 h-12 rounded-2xl bg-cyan-50 border border-cyan-100 font-serif font-bold text-cyan-700 flex items-center justify-center text-sm">BSc</span>
                        <span class="text-[10px] font-bold tracking-wider text-cyan-800 uppercase bg-cyan-50 border border-cyan-100 px-3 py-1 rounded-full">SCIENCE & APPLIED LEARNING</span>
                        <span class="text-xs text-slate-500">⏱️ 6 to 8 Weeks</span>
                        <span class="text-xs text-slate-500">🎖️ 2 to 4 UGC Credits</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">
                        Applied Data Skills, Ecology & Environmental Analytics
                    </h2>
                    <p class="text-sm text-slate-600 font-light leading-relaxed">
                        Equips BSc students in Biology, Chemistry, Physics, and Agriculture with quantitative methods, data visualization, environmental impact assessment, and lab documentation.
                    </p>
                    <div class="pt-2">
                        <h4 class="text-xs font-bold text-slate-900 tracking-wider uppercase mb-3">Key Curriculum Modules:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-700">
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Scientific Data Analysis with Excel & Python</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Environmental Impact Assessment (EIA)</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ GIS & Geospatial Mapping Basics</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Sustainable Agriculture & Eco-Audit Practices</div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 bg-[#F6F8F5] p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Tools & Skills:</h4>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Data Visualization</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Environmental Audit</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Spreadsheets</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">GIS Tools</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Target Career Roles:</h4>
                        <ul class="space-y-1.5 text-xs text-slate-600">
                            <li>• Environmental Analyst</li>
                            <li>• Data Technician</li>
                            <li>• Sustainability Coordinator</li>
                            <li>• Quality Control Trainee</li>
                        </ul>
                    </div>
                    <button onclick="openApplyModal()" class="w-full h-12 rounded-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md cursor-pointer">
                        <span>Enroll in BSc Track</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- BBA -->
        <div class="program-card business p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-7 space-y-5">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 font-serif font-bold text-purple-700 flex items-center justify-center text-sm">BBA</span>
                        <span class="text-[10px] font-bold tracking-wider text-purple-800 uppercase bg-purple-50 border border-purple-100 px-3 py-1 rounded-full">BUSINESS & MANAGEMENT</span>
                        <span class="text-xs text-slate-500">⏱️ 6 to 8 Weeks</span>
                        <span class="text-xs text-slate-500">🎖️ 2 to 4 UGC Credits</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">
                        Financial Literacy, Corporate Operations & Modern Marketing
                    </h2>
                    <p class="text-sm text-slate-600 font-light leading-relaxed">
                        For BBA and BCom undergraduates aiming to develop executive acumen in market research, digital sales funnels, financial accounting, and startup operations.
                    </p>
                    <div class="pt-2">
                        <h4 class="text-xs font-bold text-slate-900 tracking-wider uppercase mb-3">Key Curriculum Modules:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-700">
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Corporate Financial Modelling & Cash Flow</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Digital Marketing & Performance Analytics</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Supply Chain Operations & Principles</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Business Communication & Pitch Deck</div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 bg-[#F6F8F5] p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Tools & Skills:</h4>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Financial Analysis</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Growth Marketing</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">CRM Systems</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Strategy</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Target Career Roles:</h4>
                        <ul class="space-y-1.5 text-xs text-slate-600">
                            <li>• Business Development Associate</li>
                            <li>• Financial Analyst Intern</li>
                            <li>• Marketing Strategist</li>
                            <li>• Operations Associate</li>
                        </ul>
                    </div>
                    <button onclick="openApplyModal()" class="w-full h-12 rounded-full bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md cursor-pointer">
                        <span>Enroll in BBA Track</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- BCA -->
        <div class="program-card tech p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-7 space-y-5">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 font-serif font-bold text-emerald-700 flex items-center justify-center text-sm">BCA</span>
                        <span class="text-[10px] font-bold tracking-wider text-emerald-800 uppercase bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full">DIGITAL & COMPUTER TECH</span>
                        <span class="text-xs text-slate-500">⏱️ 8 Weeks</span>
                        <span class="text-xs text-slate-500">🎖️ 4 UGC Credits</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">
                        Full Stack Web Development, Cloud & Cybersecurity Fundamentals
                    </h2>
                    <p class="text-sm text-slate-600 font-light leading-relaxed">
                        Hands-on technical internship for BCA and IT students covering modern web development, API integration, relational database architecture, and defensive cybersecurity hygiene.
                    </p>
                    <div class="pt-2">
                        <h4 class="text-xs font-bold text-slate-900 tracking-wider uppercase mb-3">Key Curriculum Modules:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-700">
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Modern Web Applications (HTML, CSS, JS)</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ RESTful APIs & Backend Architecture</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Relational Databases & SQL Optimization</div>
                            <div class="p-3 rounded-2xl bg-[#FAFBF9] border border-slate-200 flex items-center gap-2">✓ Cybersecurity Hygiene & Secure Deployment</div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 bg-[#F6F8F5] p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Tools & Skills:</h4>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Modern Web</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">JavaScript</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">SQL Database</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-slate-800 border border-slate-200">Git & Cloud</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Target Career Roles:</h4>
                        <ul class="space-y-1.5 text-xs text-slate-600">
                            <li>• Junior Web Developer</li>
                            <li>• Frontend Engineer Intern</li>
                            <li>• Database Analyst</li>
                            <li>• Technical Support Specialist</li>
                        </ul>
                    </div>
                    <button onclick="openApplyModal()" class="w-full h-12 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md cursor-pointer">
                        <span>Enroll in BCA Track</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    function filterPrograms(cat) {
        document.querySelectorAll('.cat-btn').forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md');
            btn.classList.add('bg-white', 'text-slate-700', 'border', 'border-slate-200');
        });
        event.target.classList.remove('bg-white', 'text-slate-700', 'border');
        event.target.classList.add('bg-indigo-600', 'text-white', 'shadow-md');

        const cards = document.querySelectorAll('.program-card');
        cards.forEach(card => {
            if (cat === 'all' || card.classList.contains(cat)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
@endsection
