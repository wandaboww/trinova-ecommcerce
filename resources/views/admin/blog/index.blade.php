<x-layouts.admin :title="'Kelola Blog — CMS Admin'" :headerTitle="'Kelola Artikel Blog'">

    {{-- Quill Rich Text Editor Style --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border-color: #27272a !important;
            background-color: #18181b !important;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }
        .ql-container.ql-snow {
            border-color: #27272a !important;
            background-color: #09090b !important;
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            height: 280px !important;
            overflow-y: auto;
        }
        .ql-snow .ql-stroke {
            stroke: #a1a1aa !important;
        }
        .ql-snow .ql-fill {
            fill: #a1a1aa !important;
        }
        .ql-snow .ql-picker {
            color: #a1a1aa !important;
        }
        .ql-snow .ql-picker-options {
            background-color: #18181b !important;
            border-color: #27272a !important;
        }
        /* Selaraskan format editor dengan class prose blog publik */
        .ql-editor {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            color: #d4d4d8 !important; /* text-zinc-300 */
            font-size: 1rem !important; /* text-base */
            line-height: 1.75 !important; /* leading-relaxed */
            background-color: #09090b !important;
        }
        .ql-editor p {
            margin-bottom: 1.25rem !important;
        }
        .ql-editor h1, .ql-editor h2, .ql-editor h3 {
            color: #f4f4f5 !important;
            font-weight: 800 !important;
            margin-top: 1.5rem !important;
            margin-bottom: 0.75rem !important;
        }
        .ql-editor h1 { font-size: 1.875rem !important; }
        .ql-editor h2 { font-size: 1.5rem !important; }
        .ql-editor h3 { font-size: 1.25rem !important; }
        .ql-editor ul, .ql-editor ol {
            margin-bottom: 1.25rem !important;
            padding-left: 1.5rem !important;
        }
        .ql-editor ul {
            list-style-type: disc !important;
        }
        .ql-editor ol {
            list-style-type: decimal !important;
        }
    </style>

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

    <div x-data="{
        showAddModal: false,
        showCategoryModal: false,
        showEditModal: false,
        activeArticle: { id: '', title: '', status: 'draft', category_name: '', excerpt: '', content: '' },
        openEdit(data) {
            this.activeArticle = data;
            this.showEditModal = true;
            this.$nextTick(() => {
                this.$refs.editExcerpt.value = data.excerpt;
                if (window.editQuill) {
                    window.editQuill.root.innerHTML = data.content;
                    document.getElementById('edit-content-input').value = data.content;
                }
            });
        }
    }">

        {{-- Action Bar --}}
        <div class="flex items-center justify-between mb-6">
            <p class="text-xs text-zinc-500">Kelola artikel edukatif blog bisnis dan e-commerce Trinova Digital.</p>
            <div class="flex gap-3">
                <button @click="showCategoryModal = true" class="px-5 py-2.5 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 text-zinc-300 font-bold text-xs rounded-xl transition-all duration-200">
                    + Kategori Baru
                </button>
                <button @click="showAddModal = true" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 duration-200">
                    + Tulis Artikel Baru
                </button>
            </div>
        </div>

        {{-- Articles Table --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl overflow-hidden mb-10 shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-zinc-800 text-left">
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Judul Artikel</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @if($articles->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-zinc-500 text-xs">Belum ada artikel.</td>
                            </tr>
                        @endif

                        @foreach($articles as $article)
                        <tr class="hover:bg-zinc-900/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-zinc-200 max-w-sm">
                                <span class="line-clamp-2 leading-relaxed">{{ $article->title }}</span>
                            </td>
                            <td class="px-6 py-4 text-zinc-400 font-semibold">
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($article->status === 'published')
                                    <span class="px-2.5 py-1 bg-green-500/10 text-green-400 font-bold rounded-lg text-[10px]">Publish</span>
                                @else
                                    <span class="px-2.5 py-1 bg-yellow-500/10 text-yellow-400 font-bold rounded-lg text-[10px]">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button
                                        @click="openEdit({
                                            id: '{{ $article->id }}',
                                            title: {{ Js::from($article->title) }},
                                            status: {{ Js::from($article->status === 'published' ? 'publish' : 'draft') }},
                                            category_name: {{ Js::from($article->category->name ?? '') }},
                                            excerpt: {{ Js::from($article->excerpt) }},
                                            content: {{ Js::from($article->content) }}
                                        })"
                                        class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-zinc-300 hover:text-white rounded-lg transition-all text-[10px] font-bold">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.blog.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-zinc-900 border border-red-500/10 hover:border-red-500/40 text-red-400 rounded-lg transition-all text-[10px] font-bold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Write New Article Modal --}}
        <div x-show="showAddModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-cloak>
            <div @click.away="showAddModal = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="w-full max-w-4xl bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl overflow-y-auto max-h-[90vh]">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">✏️ Tulis Artikel Baru</h3>
                    <button @click="showAddModal = false" class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>
                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Judul Artikel</label>
                            <input type="text" name="title" placeholder="cth: 5 Kesalahan Fatal Seller Tokopedia..." required
                                   class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Kategori</label>
                            <select name="category_name" class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                                @if($categories->isEmpty())
                                    <option>E-Commerce</option>
                                    <option>Marketing</option>
                                    <option>Strategi Bisnis</option>
                                @else
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Status Publikasi</label>
                            <select name="status" class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                                <option value="draft">Draft</option>
                                <option value="publish">Publish</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Gambar Unggulan (Featured Image)</label>
                            <input type="file" name="featured_image" accept="image/*"
                                   class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Ringkasan Artikel</label>
                            <textarea name="excerpt" rows="2" placeholder="Ringkasan singkat artikel..." required
                                      class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none resize-none transition-colors"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Konten Artikel</label>
                            <input type="hidden" name="content" id="add-content-input" required>
                            <div id="add-editor-container"></div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2 border-t border-zinc-900">
                        <button type="button" @click="showAddModal = false" class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-7 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan Artikel</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Add Category Modal --}}
        <div x-show="showCategoryModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-cloak>
            <div @click.away="showCategoryModal = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="w-full max-w-md bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">+ Tambah Kategori Baru</h3>
                    <button @click="showCategoryModal = false" class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>
                <form action="{{ route('admin.blog.categories.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Nama Kategori</label>
                        <input type="text" name="name" placeholder="cth: Finansial" required
                               class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="showCategoryModal = false" class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Article Modal --}}
        <div x-show="showEditModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-cloak>
            <div @click.away="showEditModal = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="w-full max-w-4xl bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl overflow-y-auto max-h-[90vh]">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">✏️ Edit Artikel Blog</h3>
                    <button @click="showEditModal = false" class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>

                <form x-bind:action="'/admin/blog/' + activeArticle.id" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Judul Artikel</label>
                            <input type="text" name="title" x-model="activeArticle.title" required
                                   class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Kategori</label>
                            <select name="category_name" x-model="activeArticle.category_name" class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                                @if($categories->isEmpty())
                                    <option>E-Commerce</option>
                                    <option>Marketing</option>
                                    <option>Strategi Bisnis</option>
                                @else
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Status Publikasi</label>
                            <select name="status" x-model="activeArticle.status" class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                                <option value="draft">Draft</option>
                                <option value="publish">Publish</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Gambar Unggulan Baru (Featured Image)</label>
                            <input type="file" name="featured_image" accept="image/*"
                                   class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Ringkasan Artikel</label>
                            <textarea name="excerpt" rows="2"
                                      x-ref="editExcerpt"
                                      required
                                      class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none resize-none transition-colors"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Konten Artikel</label>
                            <input type="hidden" name="content" id="edit-content-input" required>
                            <div id="edit-editor-container"></div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2 border-t border-zinc-900">
                        <button type="button" @click="showEditModal = false" class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Quill Rich Text Editor Script --}}
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Add Editor
            const addQuill = new Quill('#add-editor-container', {
                theme: 'snow',
                placeholder: 'Tulis konten artikel di sini...'
            });
            addQuill.on('text-change', function() {
                document.getElementById('add-content-input').value = addQuill.root.innerHTML;
            });

            // Inisialisasi Edit Editor
            window.editQuill = new Quill('#edit-editor-container', {
                theme: 'snow',
                placeholder: 'Tulis konten artikel di sini...'
            });
            window.editQuill.on('text-change', function() {
                document.getElementById('edit-content-input').value = window.editQuill.root.innerHTML;
            });
        });
    </script>

</x-layouts.admin>
