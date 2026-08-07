<x-layouts.app :seo="[
        'title' => $program->title . ' — Detail Layanan & Spesifikasi Trinova Digital',
        'description' => $program->short_description,
        'canonical' => route('program.show', $program->slug),
    ]">

@php
    $topics = $program->effective_topics;
    $initialTab = $topics[0]['key'] ?? 'overview';
@endphp

    <section class="pt-28 pb-24 relative overflow-hidden" aria-label="Detail Program {{ $program->title }}"
             x-data="{ activeTab: '{{ $initialTab }}', tabOpen: false, programOpen: false }">

        {{-- Background Ambient Lights --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.15),transparent)] pointer-events-none"></div>
        <div class="absolute top-1/4 left-10 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">

            {{-- Top Navigation & Program Switcher Header --}}
            <div class="relative z-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10 pb-6 border-b border-white/5" data-reveal>
                
                {{-- Back Link --}}
                <a href="{{ route('home') }}#program"
                   class="inline-flex items-center gap-2 text-zinc-400 hover:text-zinc-100 text-xs sm:text-sm font-semibold transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" 
                         class="w-4 h-4 text-indigo-400 group-hover:-translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12l7.5-7.5" />
                    </svg>
                    <span>Kembali ke Halaman Utama</span>
                </a>

                {{-- Program Switcher Dropdown --}}
                @if(isset($allPrograms) && count($allPrograms) > 0)
                    <div class="relative inline-block text-left" @click.away="programOpen = false">
                        <button @click="programOpen = !programOpen"
                                type="button"
                                class="inline-flex items-center gap-3 px-4 py-2.5 bg-zinc-950/90 border border-white/10 hover:border-indigo-500/40 rounded-xl text-xs font-bold text-zinc-200 transition-all shadow-lg hover:shadow-indigo-500/10">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Pilih Paket: <strong class="text-indigo-400 font-heading uppercase">{{ $program->title }}</strong></span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 class="w-4 h-4 text-zinc-400 transition-transform duration-200" :class="programOpen ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="programOpen"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                             class="absolute right-0 mt-2 w-56 bg-zinc-950 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-50 p-1.5"
                             x-cloak>
                            @foreach($allPrograms as $p)
                                <a href="{{ route('program.show', $p->slug) }}"
                                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all {{ $p->slug === $program->slug ? 'bg-indigo-600/20 text-indigo-300 font-bold border border-indigo-500/30' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                                    <span>{{ $p->title }}</span>
                                    @if($p->slug === $program->slug)
                                        <span class="text-indigo-400 text-[10px]">Aktif</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Main Header Card Overview --}}
            <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-12 rounded-3xl mb-10 shadow-2xl relative overflow-hidden backdrop-blur-md" data-reveal>
                <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="px-3.5 py-1 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-extrabold rounded-full uppercase tracking-wider">
                        🎯 Target: {{ $program->target_market }}
                    </span>
                    @if($program->is_best_value ?? ($program->slug === 'grow'))
                        <span class="px-3 py-1 bg-gradient-to-r from-amber-400 to-amber-500 text-zinc-950 text-[10px] font-black rounded-full uppercase tracking-widest shadow-md shadow-amber-500/20">
                            Recommended
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-5xl font-black text-zinc-100 font-heading mb-4 tracking-tight">
                    {{ $program->title }}
                </h1>

                <p class="text-zinc-300 text-base sm:text-lg leading-relaxed max-w-3xl mb-8 font-medium">
                    {{ $program->short_description }}
                </p>

                {{-- Key Metric Highlights --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-white/5">
                    <div class="p-3.5 bg-zinc-900/40 border border-white/5 rounded-2xl">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1">Garansi Sistem</span>
                        <span class="text-xs font-extrabold text-zinc-200 font-heading">100% Turnkey Ready</span>
                    </div>
                    <div class="p-3.5 bg-zinc-900/40 border border-white/5 rounded-2xl">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1">Kecepatan Muat</span>
                        <span class="text-xs font-extrabold text-indigo-400 font-heading">&lt; 1.5 Detik</span>
                    </div>
                    <div class="p-3.5 bg-zinc-900/40 border border-white/5 rounded-2xl">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1">Dukungan Support</span>
                        <span class="text-xs font-extrabold text-emerald-400 font-heading">Tim Dedicated CS</span>
                    </div>
                    <div class="p-3.5 bg-zinc-900/40 border border-white/5 rounded-2xl">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1">Status Lisensi</span>
                        <span class="text-xs font-extrabold text-amber-400 font-heading">Full Mandiri (100% Hak Milik)</span>
                    </div>
                </div>
            </div>

            {{-- Compact Dropdown Section Tab Navigation --}}
            <div class="relative z-40 mb-8" data-reveal data-delay="100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-zinc-950/90 border border-white/10 rounded-2xl backdrop-blur-md shadow-xl">
                    
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Navigasi Topik Detail:</span>
                    </div>

                    {{-- Dropdown Tab Selector --}}
                    <div class="relative w-full md:w-80" @click.away="tabOpen = false">
                        <button @click="tabOpen = !tabOpen"
                                type="button"
                                class="w-full flex items-center justify-between px-4 py-3 bg-zinc-900 border border-white/10 hover:border-indigo-500/50 rounded-xl text-xs font-bold text-zinc-100 transition-all shadow-md">
                            <div class="flex items-center gap-2.5 truncate">
                                @foreach($topics as $t)
                                    <span x-show="activeTab === '{{ $t['key'] }}'" class="text-indigo-400 {{ $t['custom_class'] ?? '' }}" x-cloak>
                                        {{ $t['icon'] ?? '📌' }} {{ $t['title'] }}
                                    </span>
                                @endforeach
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                 class="w-4 h-4 text-zinc-400 transition-transform duration-200 shrink-0 ml-2" :class="tabOpen ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="tabOpen"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                             class="absolute left-0 right-0 mt-2 bg-zinc-950 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-50 p-2 space-y-1"
                             x-cloak>
                            
                            @foreach($topics as $t)
                                <button @click="activeTab = '{{ $t['key'] }}'; tabOpen = false"
                                        type="button"
                                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-left transition-all {{ $t['custom_class'] ?? '' }}"
                                        :class="activeTab === '{{ $t['key'] }}' ? 'bg-indigo-600/20 text-indigo-300 font-bold border border-indigo-500/30' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60'">
                                    <span class="text-sm">{{ $t['icon'] ?? '📌' }}</span>
                                    <div>
                                        <div class="font-bold text-zinc-200">{{ $t['title'] }}</div>
                                        @if(!empty($t['subtitle']))
                                            <div class="text-[10px] text-zinc-500 font-normal">{{ $t['subtitle'] }}</div>
                                        @endif
                                    </div>
                                </button>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>

            {{-- TAB CONTENT AREA --}}

            {{-- TAB 1: GAMBARAN UMUM & BENEFIT --}}
            <div x-show="activeTab === 'overview'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                
                {{-- Benefit Platform Dynamic Outcome Card --}}
                @if(!empty($program->outcome))
                    <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-10 rounded-3xl shadow-xl space-y-6">
                        <div class="flex items-center justify-between border-b border-white/5 pb-4">
                            <h3 class="text-xl font-extrabold text-zinc-100 font-heading flex items-center gap-2">
                                <span>✨</span> Benefit Platform &amp; Hasil Eksekusi
                            </h3>
                            <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full uppercase tracking-wider">
                                Checklist Output
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if(is_array($program->outcome))
                                @foreach($program->outcome as $item)
                                    <div class="p-4 bg-zinc-900/40 border border-white/5 rounded-2xl flex items-start gap-3.5 hover:border-indigo-500/20 transition-all {{ $item['custom_class'] ?? '' }}">
                                        @if(($item['icon'] ?? 'check') === 'check')
                                            <div class="w-6 h-6 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                                ✓
                                            </div>
                                            <div>
                                                <span class="text-xs font-bold text-zinc-200 block leading-snug">{{ $item['text'] ?? '' }}</span>
                                                <span class="text-[10px] text-emerald-400/80 font-medium">Fitur Terintegrasi Penuh</span>
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full bg-red-500/10 border border-red-500/20 text-red-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                                ✗
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold text-zinc-400 block leading-snug">{{ $item['text'] ?? '' }}</span>
                                                <span class="text-[10px] text-red-400/80 font-medium">Tersedia pada Paket Lebih Tinggi</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="p-4 bg-zinc-900/40 border border-white/5 rounded-2xl flex items-start gap-3.5">
                                    <div class="w-6 h-6 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                        ✓
                                    </div>
                                    <span class="text-xs font-bold text-zinc-200 leading-relaxed">{{ $program->outcome }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Detail Narrative Card --}}
                <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-10 rounded-3xl space-y-6 shadow-xl">
                    <h3 class="text-xl font-extrabold text-zinc-100 font-heading flex items-center gap-2">
                        <span>📖</span> Penjelasan Detail Program
                    </h3>
                    <p class="text-zinc-300 text-sm sm:text-base leading-relaxed font-normal whitespace-pre-line">
                        {{ $program->description }}
                    </p>
                </div>

            </div>

            {{-- TAB 2: FITUR & ARSITEKTUR PLATFORM --}}
            <div x-show="activeTab === 'features'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6" x-cloak>
                <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-10 rounded-3xl shadow-xl space-y-6">
                    <div class="border-b border-white/5 pb-4">
                        <h3 class="text-xl font-extrabold text-zinc-100 font-heading flex items-center gap-2">
                            <span>⚡</span> Fitur Utama &amp; Arsitektur Platform
                        </h3>
                        <p class="text-xs text-zinc-400 mt-1">Daftar spesifikasi teknologi dan modul fungsional yang akan dibangun pada paket {{ $program->title }}.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(isset($program->features) && count($program->features) > 0)
                            @foreach($program->features as $idx => $feature)
                                <div class="p-6 bg-zinc-900/40 border border-white/5 rounded-2xl hover:border-indigo-500/30 transition-all duration-200 flex flex-col justify-between group">
                                    <div>
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-xs">
                                                0{{ $idx + 1 }}
                                            </div>
                                            <span class="text-[9px] font-bold text-zinc-500 uppercase tracking-widest bg-zinc-900 px-2.5 py-1 rounded-full border border-white/5">Modul Aktif</span>
                                        </div>
                                        <h4 class="font-extrabold text-zinc-100 text-base font-heading mb-2 group-hover:text-indigo-300 transition-colors">
                                            {{ $feature->title }}
                                        </h4>
                                        <p class="text-zinc-400 text-xs leading-relaxed font-normal">
                                            {{ $feature->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-full p-8 text-center text-zinc-500 text-xs bg-zinc-900/20 border border-white/5 rounded-2xl">
                                Belum ada rincian fitur tambahan yang dimasukkan ke dalam paket ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- TAB 3: ALUR KERJA & ROADMAP --}}
            <div x-show="activeTab === 'workflow'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6" x-cloak>
                <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-10 rounded-3xl shadow-xl space-y-8">
                    <div class="border-b border-white/5 pb-4">
                        <h3 class="text-xl font-extrabold text-zinc-100 font-heading flex items-center gap-2">
                            <span>🚀</span> Roadmap Eksekusi &amp; Tahapan Pengerjaan
                        </h3>
                        <p class="text-xs text-zinc-400 mt-1">Alur sistematis dari analisis awal hingga website/sistem Anda siap beroperasi secara profesional.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        
                        <div class="p-5 bg-zinc-900/40 border border-white/5 rounded-2xl relative overflow-hidden">
                            <div class="text-3xl font-black text-indigo-500/20 font-heading mb-3">01</div>
                            <h4 class="font-bold text-zinc-100 text-sm mb-1.5">Fase Audit &amp; Blueprint</h4>
                            <p class="text-zinc-400 text-xs leading-relaxed">Diskusi mendalam menentukan kebutuhan produk, alur checkout, dan pemetaan penawaran brand Anda.</p>
                            <span class="inline-block mt-4 text-[9px] font-bold text-indigo-400 bg-indigo-500/10 px-2.5 py-0.5 rounded-full">Hari 1 - 3</span>
                        </div>

                        <div class="p-5 bg-zinc-900/40 border border-white/5 rounded-2xl relative overflow-hidden">
                            <div class="text-3xl font-black text-indigo-500/20 font-heading mb-3">02</div>
                            <h4 class="font-bold text-zinc-100 text-sm mb-1.5">Fase Desain &amp; System Dev</h4>
                            <p class="text-zinc-400 text-xs leading-relaxed">Coding infrastruktur, styling tampilan UI/UX modern, serta penulisan copy konversi tinggi.</p>
                            <span class="inline-block mt-4 text-[9px] font-bold text-indigo-400 bg-indigo-500/10 px-2.5 py-0.5 rounded-full">Hari 4 - 9</span>
                        </div>

                        <div class="p-5 bg-zinc-900/40 border border-white/5 rounded-2xl relative overflow-hidden">
                            <div class="text-3xl font-black text-indigo-500/20 font-heading mb-3">03</div>
                            <h4 class="font-bold text-zinc-100 text-sm mb-1.5">Fase Integrasi &amp; QA Test</h4>
                            <p class="text-zinc-400 text-xs leading-relaxed">Pemasangan Payment Gateway, pengujian alur pesanan WhatsApp, dan optimasi kecepatan server.</p>
                            <span class="inline-block mt-4 text-[9px] font-bold text-indigo-400 bg-indigo-500/10 px-2.5 py-0.5 rounded-full">Hari 10 - 12</span>
                        </div>

                        <div class="p-5 bg-zinc-900/40 border border-white/5 rounded-2xl relative overflow-hidden">
                            <div class="text-3xl font-black text-emerald-500/20 font-heading mb-3">04</div>
                            <h4 class="font-bold text-zinc-100 text-sm mb-1.5">Fase Launching &amp; Handover</h4>
                            <p class="text-zinc-400 text-xs leading-relaxed">Sistem siap rilis, penyerahan akses penuh mandiri, serta briefing pengoperasian ke tim Anda.</p>
                            <span class="inline-block mt-4 text-[9px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-0.5 rounded-full">Hari 14+</span>
                        </div>

                    </div>
                </div>
            </div>

            {{-- TAB 4: SPESIFIKASI LAYANAN & SLA --}}
            <div x-show="activeTab === 'specs'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6" x-cloak>
                <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-10 rounded-3xl shadow-xl space-y-6">
                    <div class="border-b border-white/5 pb-4">
                        <h3 class="text-xl font-extrabold text-zinc-100 font-heading flex items-center gap-2">
                            <span>🛠️</span> Spesifikasi Teknis &amp; Komitmen SLA
                        </h3>
                        <p class="text-xs text-zinc-400 mt-1">Standar infrastruktur server dan perlindungan sistem yang Anda dapatkan.</p>
                    </div>

                    <div class="space-y-3">
                        <div class="p-4 bg-zinc-900/40 border border-white/5 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-zinc-300">Server &amp; Hosting Architecture</span>
                            <span class="text-xs text-indigo-400 font-semibold">Cloud High-Speed SSD, SSL HTTPS Encrypted</span>
                        </div>
                        <div class="p-4 bg-zinc-900/40 border border-white/5 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-zinc-300">Kepemilikan Aset Digital</span>
                            <span class="text-xs text-emerald-400 font-semibold">100% Hak Milik Klien (Domain &amp; Database Full Access)</span>
                        </div>
                        <div class="p-4 bg-zinc-900/40 border border-white/5 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-zinc-300">Garansi Maintenance &amp; Backup</span>
                            <span class="text-xs text-zinc-400 font-semibold">Backup Database Otomatis &amp; Free Technical Maintenance</span>
                        </div>
                        <div class="p-4 bg-zinc-900/40 border border-white/5 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-zinc-300">Respon Support CS</span>
                            <span class="text-xs text-amber-400 font-semibold">Bantuan Teknis Fast Response via WhatsApp</span>
                        </div>
                    </div>
                </div>
            {{-- DYNAMIC CUSTOM TOPICS CONTENT --}}
            @foreach($topics as $t)
                @if(!in_array($t['key'], ['overview', 'features', 'workflow', 'specs']) || !empty($t['content']))
                    <div x-show="activeTab === '{{ $t['key'] }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6" x-cloak>
                        <div class="bg-zinc-950/80 border border-white/10 p-8 sm:p-10 rounded-3xl shadow-xl space-y-6">
                            <div class="border-b border-white/5 pb-4">
                                <h3 class="text-xl font-extrabold text-zinc-100 font-heading flex items-center gap-2">
                                    <span>{{ $t['icon'] ?? '📌' }}</span> {{ $t['title'] }}
                                </h3>
                                @if(!empty($t['subtitle']))
                                    <p class="text-xs text-zinc-400 mt-1">{{ $t['subtitle'] }}</p>
                                @endif
                            </div>
                            <div class="text-zinc-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                                {{ $t['content'] ?? 'Belum ada deskripsi konten tambahan untuk topik ini.' }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- CTA Bottom Banner --}}
            <div class="mt-14 text-center border-t border-white/5 pt-12" data-reveal data-delay="300">
                <div class="bg-gradient-to-b from-indigo-950/30 to-zinc-950 border border-indigo-500/20 p-8 sm:p-12 rounded-3xl relative overflow-hidden shadow-2xl">
                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

                    <h3 class="text-2xl sm:text-3xl font-extrabold text-zinc-100 font-heading mb-4">
                        Siap Mengakselerasi Brand Anda Bersama {{ $program->title }}?
                    </h3>
                    <p class="text-zinc-400 text-xs sm:text-sm max-w-lg mx-auto mb-8 leading-relaxed">
                        Konsultasikan arah pengembangan digital bisnis Anda sekarang. Dapatkan Analisa Bisnis Gratis untuk menentukan strategi terbaik.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('audit.index') }}"
                           class="w-full sm:w-auto py-4 px-9 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-zinc-950 font-black text-sm rounded-xl shadow-xl shadow-amber-500/20 hover:shadow-amber-500/35 transition-all duration-200 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <span>🚀 Mulai Analisa Bisnis Gratis</span>
                        </a>
                        <a href="https://wa.me/{{ config('app.whatsapp', '628xxxxxxxxxx') }}?text=Halo%20Trinova%2C%20saya%20tertarik%20dengan%20{{ urlencode($program->title) }}."
                           target="_blank" rel="noopener"
                           class="w-full sm:w-auto py-4 px-9 border border-white/10 hover:border-indigo-500/40 text-zinc-300 hover:text-zinc-100 font-bold text-sm rounded-xl transition-all duration-200 hover:bg-indigo-500/10 flex items-center justify-center gap-2">
                            <span>💬 Diskusi via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>