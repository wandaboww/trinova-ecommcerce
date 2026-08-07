<x-layouts.admin :title="'Detail Lead — CMS Admin'" :headerTitle="'Detail Pengajuan Analisa Bisnis'">

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center gap-2 text-xs text-zinc-500 hover:text-zinc-300 font-semibold transition-colors">
            ← Kembali ke Semua Leads
        </a>
    </div>

    <div x-data="{ isEditing: false }" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Lead Detail --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
                <div class="flex items-start justify-between border-b border-zinc-800 pb-5">
                    <div>
                        <h2 class="text-xl font-extrabold text-zinc-100 font-heading">Detail Lead</h2>
                        <p class="text-xs text-zinc-500 mt-1">Data pengajuan analisa bisnis gratis dari calon klien</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button @click="isEditing = !isEditing" type="button" class="px-3 py-1.5 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 text-indigo-400 text-xs font-bold rounded-lg transition-all flex items-center gap-1.5">
                            <span x-text="isEditing ? '✖ Batal Edit' : '✏️ Edit Data'"></span>
                        </button>
                        @php
                            $statusColors = [
                                'new' => 'bg-amber-500/10 text-amber-400',
                                'contacted' => 'bg-sky-500/10 text-sky-400',
                                'meeting' => 'bg-purple-500/10 text-purple-400',
                                'proposal' => 'bg-indigo-500/10 text-indigo-400',
                                'negotiation' => 'bg-orange-500/10 text-orange-400',
                                'won' => 'bg-emerald-500/10 text-emerald-400',
                                'lost' => 'bg-rose-500/10 text-rose-400'
                            ];
                            $colorClass = $statusColors[$lead->status] ?? 'bg-zinc-500/10 text-zinc-400';
                        @endphp
                        <span class="px-3 py-1 text-[10px] font-bold rounded-full uppercase tracking-widest {{ $colorClass }}">{{ $lead->status_label }}</span>
                    </div>
                </div>

                {{-- Display Mode --}}
                <div x-show="!isEditing" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Nama Pemilik Bisnis</span>
                        <span class="text-sm font-semibold text-zinc-200">{{ $lead->name }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Nama Brand / Bisnis</span>
                        <span class="text-sm font-semibold text-zinc-200">{{ $lead->company ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Nomor WhatsApp</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}" target="_blank" class="text-sm font-semibold text-green-400 hover:text-green-300 transition-colors">📞 {{ $lead->phone }}</a>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Email</span>
                        <span class="text-sm font-semibold text-zinc-200">{{ $lead->email ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Omzet Bulanan Saat Ini</span>
                        <span class="text-sm font-semibold text-zinc-200">{{ $lead->monthly_revenue ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Tanggal Pengajuan</span>
                        <span class="text-sm font-semibold text-zinc-200">{{ $lead->created_at ? $lead->created_at->format('d F Y, H:i \W\I\B') : '-' }}</span>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Masalah Bisnis Utama</span>
                        <p class="text-sm text-zinc-300 leading-relaxed bg-zinc-900/40 rounded-xl p-4 border border-zinc-800 whitespace-pre-line">
                            {{ $lead->message ?? 'Tidak ada masalah bisnis utama yang diinputkan.' }}
                        </p>
                    </div>
                </div>

                {{-- Edit Mode Form --}}
                <form x-show="isEditing" x-cloak method="POST" action="{{ route('admin.leads.update', $lead->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-1.5">Nama Pemilik Bisnis <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $lead->name) }}" required
                                   class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-800 focus:border-indigo-500 rounded-xl text-sm text-zinc-100 focus:outline-none transition-colors">
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-1.5">Nama Brand / Bisnis</label>
                            <input type="text" name="company" value="{{ old('company', $lead->company) }}"
                                   class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-800 focus:border-indigo-500 rounded-xl text-sm text-zinc-100 focus:outline-none transition-colors">
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-1.5">Nomor WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $lead->phone) }}" required
                                   class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-800 focus:border-indigo-500 rounded-xl text-sm text-zinc-100 focus:outline-none transition-colors">
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email', $lead->email) }}"
                                   class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-800 focus:border-indigo-500 rounded-xl text-sm text-zinc-100 focus:outline-none transition-colors">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-1.5">Omzet Bulanan Saat Ini (Dropdown)</label>
                            <select name="monthly_revenue"
                                    class="w-full px-4 py-2.5 bg-zinc-900 border border-zinc-800 focus:border-indigo-500 rounded-xl text-sm text-zinc-100 focus:outline-none transition-colors">
                                <option value="">Pilih Omzet</option>
                                @php
                                    $revenueOptions = [
                                        '< Rp 10 Juta' => 'Di bawah Rp 10 Juta',
                                        'Rp 10 - 50 Juta' => 'Rp 10 Juta - Rp 50 Juta',
                                        'Rp 50 - 100 Juta' => 'Rp 50 Juta - Rp 100 Juta',
                                        'Rp 100 - 500 Juta' => 'Rp 100 Juta - Rp 500 Juta',
                                        '> Rp 500 Juta' => 'Di atas Rp 500 Juta',
                                    ];
                                @endphp
                                @foreach($revenueOptions as $val => $lbl)
                                    <option value="{{ $val }}" {{ old('monthly_revenue', $lead->monthly_revenue) === $val ? 'selected' : '' }}>
                                        {{ $lbl }} ({{ $val }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <button type="button" @click="isEditing = false" class="px-4 py-2 bg-zinc-900 hover:bg-zinc-800 text-zinc-300 text-xs font-bold rounded-xl transition-all">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl transition-all shadow-md">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Action Sidebar --}}
        <div class="space-y-5">
            {{-- Quick Actions --}}
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-6 space-y-4">
                <h3 class="text-sm font-bold text-zinc-200 border-b border-zinc-800 pb-3 uppercase tracking-wider">Aksi Cepat</h3>
                <button type="button" @click="isEditing = !isEditing" class="w-full py-3 bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 text-indigo-400 font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-2">
                    ✏️ <span x-text="isEditing ? 'Batal Edit Data' : 'Edit Data Lead'"></span>
                </button>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}?text={{ urlencode('Halo ' . $lead->name . ' dari Trinova Digital...') }}"
                   target="_blank"
                   class="w-full py-3 bg-green-600/20 hover:bg-green-600/30 border border-green-500/30 hover:border-green-500/50 text-green-400 font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-2">
                    📞 Hubungi via WhatsApp
                </a>
                <form method="POST" action="{{ route('admin.leads.destroy', $lead->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data lead ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 bg-zinc-900 hover:bg-red-500/10 border border-zinc-800 hover:border-red-500/30 text-red-400 font-bold text-xs rounded-xl transition-all">
                        🗑️ Hapus Data Lead
                    </button>
                </form>
            </div>

            {{-- Status Update --}}
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-6 space-y-4">
                <h3 class="text-sm font-bold text-zinc-200 border-b border-zinc-800 pb-3 uppercase tracking-wider">Update Status</h3>
                <form method="POST" action="{{ route('admin.leads.status', $lead->id) }}" class="space-y-4">
                    @csrf @method('PUT')
                    <select name="status" class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        @foreach(App\Models\Lead::statuses() as $value => $label)
                            <option value="{{ $value }}" {{ $lead->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl transition-all">
                        💾 Simpan Status
                    </button>
                </form>
            </div>
        </div>

    </div>

</x-layouts.admin>
