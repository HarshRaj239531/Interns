@extends('layouts.admin')

@section('title', 'Manage Academic Degrees & Qualifications – Infinity Interns')

@section('content')
<div class="space-y-6" x-data="{
    degreeSearch: '',
    degreeForm: {
        name: '',
        code: '',
        duration: '3 / 4 Years (NEP-2020)',
        sort_order: 1,
        is_active: true
    },
    setDegreePreset(name, code, duration) {
        this.degreeForm.name = name;
        this.degreeForm.code = code;
        this.degreeForm.duration = duration;
    }
}">

    <!-- Top Header & Navigation Banner -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col lg:flex-row lg:items-center justify-between gap-6 motion-reveal">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 text-xs font-semibold mb-2 border border-indigo-200 dark:border-indigo-800">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Academic Setup &amp; Registration Data • Degrees</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Academic Setup & Registration Data</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 leading-relaxed">
                Configure approved academic degree qualifications (BCA, B.Tech, BSc, MCA, etc.). All active degrees configured here populate the public registration portal dropdown and student verification certificates.
            </p>
        </div>

        <!-- Quick Section Switcher Pills -->
        <div class="flex items-center gap-2 p-1.5 rounded-2xl bg-slate-100 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/60 shrink-0">
            <a href="{{ route('admin.degrees') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600 text-white shadow-md shadow-indigo-600/30 flex items-center gap-1.5">
                <span>🎓 Degrees</span>
                <span class="text-[10px] px-1.5 py-0.2 rounded-full bg-white/20">{{ $degrees->count() }}</span>
            </a>
            <a href="{{ route('admin.schools') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span>🏫 Schools</span>
            </a>
            <a href="{{ route('admin.streams') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span>🚀 Domains</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 motion-reveal">
        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Configured Degrees</span>
                <span class="text-2xl font-extrabold adm-text block mt-1">{{ $degrees->count() }}</span>
                <span class="text-[11px] text-slate-400 font-medium">Undergraduate &amp; PG</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl font-bold">
                🎓
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Active on Portal</span>
                <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 block mt-1">{{ $degrees->where('is_active', true)->count() }}</span>
                <span class="text-[11px] text-emerald-600/80 font-medium">Visible to candidates</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl font-bold">
                ✓
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Enrolled Scholars</span>
                <span class="text-2xl font-extrabold adm-text block mt-1">{{ $degrees->sum('student_profiles_count') }}</span>
                <span class="text-[11px] text-slate-400 font-medium">Across all degrees</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl font-bold">
                👥
            </div>
        </div>
    </div>

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
                    <p class="text-xs adm-text-muted mt-0.5">Fill below or tap a 1-click preset. It will instantly appear in the student registration dropdown.</p>
                </div>
            </div>

            <!-- 1-Click Fast Presets -->
            <div class="flex items-center gap-1.5 flex-wrap">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mr-1">⚡ 1-Click Presets:</span>
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

    <!-- Degrees Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl motion-reveal border">
        <!-- Search & Filter Bar -->
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/30">
            <div>
                <h3 class="font-serif font-bold text-base adm-text">Configured Degrees ({{ $degrees->count() }})</h3>
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
                            <p class="text-xs text-slate-400 mt-1">Use the Quick Registration Studio above to add your first degree.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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

<script>
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeEditDegreeModal();
    });

    const editDegreeModal = document.getElementById('editDegreeModal');
    if (editDegreeModal) {
        editDegreeModal.addEventListener('click', function(e) {
            if (e.target === editDegreeModal) closeEditDegreeModal();
        });
    }
</script>
@endsection
