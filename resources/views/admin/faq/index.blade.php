<x-layouts.admin :title="'Kelola FAQ — CMS Admin'" :headerTitle="'Kelola Pertanyaan Umum (FAQ)'">

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
        showEditModal: false,
        activeFaq: { id: '', question: '', answer: '', sort_order: '1' },
        openEdit(data) {
            this.activeFaq = data;
            this.showEditModal = true;
            this.$nextTick(() => {
                this.$refs.editAnswer.value = data.answer;
            });
        }
    }">

        {{-- Action Bar --}}
        <div class="flex items-center justify-between mb-6">
            <p class="text-xs text-zinc-500">Kelola daftar pertanyaan umum (FAQ) yang sering diajukan pelanggan.</p>
            <button @click="showAddModal = true" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 duration-200">
                + Tambah FAQ
            </button>
        </div>

        {{-- Existing FAQs List --}}
        <div class="space-y-4 max-w-4xl">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest mb-5">❓ Daftar FAQ Aktif</h3>

            @if($faqs->isEmpty())
                <div class="p-6 bg-zinc-900/40 border border-zinc-800 rounded-2xl text-center text-zinc-500 text-xs">
                    Belum ada FAQ. Klik tombol tambah di atas untuk membuat.
                </div>
            @endif

            @foreach($faqs as $faq)
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-5">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <p class="text-sm font-bold text-zinc-200 leading-snug">{{ $faq->question }}</p>
                    <div class="flex gap-2 shrink-0">
                        <button
                            @click="openEdit({
                                id: '{{ $faq->id }}',
                                question: {{ Js::from($faq->question) }},
                                answer: {{ Js::from($faq->answer) }},
                                sort_order: '{{ $faq->sort_order }}'
                            })"
                            class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-zinc-400 hover:text-white rounded-lg text-[10px] font-bold transition-all">
                            Edit
                        </button>
                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-zinc-900 border border-red-500/10 hover:border-red-500/40 text-red-400 rounded-lg text-[10px] font-bold transition-all">Hapus</button>
                        </form>
                    </div>
                </div>
                <p class="text-[11px] text-zinc-500 leading-relaxed">{{ $faq->answer }}</p>
                <div class="mt-3 text-[9px] text-zinc-600 font-semibold uppercase tracking-wider">Urutan: {{ $faq->sort_order }}</div>
            </div>
            @endforeach
        </div>

        {{-- Add FAQ Modal --}}
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
                 class="w-full max-w-lg bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">+ Tambah Pertanyaan Baru</h3>
                    <button @click="showAddModal = false" class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>
                <form action="{{ route('admin.faq.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Pertanyaan</label>
                        <input type="text" name="question" placeholder="cth: Berapa lama waktu pengerjaan website?" required
                               class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Jawaban</label>
                        <textarea name="answer" rows="5" placeholder="Tulis jawaban yang jelas dan informatif..." required
                                  class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none resize-none transition-colors"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Urutan Tampilan</label>
                        <input type="number" name="sort_order" value="1" min="1"
                               class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="showAddModal = false" class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan FAQ</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit FAQ Modal --}}
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
                 class="w-full max-w-lg bg-zinc-950 border border-zinc-900 rounded-3xl p-7 space-y-6 shadow-2xl">
                <div class="flex items-center justify-between border-b border-zinc-900 pb-4">
                    <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">✏️ Edit Pertanyaan FAQ</h3>
                    <button @click="showEditModal = false" class="text-zinc-500 hover:text-zinc-300 text-lg leading-none">✕</button>
                </div>

                <form
                    x-bind:action="'/admin/faq/' + activeFaq.id"
                    method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Pertanyaan</label>
                        <input type="text" name="question"
                               x-model="activeFaq.question"
                               required
                               class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Jawaban</label>
                        <textarea name="answer" rows="5" required
                                  x-ref="editAnswer"
                                  class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none resize-none transition-colors"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Urutan Tampilan</label>
                        <input type="number" name="sort_order"
                               x-model="activeFaq.sort_order"
                               min="1"
                               class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="showEditModal = false" class="px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-200 text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-layouts.admin>
