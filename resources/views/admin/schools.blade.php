@extends('layouts.admin')

@section('title', 'Manage Partner Schools, Colleges & Universities – Infinity Interns')

@section('content')
<div class="space-y-6" x-data="{
    schoolSearch: '',
    schoolForm: {
        name: '',
        code: '',
        type: 'COLLEGE',
        city: 'Patna',
        state: 'Bihar',
        is_active: true
    }
}">

    <!-- Top Header & Navigation Banner -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col lg:flex-row lg:items-center justify-between gap-6 motion-reveal">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-50 dark:bg-purple-950/60 text-purple-700 dark:text-purple-400 text-xs font-semibold mb-2 border border-purple-200 dark:border-purple-800">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Academic Catalog Master • Section 2 of 3</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Partner Schools, Colleges &amp; Universities</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 leading-relaxed">
                Configure accredited higher educational institutions. All active institutions configured here populate the candidate registration datalist and official certificates.
            </p>
        </div>

        <!-- Quick Section Switcher Pills -->
        <div class="flex items-center gap-2 p-1.5 rounded-2xl bg-slate-100 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/60 shrink-0">
            <a href="{{ route('admin.degrees') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span>🎓 Degrees</span>
            </a>
            <a href="{{ route('admin.schools') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-purple-600 text-white shadow-md shadow-purple-600/30 flex items-center gap-1.5">
                <span>🏫 Schools</span>
                <span class="text-[10px] px-1.5 py-0.2 rounded-full bg-white/20">{{ $schools->count() }}</span>
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
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Total Institutions</span>
                <span class="text-2xl font-extrabold adm-text block mt-1">{{ $schools->count() }}</span>
                <span class="text-[11px] text-slate-400 font-medium">Colleges &amp; Universities</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl font-bold">
                🏛️
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Active on Portal</span>
                <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 block mt-1">{{ $schools->where('is_active', true)->count() }}</span>
                <span class="text-[11px] text-emerald-600/80 font-medium">Available for selection</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl font-bold">
                ✓
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Enrolled Scholars</span>
                <span class="text-2xl font-extrabold adm-text block mt-1">{{ $schools->sum('student_profiles_count') }}</span>
                <span class="text-[11px] text-slate-400 font-medium">Across all campuses</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl font-bold">
                👥
            </div>
        </div>
    </div>

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

    <!-- Schools Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl motion-reveal border">
        <!-- Search & Filter Bar -->
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/30">
            <div>
                <h3 class="font-serif font-bold text-base adm-text">Configured Institutions ({{ $schools->count() }})</h3>
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
                            <span class="text-[10px] text-slate-400 font-semibold">{{ $school->state ?? 'Bihar' }}</span>
                        </td>

                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-[10px] font-bold">
                                {{ $school->type }}
                            </span>
                        </td>

                        <td class="py-4 px-4">
                            <span class="font-bold text-sm adm-text">{{ $school->student_profiles_count }}</span>
                            <span class="adm-text-muted text-[10px] block">Scholars</span>
                        </td>

                        <td class="py-4 px-4">
                            <form action="{{ route('admin.schools.toggle', $school->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer motion-btn-spring {{ $school->is_active ? 'bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-300 dark:border-slate-700' }}" title="Click to Toggle Status">
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
                                    <button type="submit" class="p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer motion-btn-spring" title="Delete School">
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
                            <p class="text-xs text-slate-400 mt-1">Use the Quick Registration Studio above to add your first institution.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: EDIT SCHOOL -->
<!-- ======================================================== -->
<div id="editSchoolModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-md adm-card rounded-3xl p-6 shadow-2xl border motion-reveal my-8">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-serif font-bold adm-text">Edit Institution</h3>
                <p class="text-[11px] adm-text-muted">Modify school or college details.</p>
            </div>
            <button type="button" onclick="closeEditSchoolModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <form id="editSchoolForm" method="POST" class="space-y-3.5 mt-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Institution Name *</label>
                <input type="text" name="name" id="edit_school_name" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-medium">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Code</label>
                    <input type="text" name="code" id="edit_school_code" class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-mono uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Type *</label>
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
                <input type="checkbox" name="is_active" id="edit_school_is_active" class="w-4 h-4 rounded text-purple-600">
                <label for="edit_school_is_active" class="text-xs font-semibold adm-text cursor-pointer">Active (Visible in student registration)</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeEditSchoolModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold adm-text cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold transition shadow-md shadow-purple-600/30 cursor-pointer motion-btn-spring">
                    Update Institution
                </button>
            </div>
        </form>
    </div>
</div>

<script>
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeEditSchoolModal();
    });

    const editSchoolModal = document.getElementById('editSchoolModal');
    if (editSchoolModal) {
        editSchoolModal.addEventListener('click', function(e) {
            if (e.target === editSchoolModal) closeEditSchoolModal();
        });
    }
</script>
@endsection
