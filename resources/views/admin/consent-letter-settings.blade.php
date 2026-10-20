@extends('layouts.admin')

@section('title', 'Consent Letter Settings')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Top Action / Breadcrumb Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-purple-600 dark:text-purple-400 mb-1">
                <span>Documents &amp; Templates</span>
                <span>/</span>
                <span class="text-slate-500 dark:text-slate-400">Consent Letter (Annexure I)</span>
            </div>
            <h1 class="text-2xl font-extrabold tracking-tight adm-text">Consent Letter Settings</h1>
            <p class="text-xs adm-text-secondary mt-1">
                Configure student college headers, Annexure I format, letter numbering, HOD/Principal signature, and institutional seals.
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if($sampleProfile)
                <a href="{{ route('admin.application.view-consent-letter', $sampleProfile->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400 shadow-xs transition motion-btn-spring">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>Preview Sample Letter</span>
                </a>
            @endif

            <form action="{{ route('admin.consent-letter.settings.reset') }}" method="POST" onsubmit="return confirm('Reset all consent letter settings to sample image defaults?');">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-slate-600 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 text-xs font-semibold border border-slate-200 dark:border-slate-700/80 transition cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Reset Defaults</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.consent-letter.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Section 1: Institutional Header & Annexure Setup -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold">
                    🏛️
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Institutional Header &amp; Letter Titles</h2>
                    <p class="text-xs adm-text-secondary">Printed dynamically at the top of the official college consent letter</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Default College Header Fallback -->
                <div class="space-y-1.5 md:col-span-2">
                    <label class="block text-xs font-bold adm-text">
                        Default College Name (Fallback) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="default_college" value="{{ old('default_college', $settings->default_college) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-bold uppercase focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                    <span class="text-[10px] text-emerald-600 dark:text-emerald-400 block font-medium">
                        ✦ Note: For each student, their own enrolled college name is automatically formatted in bold uppercase (e.g. <code>GAYA COLLEGE, GAYA.</code>). This field acts as the default fallback.
                    </span>
                </div>

                <!-- Annexure Text -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Annexure Subtitle <span class="text-rose-500">*</span></label>
                    <input type="text" name="annexure_text" value="{{ old('annexure_text', $settings->annexure_text) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs uppercase focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Default: <code>ANNEXURE I</code></span>
                </div>

                <!-- Letter Title -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Document Title <span class="text-rose-500">*</span></label>
                    <input type="text" name="letter_title" value="{{ old('letter_title', $settings->letter_title) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-bold uppercase focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Default: <code>CONSENT LETTER</code></span>
                </div>

                <!-- Letter Subject / Addressee -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Salutation / Subject Line <span class="text-rose-500">*</span></label>
                    <input type="text" name="letter_subject" value="{{ old('letter_subject', $settings->letter_subject) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-bold uppercase focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Default: <code>TO WHOM IT MAY CONCERN</code></span>
                </div>

                <!-- Letter No Prefix -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Letter Number Prefix <span class="text-rose-500">*</span></label>
                    <input type="text" name="letter_no_prefix" value="{{ old('letter_no_prefix', $settings->letter_no_prefix) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-mono focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Generates: <code>GC/CL/2026/047</code></span>
                </div>
            </div>
        </div>

        <!-- Section 2: Curriculum Text & Internship Credits -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold">
                    🎓
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Curriculum &amp; Credit Requirements</h2>
                    <p class="text-xs adm-text-secondary">Opening introduction paragraph printed above the 8-row candidate table</p>
                </div>
            </div>

            <div class="space-y-5">
                <!-- Credits & Hours specification -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Credits &amp; Contact Hours Requirement <span class="text-rose-500">*</span></label>
                    <input type="text" name="credits_text" value="{{ old('credits_text', $settings->credits_text) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. <code>minimum 04 credits (120 hrs)</code></span>
                </div>

                <!-- Introduction Paragraph -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Introductory Notification Paragraph</label>
                    <textarea name="intro_text" rows="3" placeholder="As part of the curriculum of CBCS UG the students are required to undertake internship of minimum 04 credits (120 hrs) in an organization. In this regard, I am introducing the below mentioned student with the following details for the purpose of internship:" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-purple-500 focus:outline-hidden">{{ old('intro_text', $settings->intro_text) }}</textarea>
                    <span class="text-[10px] adm-text-muted">Leave empty to use standard CBCS UG curriculum declaration</span>
                </div>
            </div>
        </div>

        <!-- Section 3: Official Authority, Signature & Stamp -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold">
                    ✒️
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">College Authority Signature &amp; Official Seal</h2>
                    <p class="text-xs adm-text-secondary">Configure HOD/Principal sign line, digital signature, and college seal stamps</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Authority Designation -->
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm">📝</span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white">Institutional Authority</h3>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold adm-text">Authority Designation Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="authority_designation" value="{{ old('authority_designation', $settings->authority_designation) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-purple-500 focus:outline-hidden">
                        <span class="text-[10px] adm-text-muted">e.g. <code>Signature of HOD / Principal with Seal</code></span>
                    </div>

                    <div class="pt-2">
                        <label class="flex items-center gap-2 text-xs font-medium adm-text cursor-pointer">
                            <input type="checkbox" name="show_signature_line" value="1" {{ old('show_signature_line', $settings->show_signature_line) ? 'checked' : '' }} class="w-4 h-4 rounded text-purple-600 focus:ring-purple-500 border-slate-300">
                            <span>Show physical signing line on printed document</span>
                        </label>
                    </div>

                    <!-- Upload Signature Image -->
                    <div class="space-y-2 pt-2 border-t border-slate-200 dark:border-slate-700/60">
                        <label class="block text-xs font-bold adm-text">Upload Authority Signature (Optional)</label>
                        <div class="flex items-center gap-3">
                            <div class="w-32 h-16 rounded-xl border border-dashed border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800/80 p-2 flex items-center justify-center shrink-0">
                                @if($settings->signature_path)
                                    <img src="{{ asset($settings->signature_path) }}" alt="Signature" class="max-h-full max-w-full object-contain">
                                @else
                                    <span class="text-[10px] text-slate-400 font-serif italic">Blank Line</span>
                                @endif
                            </div>

                            <div class="flex-1 space-y-1.5">
                                <input type="file" name="signature" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-purple-50 dark:file:bg-purple-950/60 file:text-purple-700 dark:file:text-purple-300 hover:file:bg-purple-100 cursor-pointer">
                                <span class="text-[10px] adm-text-muted block">Leave empty for physical pen signing</span>
                            </div>
                        </div>

                        @if($settings->signature_path)
                            <div class="text-right">
                                <button type="button" onclick="removeImage('signature')" class="text-[11px] text-rose-600 hover:underline font-bold inline-flex items-center gap-1">
                                    <span>🗑️ Remove Signature File</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- College Stamp / Seal Upload -->
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm">🔘</span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white">College Official Stamp / Seal</h3>
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Optional digital impression of the college / department round seal stamp printed adjacent to the HOD/Principal endorsement.
                    </p>

                    <!-- Upload Seal Image -->
                    <div class="space-y-3 pt-2">
                        <label class="block text-xs font-bold adm-text">Upload Official Stamp Graphic</label>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-purple-300 dark:border-purple-600 bg-white dark:bg-slate-800/80 p-2 flex items-center justify-center shrink-0">
                                @if($settings->seal_path)
                                    <img src="{{ asset($settings->seal_path) }}" alt="College Seal" class="max-h-full max-w-full object-contain">
                                @else
                                    <div class="w-16 h-16 rounded-full border border-dashed border-slate-300 flex flex-col items-center justify-center text-center p-1 text-slate-400">
                                        <span class="text-[7px] font-bold uppercase">COLLEGE</span>
                                        <span class="text-[8px]">SEAL</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 space-y-2">
                                <input type="file" name="seal" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-purple-50 dark:file:bg-purple-950/60 file:text-purple-700 dark:file:text-purple-300 hover:file:bg-purple-100 cursor-pointer">
                                <span class="text-[10px] adm-text-muted block">Circular transparent PNG or SVG stamp (max 3MB)</span>

                                @if($settings->seal_path)
                                    <button type="button" onclick="removeImage('seal')" class="text-[11px] text-rose-600 hover:underline font-bold inline-flex items-center gap-1">
                                        <span>🗑️ Remove College Seal File</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Save Floating Bar -->
        <div class="sticky bottom-4 z-20 p-4 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200 dark:border-slate-800 shadow-xl flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                <span class="text-xs font-medium adm-text">Changes update Annexure I consent letter immediately</span>
            </div>

            <div class="flex items-center gap-3">
                @if($sampleProfile)
                    <a href="{{ route('admin.application.view-consent-letter', $sampleProfile->id) }}" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold adm-text hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        👁️ Preview Live
                    </a>
                @endif
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold shadow-lg shadow-purple-600/30 transition motion-btn-spring cursor-pointer">
                    💾 Save Consent Letter Settings
                </button>
            </div>
        </div>
    </form>

    <!-- Hidden form for removing uploaded media -->
    <form id="removeImageForm" action="{{ route('admin.consent-letter.settings.remove-image') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="type" id="removeImageType">
    </form>
</div>
@endsection

@section('scripts')
<script>
    function removeImage(type) {
        if (confirm('Are you sure you want to remove this uploaded image?')) {
            document.getElementById('removeImageType').value = type;
            document.getElementById('removeImageForm').submit();
        }
    }
</script>
@endsection
