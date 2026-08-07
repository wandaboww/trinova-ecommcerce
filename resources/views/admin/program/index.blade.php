<x-layouts.admin :title="'Kelola Program — CMS Admin'" :headerTitle="'Kelola Program Akselerasi Bisnis'">

    @if(session('success'))
        <div
            class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 px-5 py-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-semibold rounded-xl">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div x-data="{
        showAddModal: false,
        showEditModal: false,
        activeProgram: { id: '', title: '', slug: '', target_market: '', outcome: [], short_description: '', description: '' },

        addOutcomeItems: [{ icon: 'check', text: '', custom_class: '' }],
        editOutcomeItems: [],

        addOutcomeRow() { this.addOutcomeItems.push({ icon: 'check', text: '', custom_class: '' }); },
        removeAddOutcomeRow(i) { if (this.addOutcomeItems.length > 1) this.addOutcomeItems.splice(i, 1); },
        toggleAddIcon(i) { this.addOutcomeItems[i].icon = this.addOutcomeItems[i].icon === 'check' ? 'cross' : 'check'; },

        addEditOutcomeRow() { this.editOutcomeItems.push({ icon: 'check', text: '', custom_class: '' }); },
        removeEditOutcomeRow(i) { if (this.editOutcomeItems.length > 1) this.editOutcomeItems.splice(i, 1); },
        toggleEditIcon(i) { this.editOutcomeItems[i].icon = this.editOutcomeItems[i].icon === 'check' ? 'cross' : 'check'; },

        openEdit(data) {
            this.activeProgram = data;
            try {
                let parsed = typeof data.outcome === 'string' ? JSON.parse(data.outcome) : data.outcome;
                this.editOutcomeItems = Array.isArray(parsed) && parsed.length > 0
                    ? parsed
                    : [{ icon: 'check', text: (typeof data.outcome === 'string' ? data.outcome : ''), custom_class: '' }];
            } catch(e) {
                this.editOutcomeItems = [{ icon: 'check', text: (typeof data.outcome === 'string' ? data.outcome : ''), custom_class: '' }];
            }
            this.showEditModal = true;
            this.$nextTick(() => {
                this.$refs.editDescription.value = data.short_description;
                this.$refs.editLongDescription.value = data.description || '';
            });
        }
    }">

        {{-- Action Bar --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs text-zinc-500 mt-1">Kelola paket program akselerasi bisnis yang ditampilkan di halaman
                    utama.</p>
            </div>
            <button @click="showAddModal = true; addOutcomeItems = [{ icon: 'check', text: '' }];"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 duration-200">
                + Tambah Program
            </button>
        </div>

        {{-- Programs Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            @if($programs->isEmpty())
                <div
                    class="col-span-full p-8 bg-zinc-900/40 border border-zinc-800 rounded-3xl text-center text-zinc-500 text-xs">
                    Belum ada program akselerasi yang ditambahkan.
                </div>
            @endif

            @foreach($programs as $prog)
                @php
                    $outcomeItems = [];
                    if (is_array($prog->outcome)) {
                        $outcomeItems = $prog->outcome;
                    } elseif (is_string($prog->outcome)) {
                        $decoded = json_decode($prog->outcome, true);
                        $outcomeItems = is_array($decoded) ? $decoded : [['icon' => 'check', 'text' => $prog->outcome]];
                    }
                @endphp
                <div
                    class="bg-zinc-950 border border-zinc-900 hover:border-indigo-500/30 rounded-2xl p-5 transition-all relative group flex flex-col justify-between">
                    @if($prog->is_best_value)
                        <span
                            class="absolute -top-2.5 left-4 px-3 py-0.5 bg-indigo-600 text-[10px] font-bold rounded-full text-white uppercase tracking-wider">Recommended</span>
                    @endif
                    <div>
                        <div
                            class="w-10 h-10 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center font-extrabold text-indigo-400 text-sm mb-4">
                            {{ strtoupper($prog->title[0]) }}
                        </div>
                        <h3 class="font-extrabold text-zinc-100 text-base mb-1">{{ $prog->title }}</h3>
                        <p class="text-[10px] text-indigo-400 font-semibold mb-3">Target: {{ $prog->target_market }}</p>
                        <ul class="space-y-1.5 mb-4">
                            @foreach($outcomeItems as $item)
                                <li class="flex items-start gap-1.5 text-[11px] text-zinc-400 leading-relaxed">
                                    @if(($item['icon'] ?? 'check') === 'check')
                                        <span class="text-green-400 mt-0.5 shrink-0">✓</span>
                                    @else
                                        <span class="text-red-400 mt-0.5 shrink-0">✗</span>
                                    @endif
                                    {{ $item['text'] ?? '' }}
                                </li>
                            @endforeach
                        </ul>

                        {{-- Toggle Best Value / Recommended --}}
                        <div class="border-t border-zinc-900 pt-3 mt-2 mb-4 flex items-center justify-between">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Mark
                                Recommended</span>
                            <form action="{{ route('admin.program.toggle-best-value', $prog->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $prog->is_best_value ? 'bg-indigo-600' : 'bg-zinc-800' }}">
                                    <span
                                        class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $prog->is_best_value ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-auto">
                        <button @click="openEdit({
                                            id: '{{ $prog->id }}',
                                            title: {{ Js::from($prog->title) }},
                                            slug: {{ Js::from($prog->slug) }},
                                            target_market: {{ Js::from($prog->target_market) }},
                                            outcome: {{ Js::from(json_encode($outcomeItems)) }},
                                            short_description: {{ Js::from($prog->short_description) }}
                                        })"
                            class="flex-1 text-center py-2 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-zinc-300 hover:text-white text-[10px] font-bold rounded-lg transition-all">
                            Edit
                        </button>
                        <form action="{{ route('admin.program.destroy', $prog->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full py-2 bg-zinc-900 border border-red-500/10 hover:border-red-500/40 text-red-400 hover:text-red-300 text-[10px] font-bold rounded-lg transition-all">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Kelola Navigasi Topik Detail Program (Elemen Baru CRUD) --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-3xl p-7 mb-10 shadow-2xl space-y-6" x-data="{
                 selectedProgramId: '{{ $programs->first()?->id ?? '' }}',
                 programsMap: {{ Js::from($programs->keyBy('id')->map(function ($p) {
    return ['id' => $p->id, 'title' => $p->title, 'topics' => $p->effective_topics]; })) }},
                 topicItems: [],

                 initTopics() {
                     if (this.selectedProgramId && this.programsMap[this.selectedProgramId]) {
                         this.topicItems = JSON.parse(JSON.stringify(this.programsMap[this.selectedProgramId].topics || []));
                     } else {
                         this.topicItems = [
                             { key: 'overview', icon: '📌', title: 'Gambaran Umum & Benefit', subtitle: 'Deskripsi narasi lengkap & poin hasil utama', content: '' },
                             { key: 'features', icon: '⚡', title: 'Fitur & Arsitektur Platform', subtitle: 'Rincian modul teknis & integrasi sistem', content: '' }
                         ];
                     }
                 },
                 onProgramChange() {
                     this.initTopics();
                 },
                 addTopicRow() {
                     this.topicItems.push({ key: 'topic_' + (this.topicItems.length + 1), icon: '💡', title: '', subtitle: '', content: '', custom_class: '' });
                 },
                 removeTopicRow(i) {
                     if (this.topicItems.length > 1) {
                         this.topicItems.splice(i, 1);
                     }
                 }
             }" x-init="initTopics()">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-zinc-900 pb-5">
                <div>
                    <h3 class="text-sm font-bold text-zinc-100 uppercase tracking-widest flex items-center gap-2">
                        <span>⚙️</span> Kelola Item Dropdown "Navigasi Topik Detail"
                    </h3>
                    <p class="text-xs text-zinc-500 mt-1">Atur elemen dropdown topik yang tampil pada halaman detail
                        program (/program/{slug}).</p>
                </div>
                <div class="flex items-center gap-3">
                    <label class="text-xs font-semibold text-zinc-400">Pilih Program:</label>
                    <select x-model="selectedProgramId" @change="onProgramChange()"
                        class="px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-100 text-xs font-bold focus:outline-none focus:border-indigo-500/60 transition-colors">
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->slug }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <form x-bind:action="'/admin/program/' + selectedProgramId + '/topics'" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <template x-for="(item, i) in topicItems" :key="i">
                        <div class="p-4 bg-zinc-900/60 border border-zinc-800/80 rounded-2xl space-y-3 relative group">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-6 h-6 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold flex items-center justify-center"
                                        x-text="i + 1"></span>
                                    <span class="text-xs font-bold text-zinc-300">Item Dropdown Topik #<span
                                            x-text="i + 1"></span></span>
                                </div>
                                <button type="button" @click="removeTopicRow(i)" x-show="topicItems.length > 1"
                                    class="text-xs font-semibold text-red-400 hover:text-red-300 px-2 py-1 bg-red-500/10 rounded-lg border border-red-500/20 transition-all">
                                    ✕ Hapus Topik
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                                <div class="sm:col-span-2">
                                    <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Ikon /
                                        Emoji</label>
                                    <input type="text" :name="'topic_icon[' + i + ']'" x-model="item.icon"
                                        placeholder="📌" required
                                        class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-100 text-xs font-bold text-center">
                                </div>
                                <div class="sm:col-span-4">
                                    <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Judul
                                        Topik</label>
                                    <input type="text" :name="'topic_title[' + i + ']'" x-model="item.title"
                                        placeholder="cth: Fitur Khusus" required
                                        class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-100 text-xs font-semibold">
                                </div>
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Key / Slug
                                        Unik</label>
                                    <input type="text" :name="'topic_key[' + i + ']'" x-model="item.key"
                                        placeholder="cth: overview / features" required
                                        class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-indigo-300 text-xs font-mono">
                                </div>
                                <div class="sm:col-span-3">
                                    <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Sub-Judul /
                                        Keterangan Singkat</label>
                                    <input type="text" :name="'topic_subtitle[' + i + ']'" x-model="item.subtitle"
                                        placeholder="cth: Penjelasan lengkap modul..."
                                        class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-100 text-xs">
                                </div>
                                <div class="sm:col-span-12">
                                    <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Custom Class
                                        CSS (Opsional)</label>
                                    <input type="text" :name="'topic_custom_class[' + i + ']'"
                                        x-model="item.custom_class" placeholder="cth: text-emerald-400"
                                        class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-100 text-xs font-mono">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Isi Konten Topik
                                    (Tampil Saat Tab Dipilih)</label>
                                <textarea :name="'topic_content[' + i + ']'" x-model="item.content" rows="2"
                                    placeholder="Tuliskan deskripsi/penjelasan detail untuk topik ini..."
                                    class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-100 text-xs resize-none"></textarea>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-zinc-900">
                    <button type="button" @click="addTopicRow()"
                        class="px-4 py-2 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-indigo-400 hover:text-indigo-300 text-xs font-bold rounded-xl transition-all">
                        + Tambah Item Dropdown Baru
                    </button>

                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        💾 Simpan Perubahan Dropdown Topik
                    </button>
                </div>
            </form>
        </div>

        {{-- Add Program Modal --}}
        <div x-show="showAddModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-cloak>
            <div @click.away="showAddModal = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="w-full max-w-2xl bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">+ Tambah Program Baru</h3>
                    <button @click="showAddModal = false"
                        class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>

                <form action="{{ route('admin.program.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Judul
                                Program</label>
                            <input type="text" name="title" placeholder="cth: START" required
                                class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Slug
                                (URL)</label>
                            <input type="text" name="slug" placeholder="cth: start" required
                                class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Target
                            Pasar</label>
                        <input type="text" name="target_market" placeholder="cth: Pemula / Brand Baru" required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                    </div>

                    {{-- Outcome List Builder --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Outcome /
                                Hasil Program</label>
                            <button type="button" @click="addOutcomeRow()"
                                class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors">+
                                Tambah Item</button>
                        </div>
                        <p class="text-[10px] text-zinc-600 mb-3">Klik ikon ✓/✗ untuk toggle antara checklist (hijau)
                            dan cross (merah).</p>
                        <div class="space-y-2">
                            <template x-for="(item, i) in addOutcomeItems" :key="i">
                                <div class="flex items-center gap-2">
                                    {{-- Icon Toggle Button --}}
                                    <button type="button" @click="toggleAddIcon(i)"
                                        :class="item.icon === 'check' ? 'text-green-400 border-green-500/30 bg-green-500/10 hover:bg-green-500/20' : 'text-red-400 border-red-500/30 bg-red-500/10 hover:bg-red-500/20'"
                                        class="w-9 h-9 shrink-0 rounded-lg border flex items-center justify-center font-bold text-sm transition-all">
                                        <span x-text="item.icon === 'check' ? '✓' : '✗'"></span>
                                    </button>
                                    {{-- Hidden inputs --}}
                                    <input type="hidden" :name="'outcome_icon[' + i + ']'" :value="item.icon">
                                    {{-- Text & Class input --}}
                                    <div class="flex-1 space-y-1">
                                        <input type="text" :name="'outcome_text[' + i + ']'" x-model="item.text"
                                            placeholder="cth: Landing Page siap konversi" required
                                            class="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-xs placeholder-zinc-600 focus:outline-none transition-colors">
                                        <input type="text" :name="'outcome_custom_class[' + i + ']'"
                                            x-model="item.custom_class" placeholder="Custom Class CSS (Opsional)"
                                            class="w-full px-3 py-1.5 bg-zinc-950 border border-zinc-800/80 focus:border-indigo-500/60 rounded-lg text-zinc-400 text-[10px] font-mono focus:outline-none transition-colors">
                                    </div>
                                    {{-- Remove Button --}}
                                    <button type="button" @click="removeAddOutcomeRow(i)"
                                        x-show="addOutcomeItems.length > 1"
                                        class="w-9 h-9 shrink-0 rounded-lg border border-zinc-800 text-zinc-600 hover:text-red-400 hover:border-red-500/30 flex items-center justify-center transition-all text-sm">
                                        ✕
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Deskripsi
                            Singkat</label>
                        <textarea name="short_description" rows="2" placeholder="Deskripsi singkat program..." required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Penjelasan Detail Program</label>
                        <textarea name="description" rows="5" placeholder="Penjelasan naratif detail program (mendukung multi baris)..." required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors resize-y"></textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-2 border-t border-zinc-900">
                        <button type="button" @click="showAddModal = false"
                            class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit"
                            class="px-7 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan
                            Program</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Program Modal --}}
        <div x-show="showEditModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-cloak>
            <div @click.away="showEditModal = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="w-full max-w-2xl bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">✏️ Edit Program Akselerasi
                    </h3>
                    <button @click="showEditModal = false"
                        class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>

                <form x-bind:action="'/admin/program/' + activeProgram.id" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Judul
                                Program</label>
                            <input type="text" name="title" x-model="activeProgram.title" required
                                class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Slug
                                (URL)</label>
                            <input type="text" name="slug" x-model="activeProgram.slug" required
                                class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Target
                            Pasar</label>
                        <input type="text" name="target_market" x-model="activeProgram.target_market" required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                    </div>

                    {{-- Outcome List Builder (Edit) --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Outcome /
                                Hasil Program</label>
                            <button type="button" @click="addEditOutcomeRow()"
                                class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors">+
                                Tambah Item</button>
                        </div>
                        <p class="text-[10px] text-zinc-600 mb-3">Klik ikon ✓/✗ untuk toggle antara checklist (hijau)
                            dan cross (merah).</p>
                        <div class="space-y-2">
                            <template x-for="(item, i) in editOutcomeItems" :key="i">
                                <div class="flex items-center gap-2">
                                    {{-- Icon Toggle Button --}}
                                    <button type="button" @click="toggleEditIcon(i)"
                                        :class="item.icon === 'check' ? 'text-green-400 border-green-500/30 bg-green-500/10 hover:bg-green-500/20' : 'text-red-400 border-red-500/30 bg-red-500/10 hover:bg-red-500/20'"
                                        class="w-9 h-9 shrink-0 rounded-lg border flex items-center justify-center font-bold text-sm transition-all">
                                        <span x-text="item.icon === 'check' ? '✓' : '✗'"></span>
                                    </button>
                                    {{-- Hidden inputs --}}
                                    <input type="hidden" :name="'outcome_icon[' + i + ']'" :value="item.icon">
                                    {{-- Text & Class input --}}
                                    <div class="flex-1 space-y-1">
                                        <input type="text" :name="'outcome_text[' + i + ']'" x-model="item.text"
                                            required
                                            class="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-xs placeholder-zinc-600 focus:outline-none transition-colors">
                                        <input type="text" :name="'outcome_custom_class[' + i + ']'"
                                            x-model="item.custom_class" placeholder="Custom Class CSS (Opsional)"
                                            class="w-full px-3 py-1.5 bg-zinc-950 border border-zinc-800/80 focus:border-indigo-500/60 rounded-lg text-zinc-400 text-[10px] font-mono focus:outline-none transition-colors">
                                    </div>
                                    {{-- Remove Button --}}
                                    <button type="button" @click="removeEditOutcomeRow(i)"
                                        x-show="editOutcomeItems.length > 1"
                                        class="w-9 h-9 shrink-0 rounded-lg border border-zinc-800 text-zinc-600 hover:text-red-400 hover:border-red-500/30 flex items-center justify-center transition-all text-sm">
                                        ✕
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Deskripsi
                            Singkat</label>
                        <textarea name="short_description" rows="3" x-ref="editDescription" required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none resize-none transition-colors"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Penjelasan Detail Program</label>
                        <textarea name="description" rows="5" x-ref="editLongDescription" required
                            class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none resize-y transition-colors"></textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-2 border-t border-zinc-900">
                        <button type="button" @click="showEditModal = false"
                            class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-layouts.admin>