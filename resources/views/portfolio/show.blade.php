<x-layouts.app :seo="[
    'title'       => $portfolio->title . ' — Studi Kasus Klien Trinova Digital',
    'description' => \Illuminate\Support\Str::limit(strip_tags($portfolio->problem), 160),
    'canonical'   => route('portfolio.show', $portfolio->slug),
]">

<section class="pt-32 pb-24 relative overflow-hidden" aria-label="Detail Studi Kasus {{ $portfolio->client_name }}">
    
    {{-- Background Glows --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.08),transparent)]"></div>
    <div class="absolute top-1/4 left-10 w-96 h-96 bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        
        {{-- Back Navigation --}}
        <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-indigo-400 text-xs font-bold mb-8 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-hover:-translate-x-1 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Semua Portofolio
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            {{-- Case Study Content (Left) --}}
            <div class="lg:col-span-8 space-y-12">
                
                {{-- Header Content --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="px-2.5 py-0.5 bg-indigo-500/10 text-indigo-400 text-[10px] font-bold rounded uppercase tracking-wider border border-indigo-500/20">
                            {{ $portfolio->industry }}
                        </span>
                        <span class="px-2.5 py-0.5 bg-zinc-900 text-zinc-400 text-[10px] font-bold rounded uppercase tracking-wider border border-white/5">
                            {{ $portfolio->client_name }}
                        </span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight font-heading text-zinc-100 leading-tight">
                        {{ $portfolio->title }}
                    </h1>
                </div>

                {{-- Detail Sections --}}
                <div class="space-y-8 bg-zinc-950/40 border border-white/5 rounded-3xl p-8 sm:p-10">
                    
                    {{-- Masalah --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2 text-red-400">
                            <span class="w-2 h-2 rounded-full bg-red-400"></span>
                            <h2 class="text-sm font-bold uppercase tracking-wider font-heading">Tantangan &amp; Masalah Utama</h2>
                        </div>
                        <div class="text-zinc-300 text-sm sm:text-base leading-relaxed pl-4 border-l border-red-500/20 whitespace-pre-line">
                            {!! nl2br(e($portfolio->problem)) !!}
                        </div>
                    </div>

                    {{-- Solusi --}}
                    <div class="space-y-3 pt-6 border-t border-white/5">
                        <div class="flex items-center gap-2 text-indigo-400">
                            <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                            <h2 class="text-sm font-bold uppercase tracking-wider font-heading">Solusi Trinova Digital</h2>
                        </div>
                        <div class="text-zinc-300 text-sm sm:text-base leading-relaxed pl-4 border-l border-indigo-500/20 whitespace-pre-line">
                            {!! nl2br(e($portfolio->solution)) !!}
                        </div>
                    </div>

                    {{-- Hasil --}}
                    <div class="space-y-3 pt-6 border-t border-white/5">
                        <div class="flex items-center gap-2 text-green-400">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            <h2 class="text-sm font-bold uppercase tracking-wider font-heading">Hasil Akhir &amp; Dampak Bisnis</h2>
                        </div>
                        <div class="text-zinc-300 text-sm sm:text-base leading-relaxed pl-4 border-l border-green-500/20 whitespace-pre-line">
                            {!! nl2br(e($portfolio->result)) !!}
                        </div>
                    </div>

                </div>

            </div>

            {{-- Summary & CTA Sidebar (Right) --}}
            <aside class="lg:col-span-4 space-y-6">
                
                {{-- Quick Facts Card --}}
                <div class="bg-zinc-950/70 border border-white/5 rounded-3xl p-6 sm:p-8 space-y-6">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest border-b border-white/5 pb-3 font-heading">Informasi Proyek</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="text-[10px] text-zinc-500 uppercase font-bold block mb-1">Hasil Utama</span>
                            <span class="text-lg font-extrabold text-green-400 font-heading">{{ $portfolio->result }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-zinc-500 uppercase font-bold block mb-1">Klien</span>
                            <span class="text-sm text-zinc-200 font-medium block">{{ $portfolio->client_name }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-zinc-500 uppercase font-bold block mb-1">Industri / Kategori</span>
                            <span class="text-sm text-zinc-200 font-medium block">{{ $portfolio->industry }}</span>
                        </div>
                        @if(!empty($portfolio->website_url))
                            <div>
                                <span class="text-[10px] text-zinc-500 uppercase font-bold block mb-1">Website Bisnis</span>
                                <a href="{{ $portfolio->website_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs text-indigo-400 hover:text-indigo-300 font-bold transition-colors">
                                    Lihat Website Klien
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Action CTA Card --}}
                <div class="bg-zinc-950/70 border border-white/5 rounded-3xl p-6 sm:p-8 space-y-6 text-center relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-24 h-24 bg-indigo-600/10 rounded-full blur-xl pointer-events-none"></div>
                    
                    <div class="space-y-2 relative z-10">
                        <span class="text-[10px] font-bold text-amber-400 bg-amber-400/10 border border-amber-400/20 px-2 py-0.5 rounded-full uppercase tracking-wider">Mulai Tumbuh</span>
                        <h4 class="text-lg font-bold text-zinc-100 font-heading pt-2">Mau Hasil Serupa Untuk Bisnis Anda?</h4>
                        <p class="text-zinc-400 text-xs leading-relaxed">
                            Cari tahu kebocoran margin keuntungan di platform marketplace Anda dan temukan formula website mandiri berkonversi tinggi bersama analis senior kami.
                        </p>
                    </div>

                    <div class="pt-2 relative z-10">
                        <a href="{{ route('audit.index') }}" class="w-full inline-flex items-center justify-center gap-2 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-600/10 transition-colors">
                            Dapatkan Analisa Bisnis Gratis
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>

            </aside>

        </div>

    </div>
</section>

</x-layouts.app>
