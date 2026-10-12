@extends('layouts.admin')

@section('title', 'Manage Internship Domains & Specialization Tracks – Infinity Interns')

@section('content')
<div class="space-y-6" x-data="{
    domainSearch: '',
    streamForm: {
        title: '',
        code: '',
        category: 'TECHNOLOGY',
        duration: '8 Weeks (120 Hours)',
        credits: '4.0 NHEQF Credits',
        description: '',
        is_active: true
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

    <!-- Top Header & Navigation Banner -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col lg:flex-row lg:items-center justify-between gap-6 motion-reveal">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 text-xs font-semibold mb-2 border border-emerald-200 dark:border-emerald-800">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Academic Catalog Master • Section 3 of 3</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Internship Streams &amp; Tracks</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 leading-relaxed">
                Configure specialized practical internship domains &amp; tracks aligned with NHEQF credits. All active streams configured here populate candidate track selections and certificate credential seals.
            </p>
        </div>

        <!-- Quick Section Switcher Pills -->
        <div class="flex items-center gap-2 p-1.5 rounded-2xl bg-slate-100 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/60 shrink-0">
            <a href="{{ route('admin.degrees') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span>🎓 Degrees</span>
            </a>
            <a href="{{ route('admin.schools') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span>🏫 Schools</span>
            </a>
            <a href="{{ route('admin.streams') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600 text-white shadow-md shadow-indigo-600/30 flex items-center gap-1.5">
                <span>🚀 Domains</span>
                <span class="text-[10px] px-1.5 py-0.2 rounded-full bg-white/20">{{ $streams->count() }}</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 motion-reveal">
        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Configured Domains</span>
                <span class="text-2xl font-extrabold adm-text block mt-1">{{ $streams->count() }}</span>
                <span class="text-[11px] text-slate-400 font-medium">Tech, Business &amp; Science</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl font-bold">
                🚀
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Active on Portal</span>
                <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 block mt-1">{{ $streams->where('is_active', true)->count() }}</span>
                <span class="text-[11px] text-emerald-600/80 font-medium">Available for selection</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl font-bold">
                ✓
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl adm-card border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider adm-text-muted block">Enrolled Scholars</span>
                <span class="text-2xl font-extrabold adm-text block mt-1">{{ $streams->sum('student_profiles_count') }}</span>
                <span class="text-[11px] text-slate-400 font-medium">Across all domain tracks</span>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl font-bold">
                👥
            </div>
        </div>
    </div>

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

                <!-- Duration -->
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

    <!-- Streams Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl motion-reveal border">
        <!-- Search & Filter Bar -->
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/30">
            <div>
                <h3 class="font-serif font-bold text-base adm-text">Configured Specialization Tracks ({{ $streams->count() }})</h3>
                <p class="text-[11px] adm-text-muted">Dynamic streams mapped to National Higher Education Qualifications Framework (NHEQF).</p>
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
                        <th class="py-3.5 px-4 font-bold">Stream Title &amp; Code</th>
                        <th class="py-3.5 px-4 font-bold">Category</th>
                        <th class="py-3.5 px-4 font-bold">Contact Hours &amp; Credits</th>
                        <th class="py-3.5 px-4 font-bold">Enrolled Students</th>
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
                                    <span class="font-bold adm-text text-sm block">{{ $stream->title }}</span>
                                    <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[11px] font-semibold">{{ $stream->code }}</span>
                                    <p class="adm-text-muted text-[11px] mt-0.5 line-clamp-1 max-w-md">{{ $stream->description }}</p>
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
                            <span class="font-bold text-sm adm-text">{{ $stream->student_profiles_count }}</span>
                            <span class="adm-text-muted text-[10px] block">Scholars</span>
                        </td>

                        <td class="py-4 px-4">
                            <form action="{{ route('admin.streams.toggle', $stream->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer motion-btn-spring {{ $stream->is_active ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-300 dark:border-slate-700' }}" title="Click to Toggle Status">
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
                            <p class="text-xs text-slate-400 mt-1">Use the Quick Registration Studio above to add your first domain track.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL: EDIT STREAM -->
<!-- ======================================================== -->
<div id="editStreamModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/75 backdrop-blur-md hidden overflow-y-auto">
    <div class="relative w-full max-w-lg adm-card rounded-3xl p-6 shadow-2xl border motion-reveal my-8">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h3 class="text-base font-serif font-bold adm-text">Edit Domain Track</h3>
                <p class="text-[11px] adm-text-muted">Modify curriculum details and NHEQF credits.</p>
            </div>
            <button type="button" onclick="closeEditStreamModal()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition cursor-pointer">✕</button>
        </div>

        <form id="editStreamForm" method="POST" class="space-y-3.5 mt-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Domain Stream Title *</label>
                <input type="text" name="title" id="edit_stream_title" required class="w-full px-3.5 py-2.5 rounded-xl adm-input text-xs font-medium">
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

<script>
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeEditStreamModal();
    });

    const editStreamModal = document.getElementById('editStreamModal');
    if (editStreamModal) {
        editStreamModal.addEventListener('click', function(e) {
            if (e.target === editStreamModal) closeEditStreamModal();
        });
    }
</script>
@endsection
