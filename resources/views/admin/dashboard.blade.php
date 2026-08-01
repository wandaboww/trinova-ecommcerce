<x-layouts.admin :title="'CMS Dashboard — Trinova Digital'" :headerTitle="'Ringkasan Dashboard'">

    {{-- Welcome Card --}}
    <div class="bg-zinc-950 border border-zinc-900 p-8 sm:p-10 rounded-3xl relative overflow-hidden mb-8 shadow-xl">
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.003)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.003)_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>
        <div class="relative z-10 space-y-3">
            <span class="px-2.5 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-[10px] font-bold text-indigo-400 uppercase tracking-widest">
                CMS Status: Active
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-100 font-heading">
                Selamat Datang kembali, Administrator!
            </h2>
            <p class="text-zinc-400 text-sm max-w-xl leading-relaxed">
                Di sini Anda dapat mengelola seluruh kebutuhan data marketing &amp; e-commerce landing page Trinova Digital secara instan dan visual.
            </p>
        </div>
    </div>

    {{-- Analytics Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        {{-- Card 1: Leads --}}
        <div class="bg-zinc-950 border border-zinc-900 p-6 rounded-2xl flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 block mb-2">Total Leads (Audit)</span>
                <span class="text-3xl font-extrabold text-zinc-100 font-heading">{{ $totalLeads }} Prospek</span>
            </div>
            <a href="{{ route('admin.leads.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 font-semibold transition-colors mt-4 block">
                Lihat Semua Leads →
            </a>
        </div>

        {{-- Card 2: Program --}}
        <div class="bg-zinc-950 border border-zinc-900 p-6 rounded-2xl flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 block mb-2">Program Akselerasi</span>
                <span class="text-3xl font-extrabold text-zinc-100 font-heading">{{ $totalPrograms }} Paket</span>
            </div>
            <a href="{{ route('admin.program.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 font-semibold transition-colors mt-4 block">
                Kelola Program →
            </a>
        </div>

        {{-- Card 3: Articles --}}
        <div class="bg-zinc-950 border border-zinc-900 p-6 rounded-2xl flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 block mb-2">Artikel Blog</span>
                <span class="text-3xl font-extrabold text-zinc-100 font-heading">{{ $totalArticles }} Publikasi</span>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 font-semibold transition-colors mt-4 block">
                Tulis Artikel Baru →
            </a>
        </div>

        {{-- Card 4: FAQ --}}
        <div class="bg-zinc-950 border border-zinc-900 p-6 rounded-2xl flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 block mb-2">Pertanyaan FAQ</span>
                <span class="text-3xl font-extrabold text-zinc-100 font-heading">{{ $totalFaqs }} Accordion</span>
            </div>
            <a href="{{ route('admin.faq.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 font-semibold transition-colors mt-4 block">
                Kelola FAQ →
            </a>
        </div>

    </div>

    {{-- Bottom Layout Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Recent Leads List (2 Columns Wide) --}}
        <div class="lg:col-span-2 bg-zinc-950 border border-zinc-900 p-6 rounded-2xl space-y-6 shadow-lg flex flex-col justify-between">
            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-zinc-800/80 pb-4">
                    <h3 class="font-bold text-zinc-200 text-sm font-heading uppercase tracking-wider">Pengajuan Leads Terbaru</h3>
                    <span class="text-[10px] text-zinc-500 font-semibold">Memerlukan Konfirmasi CS</span>
                </div>

                <div class="space-y-4">
                    @forelse($recentLeads as $lead)
                        @php
                            $statusLabels = [
                                'new' => 'Baru',
                                'contacted' => 'Dihubungi',
                                'meeting' => 'Meeting',
                                'proposal' => 'Proposal',
                                'negotiation' => 'Negosiasi',
                                'won' => 'Won',
                                'lost' => 'Lost'
                            ];
                            $statusClasses = [
                                'new' => 'bg-yellow-500/10 text-yellow-500',
                                'contacted' => 'bg-blue-500/10 text-blue-500',
                                'meeting' => 'bg-purple-500/10 text-purple-500',
                                'proposal' => 'bg-indigo-500/10 text-indigo-400',
                                'negotiation' => 'bg-amber-500/10 text-amber-500',
                                'won' => 'bg-green-500/10 text-green-500',
                                'lost' => 'bg-red-500/10 text-red-500'
                            ];
                        @endphp
                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="p-4 bg-zinc-900/40 border border-zinc-800/50 hover:border-indigo-500/30 rounded-xl flex items-center justify-between gap-4 transition-all block">
                            <div>
                                <span class="text-xs font-bold text-zinc-200 block">{{ $lead->name }}</span>
                                <span class="text-[10px] text-zinc-500 mt-0.5 block">
                                    Brand: {{ $lead->company ?? '-' }} | WhatsApp: {{ $lead->phone }}
                                </span>
                            </div>
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full {{ $statusClasses[$lead->status] ?? 'bg-zinc-800 text-zinc-400' }}">
                                {{ $statusLabels[$lead->status] ?? $lead->status }}
                            </span>
                        </a>
                    @empty
                        <div class="p-8 text-center text-zinc-500 text-xs bg-zinc-900/20 border border-zinc-850 rounded-xl">
                            Belum ada prospek/leads yang terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Quick Links Sidebar --}}
        <div class="bg-zinc-950 border border-zinc-900 p-6 rounded-2xl space-y-6 shadow-lg">
            <div class="border-b border-zinc-800/80 pb-4">
                <h3 class="font-bold text-zinc-200 text-sm font-heading uppercase tracking-wider">Aksi Pintas</h3>
            </div>
            
            <div class="space-y-3">
                <a href="{{ route('admin.landing.index') }}" class="w-full py-3 px-4 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/30 text-zinc-300 hover:text-white rounded-xl text-xs font-semibold flex items-center justify-between transition-all">
                    <span>Ubah Judul Hero Landing</span>
                    <span>➔</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="w-full py-3 px-4 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/30 text-zinc-300 hover:text-white rounded-xl text-xs font-semibold flex items-center justify-between transition-all">
                    <span>Ganti Link WhatsApp CS</span>
                    <span>➔</span>
                </a>
                <a href="{{ route('admin.testimonial.index') }}" class="w-full py-3 px-4 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/30 text-zinc-300 hover:text-white rounded-xl text-xs font-semibold flex items-center justify-between transition-all">
                    <span>Tambah Testimoni Bintang 5</span>
                    <span>➔</span>
                </a>
            </div>
        </div>

    </div>

</x-layouts.admin>
