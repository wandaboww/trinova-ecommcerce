<x-layouts.app :seo="[
    'title'       => 'Kategori: ' . $category->name . ' — Blog Trinova Digital',
    'description' => 'Lihat semua artikel dalam kategori ' . $category->name . ' di blog Trinova Digital.',
    'canonical'   => route('blog.category', $category->slug),
]">

<section class="pt-32 pb-24 relative overflow-hidden" aria-label="Blog Kategori {{ $category->name }}">
    
    {{-- Background Glows --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.08),transparent)]"></div>
    <div class="absolute top-1/4 left-10 w-96 h-96 bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        
        {{-- Back Link --}}
        <div class="mb-6">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-zinc-500 hover:text-zinc-300 text-sm font-semibold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12l7.5-7.5" /></svg>
                Kembali ke Semua Artikel
            </a>
        </div>

        {{-- Page Header --}}
        <div class="max-w-3xl mx-auto text-center mb-16">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4">
                Kategori Artikel
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading text-zinc-100">
                Kategori: <span class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">{{ $category->name }}</span>
            </h1>
            <p class="text-zinc-400 text-sm sm:text-base">
                Menampilkan kumpulan artikel edukatif seputar {{ strtolower($category->name) }}.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            {{-- Articles Area (Left) --}}
            <div class="lg:col-span-9 space-y-12">
                @if(count($articles) === 0)
                    <div class="text-center py-16 bg-zinc-950 border border-white/5 rounded-3xl">
                        <span class="text-4xl">📭</span>
                        <h3 class="text-lg font-bold text-zinc-300 font-heading mt-4">Belum Ada Artikel</h3>
                        <p class="text-zinc-500 text-sm mt-1">Belum ada artikel yang dipublikasikan di kategori ini.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($articles as $article)
                            <article class="bg-zinc-950 border border-white rounded-2xl overflow-hidden hover:border-indigo-400 transition-all duration-300 flex flex-col justify-between group">
                                <div>
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
                        @foreach($categories as $cat)
                            <li class="flex items-center justify-between">
                                <a href="{{ route('blog.category', $cat->slug) }}" 
                                   class="text-sm transition-colors {{ $cat->slug === $category->slug ? 'text-indigo-400 font-bold' : 'text-zinc-500 hover:text-zinc-200' }}">
                                    📁 {{ $cat->name }}
                                </a>
                                @if(isset($cat->articles_count))
                                    <span class="text-[10px] bg-zinc-900 border border-white/5 text-zinc-400 px-2 py-0.5 rounded-full font-bold">
                                        {{ $cat->articles_count }}
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

            </aside>

        </div>

    </div>
</section>

</x-layouts.app>
