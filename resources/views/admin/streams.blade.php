@extends('layouts.admin')

@section('title', 'Manage Internship Streams & Tracks – Infinity Interns')

@section('content')
<div class="space-y-6">

    <!-- Top Header -->
    <div class="p-6 md:p-8 rounded-3xl adm-card shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 text-xs font-semibold mb-2 border border-indigo-200 dark:border-indigo-800">
                <span>✦ Dynamic Academic Domain Catalog</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold adm-text">Internship Streams & Tracks</h1>
            <p class="text-xs sm:text-sm adm-text-muted mt-1 max-w-2xl">
                Add, configure, and manage dynamic internship specialization domains. Streams configured here instantly populate across student registration dropdowns, certificate templates, and public catalog pages.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" onclick="openAddStreamModal()" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-md shadow-indigo-600/30 cursor-pointer">
                + Add New Stream
            </button>
        </div>
    </div>

    <!-- Streams Table Card -->
    <div class="rounded-3xl adm-card overflow-hidden shadow-xl">
        <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h3 class="font-serif font-bold text-base adm-text">Configured Specialization Tracks ({{ $streams->count() }})</h3>
                <p class="text-[11px] adm-text-muted">Dynamic streams mapped to National Higher Education Qualifications Framework (NHEQF).</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="adm-table-head uppercase text-[10px] tracking-wider border-b">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Stream Title & Code</th>
                        <th class="py-3.5 px-4 font-bold">Category</th>
                        <th class="py-3.5 px-4 font-bold">Contact Hours & Credits</th>
                        <th class="py-3.5 px-4 font-bold">Enrolled Students</th>
                        <th class="py-3.5 px-4 font-bold">Status</th>
                        <th class="py-3.5 px-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($streams as $stream)
                    <tr class="adm-table-row transition">
                        <!-- Stream & Code -->
                        <td class="py-4 px-4">
                            <div>
                                <span class="font-bold adm-text text-sm block">{{ $stream->title }}</span>
                                <span class="font-mono text-indigo-600 dark:text-indigo-400 text-[11px] font-semibold">{{ $stream->code }}</span>
                                <p class="adm-text-muted text-[11px] mt-0.5 line-clamp-1 max-w-md">{{ $stream->description }}</p>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 adm-text text-[10px] font-bold uppercase tracking-wider">
                                {{ $stream->category }}
                            </span>
                        </td>

                        <!-- Duration & Credits -->
                        <td class="py-4 px-4">
                            <span class="adm-text font-medium block">{{ $stream->duration }}</span>
                            <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">{{ $stream->credits }}</span>
                        </td>

                        <!-- Students -->
                        <td class="py-4 px-4">
                            <span class="font-bold text-sm adm-text">{{ $stream->student_profiles_count }}</span>
                            <span class="adm-text-muted text-[10px] block">Active & Alumni</span>
                        </td>

                        <!-- Status Toggle -->
                        <td class="py-4 px-4">
                            <form action="{{ route('admin.streams.toggle', $stream->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer {{ $stream->is_active ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-300 dark:border-slate-700' }}" title="Click to Toggle Status">
                                    {{ $stream->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                </button>
                            </form>
                        </td>

                        <!-- Actions -->
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" onclick="openEditStreamModal({{ json_encode($stream) }})" class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700 text-[10px] font-bold transition cursor-pointer">
                                    ✎ Edit
                                </button>

                                <form action="{{ route('admin.streams.delete', $stream->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete stream {{ $stream->title }}?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer" title="Delete Stream">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center adm-text-muted text-xs">
                            No internship streams configured. Add your first stream above!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal: Add New Stream -->
<div id="addStreamModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="w-full max-w-lg rounded-3xl adm-card p-6 sm:p-8 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold adm-text">Add New Internship Specialization Stream</h3>
            <button onclick="closeAddStreamModal()" class="adm-text-muted hover:adm-text font-bold text-lg cursor-pointer">&times;</button>
        </div>

        <form action="{{ route('admin.streams.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Stream Title *</label>
                <input type="text" name="title" required placeholder="e.g. Artificial Intelligence & Deep Learning" class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Stream Code (Unique) *</label>
                    <input type="text" name="code" required placeholder="e.g. AI-DL" class="w-full px-3 py-2 rounded-xl adm-input text-xs font-mono uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Category *</label>
                    <select name="category" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        <option value="TECHNOLOGY">TECHNOLOGY</option>
                        <option value="BUSINESS">BUSINESS</option>
                        <option value="SCIENCE">SCIENCE</option>
                        <option value="ARTS">ARTS</option>
                        <option value="HEALTHCARE">HEALTHCARE</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Duration & Hours *</label>
                    <input type="text" name="duration" value="8 Weeks (120 Contact Hours)" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Academic Credits *</label>
                    <input type="text" name="credits" value="4.0 NHEQF Credits" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Curriculum & Practical Syllabus Description *</label>
                <textarea name="description" rows="3" required placeholder="Describe the hands-on lab modules, practical tools, and capstone milestones..." class="w-full px-3 py-2 rounded-xl adm-input text-xs"></textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="add_is_active" value="1" checked class="rounded text-indigo-600 focus:ring-indigo-500">
                <label for="add_is_active" class="text-xs adm-text font-medium cursor-pointer">Activate stream immediately for student registrations</label>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeAddStreamModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Save New Stream</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Stream -->
<div id="editStreamModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="w-full max-w-lg rounded-3xl adm-card p-6 sm:p-8 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base font-bold adm-text">Edit Internship Stream</h3>
            <button onclick="closeEditStreamModal()" class="adm-text-muted hover:adm-text font-bold text-lg cursor-pointer">&times;</button>
        </div>

        <form id="editStreamForm" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Stream Title *</label>
                <input type="text" name="title" id="edit_stream_title" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Stream Code *</label>
                    <input type="text" name="code" id="edit_stream_code" required class="w-full px-3 py-2 rounded-xl adm-input text-xs font-mono uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Category *</label>
                    <select name="category" id="edit_stream_category" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                        <option value="TECHNOLOGY">TECHNOLOGY</option>
                        <option value="BUSINESS">BUSINESS</option>
                        <option value="SCIENCE">SCIENCE</option>
                        <option value="ARTS">ARTS</option>
                        <option value="HEALTHCARE">HEALTHCARE</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Duration & Hours *</label>
                    <input type="text" name="duration" id="edit_stream_duration" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold adm-text-secondary mb-1">Academic Credits *</label>
                    <input type="text" name="credits" id="edit_stream_credits" required class="w-full px-3 py-2 rounded-xl adm-input text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold adm-text-secondary mb-1">Curriculum & Description *</label>
                <textarea name="description" id="edit_stream_desc" rows="3" required class="w-full px-3 py-2 rounded-xl adm-input text-xs"></textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="edit_stream_active" value="1" class="rounded text-indigo-600 focus:ring-indigo-500">
                <label for="edit_stream_active" class="text-xs adm-text font-medium cursor-pointer">Stream is active for student enrollment</label>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeEditStreamModal()" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 hover:opacity-80 adm-text text-xs font-semibold transition cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-lg shadow-indigo-600/30 cursor-pointer">Update Stream</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openAddStreamModal() {
        document.getElementById('addStreamModal').classList.remove('hidden');
    }
    function closeAddStreamModal() {
        document.getElementById('addStreamModal').classList.add('hidden');
    }

    function openEditStreamModal(stream) {
        document.getElementById('editStreamForm').action = '/admin/streams/' + stream.id;
        document.getElementById('edit_stream_title').value = stream.title || '';
        document.getElementById('edit_stream_code').value = stream.code || '';
        document.getElementById('edit_stream_category').value = stream.category || 'TECHNOLOGY';
        document.getElementById('edit_stream_duration').value = stream.duration || '';
        document.getElementById('edit_stream_credits').value = stream.credits || '';
        document.getElementById('edit_stream_desc').value = stream.description || '';
        document.getElementById('edit_stream_active').checked = !!stream.is_active;

        document.getElementById('editStreamModal').classList.remove('hidden');
    }
    function closeEditStreamModal() {
        document.getElementById('editStreamModal').classList.add('hidden');
    }
</script>
@endsection
