<x-layouts.app :seo="[
    'title'       => 'Blog & Wawasan Bisnis Digital — Trinova Digital',
    'description' => 'Temukan artikel edukasi, studi kasus, tips meningkatkan profit, menghindari perang harga, dan optimalisasi e-commerce.',
    'canonical'   => route('blog.index'),
]">

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Beranda",
            "item": "{{ route('home') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Blog",
            "item": "{{ route('blog.index') }}"
        }
    ]
}
</script>
@endpush

<section class="pt-32 pb-24 relative overflow-hidden" aria-label="Blog Trinova Digital">
    
    {{-- Background Glows --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.08),transparent)]"></div>
    <div class="absolute top-1/4 left-10 w-96 h-96 bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        
        {{-- Page Header --}}
        <div class="max-w-3xl mx-auto text-center mb-16">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4">
                Artikel Edukasi
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading text-zinc-100">
                Blog &amp; <span class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Wawasan Bisnis</span>
            </h1>
            <p class="text-zinc-400 text-sm sm:text-base">
                Tips praktis, tren pasar, dan panduan meningkatkan profit margin untuk UMKM &amp; seller marketplace di Indonesia.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            {{-- Articles Area (Left) --}}
            <div class="lg:col-span-9 space-y-12">
                @if(count($articles) === 0)
                    <div class="text-center py-16 bg-zinc-950 border border-white/5 rounded-3xl">
                        <span class="text-4xl">📭</span>
                        <h3 class="text-lg font-bold text-zinc-300 font-heading mt-4">Belum Ada Artikel</h3>
                        <p class="text-zinc-500 text-sm mt-1">Kami sedang menyusun artikel menarik untuk Anda.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($articles as $article)
                            <article class="bg-zinc-950 border border-white rounded-2xl overflow-hidden hover:border-indigo-400 transition-all duration-300 flex flex-col justify-between group">
                                <div>
                                    {{-- Placeholder / Dynamic Image --}}
                                    <div class="aspect-video bg-zinc-900 flex items-center justify-center border-b border-white/5 relative overflow-hidden">
                                        @if($article->featured_image)
                                            <img src="{{ asset($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-zinc-950/20"></div>
                                            <span class="text-4xl">📝</span>
                                        @endif
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="px-2.5 py-0.5 bg-indigo-500/10 text-indigo-400 text-[10px] font-bold rounded uppercase tracking-wider">
                                                {{ $article->category->name }}
                                            </span>
                                            <time datetime="{{ $article->published_at }}" class="text-[10px] text-zinc-500 font-semibold">
                                                {{ date('d M Y', strtotime($article->published_at)) }}
                                            </time>
                                        </div>

                                        <h2 class="text-lg font-bold text-zinc-100 group-hover:text-indigo-400 transition-colors font-heading leading-tight">
                                            <a href="{{ route('blog.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h2>

                                        <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                            {{ $article->excerpt }}
                                        </p>
                                    </div>
                                </div>

                                <div class="p-6 border-t border-white/5 pt-4">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs text-indigo-400 hover:text-indigo-300 font-bold transition-colors">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if(method_exists($articles, 'links'))
                        <div class="mt-12 flex justify-center">
                            {{ $articles->links('vendor.pagination.blog-pagination') }}
                        </div>
                    @endif
                @endif
            </div>

            {{-- Sidebar (Right) --}}
            <aside class="lg:col-span-3 space-y-8">
                
                {{-- Categories Widget --}}
                <div class="bg-zinc-950 border border-white/5 p-6 rounded-2xl">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Kategori</h3>
                    <ul class="space-y-3">
                        @foreach($categories as $category)
                            <li class="flex items-center justify-between">
                                <a href="{{ route('blog.category', $category->slug) }}" class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors">
                                    📁 {{ $category->name }}
                                </a>
                                @if(isset($category->articles_count))
                                    <span class="text-[10px] bg-zinc-900 border border-white/5 text-zinc-400 px-2 py-0.5 rounded-full font-bold">
                                        {{ $category->articles_count }}
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Newsletter Widget --}}
                <div class="bg-zinc-950 border border-white/5 p-6 rounded-2xl space-y-4">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest border-b border-white/5 pb-2">Langganan Info</h3>
                    <p class="text-zinc-500 text-xs leading-relaxed">Dapatkan pembaruan wawasan bisnis digital langsung di email Anda gratis.</p>
                    <form action="#" @submit.prevent="alert('Terima kasih sudah mendaftar!')" class="space-y-3">
                        <input type="email" required placeholder="Email Anda" class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-3.5 py-2.5 text-xs text-zinc-200 placeholder-zinc-600 focus:outline-none transition-colors">
                        <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow transition-colors">
                            Ikuti Newsletter
                        </button>
                    </form>
                </div>

            </aside>

        </div>

    </div>
</section>

</x-layouts.app>
