<x-layouts.admin :title="'CMS Dashboard — Trinova Digital'" :headerTitle="'Ringkasan Dashboard'">

    {{-- Main Light Canvas Wrapper --}}
    <div class="-m-8 p-6 sm:p-8 bg-slate-100/95 min-h-[calc(100vh-4rem)] text-slate-800 space-y-8">
        
        {{-- Welcome Card --}}
        <div class="bg-white border border-slate-200/80 p-8 sm:p-10 rounded-3xl relative overflow-hidden shadow-sm hover:shadow-md transition-shadow">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-50/60 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-sky-50/60 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 space-y-3">
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-indigo-50 border border-indigo-200/80 rounded-full text-[11px] font-bold text-indigo-700 uppercase tracking-wider flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        CMS Status: Active
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                    Selamat Datang Kembali, Administrator! 👋
                </h2>
                <p class="text-slate-600 text-sm max-w-xl leading-relaxed">
                    Di sini Anda dapat mengelola seluruh kebutuhan data marketing &amp; e-commerce landing page Trinova Digital secara instan, aman, dan visual.
                </p>
            </div>
        </div>

        {{-- Analytics Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Card 1: Leads --}}
            <div class="bg-white border border-slate-200/80 hover:border-indigo-300 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Leads (Audit)</span>
                        <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-200/60 text-amber-600 flex items-center justify-center font-bold text-sm">
                            📩
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        {{ $totalLeads }} <span class="text-xs font-semibold text-slate-400">Prospek</span>
                    </div>
                </div>
                <a href="{{ route('admin.leads.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-bold transition-colors mt-5 flex items-center justify-between pt-3 border-t border-slate-100">
                    <span>Lihat Semua Leads</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            {{-- Card 2: Program --}}
            <div class="bg-white border border-slate-200/80 hover:border-indigo-300 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Program Akselerasi</span>
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-200/60 text-indigo-600 flex items-center justify-center font-bold text-sm">
                            💼
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        {{ $totalPrograms }} <span class="text-xs font-semibold text-slate-400">Paket</span>
                    </div>
                </div>
                <a href="{{ route('admin.program.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-bold transition-colors mt-5 flex items-center justify-between pt-3 border-t border-slate-100">
                    <span>Kelola Program</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            {{-- Card 3: Articles --}}
            <div class="bg-white border border-slate-200/80 hover:border-indigo-300 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Artikel Blog</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-200/60 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            📝
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        {{ $totalArticles }} <span class="text-xs font-semibold text-slate-400">Publikasi</span>
                    </div>
                </div>
                <a href="{{ route('admin.blog.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-bold transition-colors mt-5 flex items-center justify-between pt-3 border-t border-slate-100">
                    <span>Tulis Artikel Baru</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            {{-- Card 4: FAQ --}}
            <div class="bg-white border border-slate-200/80 hover:border-indigo-300 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Pertanyaan FAQ</span>
                        <div class="w-9 h-9 rounded-xl bg-sky-50 border border-sky-200/60 text-sky-600 flex items-center justify-center font-bold text-sm">
                            ❓
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        {{ $totalFaqs }} <span class="text-xs font-semibold text-slate-400">Accordion</span>
                    </div>
                </div>
                <a href="{{ route('admin.faq.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-bold transition-colors mt-5 flex items-center justify-between pt-3 border-t border-slate-100">
                    <span>Kelola FAQ</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

        </div>

        {{-- Bottom Layout Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Recent Leads List (2 Columns Wide) --}}
            <div class="lg:col-span-2 bg-white border border-slate-200/80 p-6 sm:p-7 rounded-3xl shadow-sm space-y-6 flex flex-col justify-between">
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-base">📥</span>
                            <h3 class="font-extrabold text-slate-900 text-sm font-heading uppercase tracking-wider">Pengajuan Leads Terbaru</h3>
                        </div>
                        <span class="text-[11px] text-amber-700 bg-amber-50 border border-amber-200/80 px-3 py-1 rounded-full font-bold">
                            Memerlukan Follow-up CS
                        </span>
                    </div>

                    <div class="space-y-3">
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
                                    'new' => 'bg-amber-100/80 text-amber-800 border border-amber-200',
                                    'contacted' => 'bg-sky-100/80 text-sky-800 border border-sky-200',
                                    'meeting' => 'bg-purple-100/80 text-purple-800 border border-purple-200',
                                    'proposal' => 'bg-indigo-100/80 text-indigo-800 border border-indigo-200',
                                    'negotiation' => 'bg-orange-100/80 text-orange-800 border border-orange-200',
                                    'won' => 'bg-emerald-100/80 text-emerald-800 border border-emerald-200',
                                    'lost' => 'bg-rose-100/80 text-rose-800 border border-rose-200'
                                ];
                            @endphp
                            <a href="{{ route('admin.leads.show', $lead->id) }}" class="p-4 bg-slate-50/80 hover:bg-indigo-50/40 border border-slate-200/60 hover:border-indigo-200 rounded-2xl flex items-center justify-between gap-4 transition-all duration-150 group block shadow-2xs">
                                <div>
                                    <span class="text-xs font-bold text-slate-900 group-hover:text-indigo-900 block">{{ $lead->name }}</span>
                                    <span class="text-[11px] text-slate-500 mt-0.5 block">
                                        Brand: <strong class="text-slate-700 font-semibold">{{ $lead->company ?? '-' }}</strong> | WhatsApp: <span class="font-mono text-slate-700">{{ $lead->phone }}</span>
                                    </span>
                                </div>
                                <span class="px-3 py-1 text-[11px] font-bold rounded-full {{ $statusClasses[$lead->status] ?? 'bg-slate-200 text-slate-700' }}">
                                    {{ $statusLabels[$lead->status] ?? $lead->status }}
                                </span>
                            </a>
                        @empty
                            <div class="p-8 text-center text-slate-500 text-xs bg-slate-50 border border-slate-200/60 rounded-2xl">
                                Belum ada prospek/leads yang terdaftar.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Quick Links Sidebar --}}
            <div class="bg-white border border-slate-200/80 p-6 sm:p-7 rounded-3xl space-y-6 shadow-sm">
                <div class="border-b border-slate-100 pb-4 flex items-center gap-2">
                    <span class="text-base">⚡</span>
                    <h3 class="font-extrabold text-slate-900 text-sm font-heading uppercase tracking-wider">Aksi Pintas</h3>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.landing.index') }}" class="w-full py-3.5 px-4 bg-slate-50/80 hover:bg-indigo-50/60 border border-slate-200/80 hover:border-indigo-200 text-slate-700 hover:text-indigo-950 rounded-2xl text-xs font-bold flex items-center justify-between transition-all group">
                        <span>Ubah Judul Hero Landing</span>
                        <span class="group-hover:translate-x-1 transition-transform text-indigo-600">➔</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="w-full py-3.5 px-4 bg-slate-50/80 hover:bg-indigo-50/60 border border-slate-200/80 hover:border-indigo-200 text-slate-700 hover:text-indigo-950 rounded-2xl text-xs font-bold flex items-center justify-between transition-all group">
                        <span>Ganti Link WhatsApp CS</span>
                        <span class="group-hover:translate-x-1 transition-transform text-indigo-600">➔</span>
                    </a>
                    <a href="{{ route('admin.testimonial.index') }}" class="w-full py-3.5 px-4 bg-slate-50/80 hover:bg-indigo-50/60 border border-slate-200/80 hover:border-indigo-200 text-slate-700 hover:text-indigo-950 rounded-2xl text-xs font-bold flex items-center justify-between transition-all group">
                        <span>Tambah Testimoni Bintang 5</span>
                        <span class="group-hover:translate-x-1 transition-transform text-indigo-600">➔</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

</x-layouts.admin>

