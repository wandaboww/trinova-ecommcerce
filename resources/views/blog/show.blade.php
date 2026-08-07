<x-layouts.app :seo="[
    'title'       => $article->title . ' — Blog Trinova Digital',
    'description' => $article->excerpt,
    'canonical'   => route('blog.show', $article->slug),
    'og_type'     => 'article',
    'og_image'    => (isset($article->featured_image) && $article->featured_image) ? asset($article->featured_image) : asset('images/og-default.jpg'),
]">

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BlogPosting",
    "headline": {{ json_encode($article->title) }},
    "description": {{ json_encode($article->excerpt) }},
    "image": [
        "{{ (isset($article->featured_image) && $article->featured_image) ? asset($article->featured_image) : asset('images/og-default.jpg') }}"
    ],
    "datePublished": "{{ date('c', strtotime($article->published_at ?? now())) }}",
    "dateModified": "{{ date('c', strtotime($article->updated_at ?? now())) }}",
    "author": {
        "@@type": "Organization",
        "name": "{{ $article->author->name ?? $article->author ?? 'Tim Trinova' }}"
    },
    "publisher": {
        "@@type": "Organization",
        "name": "Trinova Digital",
        "logo": {
            "@@type": "ImageObject",
            "url": "{{ asset('images/logo.png') }}"
        }
    },
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": "{{ route('blog.show', $article->slug) }}"
    }
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@@type": "ListItem",
            "position": 1,
            "name": "Beranda",
            "item": "{{ route('home') }}"
        },
        {
            "@@type": "ListItem",
            "position": 2,
            "name": "Blog",
            "item": "{{ route('blog.index') }}"
        },
        {
            "@@type": "ListItem",
            "position": 3,
            "name": {{ json_encode($article->title) }},
            "item": "{{ route('blog.show', $article->slug) }}"
        }
    ]
}
</script>
@endpush

<section class="pt-32 pb-24 relative overflow-hidden" aria-label="Artikel: {{ $article->title }}">
    
    {{-- Background Glows --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.06),transparent)]"></div>
    <div class="absolute top-1/4 left-10 w-96 h-96 bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
        
        {{-- Visual Breadcrumb & Back Link --}}
        <nav aria-label="Breadcrumb" class="mb-8" data-reveal>
            <ol class="flex flex-wrap items-center gap-2 text-xs text-zinc-500 font-medium">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-zinc-300 transition-colors">Beranda</a>
                </li>
                <li><span>/</span></li>
                <li>
                    <a href="{{ route('blog.index') }}" class="hover:text-zinc-300 transition-colors">Blog</a>
                </li>
                <li><span>/</span></li>
                <li class="text-indigo-400 font-semibold truncate max-w-[200px] sm:max-w-xs" aria-current="page">
                    {{ $article->title }}
                </li>
            </ol>
        </nav>

        {{-- Article Header --}}
        <header class="space-y-6 mb-12" data-reveal data-delay="100">
            <div class="flex flex-wrap items-center gap-4 text-xs">
                <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 font-bold rounded-full uppercase tracking-wider">
                    {{ $article->category->name }}
                </span>
                <time datetime="{{ $article->published_at }}" class="text-zinc-500 font-semibold">
                    📅 {{ date('d F Y', strtotime($article->published_at)) }}
                </time>
                <span class="text-zinc-500 font-semibold">
                    👤 {{ $article->author->name ?? $article->author ?? 'Tim Trinova' }}
                </span>
                <span class="text-zinc-500 font-semibold">
                    👁️ {{ $article->views }} Pembaca
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-zinc-100 font-heading leading-tight">
                {{ $article->title }}
            </h1>
        </header>

        {{-- Feature Image Placeholder / Dynamic Image --}}
        <div class="aspect-[21/9] w-full bg-zinc-900 border border-white/5 rounded-3xl mb-12 flex items-center justify-center relative overflow-hidden" data-reveal data-delay="150">
            @if(isset($article->featured_image) && $article->featured_image)
                <img src="{{ asset($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/15 to-zinc-950/40"></div>
                <span class="text-5xl relative z-10">📖</span>
            @endif
        </div>

        {{-- Article Body Content --}}
        <div class="prose prose-invert prose-indigo max-w-none text-zinc-300 space-y-6 text-base sm:text-lg leading-relaxed border-b border-white/5 pb-12" data-reveal data-delay="200">
            {!! $article->content !!}
        </div>

        {{-- Related Articles --}}
        @if($relatedArticles->isNotEmpty())
            <div class="mt-16 space-y-8" data-reveal data-delay="250">
                <h2 class="text-2xl font-extrabold text-zinc-100 font-heading">
                    Artikel Terkait
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @foreach($relatedArticles as $related)
                        <div class="bg-zinc-950 border border-white p-6 rounded-2xl hover:border-indigo-400 transition-all group">
                            <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider">
                                {{ $related->category->name ?? 'Bisnis Online' }}
                            </span>
                            <h3 class="text-base font-bold text-zinc-200 group-hover:text-indigo-400 transition-colors mt-2 mb-4 font-heading leading-snug">
                                <a href="{{ route('blog.show', $related->slug) }}">
                                    {{ $related->title }}
                                </a>
                            </h3>
                            <a href="{{ route('blog.show', $related->slug) }}" class="inline-flex items-center gap-1 text-xs text-zinc-500 hover:text-indigo-400 transition-colors">
                                Baca Artikel
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- CTA Banner --}}
        <div class="mt-16 bg-gradient-to-r from-indigo-900/30 to-zinc-950 border border-white/5 p-8 sm:p-12 rounded-3xl text-center" data-reveal data-delay="300">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-[10px] font-bold text-amber-400 uppercase tracking-widest mb-4">
                Consultation Request
            </span>
            <h3 class="text-xl sm:text-2xl font-extrabold text-zinc-100 font-heading mb-4">
                Ingin Mengonsultasikan Strategi Digital Brand Anda?
            </h3>
            <p class="text-zinc-400 text-sm max-w-md mx-auto mb-8">
                Isi form analisa bisnis kami sekarang untuk mendapatkan rekomendasi dan masukan dari konsultan senior secara gratis.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('audit.index') }}" 
                   class="w-full sm:w-auto py-3 px-8 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-zinc-900 font-bold text-sm rounded-xl shadow-lg transition-all">
                    Dapatkan Analisa Bisnis Gratis
                </a>
            </div>
        </div>

    </div>
</section>

</x-layouts.app>
