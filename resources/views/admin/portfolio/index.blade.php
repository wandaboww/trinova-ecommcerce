<x-layouts.admin :title="'Kelola Portfolio — CMS Admin'" :headerTitle="'Kelola Studi Kasus Portfolio Klien'">

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
        activePortfolio: { id: '', client_name: '', category: '', problem: '', result: '' },
        openEdit(data) {
            this.activePortfolio = data;
            this.showEditModal = true;
            this.$nextTick(() => {
                this.$refs.editProblem.value = data.problem;
                this.$refs.editResult.value = data.result;
            });
        }
    }">

        <div class="flex items-center justify-between mb-6">
            <p class="text-xs text-zinc-500">Kelola studi kasus keberhasilan klien yang ditampilkan di section Portfolio.</p>
            <button @click="showAddModal = true" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow transition-all hover:-translate-y-0.5 duration-200">
                + Tambah Studi Kasus
            </button>
        </div>

        {{-- Portfolio Table --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl overflow-hidden mb-10 shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-zinc-800 text-left">
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Nama Klien / Brand</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Hasil / ROI</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @if($portfolios->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-zinc-500 text-xs">Belum ada data portfolio.</td>
                            </tr>
                        @endif

                        @foreach($portfolios as $p)
                        <tr class="hover:bg-zinc-900/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-zinc-200">{{ $p->client_name }}</td>
                            <td class="px-6 py-4 text-zinc-400">{{ $p->industry }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-green-500/10 text-green-400 font-bold rounded-lg">{{ $p->result }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button
                                        @click="openEdit({
                                            id: '{{ $p->id }}',
                                            client_name: {{ Js::from($p->client_name) }},
                                            category: {{ Js::from($p->industry) }},
                                            problem: {{ Js::from($p->problem) }},
                                            result: {{ Js::from($p->result) }}
                                        })"
                                        class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-zinc-300 hover:text-white rounded-lg transition-all text-[10px] font-bold">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.portfolio.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portfolio ini?')">
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

        {{-- Add Portfolio Modal --}}
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
                 class="w-full max-w-2xl bg-gray-800 border border-gray-700 rounded-3xl shadow-2xl">
                {{-- Blue Header --}}
                <div class="flex items-center justify-between bg-blue-700 px-7 py-5 rounded-t-3xl">
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest">+ Tambah Studi Kasus Baru</h3>
                    <button @click="showAddModal = false" class="text-blue-200 hover:text-white text-xl leading-none transition-colors">✕</button>
                </div>
                <div class="px-7 pb-7 pt-6 space-y-5">
                <form action="{{ route('admin.portfolio.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Nama Klien / Brand</label>
                            <input type="text" name="client_name" placeholder="cth: Hijab Brand A" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Kategori Bisnis</label>
                            <input type="text" name="category" placeholder="cth: Fashion Muslim" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Masalah Awal Klien</label>
                            <textarea name="problem" rows="2" placeholder="Apa masalah bisnis klien sebelum bergabung..." required
                                      class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none resize-none transition-colors"></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Hasil / ROI yang Dicapai</label>
                            <textarea name="result" rows="2" placeholder="cth: Omzet Rp18jt → Rp85jt/bulan" required
                                      class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm placeholder-gray-500 focus:outline-none resize-none transition-colors"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2 border-t border-gray-700">
                        <button type="button" @click="showAddModal = false" class="px-5 py-3 bg-gray-700 border border-gray-600 hover:bg-gray-600 text-gray-300 hover:text-white text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-7 py-3 bg-blue-700 hover:bg-blue-600 text-white font-bold text-xs rounded-xl shadow transition-all">Simpan Studi Kasus</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        {{-- Edit Portfolio Modal --}}
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
                 class="w-full max-w-2xl bg-gray-800 border border-gray-700 rounded-3xl shadow-2xl">
                {{-- Blue Header --}}
                <div class="flex items-center justify-between bg-blue-700 px-7 py-5 rounded-t-3xl">
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest">✏️ Edit Studi Kasus</h3>
                    <button @click="showEditModal = false" class="text-blue-200 hover:text-white text-xl leading-none transition-colors">✕</button>
                </div>
                <div class="px-7 pb-7 pt-6 space-y-5">
                <form x-bind:action="'/admin/portfolio/' + activePortfolio.id" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Nama Klien / Brand</label>
                            <input type="text" name="client_name" x-model="activePortfolio.client_name" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Kategori Bisnis</label>
                            <input type="text" name="category" x-model="activePortfolio.category" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none transition-colors">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Masalah Awal Klien</label>
                            <textarea name="problem" rows="3"
                                      x-ref="editProblem"
                                      required
                                      class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none resize-none transition-colors"></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-2">Hasil / ROI yang Dicapai</label>
                            <textarea name="result" rows="3"
                                      x-ref="editResult"
                                      required
                                      class="w-full px-4 py-3 bg-gray-700 border border-gray-600 focus:border-blue-400 rounded-xl text-gray-100 text-sm focus:outline-none resize-none transition-colors"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2 border-t border-gray-700">
                        <button type="button" @click="showEditModal = false" class="px-5 py-3 bg-gray-700 border border-gray-600 hover:bg-gray-600 text-gray-300 hover:text-white text-xs font-bold rounded-xl transition-all">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-blue-700 hover:bg-blue-600 text-white text-xs font-bold rounded-xl shadow transition-all">Simpan Perubahan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>

</x-layouts.admin>
