<x-layouts.app :seo="[
    'title'       => 'Studi Kasus & Portofolio — Trinova Digital',
    'description' => 'Lihat bukti nyata bagaimana kami mendampingi seller marketplace dan UMKM bertransformasi menjadi pemilik brand mandiri dengan profit maksimal.',
    'canonical'   => route('portfolio.index'),
]">

<section class="pt-32 pb-24 relative overflow-hidden" aria-label="Portfolio Studi Kasus Trinova Digital">
    
    {{-- Background Glows --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.08),transparent)]"></div>
    <div class="absolute top-1/4 right-10 w-96 h-96 bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        
        {{-- Page Header --}}
        <div class="max-w-3xl mx-auto text-center mb-16">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4">
                Bukti Nyata Hasil
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading text-zinc-100">
                Studi Kasus &amp; <span class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Portofolio Klien</span>
            </h1>
            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                Bagaimana kami mendampingi para pebisnis bertransformasi dari ketergantungan penuh pada marketplace menjadi pemilik brand mandiri dengan profit maksimal.
            </p>
        </div>

        @if(count($portfolios) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $portfolio)
                    <div class="bg-zinc-950/60 border border-white/5 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider bg-indigo-500/10 border border-indigo-500/20 px-2.5 py-1 rounded-md">{{ $portfolio->industry }}</span>
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-bold rounded-full uppercase">{{ $portfolio->client_name }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-zinc-100 mb-4 font-heading group-hover:text-indigo-400 transition-colors">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}">
                                    {{ $portfolio->title }}
                                </a>
                            </h3>

                            <div class="space-y-4 mb-6">
                                <div>
                                    <h4 class="text-xs font-bold text-red-400 uppercase tracking-wide">Masalah:</h4>
                                    <p class="text-zinc-400 text-sm mt-1.5 line-clamp-3 leading-relaxed">{{ $portfolio->problem }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-indigo-400 uppercase tracking-wide">Solusi Trinova:</h4>
                                    <p class="text-zinc-400 text-sm mt-1.5 line-clamp-3 leading-relaxed">{{ $portfolio->solution }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-white/5 pt-6 mt-6">
                            <div class="flex items-center justify-between mb-5">
                                <span class="text-xs text-zinc-500 font-semibold">Hasil Akhir:</span>
                                <span class="text-lg font-extrabold text-green-400 font-heading">{{ $portfolio->result }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="inline-flex items-center gap-1.5 text-xs text-indigo-400 hover:text-indigo-300 font-bold transition-colors">
                                    Detail Studi Kasus
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                                
                                @if(!empty($portfolio->website_url))
                                    <a href="{{ $portfolio->website_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-[11px] text-zinc-500 hover:text-indigo-400 transition-colors">
                                        Kunjungi Web
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-zinc-950 border border-white/5 rounded-3xl max-w-2xl mx-auto">
                <span class="text-4xl">💼</span>
                <h3 class="text-lg font-bold text-zinc-300 font-heading mt-4">Belum Ada Studi Kasus</h3>
                <p class="text-zinc-500 text-sm mt-1">Kami sedang mempersiapkan data portofolio studi kasus terbaik untuk Anda.</p>
            </div>
        @endif

    </div>
</section>

</x-layouts.app>
