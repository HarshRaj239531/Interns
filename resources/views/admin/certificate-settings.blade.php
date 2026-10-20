@extends('layouts.admin')

@section('title', 'Certificate Settings')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Top Action / Breadcrumb Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-emerald-600 dark:text-emerald-400 mb-1">
                <span>Documents &amp; Templates</span>
                <span>/</span>
                <span class="text-slate-500 dark:text-slate-400">Official Certificate of Completion</span>
            </div>
            <h1 class="text-2xl font-extrabold tracking-tight adm-text">Certificate of Completion Settings</h1>
            <p class="text-xs adm-text-secondary mt-1">
                Configure certificate typography, director stamp &amp; signature, MSME &amp; AICTE accreditation logos, training duration, mode, and verification QR links.
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if($sampleProfile)
                <a href="{{ route('admin.application.view-certificate', $sampleProfile->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400 shadow-xs transition motion-btn-spring">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>Preview Live Certificate</span>
                </a>
            @endif

            <form action="{{ route('admin.certificate.settings.reset') }}" method="POST" onsubmit="return confirm('Reset all certificate settings to exact sample image defaults?');">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-slate-600 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 text-xs font-semibold border border-slate-200 dark:border-slate-700/80 transition cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Reset Defaults</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.certificate.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Section 1: Header & Typography Setup -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg">
                    🎓
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Certificate Header &amp; Branding</h2>
                    <p class="text-xs adm-text-secondary">Official titles and slogans printed at the top center</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Company Name -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Company / Brand Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="company_name" value="{{ old('company_name', $settings->company_name) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>

                <!-- Tagline / Slogan -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Official Tagline / Slogan <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="tagline" value="{{ old('tagline', $settings->tagline) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>

                <!-- Certificate Title -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Certificate Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $settings->title) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>

                <!-- Website URL -->
                <div class="space-y-1.5 md:col-span-2 lg:col-span-3">
                    <label class="block text-xs font-bold adm-text">
                        Official Website URL (Printed at bottom right) <span class="text-rose-500">*</span>
                    </label>
                    <input type="url" name="website_url" value="{{ old('website_url', $settings->website_url) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>
            </div>
        </div>

        <!-- Section 2: Program Parameters (Duration & Mode) -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg">
                    ⏱️
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Internship Parameters</h2>
                    <p class="text-xs adm-text-secondary">Default duration and delivery mode printed in certificate citation</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Duration -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Default Internship Duration <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="default_duration" value="{{ old('default_duration', $settings->default_duration) }}" placeholder="e.g. 45 Days, 6 Weeks, 8 Weeks" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>

                <!-- Delivery Mode -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Default Delivery Mode <span class="text-rose-500">*</span>
                    </label>
                    <select name="default_mode" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                        <option value="Offline" {{ old('default_mode', $settings->default_mode) === 'Offline' ? 'selected' : '' }}>Offline mode</option>
                        <option value="Online" {{ old('default_mode', $settings->default_mode) === 'Online' ? 'selected' : '' }}>Online mode</option>
                        <option value="Hybrid" {{ old('default_mode', $settings->default_mode) === 'Hybrid' ? 'selected' : '' }}>Hybrid mode</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Section 3: Official Signatory & Stamp Box -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-lg">
                    ✍️
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Director Signature, Stamp &amp; Corporate Unit</h2>
                    <p class="text-xs adm-text-secondary">Authentic stamp box with handwritten signature printed at bottom left</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Director Name -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Signatory / Director Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="director_name" value="{{ old('director_name', $settings->director_name) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>

                <!-- Director Title -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Signatory Designation <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="director_title" value="{{ old('director_title', $settings->director_title) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>

                <!-- Company Unit -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold adm-text">
                        Corporate Unit Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="company_unit" value="{{ old('company_unit', $settings->company_unit) }}" required class="w-full px-3.5 py-2.5 rounded-xl text-xs adm-input">
                </div>
            </div>

            <!-- Stamp & Signature Box Upload -->
            <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
                <label class="block text-xs font-bold adm-text mb-2">
                    Official Stamp Box with Signature (PNG, Transparent background recommended)
                </label>
                <div class="flex flex-col sm:flex-row sm:items-center gap-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800">
                    <div class="w-48 h-20 bg-white border border-slate-300 dark:border-slate-700 rounded-lg flex items-center justify-center p-2 shadow-xs shrink-0 overflow-hidden">
                        @if($settings->stamp_signature_path && file_exists(public_path($settings->stamp_signature_path)))
                            <img src="{{ asset($settings->stamp_signature_path) }}" alt="Stamp Signature" class="max-h-full max-w-full object-contain">
                        @else
                            <img src="/images/certificate/stamp_signature.png" alt="Stamp Signature" class="max-h-full max-w-full object-contain">
                        @endif
                    </div>
                    <div class="flex-1 space-y-2">
                        <input type="file" name="stamp_signature" accept="image/*" class="text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-950/80 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 cursor-pointer">
                        <p class="text-[11px] adm-text-muted">
                            Recommended: High-resolution transparent PNG with border and signature. Currently using: <code class="font-mono text-[10px] text-indigo-600 dark:text-indigo-400">{{ $settings->stamp_signature_path ?? '/images/certificate/stamp_signature.png' }}</code>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 4: Government Accreditations (MSME & AICTE Logos) -->
        <div class="adm-card p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-lg">
                    🇮🇳
                </div>
                <div>
                    <h2 class="text-base font-bold adm-text">Government Recognition Emblems</h2>
                    <p class="text-xs adm-text-secondary">Official MSME &amp; AICTE accreditation logos printed at bottom center</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- MSME Logo -->
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 space-y-3">
                    <span class="block text-xs font-bold adm-text">1. MSME Logo (Govt of India Ashoka Lion + MSME)</span>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-white border border-slate-300 dark:border-slate-700 rounded-lg flex items-center justify-center p-2 shadow-xs shrink-0">
                            @if($settings->msme_logo_path && file_exists(public_path($settings->msme_logo_path)))
                                <img src="{{ asset($settings->msme_logo_path) }}" alt="MSME Logo" class="max-h-full max-w-full object-contain">
                            @else
                                <img src="/images/certificate/msme_logo.png" alt="MSME Logo" class="max-h-full max-w-full object-contain">
                            @endif
                        </div>
                        <div class="flex-1 space-y-1.5">
                            <input type="file" name="msme_logo" accept="image/*" class="text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:text-[11px] file:font-semibold file:bg-slate-200 dark:file:bg-slate-800 text-slate-700 dark:text-slate-300 cursor-pointer">
                            <p class="text-[10px] adm-text-muted">Standard transparent PNG.</p>
                        </div>
                    </div>
                </div>

                <!-- AICTE Logo -->
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 space-y-3">
                    <span class="block text-xs font-bold adm-text">2. AICTE Logo (Technical Education Gear Emblem)</span>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-white border border-slate-300 dark:border-slate-700 rounded-lg flex items-center justify-center p-2 shadow-xs shrink-0">
                            @if($settings->aicte_logo_path && file_exists(public_path($settings->aicte_logo_path)))
                                <img src="{{ asset($settings->aicte_logo_path) }}" alt="AICTE Logo" class="max-h-full max-w-full object-contain">
                            @else
                                <img src="/images/certificate/aicte_logo.png" alt="AICTE Logo" class="max-h-full max-w-full object-contain">
                            @endif
                        </div>
                        <div class="flex-1 space-y-1.5">
                            <input type="file" name="aicte_logo" accept="image/*" class="text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:text-[11px] file:font-semibold file:bg-slate-200 dark:file:bg-slate-800 text-slate-700 dark:text-slate-300 cursor-pointer">
                            <p class="text-[10px] adm-text-muted">Standard transparent PNG.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
            <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-lg shadow-emerald-600/30 transition motion-btn-spring cursor-pointer flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Save Certificate Template Settings</span>
            </button>
        </div>
    </form>

</div>
@endsection
