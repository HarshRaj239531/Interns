@extends('layouts.app')

@section('title', 'Frequently Asked Questions – Infinity Interns')

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
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Knowledge Base & Support</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6 motion-hero-title">
            Frequently Asked <br>
            <span class="text-indigo-400 italic">Questions.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed mb-8 motion-hero-sub">
            Everything you need to know regarding UGC internship guidelines, eligibility, college approvals, session formats, and verified marksheet issuance.
        </p>

        <!-- Search input -->
        <div class="max-w-xl mx-auto relative motion-reveal">
            <input type="text" id="faqSearch" oninput="searchFaqs()" placeholder="Search by keyword (e.g. credits, certificate, BA, fees)..." class="w-full h-14 pl-6 pr-6 rounded-full bg-white text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-xl">
        </div>
    </div>
</section>

<!-- Filter Tabs & Accordion -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
    <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
        <button onclick="filterFaqCategory('all')" class="faq-cat-btn px-4 py-2 rounded-full text-xs font-bold transition bg-indigo-600 text-white shadow-md motion-btn-spring">All Questions</button>
        <button onclick="filterFaqCategory('eligibility')" class="faq-cat-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 motion-btn-spring">Eligibility & Streams</button>
        <button onclick="filterFaqCategory('ugc')" class="faq-cat-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 motion-btn-spring">UGC & Credits</button>
        <button onclick="filterFaqCategory('learning')" class="faq-cat-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 motion-btn-spring">Learning Format</button>
        <button onclick="filterFaqCategory('certification')" class="faq-cat-btn px-4 py-2 rounded-full text-xs font-bold transition bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 motion-btn-spring">Certificates</button>
    </div>

    @php
    $faqs = [
        ['cat' => 'eligibility', 'q' => 'Who is eligible to enroll in Infinity Interns programs?', 'a' => 'Any undergraduate student currently enrolled in BA, BSc, BBA, BCA, BCom, or related degree programs at recognized Indian universities or colleges is eligible. Students from 1st to 6th/8th semesters can participate based on their university curriculum requirements.'],
        ['cat' => 'eligibility', 'q' => 'Is Infinity Interns limited only to technical / engineering students?', 'a' => 'No! Infinity Interns is uniquely tailored for non-engineering undergraduate students (BA, BSc, BBA, BCA, BCom) who frequently lack structured, accredited internship pathways aligned with UGC and NEP-2020 guidelines.'],
        ['cat' => 'ugc', 'q' => 'Are the certificates and marksheets compliant with UGC and NEP-2020?', 'a' => 'Yes. Our curriculum, contact hours (60 to 120 hours), capstone projects, and evaluation frameworks are designed strictly according to UGC National Higher Education Qualifications Framework (NHEQF) guidelines for awarding 2 to 4 academic credits.'],
        ['cat' => 'ugc', 'q' => 'How does credit transfer work with my college / university?', 'a' => 'Upon completion, you receive an official packet containing your Certificate, Detailed Subject Marksheet, Project Report Dossier, and Attendance Log. You can submit this directly to your HOD or Examination Department for internal assessment scores.'],
        ['cat' => 'learning', 'q' => 'What is the format of the learning modules and sessions?', 'a' => 'The program is delivered through a hybrid structure: self-paced concept modules with practical workbooks, combined with scheduled weekly live interactive webinars for demonstrations, mentor reviews, and live Q&A.'],
        ['cat' => 'learning', 'q' => 'How much time do I need to commit each week?', 'a' => 'Students generally invest 4 to 6 hours per week. Because the self-paced materials and assignments are flexible, you can comfortably complete the internship without disrupting your daily college lectures and exam preparation.'],
        ['cat' => 'learning', 'q' => 'What kind of project will I build during the internship?', 'a' => 'Depending on your stream, you will complete an authentic industry-style capstone project. For example: survey analysis & policy brief (BA), ecological impact assessment report (BSc), financial model & pitch deck (BBA), or a full-stack web application (BCA).'],
        ['cat' => 'certification', 'q' => 'How can my college or employer verify my internship certificate?', 'a' => 'Every completion certificate issued by Infinity Interns includes an encrypted QR code and unique serial number (e.g. UGC-INF-XXXXXX). Anyone can verify the authenticity, dates, and grading via our central credential verification system.'],
        ['cat' => 'eligibility', 'q' => 'How do I complete registration and begin my onboarding?', 'a' => 'Click on any "Apply Now" or "Start Your Journey" button on the website. This opens our student enrollment form where you input your academic details and create your student dashboard credentials.'],
    ];
    @endphp

    <div class="space-y-4 motion-stagger" id="faqList">
        @foreach($faqs as $idx => $f)
        <details class="faq-item group p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs motion-card-hover [&_summary::-webkit-details-marker]:none" data-cat="{{ $f['cat'] }}">
            <summary class="flex items-center justify-between cursor-pointer font-serif text-base sm:text-lg text-slate-900 hover:text-indigo-700 font-medium">
                <span class="faq-q">{{ $f['q'] }}</span>
                <span class="ml-4 shrink-0 rounded-full bg-slate-100 p-1.5 text-slate-900 group-open:-rotate-180 transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
            </summary>
            <p class="faq-a mt-4 text-xs text-slate-600 leading-relaxed pt-3 border-t border-slate-100">
                {{ $f['a'] }}
            </p>
        </details>
        @endforeach
    </div>
</section>

@section('scripts')
<script>
    let activeCat = 'all';

    function filterFaqCategory(cat) {
        activeCat = cat;
        document.querySelectorAll('.faq-cat-btn').forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md');
            btn.classList.add('bg-white', 'text-slate-700', 'border', 'border-slate-200');
        });
        event.target.classList.remove('bg-white', 'text-slate-700', 'border');
        event.target.classList.add('bg-indigo-600', 'text-white', 'shadow-md');

        applyFilters();
    }

    function searchFaqs() {
        applyFilters();
    }

    function applyFilters() {
        const query = document.getElementById('faqSearch').value.toLowerCase();
        const items = document.querySelectorAll('.faq-item');

        items.forEach(item => {
            const cat = item.getAttribute('data-cat');
            const q = item.querySelector('.faq-q').innerText.toLowerCase();
            const a = item.querySelector('.faq-a').innerText.toLowerCase();

            const matchCat = (activeCat === 'all' || cat === activeCat);
            const matchQuery = (q.includes(query) || a.includes(query));

            if (matchCat && matchQuery) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection
@endsection
