@extends('layouts.admin')

@section('title', 'Offer Letter Settings')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Top Action / Breadcrumb Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-indigo-600 dark:text-indigo-400 mb-1">
                <span>Documents &amp; Templates</span>
                <span>/</span>
                <span class="text-slate-500 dark:text-slate-400">Offer Letter</span>
            </div>
            <h1 class="text-2xl font-extrabold tracking-tight adm-text">Offer Letter Settings</h1>
            <p class="text-xs adm-text-secondary mt-1">
                Configure letterhead header, registered office, CIN, signatory signature, and official seal stamps.
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if($sampleProfile)
                <a href="{{ route('admin.application.view-offer-letter', $sampleProfile->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 shadow-xs transition motion-btn-spring">
                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>Preview Sample Letter</span>
                </a>
            @endif

            <form action="{{ route('admin.offer-letter.settings.reset') }}" method="POST" onsubmit="return confirm('Reset all offer letter settings to sample image defaults? Any uploaded signature/seal will be retained.');">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-slate-600 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 text-xs font-semibold border border-slate-200 dark:border-slate-700/80 transition cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Reset Defaults</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.offer-letter.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Section 1: Header & Company Details -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold">
                    🏛️
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Header &amp; Organization Information</h2>
                    <p class="text-xs adm-text-secondary">Printed at the very top of the official letterhead</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Company Name -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Company / Organization Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="company_name" value="{{ old('company_name', $settings->company_name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Displayed in header &amp; sign-off (e.g. INFINITY INTERNS)</span>
                </div>

                <!-- Company Subtitle -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Legal Subtitle / Unit Affiliation</label>
                    <input type="text" name="company_subtitle" value="{{ old('company_subtitle', $settings->company_subtitle) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. A unit of Infinitya1 Career Counselling private limited</span>
                </div>

                <!-- CIN Number -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">CIN Number</label>
                    <input type="text" name="cin_number" value="{{ old('cin_number', $settings->cin_number) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-mono focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. U85500BR2025PTC075319</span>
                </div>

                <!-- Registered Address -->
                <div class="space-y-1.5 md:col-span-2">
                    <label class="block text-xs font-bold adm-text">Official Header Address <span class="text-rose-500">*</span></label>
                    <input type="text" name="address" value="{{ old('address', $settings->address) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. B-hub Maurya Lok Complex, Patna, Bihar – 800001</span>
                </div>

                <!-- Contact Email -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Official Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $settings->email) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. info@infinityinterns.com</span>
                </div>

                <!-- Official Website -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Official Website <span class="text-rose-500">*</span></label>
                    <input type="text" name="website" value="{{ old('website', $settings->website) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. www.infinityinterns.com</span>
                </div>

                <!-- Custom Header Logo -->
                <div class="space-y-1.5 md:col-span-2">
                    <label class="block text-xs font-bold adm-text">Custom Header Logo (Optional)</label>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-16 rounded-xl border border-slate-200 dark:border-slate-700 bg-white p-2 flex items-center justify-center shrink-0">
                            <img src="{{ $settings->logo_path ? asset($settings->logo_path) : '/infinity-interns-logo.png' }}" alt="Current Logo" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="flex-1 space-y-2">
                            <input type="file" name="logo" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-950/60 file:text-indigo-700 dark:file:text-indigo-400 hover:file:bg-indigo-100 cursor-pointer">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] adm-text-muted">Leave empty to use default Infinity Interns logo (PNG, JPG, SVG, max 3MB)</span>
                                @if($settings->logo_path)
                                    <button type="button" onclick="removeImage('logo')" class="text-[10px] text-rose-600 hover:underline font-bold">Remove Custom Logo</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Authorized Signatory & Official Stamp / Seal -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold">
                    ✍️
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Authorized Signatory &amp; Official Seal</h2>
                    <p class="text-xs adm-text-secondary">Upload signature and official seal stamp images to render at the bottom of the letter</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Signatory Info & Upload -->
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm">✒️</span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white">Authorized Signatory</h3>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold adm-text">Signatory Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="signatory_name" value="{{ old('signatory_name', $settings->signatory_name) }}" required class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                        <span class="text-[10px] adm-text-muted">e.g. Aryav Singh Vishal</span>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold adm-text">Designation / Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="signatory_designation" value="{{ old('signatory_designation', $settings->signatory_designation) }}" required class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                        <span class="text-[10px] adm-text-muted">e.g. Authorized Signatory</span>
                    </div>

                    <!-- Upload Signature Image -->
                    <div class="space-y-2 pt-2 border-t border-slate-200 dark:border-slate-700/60">
                        <label class="block text-xs font-bold adm-text">Upload Signature Image</label>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-32 h-16 rounded-xl border border-dashed border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800/80 p-2 flex items-center justify-center shrink-0">
                                @if($settings->signature_path)
                                    <img src="{{ asset($settings->signature_path) }}" alt="Signature" class="max-h-full max-w-full object-contain">
                                @else
                                    <span class="text-[10px] text-slate-400 font-serif italic">No signature file</span>
                                @endif
                            </div>

                            <div class="flex-1 space-y-1.5">
                                <input type="file" name="signature" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-purple-50 dark:file:bg-purple-950/60 file:text-purple-700 dark:file:text-purple-300 hover:file:bg-purple-100 cursor-pointer">
                                <span class="text-[10px] adm-text-muted block">Transparent PNG or SVG recommended (max 3MB)</span>
                            </div>
                        </div>

                        @if($settings->signature_path)
                            <div class="text-right">
                                <button type="button" onclick="removeImage('signature')" class="text-[11px] text-rose-600 hover:underline font-bold inline-flex items-center gap-1">
                                    <span>🗑️ Remove Uploaded Signature</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Official Stamp / Seal Upload -->
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm">🔘</span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900 dark:text-white">Official Stamp / Seal</h3>
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        The official seal stamp is positioned on the bottom right of the offer letter, above the label <strong class="text-slate-800 dark:text-slate-200">"Official Seal / Signature"</strong>.
                    </p>

                    <!-- Upload Seal Image -->
                    <div class="space-y-3 pt-2">
                        <label class="block text-xs font-bold adm-text">Upload Official Stamp / Seal Graphic</label>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-indigo-300 dark:border-indigo-600 bg-white dark:bg-slate-800/80 p-2 flex items-center justify-center shrink-0">
                                @if($settings->seal_path)
                                    <img src="{{ asset($settings->seal_path) }}" alt="Official Seal" class="max-h-full max-w-full object-contain">
                                @else
                                    <div class="w-16 h-16 rounded-full border border-dashed border-slate-300 flex flex-col items-center justify-center text-center p-1 text-slate-400">
                                        <span class="text-[7px] font-bold uppercase">SEAL</span>
                                        <span class="text-[8px]">STAMP</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 space-y-2">
                                <input type="file" name="seal" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-indigo-50 dark:file:bg-indigo-950/60 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 cursor-pointer">
                                <span class="text-[10px] adm-text-muted block">Circular transparent PNG or SVG stamp recommended (max 3MB)</span>

                                @if($settings->seal_path)
                                    <button type="button" onclick="removeImage('seal')" class="text-[11px] text-rose-600 hover:underline font-bold inline-flex items-center gap-1">
                                        <span>🗑️ Remove Uploaded Seal Stamp</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Offer Letter Table & Default Terms -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold">
                    📋
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Offer Letter Table &amp; Key Details</h2>
                    <p class="text-xs adm-text-secondary">Configures the 7 table rows and reference numbering format</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Letter Title -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Document Heading Title <span class="text-rose-500">*</span></label>
                    <input type="text" name="letter_title" value="{{ old('letter_title', $settings->letter_title) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-bold uppercase focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Default: INTERNSHIP OFFER LETTER</span>
                </div>

                <!-- Ref Prefix -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Reference Number Prefix <span class="text-rose-500">*</span></label>
                    <input type="text" name="ref_prefix" value="{{ old('ref_prefix', $settings->ref_prefix) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs font-mono focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Generates: <code>II/OL/2026/047</code></span>
                </div>

                <!-- Acceptance Days -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Acceptance Window (Days) <span class="text-rose-500">*</span></label>
                    <input type="number" name="acceptance_days" min="1" max="90" value="{{ old('acceptance_days', $settings->acceptance_days) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Days after issue date for "confirm acceptance by [Date]"</span>
                </div>

                <!-- Row 1: Default Role -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Default Internship Role</label>
                    <input type="text" name="default_role" value="{{ old('default_role', $settings->default_role) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">Fallback if student domain is empty (e.g. Financial Management Intern)</span>
                </div>

                <!-- Row 2: Default Department -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Default Department</label>
                    <input type="text" name="default_department" value="{{ old('default_department', $settings->default_department) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. Marketing &amp; Finance</span>
                </div>

                <!-- Row 3: Location -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Work Location <span class="text-rose-500">*</span></label>
                    <input type="text" name="default_location" value="{{ old('default_location', $settings->default_location) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. ON-OFFICE or Remote or Patna Office</span>
                </div>

                <!-- Row 4: Duration -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Internship Duration <span class="text-rose-500">*</span></label>
                    <input type="text" name="default_duration" value="{{ old('default_duration', $settings->default_duration) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. 06 June 2026 to 21 July 2026</span>
                </div>

                <!-- Row 5: Stipend -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Stipend Details <span class="text-rose-500">*</span></label>
                    <input type="text" name="default_stipend" value="{{ old('default_stipend', $settings->default_stipend) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. Rs 5000 or Performance Based</span>
                </div>

                <!-- Row 6: Reporting Manager -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Reporting Manager <span class="text-rose-500">*</span></label>
                    <input type="text" name="default_reporting_manager" value="{{ old('default_reporting_manager', $settings->default_reporting_manager) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. Aryav Singh Vishal</span>
                </div>

                <!-- Row 7: Mode of Internship -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Mode of Internship <span class="text-rose-500">*</span></label>
                    <input type="text" name="default_mode" value="{{ old('default_mode', $settings->default_mode) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">
                    <span class="text-[10px] adm-text-muted">e.g. Office / Hybrid / Online</span>
                </div>
            </div>
        </div>

        <!-- Section 4: Paragraphs & Custom Content (Optional) -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold">
                    📝
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Letter Body Paragraphs (Optional Customization)</h2>
                    <p class="text-xs adm-text-secondary">Leave blank to use the standard verified text from the reference template</p>
                </div>
            </div>

            <div class="space-y-5">
                <!-- Intro text -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Introduction Paragraph</label>
                    <textarea name="intro_text" rows="3" placeholder="We are pleased to offer you an internship with [Company Name] ([Company Subtitle]). We believe that your skills and interests align well with our mission, and we are confident that this internship will be a valuable opportunity for your professional growth and development." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">{{ old('intro_text', $settings->intro_text) }}</textarea>
                </div>

                <!-- Terms text -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Conduct &amp; Policies Statement (Under Table)</label>
                    <textarea name="terms_text" rows="2" placeholder="You will be expected to maintain professionalism, meet the assigned objectives, and abide by the policies and confidentiality terms of the organization." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">{{ old('terms_text', $settings->terms_text) }}</textarea>
                </div>

                <!-- Closing text -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">Closing Wish Line</label>
                    <textarea name="closing_text" rows="2" placeholder="We look forward to having you as part of our team and wish you a fruitful learning journey with Infinity Interns." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 adm-text text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-hidden">{{ old('closing_text', $settings->closing_text) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Sticky Save Floating Bar -->
        <div class="sticky bottom-4 z-20 p-4 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200 dark:border-slate-800 shadow-xl flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span class="text-xs font-medium adm-text">Changes apply instantly to all student offer letters</span>
            </div>

            <div class="flex items-center gap-3">
                @if($sampleProfile)
                    <a href="{{ route('admin.application.view-offer-letter', $sampleProfile->id) }}" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold adm-text hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        👁️ Preview Live
                    </a>
                @endif
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-lg shadow-indigo-600/30 transition motion-btn-spring cursor-pointer">
                    💾 Save Offer Letter Settings
                </button>
            </div>
        </div>
    </form>

    <!-- Hidden form for removing uploaded media -->
    <form id="removeImageForm" action="{{ route('admin.offer-letter.settings.remove-image') }}" method="POST" class="hidden">
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
