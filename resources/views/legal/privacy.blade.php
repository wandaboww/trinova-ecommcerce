<x-layouts.app :seo="$seo">

    {{-- Header Section --}}
    <section class="pt-32 pb-12 relative overflow-hidden bg-zinc-950 border-b border-white/5"
             aria-label="Header Kebijakan Privasi">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_60%_at_50%_-20%,rgba(99,102,241,0.12),transparent)] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="w-full flex items-center justify-between mb-8 sm:mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    Dokumen Legal Resmi
                </div>
                <div class="hidden sm:flex items-center gap-4 text-xs text-zinc-500">
                    @if($document->version)
                        <span class="inline-flex items-center gap-1.5 bg-zinc-900/80 px-3 py-1.5 rounded-lg border border-white/5">
                            📌 Versi {{ $document->version }}
                        </span>
                    @endif
                    @if($document->effective_date)
                        <span class="inline-flex items-center gap-1.5 bg-zinc-900/80 px-3 py-1.5 rounded-lg border border-white/5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-indigo-400" aria-hidden="true">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            Berlaku: <span class="text-zinc-300 font-semibold">{{ $document->effective_date->translatedFormat('d F Y') }}</span>
                        </span>
                    @endif
                </div>
            </div>
            <div class="max-w-3xl mx-auto text-center flex flex-col items-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-zinc-100 font-heading mb-4">
                    {{ $document->title }}
                </h1>
                @if($document->subtitle)
                    <p class="text-zinc-400 text-base sm:text-lg leading-relaxed mb-6 text-center">
                        {{ $document->subtitle }}
                    </p>
                @endif
                {{-- Mobile meta --}}
                <div class="flex sm:hidden flex-wrap items-center justify-center gap-3 text-xs text-zinc-500">
                    @if($document->version)
                        <span class="bg-zinc-900/80 px-2.5 py-1 rounded-lg border border-white/5">v{{ $document->version }}</span>
                    @endif
                    @if($document->effective_date)
                        <span class="bg-zinc-900/80 px-2.5 py-1 rounded-lg border border-white/5">
                            Berlaku: {{ $document->effective_date->translatedFormat('d M Y') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Main Document Container --}}
    <section class="py-12 lg:py-16 bg-zinc-950 relative"
             x-data="{
                 activeSection: '{{ $sections->first()?->slug ?? '' }}',
                 mobileTocOpen: false,
                 scrollTo(id) {
                     const el = document.getElementById(id);
                     if (el) {
                         const y = el.getBoundingClientRect().top + window.scrollY - 100;
                         window.scrollTo({ top: y, behavior: 'smooth' });
                         this.activeSection = id;
                         this.mobileTocOpen = false;
                     }
                 }
             }"
             x-init="
                 const observer = new IntersectionObserver((entries) => {
                     entries.forEach(entry => {
                         if (entry.isIntersecting) {
                             activeSection = entry.target.id;
                         }
                     });
                 }, { threshold: 0.2, rootMargin: '-80px 0px -40% 0px' });
                 document.querySelectorAll('[data-legal-section]').forEach(el => observer.observe(el));
             "
             aria-label="Dokumen Kebijakan Privasi">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            @if($sections->isEmpty())
                <div class="text-center py-20 text-zinc-600 text-sm">
                    Dokumen sedang dalam proses penyusunan. Silakan kunjungi kembali nanti.
                </div>
            @else

            {{-- Mobile: Collapsible TOC --}}
            <div class="lg:hidden mb-8 bg-zinc-900/90 border border-white/10 rounded-2xl overflow-hidden shadow-lg">
                <button @click="mobileTocOpen = !mobileTocOpen"
                        type="button"
                        class="w-full px-5 py-4 flex items-center justify-between text-left font-bold text-sm text-zinc-200 bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/50"
                        :aria-expanded="mobileTocOpen"
                        aria-controls="mobile-toc-list">
                    <span class="flex items-center gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-indigo-400" aria-hidden="true">
                            <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/>
                            <line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                        </svg>
                        Daftar Isi Dokumen
                        <span class="text-[10px] font-normal text-zinc-500">({{ $sections->count() }} pasal)</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="text-zinc-400 transition-transform duration-200"
                         :class="mobileTocOpen ? 'rotate-180 text-indigo-400' : ''" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <div id="mobile-toc-list" x-show="mobileTocOpen" x-collapse x-cloak
                     class="border-t border-white/5 px-3 py-3 bg-zinc-950/60">
                    <nav class="flex flex-col space-y-1" aria-label="Daftar Isi Mobile">
                        @foreach($sections as $i => $section)
                            <a href="#{{ $section->slug }}"
                               @click.prevent="scrollTo('{{ $section->slug }}')"
                               :class="activeSection === '{{ $section->slug }}' ? 'bg-indigo-500/15 text-indigo-300 font-semibold border-l-2 border-indigo-400 pl-3' : 'text-zinc-400 hover:text-zinc-200 pl-3'"
                               class="py-2 pr-3 text-xs transition-colors rounded-r-lg flex items-center justify-between">
                                <span>{{ $i + 1 }}. {{ $section->title }}</span>
                                <svg x-show="activeSection === '{{ $section->slug }}'" xmlns="http://www.w3.org/2000/svg"
                                     width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                     class="text-indigo-400" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        @endforeach
                    </nav>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- Desktop Sticky Sidebar TOC --}}
                <aside class="hidden lg:block lg:col-span-4 xl:col-span-3" aria-label="Daftar Isi">
                    <div class="sticky top-28 bg-zinc-900/60 border border-white/5 rounded-2xl p-5 backdrop-blur-md">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-400 mb-4 pb-3 border-b border-white/5 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-indigo-400" aria-hidden="true">
                                <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                                <line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/>
                                <line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                            </svg>
                            Daftar Isi
                        </h2>
                        <nav class="flex flex-col space-y-0.5 max-h-[calc(100vh-200px)] overflow-y-auto pr-1" aria-label="Navigasi Dokumen">
                            @foreach($sections as $i => $section)
                                <a href="#{{ $section->slug }}"
                                   @click.prevent="scrollTo('{{ $section->slug }}')"
                                   :class="activeSection === '{{ $section->slug }}'
                                       ? 'bg-indigo-500/15 text-indigo-300 font-semibold border-l-2 border-indigo-400 pl-3'
                                       : 'text-zinc-400 hover:text-zinc-200 hover:bg-white/5 pl-3'"
                                   class="py-2 pr-2.5 rounded-r-lg transition-all duration-150 flex items-start gap-2 text-xs group">
                                    <span class="text-zinc-600 shrink-0 mt-0.5 w-4 text-right">{{ $i + 1 }}.</span>
                                    <span class="leading-snug">{{ $section->title }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>

                {{-- Main Content --}}
                <main class="lg:col-span-8 xl:col-span-9 space-y-8" aria-label="Isi Dokumen">
                    @foreach($sections as $i => $section)
                        <article id="{{ $section->slug }}"
                                 data-legal-section
                                 class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                            <header class="mb-5 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading shrink-0">
                                    {{ $i + 1 }}
                                </span>
                                <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">
                                    {{ $section->title }}
                                </h2>
                            </header>
                            <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                                @foreach(array_filter(explode("\n\n", $section->content ?? '')) as $paragraph)
                                    <p>{{ trim($paragraph) }}</p>
                                @endforeach
                                @if(empty(trim($section->content ?? '')))
                                    <p class="text-zinc-600 italic text-sm">Konten section ini belum diisi.</p>
                                @endif
                            </div>
                        </article>
                    @endforeach

                    {{-- Document Footer Meta --}}
                    <div class="mt-8 pt-6 border-t border-white/5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-zinc-600">
                        <p>
                            Dokumen ini adalah Kebijakan Privasi resmi Omset Digital
                            @if($document->version) · Versi {{ $document->version }} @endif
                        </p>
                        @if($document->effective_date)
                            <p>Berlaku sejak {{ $document->effective_date->translatedFormat('d F Y') }}</p>
                        @endif
                    </div>
                </main>

            </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-12 bg-zinc-950 border-t border-white/5" aria-label="Hubungi Kami">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-zinc-500 text-sm mb-3">Punya pertanyaan mengenai Kebijakan Privasi ini?</p>
            <h2 class="text-xl font-bold text-zinc-200 mb-5">Hubungi Tim Omset Digital</h2>
            <a href="{{ route('contact.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 duration-200">
                💬 Hubungi Kami
            </a>
        </div>
    </section>

</x-layouts.app>
