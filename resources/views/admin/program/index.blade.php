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
        activeProgram: { 
            id: '', 
            title: '', 
            slug: '', 
            target_market: '', 
            outcome: [], 
            short_description: '', 
            description: '',
            spec_warranty: '',
            spec_speed: '',
            spec_support: '',
            spec_license: ''
        },

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
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow transition-all hover:-translate-y-0.5 duration-200">
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
                        <div class="flex items-center gap-3 mb-2">
                            <div
                                class="w-10 h-10 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex shrink-0 items-center justify-center font-extrabold text-indigo-400 text-sm">
                                {{ strtoupper($prog->title[0]) }}
                            </div>
                            <div>
                                <h3 class="font-extrabold text-zinc-100 text-base leading-tight">{{ $prog->title }}</h3>
                                <p class="text-[10px] text-indigo-400 font-semibold mt-0.5">Target:
                                    {{ $prog->target_market }}</p>
                            </div>
                        </div>

                        @if($prog->current_price || $prog->original_price)
                            <div class="flex items-baseline gap-2 mb-4 px-1">
                                @if($prog->original_price)
                                    <span
                                        class="text-xs text-zinc-500 line-through decoration-zinc-500/50">{{ $prog->original_price }}</span>
                                @endif
                                @if($prog->current_price)
                                    <span class="font-bold text-emerald-400">
                                        {!! preg_replace('/^(Rp\s*)/i', '<span class="text-xs font-semibold">$1</span><span class="text-lg font-black">', e($prog->current_price)) !!}{!! preg_match('/^(Rp\s*)/i', $prog->current_price) ? '</span>' : '' !!}
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="mb-4"></div>
                        @endif

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
                                                                short_description: {{ Js::from($prog->short_description) }},
                                                                description: {{ Js::from($prog->description) }},
                                                                spec_warranty: {{ Js::from($prog->spec_warranty) }},
                                                                spec_speed: {{ Js::from($prog->spec_speed) }},
                                                                spec_support: {{ Js::from($prog->spec_support) }},
                                                                spec_license: {{ Js::from($prog->spec_license) }},
                                                                original_price: {{ Js::from($prog->original_price) }},
                                                                current_price: {{ Js::from($prog->current_price) }}
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
                 selectedProgramId: '{{ request('program_id') ?? $programs->first()?->id ?? '' }}',
                 programsMap: {{ Js::from($programs->keyBy('id')->map(function ($p) {
    return ['id' => $p->id, 'title' => $p->title, 'topics' => $p->effective_topics]; })) }},
                 topicItems: [],

                 initTopics() {
                     if (this.selectedProgramId && this.programsMap[this.selectedProgramId]) {
                         this.topicItems = JSON.parse(JSON.stringify(this.programsMap[this.selectedProgramId].topics || []));
                     } else {
                         this.topicItems = [
                             { key: 'overview', icon: '📌', title: 'Gambaran Umum & Benefit', subtitle: 'Deskripsi narasi lengkap & poin hasil utama', content: '' },
                             { key: 'features', icon: '⚡', title: 'Fitur & Arsitektur Platform', subtitle: 'Rincian modul teknis & integrasi sistem', content: '' },
                             { key: 'workflow', icon: '🚀', title: 'Alur Kerja & Roadmap', subtitle: 'Tahapan eksekusi dari ide hingga rilis', content: '' },
                             { key: 'specs', icon: '🛠️', title: 'Spesifikasi Layanan & SLA', subtitle: 'Infrastruktur server, enkripsi & garansi', content: '' }
                         ];
                     }
                     
                     // Siapkan data terpisah untuk specs dan features
                     this.topicItems.forEach(item => {
                         if (item.key === 'specs') {
                             let lines = (item.content || '').split('\n').map(l => l.trim()).filter(l => l !== '');
                             item.spec_1 = lines[0] || 'Cloud High-Speed SSD, SSL HTTPS Encrypted';
                             item.spec_2 = lines[1] || '100% Hak Milik Klien (Domain & Database Full Access)';
                             item.spec_3 = lines[2] || 'Backup Database Otomatis & Free Technical Maintenance';
                             item.spec_4 = lines[3] || 'Bantuan Teknis Fast Response via WhatsApp';
                             this.updateSpecsContent(item);
                         } else if (item.key === 'features') {
                             try {
                                 let parsed = JSON.parse(item.content || '[]');
                                 if (Array.isArray(parsed) && parsed.length > 0) {
                                     item.feature_items = parsed;
                                 } else {
                                     item.feature_items = [
                                         { icon: 'check', text: 'Landing Page High-Converting & Mobile Responsive', custom_class: '' },
                                         { icon: 'check', text: 'Integrasi Checkout & Form Pemesanan WhatsApp', custom_class: '' },
                                         { icon: 'check', text: 'Sistem Katalog Produk & Manajemen Stok', custom_class: '' },
                                         { icon: 'check', text: 'Dashboard Admin CMS Mandiri', custom_class: '' }
                                     ];
                                 }
                             } catch (e) {
                                 let lines = (item.content || '').split('\n').map(l => l.trim()).filter(l => l !== '');
                                 if (lines.length > 0) {
                                     item.feature_items = lines.map(line => ({ icon: 'check', text: line, custom_class: '' }));
                                 } else {
                                     item.feature_items = [
                                         { icon: 'check', text: 'Landing Page High-Converting & Mobile Responsive', custom_class: '' },
                                         { icon: 'check', text: 'Integrasi Checkout & Form Pemesanan WhatsApp', custom_class: '' },
                                         { icon: 'check', text: 'Sistem Katalog Produk & Manajemen Stok', custom_class: '' },
                                         { icon: 'check', text: 'Dashboard Admin CMS Mandiri', custom_class: '' }
                                     ];
                                 }
                             }
                             this.updateFeaturesContent(item);
                         }
                     });
                 },
                 updateSpecsContent(item) {
                     item.content = [item.spec_1, item.spec_2, item.spec_3, item.spec_4].join('\n');
                 },
                 updateFeaturesContent(item) {
                     item.content = JSON.stringify(item.feature_items || []);
                 },
                 toggleFeatureIcon(item, idx) {
                     if (!item.feature_items) item.feature_items = [];
                     item.feature_items[idx].icon = item.feature_items[idx].icon === 'check' ? 'cross' : 'check';
                     this.updateFeaturesContent(item);
                 },
                 addFeatureItem(item) {
                     if (!item.feature_items) item.feature_items = [];
                     item.feature_items.push({ icon: 'check', text: '', custom_class: '' });
                     this.updateFeaturesContent(item);
                 },
                 removeFeatureItem(item, idx) {
                     if (item.feature_items && item.feature_items.length > 1) {
                         item.feature_items.splice(idx, 1);
                         this.updateFeaturesContent(item);
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
                                <div class="sm:col-span-10">
                                    <label class="block text-[10px] font-bold text-zinc-500 uppercase mb-1">Judul
                                        Topik</label>
                                    <input type="text" :name="'topic_title[' + i + ']'" x-model="item.title"
                                        placeholder="cth: Fitur Khusus" required
                                        class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-100 text-xs font-semibold">

                                    {{-- Hidden inputs to preserve existing data --}}
                                    <input type="hidden" :name="'topic_key[' + i + ']'" x-model="item.key">
                                    <input type="hidden" :name="'topic_subtitle[' + i + ']'" x-model="item.subtitle">
                                    <input type="hidden" :name="'topic_custom_class[' + i + ']'"
                                        x-model="item.custom_class">
                                </div>
                            </div>

                            <template x-if="item.key === 'specs'">
                                <div class="bg-indigo-950/20 border border-indigo-500/20 rounded-xl p-4 space-y-3">
                                    <h4
                                        class="text-[10px] font-bold text-indigo-400 uppercase flex items-center gap-2 mb-3">
                                        <span>⚙️</span> Atur Spesifikasi & SLA (4 Poin)
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold text-zinc-500 mb-1">1. Server &
                                                Hosting</label>
                                            <input type="text" x-model="item.spec_1" @input="updateSpecsContent(item)"
                                                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 focus:border-indigo-500/50 rounded-xl text-zinc-100 text-xs transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-zinc-500 mb-1">2. Kepemilikan
                                                Aset</label>
                                            <input type="text" x-model="item.spec_2" @input="updateSpecsContent(item)"
                                                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 focus:border-indigo-500/50 rounded-xl text-zinc-100 text-xs transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-zinc-500 mb-1">3. Garansi &
                                                Backup</label>
                                            <input type="text" x-model="item.spec_3" @input="updateSpecsContent(item)"
                                                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 focus:border-indigo-500/50 rounded-xl text-zinc-100 text-xs transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-zinc-500 mb-1">4. Respon
                                                Support CS</label>
                                            <input type="text" x-model="item.spec_4" @input="updateSpecsContent(item)"
                                                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 focus:border-indigo-500/50 rounded-xl text-zinc-100 text-xs transition-colors">
                                        </div>
                                    </div>
                                    <input type="hidden" :name="'topic_content[' + i + ']'" :value="item.content">
                                </div>
                            </template>

                            {{-- Fitur & Arsitektur Platform: Dynamic Point Builder --}}
                            <template x-if="item.key === 'features'">
                                <div class="bg-indigo-950/20 border border-indigo-500/20 rounded-xl p-4 space-y-4">
                                    <div class="flex items-center justify-between border-b border-indigo-500/20 pb-3">
                                        <h4 class="text-[10px] font-bold text-indigo-400 uppercase flex items-center gap-2">
                                            <span>⚡</span> Poin-Poin Fitur &amp; Arsitektur Platform
                                        </h4>
                                        <button type="button" @click="addFeatureItem(item)"
                                            class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors">
                                            + Tambah Poin Fitur
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-zinc-500">Klik ikon ✓/✗ untuk toggle checklist (hijau) atau cross (merah).</p>

                                    <div class="space-y-2.5">
                                        <template x-for="(fItem, fIdx) in item.feature_items" :key="fIdx">
                                            <div class="flex items-center gap-2">
                                                {{-- Toggle Icon Button --}}
                                                <button type="button" @click="toggleFeatureIcon(item, fIdx)"
                                                    :class="fItem.icon === 'check' ? 'text-green-400 border-green-500/30 bg-green-500/10 hover:bg-green-500/20' : 'text-red-400 border-red-500/30 bg-red-500/10 hover:bg-red-500/20'"
                                                    class="w-9 h-9 shrink-0 rounded-lg border flex items-center justify-center font-bold text-sm transition-all">
                                                    <span x-text="fItem.icon === 'check' ? '✓' : '✗'"></span>
                                                </button>

                                                <div class="flex-1 space-y-1">
                                                    <input type="text" x-model="fItem.text" @input="updateFeaturesContent(item)" required
                                                        placeholder="cth: Integrasi Payment Gateway Otomatis"
                                                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-xs placeholder-gray-500 focus:outline-none transition-colors">
                                                    <input type="text" x-model="fItem.custom_class" @input="updateFeaturesContent(item)"
                                                        placeholder="Deskripsi / Penjelasan Fitur (Opsional)"
                                                        class="w-full px-3 py-1.5 bg-gray-900 border border-gray-700 focus:border-blue-400 rounded-lg text-gray-400 text-[10px] focus:outline-none transition-colors">
                                                </div>

                                                {{-- Delete Row Button --}}
                                                <button type="button" @click="removeFeatureItem(item, fIdx)" x-show="item.feature_items && item.feature_items.length > 1"
                                                    class="w-9 h-9 shrink-0 rounded-lg border border-zinc-800 text-zinc-600 hover:text-red-400 hover:border-red-500/30 flex items-center justify-center transition-all text-sm">
                                                    ✕
                                                </button>
                                            </div>
                                        </template>
                                    </div>

                                    <input type="hidden" :name="'topic_content[' + i + ']'" :value="item.content">
                                </div>
                            </template>


                        </div>
                    </template>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-zinc-900">
                    <button type="button" @click="addTopicRow()"
                        class="px-4 py-2 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-indigo-400 hover:text-indigo-300 text-xs font-bold rounded-xl transition-all">
                        + Tambah Item Dropdown Baru
                    </button>

                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow transition-all">
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
                class="w-full max-w-2xl bg-gray-800 border border-gray-700 rounded-3xl shadow-2xl max-h-[90vh] overflow-y-auto">
                {{-- Blue Header --}}
                <div class="flex items-center justify-between bg-blue-700 px-7 py-5 rounded-t-3xl">
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest">+ Tambah Program Baru</h3>
                    <button @click="showAddModal = false"
                        class="text-blue-200 hover:text-white text-xl leading-none transition-colors">✕</button>
                </div>
                <div class="px-7 pb-7 pt-6 space-y-6">

                    <form action="{{ route('admin.program.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Judul
                                    Program</label>
                                <input type="text" name="title" placeholder="cth: START" required
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Slug
                                    (URL)</label>
                                <input type="text" name="slug" placeholder="cth: start" required
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Target
                                Pasar</label>
                            <input type="text" name="target_market" placeholder="cth: Pemula / Brand Baru" required
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Harga
                                    Coret (Opsional)</label>
                                <input type="text" name="original_price" placeholder="cth: Rp 5.000.000"
                                    oninput="let val = this.value.replace(/[^0-9]/g, ''); this.value = val ? 'Rp ' + val.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Harga
                                    Saat Ini</label>
                                <input type="text" name="current_price" placeholder="cth: Rp 3.500.000"
                                    oninput="let val = this.value.replace(/[^0-9]/g, ''); this.value = val ? 'Rp ' + val.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                        </div>

                        {{-- Outcome List Builder --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label
                                    class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Outcome /
                                    Hasil Program</label>
                                <button type="button" @click="addOutcomeRow()"
                                    class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors">+
                                    Tambah Item</button>
                            </div>
                            <p class="text-[10px] text-zinc-600 mb-3">Klik ikon ✓/✗ untuk toggle antara checklist
                                (hijau)
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
                                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-xs placeholder-gray-500 focus:outline-none transition-colors">
                                            <input type="text" :name="'outcome_custom_class[' + i + ']'"
                                                x-model="item.custom_class" placeholder="Custom Class CSS (Opsional)"
                                                class="w-full px-3 py-1.5 bg-gray-900 border border-gray-700 focus:border-blue-400 rounded-lg text-gray-400 text-[10px] font-mono focus:outline-none transition-colors">
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
                            <label
                                class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Deskripsi
                                Singkat</label>
                            <textarea name="short_description" rows="2" placeholder="Deskripsi singkat program..."
                                required
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors resize-none"></textarea>
                        </div>

                        {{-- Metric Highlights --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Garansi
                                    Sistem</label>
                                <input type="text" name="spec_warranty" placeholder="cth: 100% Turnkey Ready"
                                    value="100% Turnkey Ready"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Kecepatan
                                    Muat</label>
                                <input type="text" name="spec_speed" placeholder="cth: < 1.5 Detik" value="< 1.5 Detik"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Dukungan
                                    Support</label>
                                <input type="text" name="spec_support" placeholder="cth: Tim Dedicated CS"
                                    value="Tim Dedicated CS"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Status
                                    Lisensi</label>
                                <input type="text" name="spec_license" placeholder="cth: Full Mandiri (100% Hak Milik)"
                                    value="Full Mandiri (100% Hak Milik)"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                        </div>



                        <div class="flex justify-end gap-3 pt-2 border-t border-gray-700">
                            <button type="button" @click="showAddModal = false"
                                class="px-5 py-3 bg-gray-700 border border-gray-600 hover:bg-gray-600 text-gray-300 hover:text-white text-xs font-bold rounded-xl transition-all">Batal</button>
                            <button type="submit"
                                class="px-7 py-3 bg-blue-700 hover:bg-blue-600 text-white font-bold text-xs rounded-xl shadow transition-all">Simpan
                                Program</button>
                        </div>
                    </form>
                </div>
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
                class="w-full max-w-2xl bg-gray-800 border border-gray-700 rounded-3xl shadow-2xl max-h-[90vh] overflow-y-auto">
                {{-- Blue Header --}}
                <div class="flex items-center justify-between bg-blue-700 px-7 py-5 rounded-t-3xl">
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest">✏️ Edit Program Akselerasi
                    </h3>
                    <button @click="showEditModal = false"
                        class="text-blue-200 hover:text-white text-xl leading-none transition-colors">✕</button>
                </div>
                <div class="px-7 pb-7 pt-6 space-y-6">

                    <form x-bind:action="'/admin/program/' + activeProgram.id" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Judul
                                    Program</label>
                                <input type="text" name="title" x-model="activeProgram.title" required
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Slug
                                    (URL)</label>
                                <input type="text" name="slug" x-model="activeProgram.slug" required
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Target
                                Pasar</label>
                            <input type="text" name="target_market" x-model="activeProgram.target_market" required
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Harga
                                    Coret (Opsional)</label>
                                <input type="text" name="original_price" x-model="activeProgram.original_price"
                                    placeholder="cth: Rp 5.000.000"
                                    @input="let val = $event.target.value.replace(/[^0-9]/g, ''); activeProgram.original_price = val ? 'Rp ' + val.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Harga
                                    Saat Ini</label>
                                <input type="text" name="current_price" x-model="activeProgram.current_price"
                                    placeholder="cth: Rp 3.500.000"
                                    @input="let val = $event.target.value.replace(/[^0-9]/g, ''); activeProgram.current_price = val ? 'Rp ' + val.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                            </div>
                        </div>

                        {{-- Outcome List Builder (Edit) --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label
                                    class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Outcome /
                                    Hasil Program</label>
                                <button type="button" @click="addEditOutcomeRow()"
                                    class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors">+
                                    Tambah Item</button>
                            </div>
                            <p class="text-[10px] text-zinc-600 mb-3">Klik ikon ✓/✗ untuk toggle antara checklist
                                (hijau)
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
                                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-xs placeholder-gray-500 focus:outline-none transition-colors">
                                            <input type="text" :name="'outcome_custom_class[' + i + ']'"
                                                x-model="item.custom_class" placeholder="Custom Class CSS (Opsional)"
                                                class="w-full px-3 py-1.5 bg-gray-900 border border-gray-700 focus:border-blue-400 rounded-lg text-gray-400 text-[10px] font-mono focus:outline-none transition-colors">
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
                            <label
                                class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Deskripsi
                                Singkat</label>
                            <textarea name="short_description" rows="3" x-ref="editDescription" required
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none resize-none transition-colors"></textarea>
                        </div>

                        {{-- Metric Highlights --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Garansi
                                    Sistem</label>
                                <input type="text" name="spec_warranty" x-model="activeProgram.spec_warranty"
                                    placeholder="cth: 100% Turnkey Ready"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Kecepatan
                                    Muat</label>
                                <input type="text" name="spec_speed" x-model="activeProgram.spec_speed"
                                    placeholder="cth: < 1.5 Detik"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Dukungan
                                    Support</label>
                                <input type="text" name="spec_support" x-model="activeProgram.spec_support"
                                    placeholder="cth: Tim Dedicated CS"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Status
                                    Lisensi</label>
                                <input type="text" name="spec_license" x-model="activeProgram.spec_license"
                                    placeholder="cth: Full Mandiri (100% Hak Milik)"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                            </div>
                        </div>



                        <div class="flex justify-end gap-3 pt-2 border-t border-gray-700">
                            <button type="button" @click="showEditModal = false"
                                class="px-5 py-3 bg-gray-700 border border-gray-600 hover:bg-gray-600 text-gray-300 hover:text-white text-xs font-bold rounded-xl transition-all">Batal</button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-700 hover:bg-blue-600 text-white text-xs font-bold rounded-xl shadow transition-all">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-layouts.admin>