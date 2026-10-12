@extends('layouts.admin')

@section('title', 'Academic Setup & Registration Options – Infinity Interns')

@section('content')
<div class="space-y-6" x-data="{
    currentTab: '{{ $tab ?? 'degrees' }}',
    degreeSearch: '',
    schoolSearch: '',
    domainSearch: '',
    // Real-time Preview State for Create Degree
    degreeForm: {
        name: '',
        code: '',
        duration: '3 / 4 Years (NEP-2020)',
        description: '',
        sort_order: 1,
        is_active: true
    },
    // Real-time Preview State for Create School
    schoolForm: {
        name: '',
        code: '',
        type: 'COLLEGE',
        city: 'Patna',
        state: 'Bihar',
        is_active: true
    },
    // Real-time Preview State for Create Domain
    streamForm: {
        title: '',
        code: '',
        category: 'TECHNOLOGY',
        duration: '8 Weeks (120 Contact Hours)',
        credits: '4.0 NHEQF Credits',
        description: '',
        is_active: true
    },
    setDegreePreset(name, code, duration) {
        this.degreeForm.name = name;
        this.degreeForm.code = code;
        this.degreeForm.duration = duration;
    },
    setSchoolPreset(name, code, city) {
        this.schoolForm.name = name;
        this.schoolForm.code = code;
        this.schoolForm.city = city;
    },
    setDomainPreset(title, code, category, duration, credits, desc) {
        this.streamForm.title = title;
        this.streamForm.code = code;
        this.streamForm.category = category;
        this.streamForm.duration = duration;
        this.streamForm.credits = credits;
        this.streamForm.description = desc;
    }
}">

    <!-- Top Header & Banner -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col lg:flex-row lg:items-center justify-between gap-6 motion-reveal">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 text-xs font-semibold mb-2 border border-indigo-200 dark:border-indigo-800">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Master Academic Catalog &amp; Registration Controls</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Academic Setup & Registration Data</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 leading-relaxed">
                Configure dynamic Degrees, Schools / Colleges, and Internship Domain Tracks in one place. All active entries configured here instantly populate the student registration portal, certificate issue templates, and administrative filter desks.
            </p>
        </div>

        <!-- Quick Stats Pills -->
        <div class="grid grid-cols-3 gap-3 shrink-0">
            <!-- Degrees Stat -->
            <button type="button" @click="currentTab = 'degrees'" class="p-3.5 rounded-2xl border text-center transition cursor-pointer" :class="currentTab === 'degrees' ? 'bg-indigo-600/10 border-indigo-500/50 ring-2 ring-indigo-500/20 text-indigo-600 dark:text-indigo-400' : 'bg-slate-50 dark:bg-slate-800/40 border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700'">
                <span class="text-xl sm:text-2xl font-extrabold block adm-text">{{ $stats['total_degrees'] ?? 0 }}</span>
                <span class="text-[10px] font-bold uppercase tracking-wider block adm-text-muted">Degrees</span>
                <span class="text-[9px] text-emerald-600 dark:text-emerald-400 font-semibold flex items-center justify-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ $stats['active_degrees'] ?? 0 }} Active
                </span>
            </button>

            <!-- Schools Stat -->
            <button type="button" @click="currentTab = 'schools'" class="p-3.5 rounded-2xl border text-center transition cursor-pointer" :class="currentTab === 'schools' ? 'bg-indigo-600/10 border-indigo-500/50 ring-2 ring-indigo-500/20 text-indigo-600 dark:text-indigo-400' : 'bg-slate-50 dark:bg-slate-800/40 border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700'">
                <span class="text-xl sm:text-2xl font-extrabold block adm-text">{{ $stats['total_schools'] ?? 0 }}</span>
                <span class="text-[10px] font-bold uppercase tracking-wider block adm-text-muted">Schools / Colleges</span>
                <span class="text-[9px] text-emerald-600 dark:text-emerald-400 font-semibold flex items-center justify-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ $stats['active_schools'] ?? 0 }} Active
                </span>
            </button>

            <!-- Domains Stat -->
            <button type="button" @click="currentTab = 'domains'" class="p-3.5 rounded-2xl border text-center transition cursor-pointer" :class="currentTab === 'domains' ? 'bg-indigo-600/10 border-indigo-500/50 ring-2 ring-indigo-500/20 text-indigo-600 dark:text-indigo-400' : 'bg-slate-50 dark:bg-slate-800/40 border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700'">
                <span class="text-xl sm:text-2xl font-extrabold block adm-text">{{ $stats['total_streams'] ?? 0 }}</span>
                <span class="text-[10px] font-bold uppercase tracking-wider block adm-text-muted">Domain Tracks</span>
                <span class="text-[9px] text-emerald-600 dark:text-emerald-400 font-semibold flex items-center justify-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ $stats['active_streams'] ?? 0 }} Active
                </span>
            </button>
        </div>
    </div>

    <!-- Tab Bar & Controls -->
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-3">
        <!-- Interactive Pill Switchers -->
        <div class="flex items-center gap-1.5 p-1.5 rounded-2xl bg-slate-100 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/60">
            <!-- Degrees Tab Button -->
            <button type="button" @click="currentTab = 'degrees'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition cursor-pointer" :class="currentTab === 'degrees' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'">
                <span class="text-sm">🎓</span>
                <span>Degrees &amp; Programs</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full font-extrabold" :class="currentTab === 'degrees' ? 'bg-white/20 text-white' : 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300'">
                    {{ $degrees->count() }}
                </span>
            </button>

            <!-- Schools & Colleges Tab Button -->
            <button type="button" @click="currentTab = 'schools'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition cursor-pointer" :class="currentTab === 'schools' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'">
                <span class="text-sm">🏫</span>
                <span>Schools &amp; Colleges</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full font-extrabold" :class="currentTab === 'schools' ? 'bg-white/20 text-white' : 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300'">
                    {{ $schools->count() }}
                </span>
            </button>

            <!-- Domains & Tracks Tab Button -->
            <button type="button" @click="currentTab = 'domains'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition cursor-pointer" :class="currentTab === 'domains' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'">
                <span class="text-sm">🚀</span>
                <span>Domains &amp; Tracks</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full font-extrabold" :class="currentTab === 'domains' ? 'bg-white/20 text-white' : 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300'">
                    {{ $streams->count() }}
                </span>
            </button>
        </div>

        <!-- Dynamic Action Buttons with Glow Effect -->
        <div class="flex items-center gap-3">
            <template x-if="currentTab === 'degrees'">
                <button type="button" onclick="openAddDegreeModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring flex items-center gap-2 border border-indigo-400/30">
                    <span class="text-sm">✦</span>
                    <span>Create New Degree</span>
                </button>
            </template>

            <template x-if="currentTab === 'schools'">
                <button type="button" onclick="openAddSchoolModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring flex items-center gap-2 border border-indigo-400/30">
                    <span class="text-sm">✦</span>
                    <span>Add School / College</span>
                </button>
            </template>

            <template x-if="currentTab === 'domains'">
                <button type="button" onclick="openAddStreamModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring flex items-center gap-2 border border-indigo-400/30">
                    <span class="text-sm">✦</span>
                    <span>Create Domain Track</span>
                </button>
            </template>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 1: DEGREES MANAGEMENT -->
    <!-- ========================================== -->
    <div x-show="currentTab === 'degrees'" class="space-y-6" x-cloak>

        <!-- ========================================== -->
        <!-- PRO INLINE STUDIO: CREATE NEW DEGREE -->
        <!-- ========================================== -->
        <div class="rounded-3xl adm-card border border-indigo-200 dark:border-indigo-800/80 p-5 sm:p-7 shadow-xl bg-gradient-to-br from-indigo-50/50 via-white to-purple-50/30 dark:from-indigo-950/20 dark:via-slate-900/60 dark:to-purple-950/20 motion-reveal">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-indigo-100 dark:border-indigo-900/40">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-indigo-600 text-white font-bold text-xl flex items-center justify-center shadow-md shadow-indigo-600/30 shrink-0">
                        🎓
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                            <span>⚡ Quick Registration Studio</span>
                        </div>
                        <h3 class="text-lg font-serif font-bold adm-text">Create &amp; Publish New Degree</h3>
                        <p class="text-xs adm-text-muted mt-0.5">Fill the form below or tap a 1-click preset. It will instantly appear in the student registration dropdown.</p>
                    </div>
                </div>

                <!-- 1-Click Fast Presets -->
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mr-1">⚡ Presets:</span>
                    <button type="button" @click="setDegreePreset('Bachelor of Computer Applications', 'BCA', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ BCA</button>
                    <button type="button" @click="setDegreePreset('Bachelor of Technology', 'B.Tech', '4 Years (8 Semesters)')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ B.Tech</button>
                    <button type="button" @click="setDegreePreset('Bachelor of Science', 'BSc', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ BSc</button>
                    <button type="button" @click="setDegreePreset('Bachelor of Business Administration', 'BBA', '3 Years (6 Semesters)')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ BBA</button>
                    <button type="button" @click="setDegreePreset('Bachelor of Commerce', 'BCom', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ BCom</button>
                    <button type="button" @click="setDegreePreset('Bachelor of Arts', 'BA', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ BA</button>
                    <button type="button" @click="setDegreePreset('Master of Computer Applications', 'MCA', '2 Years (4 Semesters)')" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">+ MCA</button>
                    <button type="button" @click="setDegreePreset('Master of Business Administration', 'MBA', '2 Years (4 Semesters)')" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">+ MBA</button>
                </div>
            </div>

            <!-- The Form -->
            <form action="{{ route('admin.degrees.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4">
                    <!-- Full Title -->
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold adm-text mb-1">Degree Title *</label>
                        <input type="text" name="name" x-model="degreeForm.name" required placeholder="e.g. Bachelor of Computer Applications" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-medium focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Code -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">Short Code *</label>
                        <input type="text" name="code" x-model="degreeForm.code" required placeholder="e.g. BCA, B.Tech" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-bold uppercase tracking-wider focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Duration -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold adm-text mb-1">Duration &amp; Framework *</label>
                        <input type="text" name="duration" x-model="degreeForm.duration" required placeholder="e.g. 3 / 4 Years (NEP-2020)" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Priority -->
                    <div class="md:col-span-1">
                        <label class="block text-xs font-bold adm-text mb-1">Order</label>
                        <input type="number" name="sort_order" x-model="degreeForm.sort_order" min="0" class="w-full px-3 py-2.5 rounded-xl adm-input text-xs text-center focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white text-xs font-extrabold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring flex items-center justify-center gap-1.5 border border-indigo-400/40">
                            <span>✦ Add Degree</span>
                        </button>
                    </div>
                </div>

                <!-- Footer Strip: Active Checkbox & Live Dropdown Preview -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2 border-t border-indigo-100/60 dark:border-indigo-900/30 text-xs">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="inline_degree_is_active" x-model="degreeForm.is_active" checked class="w-4 h-4 rounded text-indigo-600 cursor-pointer">
                        <label for="inline_degree_is_active" class="text-xs font-semibold adm-text cursor-pointer select-none">
                            Publish immediately to student registration dropdown
                        </label>
                    </div>

                    <!-- Live Dropdown Preview Badge -->
                    <div class="flex items-center gap-2 text-[11px] text-slate-500 bg-white/70 dark:bg-slate-800/70 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold">Candidate Dropdown Preview:</span>
                        <span class="font-bold adm-text" x-text="(degreeForm.code || 'CODE') + ' — ' + (degreeForm.name || 'Full Degree Title')"></span>
                    </div>
                </div>
            </form>
        </div>

        <div class="rounded-3xl adm-card overflow-hidden shadow-xl motion-reveal border">
            <!-- Search & Filter Bar -->
            <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/30">
                <div>
                    <h3 class="font-serif font-bold text-base adm-text">Undergraduate &amp; Academic Degrees ({{ $degrees->count() }})</h3>
                    <p class="text-[11px] adm-text-muted">Degrees that appear in the student registration dropdown, certificates, and academic reports.</p>
                </div>
                <div class="relative w-full sm:w-64">
                    <input type="text" x-model="degreeSearch" placeholder="Filter degrees (e.g. BCA)..." class="w-full pl-8 pr-3 py-1.5 rounded-xl adm-input text-xs">
                    <svg class="w-3.5 h-3.5 absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                        <tr>
                            <th class="py-3.5 px-4 font-bold">Degree Title &amp; Code</th>
                            <th class="py-3.5 px-4 font-bold">Duration / NEP Framework</th>
                            <th class="py-3.5 px-4 font-bold">Registered Scholars</th>
                            <th class="py-3.5 px-4 font-bold">Status</th>
                            <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($degrees as $degree)
                        <tr class="adm-table-row transition" x-show="!degreeSearch || '{{ strtolower($degree->name . ' ' . $degree->code) }}'.includes(degreeSearch.toLowerCase())">
                            <td class="py-4 px-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-indigo-600/20 text-indigo-600 dark:text-indigo-400 font-bold text-xs flex items-center justify-center shrink-0 border border-indigo-200 dark:border-indigo-800/80 shadow-xs">
                                        {{ $degree->code }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold adm-text text-sm">{{ $degree->name }}</span>
                                            <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[10px] font-bold px-2 py-0.5 rounded-md bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800/80">
                                                {{ $degree->code }}
                                            </span>
                                        </div>
                                        @if($degree->description)
                                            <p class="adm-text-muted text-[11px] mt-0.5 max-w-md line-clamp-1">{{ $degree->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                <span class="adm-text font-medium block">{{ $degree->duration }}</span>
                                <span class="text-[10px] text-slate-400 font-semibold">Priority #{{ $degree->sort_order }}</span>
                            </td>

                            <td class="py-4 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-extrabold text-sm adm-text">{{ $degree->student_profiles_count }}</span>
                                    <span class="adm-text-muted text-[10px]">Scholars</span>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                <form action="{{ route('admin.degrees.toggle', $degree->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer motion-btn-spring {{ $degree->is_active ? 'bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-300 dark:border-slate-700' }}" title="Click to Toggle Active Status">
                                        {{ $degree->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openEditDegreeModal({{ json_encode($degree) }})" class="px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700 text-[11px] font-bold transition cursor-pointer motion-btn-spring">
                                        ✎ Edit
                                    </button>

                                    <form action="{{ route('admin.degrees.delete', $degree->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete degree {{ $degree->name }} ({{ $degree->code }})?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer motion-btn-spring" title="Delete Degree">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center adm-text-muted">
                                <div class="text-3xl mb-2">🎓</div>
                                <p class="font-semibold text-sm">No degrees configured yet.</p>
                                <button type="button" onclick="openAddDegreeModal()" class="mt-3 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold">
                                    + Add Your First Degree
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 2: SCHOOLS & COLLEGES MANAGEMENT -->
    <!-- ========================================== -->
    <div x-show="currentTab === 'schools'" class="space-y-6" x-cloak>

        <!-- ========================================== -->
        <!-- PRO INLINE STUDIO: REGISTER NEW SCHOOL / COLLEGE -->
        <!-- ========================================== -->
        <div class="rounded-3xl adm-card border border-purple-200 dark:border-purple-800/80 p-5 sm:p-7 shadow-xl bg-gradient-to-br from-purple-50/50 via-white to-indigo-50/30 dark:from-purple-950/20 dark:via-slate-900/60 dark:to-indigo-950/20 motion-reveal">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-purple-100 dark:border-purple-900/40">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-purple-600 text-white font-bold text-xl flex items-center justify-center shadow-md shadow-purple-600/30 shrink-0">
                        🏫
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400">
                            <span>⚡ Quick Registration Studio</span>
                        </div>
                        <h3 class="text-lg font-serif font-bold adm-text">Register New School / College</h3>
                        <p class="text-xs adm-text-muted mt-0.5">Add approved partner college or university. It will populate student registration options immediately.</p>
                    </div>
                </div>

                <!-- Quick City Shortcuts -->
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mr-1">⚡ Quick Cities:</span>
                    <button type="button" @click="schoolForm.city = 'Patna'" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">Patna</button>
                    <button type="button" @click="schoolForm.city = 'Gaya'" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">Gaya</button>
                    <button type="button" @click="schoolForm.city = 'Muzaffarpur'" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">Muzaffarpur</button>
                    <button type="button" @click="schoolForm.city = 'Bhagalpur'" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">Bhagalpur</button>
                    <button type="button" @click="schoolForm.city = 'Ranchi'" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">Ranchi</button>
                    <button type="button" @click="schoolForm.city = 'New Delhi'" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">Delhi</button>
                </div>
            </div>

            <!-- The Form -->
            <form action="{{ route('admin.schools.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4">
                    <!-- Institution Name -->
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold adm-text mb-1">Institution Name *</label>
                        <input type="text" name="name" x-model="schoolForm.name" required placeholder="e.g. Patna Science College, Patna University" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-medium focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Short Code -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">Short Code</label>
                        <input type="text" name="code" x-model="schoolForm.code" placeholder="e.g. PSC-PU, IITP" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-mono uppercase focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Category -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">Category *</label>
                        <select name="type" x-model="schoolForm.type" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-semibold focus:ring-2 focus:ring-purple-500">
                            <option value="COLLEGE">COLLEGE</option>
                            <option value="UNIVERSITY">UNIVERSITY</option>
                            <option value="INSTITUTE">INSTITUTE</option>
                            <option value="SCHOOL">SCHOOL</option>
                        </select>
                    </div>

                    <!-- City -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">City / District</label>
                        <input type="text" name="city" x-model="schoolForm.city" placeholder="e.g. Patna" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white text-xs font-extrabold transition shadow-lg shadow-purple-600/30 cursor-pointer motion-btn-spring flex items-center justify-center gap-1.5 border border-purple-400/40">
                            <span>✦ Add School</span>
                        </button>
                    </div>
                </div>

                <!-- Footer Strip: Active Checkbox & Live Dropdown Preview -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2 border-t border-purple-100/60 dark:border-purple-900/30 text-xs">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="inline_school_is_active" x-model="schoolForm.is_active" checked class="w-4 h-4 rounded text-purple-600 cursor-pointer">
                        <label for="inline_school_is_active" class="text-xs font-semibold adm-text cursor-pointer select-none">
                            Active (Immediately available in candidate registration)
                        </label>
                    </div>

                    <!-- Live Dropdown Preview Badge -->
                    <div class="flex items-center gap-2 text-[11px] text-slate-500 bg-white/70 dark:bg-slate-800/70 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-purple-600 dark:text-purple-400 font-bold">Candidate Dropdown Preview:</span>
                        <span class="font-bold adm-text" x-text="(schoolForm.name || 'Institution Name') + (schoolForm.city ? ' (' + schoolForm.city + ')' : '')"></span>
                    </div>
                </div>
            </form>
        </div>

        <div class="rounded-3xl adm-card overflow-hidden shadow-xl motion-reveal border">
            <!-- Search & Filter Bar -->
            <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/30">
                <div>
                    <h3 class="font-serif font-bold text-base adm-text">Partner Schools, Colleges &amp; Universities ({{ $schools->count() }})</h3>
                    <p class="text-[11px] adm-text-muted">Approved institutions populated in student registration dropdowns and official documentation.</p>
                </div>
                <div class="relative w-full sm:w-64">
                    <input type="text" x-model="schoolSearch" placeholder="Filter institutions..." class="w-full pl-8 pr-3 py-1.5 rounded-xl adm-input text-xs">
                    <svg class="w-3.5 h-3.5 absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                        <tr>
                            <th class="py-3.5 px-4 font-bold">Institution / School Name</th>
                            <th class="py-3.5 px-4 font-bold">Code</th>
                            <th class="py-3.5 px-4 font-bold">City &amp; State</th>
                            <th class="py-3.5 px-4 font-bold">Type</th>
                            <th class="py-3.5 px-4 font-bold">Students</th>
                            <th class="py-3.5 px-4 font-bold">Status</th>
                            <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($schools as $school)
                        <tr class="adm-table-row transition" x-show="!schoolSearch || '{{ strtolower($school->name . ' ' . $school->city . ' ' . $school->code) }}'.includes(schoolSearch.toLowerCase())">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-purple-500/10 to-indigo-600/20 text-purple-600 dark:text-purple-400 font-bold text-xs flex items-center justify-center shrink-0 border border-purple-200 dark:border-purple-800/80 shadow-xs">
                                        🏛️
                                    </div>
                                    <span class="font-bold adm-text text-sm block">{{ $school->name }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                @if($school->code)
                                    <span class="font-mono text-purple-600 dark:text-purple-400 text-[11px] font-bold px-2 py-0.5 rounded-md bg-purple-50 dark:bg-purple-950/60 border border-purple-200 dark:border-purple-800/80">
                                        {{ $school->code }}
                                    </span>
                                @else
                                    <span class="adm-text-muted text-[10px]">—</span>
                                @endif
                            </td>

                            <td class="py-4 px-4">
                                <span class="adm-text font-medium block">{{ $school->city ?? 'Not specified' }}</span>
                                <span class="text-[10px] text-slate-400">{{ $school->state ?? 'Bihar' }}</span>
                            </td>

                            <td class="py-4 px-4">
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 adm-text text-[10px] font-bold uppercase tracking-wider">
                                    {{ $school->type }}
                                </span>
                            </td>

                            <td class="py-4 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-extrabold text-sm adm-text">{{ $school->student_profiles_count }}</span>
                                    <span class="adm-text-muted text-[10px]">Enrolled</span>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                <form action="{{ route('admin.schools.toggle', $school->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer motion-btn-spring {{ $school->is_active ? 'bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-300 dark:border-slate-700' }}" title="Click to Toggle Active Status">
                                        {{ $school->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openEditSchoolModal({{ json_encode($school) }})" class="px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700 text-[11px] font-bold transition cursor-pointer motion-btn-spring">
                                        ✎ Edit
                                    </button>

                                    <form action="{{ route('admin.schools.delete', $school->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete institution {{ $school->name }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer motion-btn-spring" title="Delete Institution">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center adm-text-muted">
                                <div class="text-3xl mb-2">🏛️</div>
                                <p class="font-semibold text-sm">No schools or colleges configured yet.</p>
                                <button type="button" onclick="openAddSchoolModal()" class="mt-3 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold">
                                    + Add Your First Institution
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 3: DOMAINS & TRACKS MANAGEMENT -->
    <!-- ========================================== -->
    <div x-show="currentTab === 'domains'" class="space-y-6" x-cloak>

        <!-- ========================================== -->
        <!-- PRO INLINE STUDIO: CREATE NEW DOMAIN TRACK -->
        <!-- ========================================== -->
        <div class="rounded-3xl adm-card border border-indigo-200 dark:border-indigo-800/80 p-5 sm:p-7 shadow-xl bg-gradient-to-br from-indigo-50/50 via-white to-purple-50/30 dark:from-indigo-950/20 dark:via-slate-900/60 dark:to-purple-950/20 motion-reveal">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-indigo-100 dark:border-indigo-900/40">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white font-bold text-xl flex items-center justify-center shadow-md shadow-indigo-600/30 shrink-0">
                        🚀
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                            <span>⚡ Quick Registration Studio</span>
                        </div>
                        <h3 class="text-lg font-serif font-bold adm-text">Create &amp; Publish Domain Track</h3>
                        <p class="text-xs adm-text-muted mt-0.5">Define specialized internship domain tracks aligned with NHEQF credits &amp; contact hours.</p>
                    </div>
                </div>

                <!-- 1-Click Track Presets -->
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mr-1">⚡ Presets:</span>
                    <button type="button" @click="setDomainPreset('Full Stack Web Development', 'FSW-01', 'TECHNOLOGY', '8 Weeks (120 Hours)', '4.0 NHEQF Credits', 'Full Stack Web Development using modern PHP/Laravel and React.')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ Full Stack</button>
                    <button type="button" @click="setDomainPreset('AI & Machine Learning', 'AIML-02', 'TECHNOLOGY', '8 Weeks (120 Hours)', '4.0 NHEQF Credits', 'Artificial Intelligence, Deep Learning and Machine Learning engineering.')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ AI / ML</button>
                    <button type="button" @click="setDomainPreset('Data Science & Analytics', 'DSA-03', 'TECHNOLOGY', '8 Weeks (120 Hours)', '4.0 NHEQF Credits', 'Data analysis, visualization, statistical modeling.')" class="px-2.5 py-1 rounded-lg bg-indigo-100/80 hover:bg-indigo-200 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 text-xs font-bold transition cursor-pointer border border-indigo-200 dark:border-indigo-800/60">+ Data Science</button>
                    <button type="button" @click="setDomainPreset('Digital Marketing & Growth', 'DMG-04', 'BUSINESS', '6 Weeks (90 Hours)', '3.0 NHEQF Credits', 'SEO, Performance marketing, analytics.')" class="px-2.5 py-1 rounded-lg bg-purple-100/80 hover:bg-purple-200 dark:bg-purple-900/40 dark:hover:bg-purple-900/70 text-purple-700 dark:text-purple-300 text-xs font-bold transition cursor-pointer border border-purple-200 dark:border-purple-800/60">+ Marketing</button>
                </div>
            </div>

            <!-- The Form -->
            <form action="{{ route('admin.streams.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4">
                    <!-- Title -->
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold adm-text mb-1">Domain Track Title *</label>
                        <input type="text" name="title" x-model="streamForm.title" required placeholder="e.g. Artificial Intelligence & Data Science" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-medium focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Code -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">Code *</label>
                        <input type="text" name="code" x-model="streamForm.code" required placeholder="e.g. AIML-02" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-mono uppercase focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Category -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">Category *</label>
                        <select name="category" x-model="streamForm.category" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-semibold focus:ring-2 focus:ring-indigo-500">
                            <option value="TECHNOLOGY">TECHNOLOGY</option>
                            <option value="BUSINESS">BUSINESS</option>
                            <option value="SCIENCE">SCIENCE</option>
                            <option value="ARTS">ARTS</option>
                        </select>
                    </div>

                    <!-- Duration & Credits -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold adm-text mb-1">Duration *</label>
                        <input type="text" name="duration" x-model="streamForm.duration" required placeholder="e.g. 8 Weeks (120 Hours)" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white text-xs font-extrabold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring flex items-center justify-center gap-1.5 border border-indigo-400/40">
                            <span>✦ Add Domain</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4">
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold adm-text mb-1">NHEQF Credits *</label>
                        <input type="text" name="credits" x-model="streamForm.credits" required placeholder="e.g. 4.0 NHEQF Credits" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="md:col-span-8">
                        <label class="block text-xs font-bold adm-text mb-1">Curriculum &amp; Practical Scope Summary *</label>
                        <input type="text" name="description" x-model="streamForm.description" required placeholder="Comprehensive practical internship syllabus and outcome summary" class="w-full px-3.5 py-2 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <!-- Footer Strip -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2 border-t border-indigo-100/60 dark:border-indigo-900/30 text-xs">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="inline_stream_is_active" x-model="streamForm.is_active" checked class="w-4 h-4 rounded text-indigo-600 cursor-pointer">
                        <label for="inline_stream_is_active" class="text-xs font-semibold adm-text cursor-pointer select-none">
                            Active (Immediately available in candidate registration)
                        </label>
                    </div>

                    <!-- Live Dropdown Preview Badge -->
                    <div class="flex items-center gap-2 text-[11px] text-slate-500 bg-white/70 dark:bg-slate-800/70 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold">Candidate Dropdown Preview:</span>
                        <span class="font-bold adm-text" x-text="(streamForm.title || 'Domain Track Title') + ' [' + (streamForm.code || 'CODE') + ']'"></span>
                    </div>
                </div>
            </form>
        </div>

        <div class="rounded-3xl adm-card overflow-hidden shadow-xl motion-reveal border">
            <!-- Search & Filter Bar -->
            <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/30">
                <div>
                    <h3 class="font-serif font-bold text-base adm-text">Specialization Domain Tracks ({{ $streams->count() }})</h3>
                    <p class="text-[11px] adm-text-muted">Domains aligned with NHEQF standards that populate student track selection and certificate seals.</p>
                </div>
                <div class="relative w-full sm:w-64">
                    <input type="text" x-model="domainSearch" placeholder="Filter domain tracks..." class="w-full pl-8 pr-3 py-1.5 rounded-xl adm-input text-xs">
                    <svg class="w-3.5 h-3.5 absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                        <tr>
                            <th class="py-3.5 px-4 font-bold">Domain Title &amp; Code</th>
                            <th class="py-3.5 px-4 font-bold">Category</th>
                            <th class="py-3.5 px-4 font-bold">Duration &amp; Credits</th>
                            <th class="py-3.5 px-4 font-bold">Scholars</th>
                            <th class="py-3.5 px-4 font-bold">Status</th>
                            <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($streams as $stream)
                        <tr class="adm-table-row transition" x-show="!domainSearch || '{{ strtolower($stream->title . ' ' . $stream->code . ' ' . $stream->category) }}'.includes(domainSearch.toLowerCase())">
                            <td class="py-4 px-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-purple-600/20 text-indigo-600 dark:text-indigo-400 font-bold text-xs flex items-center justify-center shrink-0 border border-indigo-200 dark:border-indigo-800/80 shadow-xs">
                                        🚀
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold adm-text text-sm">{{ $stream->title }}</span>
                                            <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[10px] font-bold px-2 py-0.5 rounded-md bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800/80">
                                                {{ $stream->code }}
                                            </span>
                                        </div>
                                        @if($stream->description)
                                            <p class="adm-text-muted text-[11px] mt-0.5 line-clamp-1 max-w-md">{{ $stream->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 adm-text text-[10px] font-bold uppercase tracking-wider">
                                    {{ $stream->category }}
                                </span>
                            </td>

                            <td class="py-4 px-4">
                                <span class="adm-text font-medium block">{{ $stream->duration }}</span>
                                <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">{{ $stream->credits }}</span>
                            </td>

                            <td class="py-4 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-extrabold text-sm adm-text">{{ $stream->student_profiles_count }}</span>
                                    <span class="adm-text-muted text-[10px]">Active</span>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                <form action="{{ route('admin.streams.toggle', $stream->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer motion-btn-spring {{ $stream->is_active ? 'bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-300 dark:border-slate-700' }}" title="Click to Toggle Status">
                                        {{ $stream->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                    </button>
                                </form>
                            </td>

                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openEditStreamModal({{ json_encode($stream) }})" class="px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700 text-[11px] font-bold transition cursor-pointer motion-btn-spring">
                                        ✎ Edit
                                    </button>

                                    <form action="{{ route('admin.streams.delete', $stream->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete stream {{ $stream->title }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer motion-btn-spring" title="Delete Stream">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center adm-text-muted">
                                <div class="text-3xl mb-2">🚀</div>
                                <p class="font-semibold text-sm">No internship streams configured yet.</p>
                                <button type="button" onclick="openAddStreamModal()" class="mt-3 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold">
                                    + Add Your First Domain Track
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: ADD DEGREE (PRO 2-COLUMN WITH LIVE PREVIEW & PRESETS) -->
<!-- ======================================================== -->
<div id="addDegreeModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-4xl adm-card rounded-3xl p-6 sm:p-8 shadow-2xl border motion-reveal my-8">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white font-bold text-lg flex items-center justify-center shadow-md shadow-indigo-600/30">
                    🎓
                </div>
                <div>
                    <h3 class="text-lg font-serif font-bold adm-text">Create Academic Degree Program</h3>
                    <p class="text-[11px] adm-text-muted">Configure a new qualification track for student registration and university credits.</p>
                </div>
            </div>
            <button type="button" onclick="closeAddDegreeModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <!-- 2-Column Layout: Left Form + Right Live Preview -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
            <!-- Left Form (7 Cols) -->
            <form action="{{ route('admin.degrees.store') }}" method="POST" class="lg:col-span-7 space-y-4">
                @csrf
                
                <!-- 1-Click Quick Presets -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">⚡ 1-Click Common Presets</label>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" @click="setDegreePreset('Bachelor of Computer Applications', 'BCA', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 text-[11px] font-semibold border border-indigo-200 dark:border-indigo-800 transition cursor-pointer">+ BCA</button>
                        <button type="button" @click="setDegreePreset('Bachelor of Technology', 'B.Tech', '4 Years (8 Semesters)')" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 text-[11px] font-semibold border border-indigo-200 dark:border-indigo-800 transition cursor-pointer">+ B.Tech</button>
                        <button type="button" @click="setDegreePreset('Bachelor of Science', 'BSc', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 text-[11px] font-semibold border border-indigo-200 dark:border-indigo-800 transition cursor-pointer">+ BSc</button>
                        <button type="button" @click="setDegreePreset('Bachelor of Arts', 'BA', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 text-[11px] font-semibold border border-indigo-200 dark:border-indigo-800 transition cursor-pointer">+ BA</button>
                        <button type="button" @click="setDegreePreset('Bachelor of Business Administration', 'BBA', '3 Years (6 Semesters)')" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 text-[11px] font-semibold border border-indigo-200 dark:border-indigo-800 transition cursor-pointer">+ BBA</button>
                        <button type="button" @click="setDegreePreset('Bachelor of Commerce', 'BCom', '3 / 4 Years (NEP-2020)')" class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 hover:bg-indigo-100 text-indigo-700 dark:text-indigo-300 text-[11px] font-semibold border border-indigo-200 dark:border-indigo-800 transition cursor-pointer">+ BCom</button>
                        <button type="button" @click="setDegreePreset('Master of Computer Applications', 'MCA', '2 Years (4 Semesters)')" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">+ MCA</button>
                        <button type="button" @click="setDegreePreset('Master of Business Administration', 'MBA', '2 Years (4 Semesters)')" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">+ MBA</button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text mb-1">Full Degree Title *</label>
                    <input type="text" name="name" x-model="degreeForm.name" required placeholder="e.g. Bachelor of Artificial Intelligence & Data Science" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-medium focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Short Code *</label>
                        <input type="text" name="code" x-model="degreeForm.code" required placeholder="e.g. B.AI, BCA, B.Tech" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-bold uppercase tracking-wider focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Display Priority Order</label>
                        <input type="number" name="sort_order" x-model="degreeForm.sort_order" min="0" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text mb-1">Academic Duration &amp; Framework *</label>
                    <input type="text" name="duration" x-model="degreeForm.duration" required placeholder="e.g. 3 / 4 Years (NEP-2020)" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text mb-1">Curriculum Summary / Academic Notes</label>
                    <textarea name="description" x-model="degreeForm.description" rows="2" placeholder="Undergraduate degree curriculum details..." class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800">
                    <input type="checkbox" name="is_active" id="degree_is_active" x-model="degreeForm.is_active" checked class="w-4 h-4 rounded text-indigo-600 cursor-pointer">
                    <label for="degree_is_active" class="text-xs font-semibold adm-text cursor-pointer select-none">
                        Publish to Student Registration immediately
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <button type="button" onclick="closeAddDegreeModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring">
                        Create &amp; Publish Degree
                    </button>
                </div>
            </form>

            <!-- Right Live Preview Card (5 Cols) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-indigo-50/50 via-slate-50 to-purple-50/30 dark:from-indigo-950/20 dark:via-slate-900/40 dark:to-purple-950/10 p-5 rounded-2xl border border-indigo-100 dark:border-indigo-900/40 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">✦ Live Scholar Preview</span>
                    <span class="text-[9px] px-2 py-0.5 rounded-full font-bold" :class="degreeForm.is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-200 text-slate-700 dark:bg-slate-800 dark:text-slate-400'" x-text="degreeForm.is_active ? 'PUBLISHED' : 'INACTIVE'"></span>
                </div>

                <!-- Registration Dropdown Appearance Preview -->
                <div class="space-y-1.5">
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider block">Student Portal Dropdown Preview</span>
                    <div class="p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs shadow-xs">
                        <div class="text-[11px] text-slate-400 mb-1">Undergraduate Degree *</div>
                        <div class="font-bold text-slate-800 dark:text-white flex items-center justify-between">
                            <span x-text="(degreeForm.name || 'Select Degree Program...') + (degreeForm.code ? ' (' + degreeForm.code + ')' : '')"></span>
                            <span class="text-indigo-500">▾</span>
                        </div>
                    </div>
                </div>

                <!-- Official Certificate Alignment Preview -->
                <div class="space-y-1.5">
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider block">Official Certificate Excerpt</span>
                    <div class="p-3.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[11px] leading-relaxed shadow-xs text-slate-600 dark:text-slate-300">
                        "...who is an undergraduate scholar pursuing <strong class="text-indigo-600 dark:text-indigo-400 font-bold" x-text="degreeForm.code || 'DEGREE'"></strong> (<span x-text="degreeForm.name || 'Full Degree Title'"></span>), under <span class="font-semibold text-slate-800 dark:text-white" x-text="degreeForm.duration || 'NEP Guidelines'"></span>."
                    </div>
                </div>

                <!-- Badge & Framework Details -->
                <div class="pt-2 border-t border-slate-200 dark:border-slate-800/80 flex items-center justify-between text-[11px]">
                    <span class="text-slate-400">Display Order</span>
                    <span class="font-bold adm-text" x-text="'#' + (degreeForm.sort_order || 1) + ' in dropdown list'"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: EDIT DEGREE -->
<!-- ======================================================== -->
<div id="editDegreeModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-md adm-card rounded-3xl p-6 shadow-2xl border motion-reveal my-8">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-serif font-bold adm-text">Edit Academic Degree</h3>
                <p class="text-[11px] adm-text-muted">Modify degree metadata and framework alignment.</p>
            </div>
            <button type="button" onclick="closeEditDegreeModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <form id="editDegreeForm" method="POST" class="space-y-3.5 mt-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Degree Title *</label>
                <input type="text" name="name" id="edit_degree_name" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Degree Code *</label>
                    <input type="text" name="code" id="edit_degree_code" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-bold uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Display Order</label>
                    <input type="number" name="sort_order" id="edit_degree_sort_order" min="0" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Duration &amp; Framework *</label>
                <input type="text" name="duration" id="edit_degree_duration" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Description (Optional)</label>
                <textarea name="description" id="edit_degree_description" rows="2" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" id="edit_degree_is_active" class="w-4 h-4 rounded text-indigo-600">
                <label for="edit_degree_is_active" class="text-xs font-semibold adm-text cursor-pointer">Active (Visible in student registration)</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeEditDegreeModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer motion-btn-spring">
                    Update Degree
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: ADD SCHOOL / COLLEGE (PRO 2-COLUMN WITH LIVE PREVIEW) -->
<!-- ======================================================== -->
<div id="addSchoolModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-4xl adm-card rounded-3xl p-6 sm:p-8 shadow-2xl border motion-reveal my-8">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-purple-600 text-white font-bold text-lg flex items-center justify-center shadow-md shadow-purple-600/30">
                    🏛️
                </div>
                <div>
                    <h3 class="text-lg font-serif font-bold adm-text">Register Partner School / College</h3>
                    <p class="text-[11px] adm-text-muted">Register accredited undergraduate institution for student onboarding &amp; documentation.</p>
                </div>
            </div>
            <button type="button" onclick="closeAddSchoolModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <!-- 2-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
            <!-- Left Form (7 Cols) -->
            <form action="{{ route('admin.schools.store') }}" method="POST" class="lg:col-span-7 space-y-4">
                @csrf

                <!-- Presets / Quick Chips -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">⚡ Quick City Shortcuts</label>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" @click="schoolForm.city = 'Patna'" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">Patna</button>
                        <button type="button" @click="schoolForm.city = 'Gaya'" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">Gaya</button>
                        <button type="button" @click="schoolForm.city = 'Muzaffarpur'" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">Muzaffarpur</button>
                        <button type="button" @click="schoolForm.city = 'Bhagalpur'" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">Bhagalpur</button>
                        <button type="button" @click="schoolForm.city = 'Ranchi'" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">Ranchi</button>
                        <button type="button" @click="schoolForm.city = 'New Delhi'" class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/50 hover:bg-purple-100 text-purple-700 dark:text-purple-300 text-[11px] font-semibold border border-purple-200 dark:border-purple-800 transition cursor-pointer">Delhi</button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text mb-1">Full Institution Name *</label>
                    <input type="text" name="name" x-model="schoolForm.name" required placeholder="e.g. Patna Science College, Patna University" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-medium focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Short Code (Optional)</label>
                        <input type="text" name="code" x-model="schoolForm.code" placeholder="e.g. PSC-PU, IITP" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-mono uppercase focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Institution Category *</label>
                        <select name="type" x-model="schoolForm.type" required class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-semibold focus:ring-2 focus:ring-purple-500">
                            <option value="COLLEGE">COLLEGE</option>
                            <option value="UNIVERSITY">UNIVERSITY</option>
                            <option value="INSTITUTE">INSTITUTE</option>
                            <option value="SCHOOL">SCHOOL</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">City / District</label>
                        <input type="text" name="city" x-model="schoolForm.city" placeholder="e.g. Patna" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">State</label>
                        <input type="text" name="state" x-model="schoolForm.state" placeholder="e.g. Bihar" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800">
                    <input type="checkbox" name="is_active" id="school_is_active" x-model="schoolForm.is_active" checked class="w-4 h-4 rounded text-purple-600 cursor-pointer">
                    <label for="school_is_active" class="text-xs font-semibold adm-text cursor-pointer select-none">
                        Active (Populated in student registration dropdown immediately)
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <button type="button" onclick="closeAddSchoolModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold transition shadow-lg shadow-purple-600/30 cursor-pointer motion-btn-spring">
                        Save Institution
                    </button>
                </div>
            </form>

            <!-- Right Live Preview Card (5 Cols) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-purple-50/50 via-slate-50 to-indigo-50/30 dark:from-purple-950/20 dark:via-slate-900/40 dark:to-indigo-950/10 p-5 rounded-2xl border border-purple-100 dark:border-purple-900/40 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400">✦ Live Institution Preview</span>
                    <span class="text-[9px] px-2 py-0.5 rounded-full font-bold" :class="schoolForm.is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-200 text-slate-700 dark:bg-slate-800 dark:text-slate-400'" x-text="schoolForm.is_active ? 'ACTIVE' : 'INACTIVE'"></span>
                </div>

                <!-- Card Badge Preview -->
                <div class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-xs space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="px-2 py-0.5 rounded-md bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300 font-bold text-[10px] uppercase" x-text="schoolForm.type"></span>
                        <span class="font-mono text-purple-600 dark:text-purple-400 text-xs font-bold" x-text="schoolForm.code || 'CODE'"></span>
                    </div>
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white leading-snug" x-text="schoolForm.name || 'Institution Name'"></h4>
                    <div class="text-[11px] text-slate-500 flex items-center gap-1">
                        <span>📍</span>
                        <span x-text="(schoolForm.city || 'City') + ', ' + (schoolForm.state || 'State')"></span>
                    </div>
                </div>

                <!-- Registration Dropdown Appearance -->
                <div class="space-y-1.5">
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider block">Student Form Option Preview</span>
                    <div class="p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white font-medium shadow-xs truncate">
                        <span x-text="schoolForm.name || 'Select School / College...'"></span>
                        <span class="text-slate-400 ml-1" x-text="schoolForm.city ? '(' + schoolForm.city + ')' : ''"></span>
                    </div>
                </div>

                <!-- Official Letters Preview -->
                <div class="p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[11px] text-slate-600 dark:text-slate-300 leading-relaxed shadow-xs">
                    "...an undergraduate scholar from <strong class="text-purple-600 dark:text-purple-400 font-bold" x-text="schoolForm.name || 'Institution'"></strong>, approved for academic internship credits."
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: EDIT SCHOOL / COLLEGE -->
<!-- ======================================================== -->
<div id="editSchoolModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-md adm-card rounded-3xl p-6 shadow-2xl border motion-reveal my-8">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-serif font-bold adm-text">Edit School / College</h3>
                <p class="text-[11px] adm-text-muted">Update institution metadata and location.</p>
            </div>
            <button type="button" onclick="closeEditSchoolModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <form id="editSchoolForm" method="POST" class="space-y-3.5 mt-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Full Institution Name *</label>
                <input type="text" name="name" id="edit_school_name" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Short Code</label>
                    <input type="text" name="code" id="edit_school_code" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-mono uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Institution Type *</label>
                    <select name="type" id="edit_school_type" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-semibold">
                        <option value="COLLEGE">COLLEGE</option>
                        <option value="UNIVERSITY">UNIVERSITY</option>
                        <option value="INSTITUTE">INSTITUTE</option>
                        <option value="SCHOOL">SCHOOL</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">City</label>
                    <input type="text" name="city" id="edit_school_city" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">State</label>
                    <input type="text" name="state" id="edit_school_state" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" id="edit_school_is_active" class="w-4 h-4 rounded text-indigo-600">
                <label for="edit_school_is_active" class="text-xs font-semibold adm-text cursor-pointer">Active (Visible in student registration)</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeEditSchoolModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer motion-btn-spring">
                    Update Institution
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: ADD DOMAIN / STREAM (PRO 2-COLUMN WITH LIVE PREVIEW) -->
<!-- ======================================================== -->
<div id="addStreamModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-4xl adm-card rounded-3xl p-6 sm:p-8 shadow-2xl border motion-reveal my-8">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold text-lg flex items-center justify-center shadow-md shadow-indigo-600/30">
                    🚀
                </div>
                <div>
                    <h3 class="text-lg font-serif font-bold adm-text">Create Domain Specialization Track</h3>
                    <p class="text-[11px] adm-text-muted">Configure an academic internship specialization mapped to NHEQF guidelines &amp; credit transfers.</p>
                </div>
            </div>
            <button type="button" onclick="closeAddStreamModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <!-- 2-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
            <!-- Left Form (7 Cols) -->
            <form action="{{ route('admin.streams.store') }}" method="POST" class="lg:col-span-7 space-y-4">
                @csrf

                <!-- Presets / Quick Category Chips -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">⚡ Domain Category</label>
                    <div class="grid grid-cols-4 gap-2">
                        <button type="button" @click="streamForm.category = 'TECHNOLOGY'" class="p-2 rounded-xl text-center border text-[11px] font-bold transition cursor-pointer" :class="streamForm.category === 'TECHNOLOGY' ? 'bg-indigo-600 text-white border-indigo-600 shadow-md shadow-indigo-600/30' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700'">💻 Tech</button>
                        <button type="button" @click="streamForm.category = 'BUSINESS'" class="p-2 rounded-xl text-center border text-[11px] font-bold transition cursor-pointer" :class="streamForm.category === 'BUSINESS' ? 'bg-amber-600 text-white border-amber-600 shadow-md shadow-amber-600/30' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700'">📊 Business</button>
                        <button type="button" @click="streamForm.category = 'SCIENCE'" class="p-2 rounded-xl text-center border text-[11px] font-bold transition cursor-pointer" :class="streamForm.category === 'SCIENCE' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md shadow-emerald-600/30' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700'">🔬 Science</button>
                        <button type="button" @click="streamForm.category = 'ARTS'" class="p-2 rounded-xl text-center border text-[11px] font-bold transition cursor-pointer" :class="streamForm.category === 'ARTS' ? 'bg-purple-600 text-white border-purple-600 shadow-md shadow-purple-600/30' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700'">🎨 Arts</button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text mb-1">Domain Stream Title *</label>
                    <input type="text" name="title" x-model="streamForm.title" required placeholder="e.g. AI, Machine Learning & Data Science" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-medium focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Track Code *</label>
                        <input type="text" name="code" x-model="streamForm.code" required placeholder="e.g. AI-DATA, TECH-WEB" class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-mono uppercase focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Category (Form Value)</label>
                        <input type="text" name="category" x-model="streamForm.category" readonly class="w-full px-4 py-2.5 rounded-xl adm-input text-xs font-bold uppercase bg-slate-100 dark:bg-slate-800 text-slate-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">Duration &amp; Hours *</label>
                        <input type="text" name="duration" x-model="streamForm.duration" required class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold adm-text mb-1">NHEQF Academic Credits *</label>
                        <input type="text" name="credits" x-model="streamForm.credits" required class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold adm-text mb-1">Practical Scope &amp; Deliverables *</label>
                    <textarea name="description" x-model="streamForm.description" rows="3" required placeholder="Hands-on skills, industry software, projects and viva syllabus..." class="w-full px-4 py-2.5 rounded-xl adm-input text-xs focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800">
                    <input type="checkbox" name="is_active" id="stream_is_active" x-model="streamForm.is_active" checked class="w-4 h-4 rounded text-indigo-600 cursor-pointer">
                    <label for="stream_is_active" class="text-xs font-semibold adm-text cursor-pointer select-none">
                        Active Track (Available in student registration track picker)
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <button type="button" onclick="closeAddStreamModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer motion-btn-spring">
                        Save Domain Track
                    </button>
                </div>
            </form>

            <!-- Right Live Preview Card (5 Cols) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-indigo-50/50 via-slate-50 to-purple-50/30 dark:from-indigo-950/20 dark:via-slate-900/40 dark:to-purple-950/10 p-5 rounded-2xl border border-indigo-100 dark:border-indigo-900/40 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">✦ Live Domain Preview</span>
                    <span class="text-[9px] px-2 py-0.5 rounded-full font-bold" :class="streamForm.is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-200 text-slate-700 dark:bg-slate-800 dark:text-slate-400'" x-text="streamForm.is_active ? 'ACTIVE' : 'INACTIVE'"></span>
                </div>

                <div class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-xs space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded-md font-bold text-[10px] uppercase tracking-wider" :class="{
                            'bg-indigo-100 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300': streamForm.category === 'TECHNOLOGY',
                            'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300': streamForm.category === 'BUSINESS',
                            'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300': streamForm.category === 'SCIENCE',
                            'bg-purple-100 text-purple-700 dark:bg-purple-950 dark:text-purple-300': streamForm.category === 'ARTS'
                        }" x-text="streamForm.category"></span>
                        <span class="font-mono text-indigo-600 dark:text-indigo-400 font-bold text-xs" x-text="streamForm.code || 'CODE'"></span>
                    </div>

                    <h4 class="font-bold text-sm text-slate-900 dark:text-white leading-snug" x-text="streamForm.title || 'Domain Specialization Title'"></h4>
                    <p class="text-[11px] text-slate-500 line-clamp-2" x-text="streamForm.description || 'Curriculum summary...'"></p>

                    <div class="pt-2 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between text-[11px]">
                        <span class="text-slate-600 dark:text-slate-400" x-text="streamForm.duration"></span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-bold" x-text="streamForm.credits"></span>
                    </div>
                </div>

                <!-- Registration Dropdown Appearance -->
                <div class="space-y-1.5">
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider block">Student Form Option Preview</span>
                    <div class="p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white font-medium shadow-xs truncate">
                        <span x-text="streamForm.title || 'Select Program Domain Track...'"></span>
                        <span class="text-slate-400 ml-1" x-text="streamForm.code ? '(' + streamForm.code + ')' : ''"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: EDIT DOMAIN / STREAM -->
<!-- ======================================================== -->
<div id="editStreamModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-lg adm-card rounded-3xl p-6 shadow-2xl border motion-reveal my-8">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-serif font-bold adm-text">Edit Domain Specialization Track</h3>
                <p class="text-[11px] adm-text-muted">Modify curriculum details, contact hours, and credits.</p>
            </div>
            <button type="button" onclick="closeEditStreamModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <form id="editStreamForm" method="POST" class="space-y-3.5 mt-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Domain Stream Title *</label>
                <input type="text" name="title" id="edit_stream_title" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Track Code *</label>
                    <input type="text" name="code" id="edit_stream_code" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-mono uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Broad Category *</label>
                    <select name="category" id="edit_stream_category" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-semibold">
                        <option value="TECHNOLOGY">TECHNOLOGY</option>
                        <option value="BUSINESS">BUSINESS</option>
                        <option value="SCIENCE">SCIENCE</option>
                        <option value="ARTS">ARTS</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Duration &amp; Contact Hours *</label>
                    <input type="text" name="duration" id="edit_stream_duration" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Academic Credits *</label>
                    <input type="text" name="credits" id="edit_stream_credits" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Curriculum &amp; Practical Scope Description *</label>
                <textarea name="description" id="edit_stream_description" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" id="edit_stream_is_active" class="w-4 h-4 rounded text-indigo-600">
                <label for="edit_stream_is_active" class="text-xs font-semibold adm-text cursor-pointer">Active Domain (Populated on registration forms)</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeEditStreamModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer motion-btn-spring">
                    Update Domain Track
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL LOGIC (VANILLA JS) -->
<!-- ======================================================== -->
<script>
    // Degree Modals
    function openAddDegreeModal() {
        document.getElementById('addDegreeModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeAddDegreeModal() {
        document.getElementById('addDegreeModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    function openEditDegreeModal(degree) {
        document.getElementById('editDegreeForm').action = '/admin/degrees/' + degree.id;
        document.getElementById('edit_degree_name').value = degree.name || '';
        document.getElementById('edit_degree_code').value = degree.code || '';
        document.getElementById('edit_degree_sort_order').value = degree.sort_order ?? 0;
        document.getElementById('edit_degree_duration').value = degree.duration || '';
        document.getElementById('edit_degree_description').value = degree.description || '';
        document.getElementById('edit_degree_is_active').checked = Boolean(degree.is_active);
        document.getElementById('editDegreeModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEditDegreeModal() {
        document.getElementById('editDegreeModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // School Modals
    function openAddSchoolModal() {
        document.getElementById('addSchoolModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeAddSchoolModal() {
        document.getElementById('addSchoolModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    function openEditSchoolModal(school) {
        document.getElementById('editSchoolForm').action = '/admin/schools/' + school.id;
        document.getElementById('edit_school_name').value = school.name || '';
        document.getElementById('edit_school_code').value = school.code || '';
        document.getElementById('edit_school_type').value = school.type || 'COLLEGE';
        document.getElementById('edit_school_city').value = school.city || '';
        document.getElementById('edit_school_state').value = school.state || 'Bihar';
        document.getElementById('edit_school_is_active').checked = Boolean(school.is_active);
        document.getElementById('editSchoolModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEditSchoolModal() {
        document.getElementById('editSchoolModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Stream Modals
    function openAddStreamModal() {
        document.getElementById('addStreamModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeAddStreamModal() {
        document.getElementById('addStreamModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    function openEditStreamModal(stream) {
        document.getElementById('editStreamForm').action = '/admin/streams/' + stream.id;
        document.getElementById('edit_stream_title').value = stream.title || '';
        document.getElementById('edit_stream_code').value = stream.code || '';
        document.getElementById('edit_stream_category').value = stream.category || 'TECHNOLOGY';
        document.getElementById('edit_stream_duration').value = stream.duration || '';
        document.getElementById('edit_stream_credits').value = stream.credits || '';
        document.getElementById('edit_stream_description').value = stream.description || '';
        document.getElementById('edit_stream_is_active').checked = Boolean(stream.is_active);
        document.getElementById('editStreamModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEditStreamModal() {
        document.getElementById('editStreamModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddDegreeModal();
            closeEditDegreeModal();
            closeAddSchoolModal();
            closeEditSchoolModal();
            closeAddStreamModal();
            closeEditStreamModal();
        }
    });

    // Close when clicking modal backdrop
    ['addDegreeModal', 'editDegreeModal', 'addSchoolModal', 'editSchoolModal', 'addStreamModal', 'editStreamModal'].forEach(function(modalId) {
        const modalEl = document.getElementById(modalId);
        if (modalEl) {
            modalEl.addEventListener('click', function(e) {
                if (e.target === modalEl) {
                    modalEl.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        }
    });
</script>
@endsection
