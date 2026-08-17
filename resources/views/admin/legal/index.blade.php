<x-layouts.admin :title="($type === 'privacy_policy' ? 'Kebijakan Privasi' : 'Syarat & Ketentuan') . ' — CMS Admin'" :headerTitle="'Dokumen Legal — ' . ($type === 'privacy_policy' ? 'Kebijakan Privasi' : 'Syarat & Ketentuan')">

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 px-5 py-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-semibold rounded-xl">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 px-5 py-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs rounded-xl space-y-1">
            @foreach($errors->all() as $error)
                <p>⚠️ {{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Document Type Tabs --}}
    <div class="flex items-center gap-3 mb-6 border-b border-zinc-900 pb-4">
        <a href="{{ route('admin.legal.index', ['type' => 'terms_and_conditions']) }}"
            class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 {{ $type === 'terms_and_conditions' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'bg-zinc-900 text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
            📜 Syarat &amp; Ketentuan
        </a>
        <a href="{{ route('admin.legal.index', ['type' => 'privacy_policy']) }}"
            class="px-5 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 {{ $type === 'privacy_policy' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'bg-zinc-900 text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
            🔒 Kebijakan Privasi
        </a>
    </div>

    <div x-data="{
        showAddSection: false,
        showEditSection: false,
        activeSection: { id: '', title: '', content: '', sort_order: '1', is_active: true },
        openEdit(data) {
            this.activeSection = data;
            this.showEditSection = true;
            this.$nextTick(() => {
                if (this.$refs.editContent) {
                    this.$refs.editContent.value = data.content;
                }
            });
        }
    }">

        {{-- ===== DOCUMENT INFO FORM ===== --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-3xl p-7 mb-8 shadow-2xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-zinc-900 pb-5 mb-6">
                <div>
                    <h2 class="text-sm font-bold text-zinc-100 uppercase tracking-widest flex items-center gap-2">
                        <span>📋</span> Informasi Dokumen {{ $type === 'privacy_policy' ? 'Kebijakan Privasi' : 'Syarat & Ketentuan' }}
                    </h2>
                    <p class="text-xs text-zinc-500 mt-1">Atur judul, versi, tanggal berlaku, dan metadata SEO dokumen.</p>
                </div>
                <div class="flex items-center gap-2">
                    @if($document)
                        <span class="px-3 py-1.5 text-[10px] font-bold rounded-full uppercase tracking-wider
                            {{ $document->status === 'published' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                            {{ $document->status === 'published' ? '🟢 Published' : '🟡 Draft' }}
                        </span>
                        @if($document->version)
                            <span class="px-3 py-1.5 text-[10px] font-bold bg-zinc-800 border border-zinc-700 rounded-full text-zinc-400">
                                v{{ $document->version }}
                            </span>
                        @endif
                    @else
                        <span class="px-3 py-1.5 text-[10px] font-bold rounded-full bg-zinc-800 border border-zinc-700 text-zinc-500">
                            Belum ada dokumen
                        </span>
                    @endif
                </div>
            </div>

            <form action="{{ route('admin.legal.document.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Judul Dokumen</label>
                        <input type="text" name="title" value="{{ old('title', $document?->title ?? ($type === 'privacy_policy' ? 'Kebijakan Privasi' : 'Syarat & Ketentuan')) }}" required
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors"
                            placeholder="Judul Dokumen">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Deskripsi Singkat (Subtitle)</label>
                        <textarea name="subtitle" rows="2"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none resize-none transition-colors"
                            placeholder="Deskripsi singkat dokumen...">{{ old('subtitle', $document?->subtitle ?? ($type === 'privacy_policy' ? 'Kami menghargai privasi Anda. Halaman ini menjelaskan bagaimana Omset Digital mengumpulkan, menggunakan, menyimpan, dan melindungi informasi yang diberikan ketika Anda menggunakan website dan layanan kami.' : 'Ketentuan penggunaan website dan layanan Omset Digital.')) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Nomor Versi</label>
                        <input type="text" name="version" value="{{ old('version', $document?->version ?? '1.0') }}" required
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors"
                            placeholder="1.0">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Tanggal Berlaku</label>
                        <input type="date" name="effective_date"
                            value="{{ old('effective_date', $document?->effective_date?->format('Y-m-d') ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                    </div>
                </div>

                <div class="border-t border-zinc-900 pt-5">
                    <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span>🔍</span> Metadata SEO (Opsional)
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 mb-1.5">Meta Title</label>
                            <input type="text" name="meta_title"
                                value="{{ old('meta_title', $document?->meta_title ?? '') }}"
                                placeholder="{{ $type === 'privacy_policy' ? 'Kebijakan Privasi | Omset Digital' : 'Syarat & Ketentuan | Omset Digital' }}"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 mb-1.5">Meta Description</label>
                            <input type="text" name="meta_description"
                                value="{{ old('meta_description', $document?->meta_description ?? '') }}"
                                placeholder="Deskripsi meta untuk mesin pencari..."
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="border-t border-zinc-900 pt-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="submit"
                            class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-zinc-200 font-bold text-xs rounded-xl transition-all">
                            💾 Simpan Draft
                        </button>
                        @if($document)
                            <button type="submit" formaction="{{ route('admin.legal.document.publish') }}"
                                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5"
                                onclick="return confirm('Publikasikan dokumen ini? Dokumen dan perubahan terbaru akan langsung tampil di halaman publik.')">
                                🚀 Publikasikan
                            </button>
                        @endif
                    </div>
                    @if($document)
                        <div class="flex flex-col sm:items-end text-[10px] text-zinc-500">
                            <a href="{{ $type === 'privacy_policy' ? route('privacy') : route('terms') }}?preview=1" target="_blank"
                                class="inline-flex items-center gap-1.5 hover:text-indigo-400 transition-colors mb-1">
                                👁️ Preview Halaman
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                            @if($document->status === 'published' && $document->published_at)
                                <span>Terakhir dipublikasikan: {{ $document->published_at->translatedFormat('d M Y, H:i') }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            </form>
        </div>

        {{-- ===== SECTION MANAGER ===== --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-3xl p-7 shadow-2xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-zinc-900 pb-5 mb-6">
                <div>
                    <h2 class="text-sm font-bold text-zinc-100 uppercase tracking-widest flex items-center gap-2">
                        <span>📑</span> Kelola Isi Dokumen (Section / Pasal)
                    </h2>
                    <p class="text-xs text-zinc-500 mt-1">
                        Setiap section merupakan satu pasal/bagian dokumen. Urutan tampil diatur dari nilai "Urutan".
                    </p>
                </div>
                @if($document)
                    <button @click="showAddSection = true"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow transition-all hover:-translate-y-0.5 duration-200 shrink-0">
                        + Tambah Section
                    </button>
                @else
                    <span class="text-xs text-zinc-600 italic">Simpan informasi dokumen dahulu sebelum menambah section.</span>
                @endif
            </div>

            {{-- Section List --}}
            @if($sections->isEmpty())
                <div class="p-8 bg-zinc-900/30 border border-zinc-800 rounded-2xl text-center text-zinc-500 text-xs">
                    Belum ada section. Klik tombol "Tambah Section" untuk membuat konten dokumen.
                </div>
            @else
                <div class="space-y-3 max-w-4xl">
                    @foreach($sections as $section)
                        <div class="bg-zinc-900/60 border {{ $section->is_active ? 'border-zinc-800' : 'border-zinc-800/50 opacity-60' }} rounded-2xl p-4 sm:p-5 relative group">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-3 flex-1 min-w-0">
                                    <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                                        {{ $section->sort_order }}
                                    </span>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap mb-1">
                                            <p class="text-sm font-bold text-zinc-200 leading-snug">{{ $section->title }}</p>
                                            @if(!$section->is_active)
                                                <span class="px-2 py-0.5 text-[9px] font-bold bg-zinc-800 text-zinc-500 rounded-full">NONAKTIF</span>
                                            @endif
                                        </div>
                                        <p class="text-[10px] text-zinc-600 font-mono">#{{ $section->slug }}</p>
                                        @if($section->content)
                                            <p class="text-xs text-zinc-500 leading-relaxed mt-2 line-clamp-2">{{ Str::limit($section->content, 120) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-2 shrink-0">
                                    <button
                                        @click="openEdit({
                                            id: '{{ $section->id }}',
                                            title: {{ Js::from($section->title) }},
                                            content: {{ Js::from($section->content) }},
                                            sort_order: '{{ $section->sort_order }}',
                                            is_active: {{ $section->is_active ? 'true' : 'false' }}
                                        })"
                                        class="px-3 py-1.5 bg-zinc-800 border border-zinc-700 hover:border-indigo-500/40 text-zinc-400 hover:text-white rounded-lg text-[10px] font-bold transition-all">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.legal.sections.destroy', $section->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Hapus section ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-zinc-800 border border-red-500/10 hover:border-red-500/40 text-red-400 rounded-lg text-[10px] font-bold transition-all">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ===== ADD SECTION MODAL ===== --}}
        <div x-show="showAddSection"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
             x-cloak>
            <div @click.away="showAddSection = false"
                 class="bg-zinc-950 border border-zinc-800 rounded-3xl p-7 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-zinc-100 uppercase tracking-widest">+ Tambah Section Baru</h3>
                    <button @click="showAddSection = false" class="text-zinc-600 hover:text-zinc-300 transition-colors text-lg">&times;</button>
                </div>
                <form action="{{ route('admin.legal.sections.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Judul Section</label>
                        <input type="text" name="title" required
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors"
                            placeholder="cth: Pendahuluan">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">
                            Isi / Konten Section
                            <span class="normal-case text-zinc-600 font-normal ml-1">(Setiap baris kosong = paragraf baru)</span>
                        </label>
                        <textarea name="content" rows="8"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none resize-y transition-colors"
                            placeholder="Tuliskan isi konten section ini..."></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Urutan Tampil</label>
                        <input type="number" name="sort_order" min="0"
                            value="{{ $sections->max('sort_order') + 1 }}"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl transition-all">
                            Tambah Section
                        </button>
                        <button type="button" @click="showAddSection = false"
                            class="px-5 py-2.5 bg-zinc-900 border border-zinc-800 text-zinc-400 font-bold text-xs rounded-xl transition-all">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===== EDIT SECTION MODAL ===== --}}
        <div x-show="showEditSection"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
             x-cloak>
            <div @click.away="showEditSection = false"
                 class="bg-zinc-950 border border-zinc-800 rounded-3xl p-7 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-zinc-100 uppercase tracking-widest">✏️ Edit Section</h3>
                    <button @click="showEditSection = false" class="text-zinc-600 hover:text-zinc-300 transition-colors text-lg">&times;</button>
                </div>
                <form :action="'/admin/legal/sections/' + activeSection.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Judul Section</label>
                        <input type="text" name="title" x-model="activeSection.title" required
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">
                            Isi / Konten Section
                        </label>
                        <textarea name="content" x-ref="editContent" rows="10"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none resize-y transition-colors"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Urutan Tampil</label>
                            <input type="number" name="sort_order" x-model="activeSection.sort_order" min="0"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-1.5">Status</label>
                            <div class="flex items-center gap-3 h-12">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded"
                                        :checked="activeSection.is_active">
                                    <span class="text-xs text-zinc-300 font-semibold">Aktif (tampil di halaman publik)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl transition-all">
                            Simpan Perubahan
                        </button>
                        <button type="button" @click="showEditSection = false"
                            class="px-5 py-2.5 bg-zinc-900 border border-zinc-800 text-zinc-400 font-bold text-xs rounded-xl transition-all">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-layouts.admin>
