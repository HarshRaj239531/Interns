@extends('layouts.admin')

@section('title', 'Manual Certificate Generator – Infinity Interns')

@section('content')
<div class="space-y-6">

    <!-- Top Header -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 text-xs font-semibold mb-2 border border-emerald-200 dark:border-emerald-800">
                <span>✦ Authentic UGC Central Credential Registry</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Manual Certificate Generator</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 max-w-2xl">
                Generate, authorize, and issue tamper-proof completion certificates for any enrolled student or on-the-fly candidate with instant tamper-proof QR verification.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-xl adm-card hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold transition">
                ← Back to Dashboard
            </a>
            <a href="{{ route('verify') }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30">
                Open Public Verifier ↗
            </a>
        </div>
    </div>

    <!-- Generator Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Form Card (Col 7) -->
        <div class="lg:col-span-7 rounded-3xl adm-card p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
                <h3 class="font-serif font-bold text-lg adm-text">Certificate Issue Parameters</h3>
                <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 font-bold">
                    Direct Dispatch
                </span>
            </div>

            <!-- Mode Switcher -->
            <div class="flex items-center gap-2 p-1.5 rounded-2xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-bold">
                <button type="button" onclick="setMode('existing')" id="modeBtnExisting" class="flex-1 py-2 rounded-xl bg-indigo-600 text-white shadow-sm transition">
                    Pick Enrolled Student
                </button>
                <button type="button" onclick="setMode('custom')" id="modeBtnCustom" class="flex-1 py-2 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition">
                    Custom / Direct Entry
                </button>
            </div>

            <form action="{{ route('admin.certificate-generator.generate') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="mode" id="generatorMode" value="existing">

                <!-- 1. Existing Student Selection -->
                <div id="existingStudentSection" class="space-y-3">
                    <label class="block text-xs font-semibold adm-text-secondary">Select Enrolled Student *</label>
                    <select name="student_id" id="student_select" onchange="populateStudentData(this)" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-medium">
                        <option value="">-- Choose Candidate from Database --</option>
                        @foreach($students as $st)
                            <option value="{{ $st->id }}"
                                data-name="{{ $st->user->name }}"
                                data-college="{{ $st->college }}"
                                data-degree="{{ $st->degree }}"
                                data-domain="{{ $st->program_domain }}"
                                data-mentor="{{ $st->mentor_name }}"
                                data-project="{{ $st->project_title }}"
                                data-cert="{{ $st->certificate_number }}"
                                {{ ($selectedStudent && $selectedStudent->id === $st->id) ? 'selected' : '' }}>
                                {{ $st->user->name }} ({{ $st->application_number }}) – {{ $st->college }} [{{ $st->program_domain }}]
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. Custom Candidate Details (Shows when custom mode is active) -->
                <div id="customCandidateSection" class="hidden space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold adm-text-secondary mb-1">Candidate Full Name *</label>
                            <input type="text" name="candidate_name" id="custom_name" placeholder="e.g. Priya Kumari" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold adm-text-secondary mb-1">Candidate Email</label>
                            <input type="email" name="candidate_email" id="custom_email" placeholder="priya@example.com" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold adm-text-secondary mb-1">College / Institute *</label>
                            <input type="text" name="college" id="custom_college" placeholder="e.g. Patna Women's College" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold adm-text-secondary mb-1">Degree *</label>
                            <select name="degree" id="custom_degree" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                                <option value="BSc">Bachelor of Science (BSc)</option>
                                <option value="BA">Bachelor of Arts (BA)</option>
                                <option value="BBA">Bachelor of Business Admin (BBA)</option>
                                <option value="BCA">Bachelor of Computer App (BCA)</option>
                                <option value="BCom">Bachelor of Commerce (BCom)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 3. Stream & Credential Parameters -->
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Internship Stream Domain *</label>
                    <select name="program_domain" id="input_domain" required class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                        @foreach($streams as $stream)
                            <option value="{{ $stream->title }}">{{ $stream->title }} ({{ $stream->code }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text-secondary mb-1">Certificate Serial Number</label>
                        <input type="text" name="certificate_number" id="input_cert_number" value="UGC-INF-{{ rand(100000, 999999) }}" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs font-mono font-bold">
                        <span class="text-[10px] text-slate-400">Unique alphanumeric tamper-proof identifier</span>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text-secondary mb-1">Certificate Issue Date *</label>
                        <input type="date" name="certificate_date" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text-secondary mb-1">Faculty Mentor Signatory</label>
                        <input type="text" name="mentor_name" id="input_mentor" value="Dr. Alok Verma, M.Tech, PhD" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text-secondary mb-1">Overall Evaluation Grade</label>
                        <select name="marksheet_grade" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs font-bold">
                            <option value="A+">A+ (Outstanding - 90%+)</option>
                            <option value="A">A (Excellent - 80-89%)</option>
                            <option value="B+">B+ (Very Good - 70-79%)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Capstone Project Title</label>
                    <input type="text" name="project_title" id="input_project" value="Applied Practical Domain Capstone Report" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs">
                </div>

                <div class="pt-4 flex items-center justify-between border-t border-slate-200 dark:border-slate-800">
                    <span class="text-[11px] adm-text-muted">Generates instant verifiable UGC document.</span>
                    <button type="submit" class="px-7 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition shadow-lg shadow-emerald-600/30 cursor-pointer">
                        Authorize & Print Certificate ↗
                    </button>
                </div>
            </form>
        </div>

        <!-- Live Preview / Info Card (Col 5) -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Simulated Certificate Card -->
            <div class="p-6 rounded-3xl adm-card border-2 border-indigo-500/30 shadow-2xl relative overflow-hidden space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Live Preview Sample</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>

                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 text-center space-y-2">
                    <img src="/infinity-interns-logo.png" alt="Logo" class="h-10 mx-auto object-contain">
                    <h4 class="font-serif font-bold text-base adm-text">CERTIFICATE OF INTERNSHIP COMPLETION</h4>
                    <p class="text-[11px] adm-text-muted">This certifies that</p>
                    <p class="text-base font-bold text-indigo-600 dark:text-indigo-400" id="previewName">Candidate Name</p>
                    <p class="text-[11px] adm-text-muted">of <strong id="previewCollege">University / College</strong></p>
                    <p class="text-xs adm-text font-medium">has successfully completed the UGC-Accredited 8-Week Practical Training in <span class="text-indigo-600 dark:text-indigo-400 font-bold" id="previewDomain">Domain Track</span>.</p>
                    <div class="pt-3 flex items-center justify-between text-[10px] text-slate-400 font-mono border-t border-slate-200 dark:border-slate-800">
                        <span id="previewSerial">SERIAL: UGC-INF-XXXXXX</span>
                        <span>QR VERIFIED ✓</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-200 dark:border-indigo-800/40 text-xs space-y-1.5">
                    <span class="font-bold text-indigo-900 dark:text-indigo-200 block">✦ UGC Compliance Checklist:</span>
                    <p class="text-indigo-700 dark:text-indigo-300 text-[11px]">• NHEQF Level 5/6 4.0 Academic Credits transferable to university portal.</p>
                    <p class="text-indigo-700 dark:text-indigo-300 text-[11px]">• Tamper-proof SHA verification code tied to central database.</p>
                    <p class="text-indigo-700 dark:text-indigo-300 text-[11px]">• Instant scan verification via smartphone camera.</p>
                </div>
            </div>

            <!-- Recent Issued Certificates List -->
            <div class="p-6 rounded-3xl adm-card shadow-xl space-y-3">
                <h4 class="font-serif font-bold text-sm adm-text">Recently Issued Certificates</h4>
                <div class="space-y-2 text-xs">
                    @forelse($recentCertificates as $rc)
                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex items-center justify-between">
                            <div>
                                <span class="font-bold adm-text block">{{ $rc->user->name ?? 'Candidate' }}</span>
                                <span class="font-mono text-emerald-600 dark:text-emerald-400 text-[11px]">{{ $rc->certificate_number }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.application.view-certificate', $rc->id) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-[10px] font-bold hover:underline">
                                    View ↗
                                </a>
                                <a href="{{ route('verify', $rc->certificate_number) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold hover:underline">
                                    Verify ↗
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs adm-text-muted py-2">No certificates issued yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function setMode(mode) {
        document.getElementById('generatorMode').value = mode;
        const btnExisting = document.getElementById('modeBtnExisting');
        const btnCustom = document.getElementById('modeBtnCustom');
        const secExisting = document.getElementById('existingStudentSection');
        const secCustom = document.getElementById('customCandidateSection');

        if (mode === 'existing') {
            btnExisting.className = 'flex-1 py-2 rounded-xl bg-indigo-600 text-white shadow-sm transition';
            btnCustom.className = 'flex-1 py-2 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition';
            secExisting.classList.remove('hidden');
            secCustom.classList.add('hidden');
        } else {
            btnCustom.className = 'flex-1 py-2 rounded-xl bg-indigo-600 text-white shadow-sm transition';
            btnExisting.className = 'flex-1 py-2 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition';
            secCustom.classList.remove('hidden');
            secExisting.classList.add('hidden');
        }
    }

    function populateStudentData(selectElem) {
        const option = selectElem.options[selectElem.selectedIndex];
        if (!option || !option.value) return;

        const name = option.getAttribute('data-name');
        const college = option.getAttribute('data-college');
        const domain = option.getAttribute('data-domain');
        const mentor = option.getAttribute('data-mentor');
        const project = option.getAttribute('data-project');
        const cert = option.getAttribute('data-cert');

        document.getElementById('previewName').innerText = name || 'Candidate Name';
        document.getElementById('previewCollege').innerText = college || 'Institute';
        document.getElementById('previewDomain').innerText = domain || 'Domain Track';

        if (domain) {
            const domainSelect = document.getElementById('input_domain');
            for (let i = 0; i < domainSelect.options.length; i++) {
                if (domainSelect.options[i].value === domain) {
                    domainSelect.selectedIndex = i;
                    break;
                }
            }
        }

        if (mentor) document.getElementById('input_mentor').value = mentor;
        if (project) document.getElementById('input_project').value = project;
        if (cert) {
            document.getElementById('input_cert_number').value = cert;
            document.getElementById('previewSerial').innerText = 'SERIAL: ' + cert;
        }
    }
</script>
@endsection
