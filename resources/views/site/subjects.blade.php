@extends('layouts.app')

@section('title', 'Learning Domains & Subjects – Infinity Interns')

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
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Curriculum Architecture</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6 motion-hero-title">
            Learning Domains & <br>
            <span class="text-indigo-400 italic">Specialized Subjects.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed motion-hero-sub">
            Explore our multidisciplinary subject areas designed to transform university theory into applied workplace competence across 4 core domains.
        </p>
    </div>
</section>

<!-- 4 Domains In-Depth -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-16 motion-stagger">
    <!-- Domain 1: Tech -->
    <div class="p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition motion-card-hover">
        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6 mb-8 pb-6 border-b border-slate-100">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-indigo-700 bg-indigo-50 border-indigo-100 shrink-0 text-2xl font-bold">
                    💻
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">Technology & Digital Skills</h2>
                    <p class="text-xs text-indigo-600 font-semibold tracking-wide mt-1">Modern digital literacy, coding, cybersecurity, and creative media tools</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Frontend Intern</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Digital Operations</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">IT Support</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 font-light leading-relaxed mb-8 max-w-4xl">
            Equips undergraduate students with modern computer capabilities required in virtually every 21st-century workplace, ranging from web presence to data safety.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Web Development & Design</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Building responsive websites using HTML, CSS, JavaScript, and modern frameworks with user-first layouts.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Cyber Security Essentials</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Understanding digital hygiene, phishing defenses, network basics, data privacy laws, and safe corporate online habits.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Digital Literacy & Office Suite</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Advanced spreadsheet modelling, presentation design, and cloud collaborative workspace tools.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Graphics & Content Creation</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Brand storytelling, digital asset creation, Canva/Figma workflows, and multimedia editorial design.</p>
            </div>
        </div>
    </div>

    <!-- Domain 2: Social Sciences -->
    <div class="p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition motion-card-hover">
        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6 mb-8 pb-6 border-b border-slate-100">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-purple-700 bg-purple-50 border-purple-100 shrink-0 text-2xl font-bold">
                    🌐
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">Social Sciences & Public Policy</h2>
                    <p class="text-xs text-purple-600 font-semibold tracking-wide mt-1">Applied social research, field surveys, civic governance, and outreach</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Social Researcher</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Policy Assistant</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">NGO Coordinator</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 font-light leading-relaxed mb-8 max-w-4xl">
            Enables students in Arts and Humanities to transform theoretical knowledge into actionable community development and empirical research.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Political Science & Governance</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Analyzing legislative frameworks, municipal bodies, public welfare schemes, and policy implementation.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Community & Rural Development</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Groundwork in village survey methods, micro-finance models, and NGO operational practices.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Social Research & Field Surveys</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Designing questionnaire surveys, conducting interviews, sampling strategies, and quantitative data collection.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Demographics & Census Studies</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Studying demographic transitions, urban-rural migration patterns, and health census data.</p>
            </div>
        </div>
    </div>

    <!-- Domain 3: Business -->
    <div class="p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition motion-card-hover">
        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6 mb-8 pb-6 border-b border-slate-100">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-emerald-700 bg-emerald-50 border-emerald-100 shrink-0 text-2xl font-bold">
                    💼
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">Professional Skills & Business</h2>
                    <p class="text-xs text-emerald-600 font-semibold tracking-wide mt-1">Executive communication, financial acumen, and entrepreneurial habits</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Business Trainee</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Financial Analyst</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Growth Marketer</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 font-light leading-relaxed mb-8 max-w-4xl">
            Focuses on corporate readiness, leadership traits, budget management, and foundational business acumen applicable across sectors.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Personality & Soft Skills</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Professional email etiquette, corporate body language, conflict resolution, and structured interview techniques.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Financial Literacy & Accounting</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Budgeting principles, GST basics, taxation, cash flow monitoring, and fundamental investment metrics.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Entrepreneurship & Startups</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Lean startup methodology, customer discovery interviews, unit economics, and pitch deck development.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Modern Pedagogy & Teaching</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Interactive classroom management, hybrid teaching methods, and student assessment architectures.</p>
            </div>
        </div>
    </div>

    <!-- Domain 4: Environment -->
    <div class="p-8 sm:p-12 rounded-[2.5rem] bg-white border border-slate-200/90 shadow-xs hover:shadow-xl transition motion-card-hover">
        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6 mb-8 pb-6 border-b border-slate-100">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center border text-cyan-700 bg-cyan-50 border-cyan-100 shrink-0 text-2xl font-bold">
                    🌿
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-serif text-slate-900 leading-snug">Environment, Agriculture & Development</h2>
                    <p class="text-xs text-cyan-600 font-semibold tracking-wide mt-1">Sustainability metrics, eco-auditing, agro-business, and disaster response</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Environmental Officer</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Agri-Business Intern</span>
                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full border border-slate-200">Eco-Auditor</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 font-light leading-relaxed mb-8 max-w-4xl">
            Critical learning for science and agriculture backgrounds addressing sustainable development goals, crop logistics, and climate resilience.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Environmental Science & Eco-Audits</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Carbon footprint assessment, water conservation strategies, and industrial green compliance norms.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Sustainable Agriculture & Agro-Tech</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Organic farming value chains, soil testing basics, post-harvest logistics, and farmer organizations.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Eco-Tourism & Hospitality Management</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Heritage circuit planning, hospitality operations, and eco-friendly tourist facility governance.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAFBF9] border border-slate-200/80 space-y-1">
                <h4 class="text-sm font-bold text-slate-900 font-serif">✓ Disaster Risk Management</h4>
                <p class="text-xs text-slate-600 font-light leading-relaxed">Emergency response logistics, flood & heatwave vulnerability mapping, and community mitigation drills.</p>
            </div>
        </div>
    </div>
</section>
@endsection
