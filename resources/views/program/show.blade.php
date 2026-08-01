<x-layouts.app :seo="[
        'title' => $program->title . ' — Detail Layanan Trinova Digital',
        'description' => $program->short_description,
        'canonical' => route('program.show', $program->slug),
    ]">

    <section class="pt-32 pb-24 relative overflow-hidden" aria-label="Detail Program {{ $program->title }}">

        {{-- Background Glows --}}
        <div
            class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.1),transparent)]">
        </div>
        <div class="absolute top-1/4 left-10 w-80 h-80 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-10 w-80 h-80 bg-amber-500/5 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10">

            {{-- Back Button --}}
            <div class="mb-8" data-reveal>
                <a href="{{ route('home') }}#programs"
                    class="inline-flex items-center gap-2 text-zinc-500 hover:text-zinc-300 text-sm font-semibold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12l7.5-7.5" />
                    </svg>
                    Kembali ke Semua Program
                </a>
            </div>

            {{-- Program Overview Card --}}
            <div class="bg-zinc-950/80 border border-white/5 p-8 sm:p-12 rounded-3xl mb-12" data-reveal
                data-delay="100">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-zinc-100 font-heading mt-4 mb-2">
                    {{ $program->title }}
                </h1>

                <span class="px-0 py-1 text-indigo-400 text-xs font-bold rounded-full uppercase tracking-wider">
                    Target Market: {{ $program->target_market }}
                </span>

                <p class="text-zinc-400 text-base sm:text-lg leading-relaxed mb-8">
                    {{ $program->description }}
                </p>

                <div class="space-y-8" data-reveal data-delay="200">
                    <h2 class="text-2xl font-extrabold text-zinc-100 font-heading">
                        Deskripsi Program
                    </h2>

                    <h2 class="text-2xl font-extrabold text-zinc-100 font-heading">
                        Fitur Platform
                    </h2>

                    <h2 class="text-2xl font-extrabold text-zinc-100 font-heading">
                        Spesifikasi &amp; Layanan
                    </h2>
                </div>

                <div
                    class="bg-zinc-900/50 border border-white/5 rounded-2xl p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    @if(!empty($program->outcome))
                        <div class="flex-grow">
                            <span class="text-xs font-bold text-zinc-500 uppercase block mb-3">Benefit Platform :</span>
                            <ul class="space-y-2">
                                @if(is_array($program->outcome))
                                    @foreach($program->outcome as $item)
                                        <li class="text-sm flex items-start gap-2.5 leading-relaxed text-zinc-300">
                                            @if(($item['icon'] ?? 'check') === 'check')
                                                <span class="text-green-400 font-bold shrink-0">✓</span>
                                            @else
                                                <span class="text-red-400 font-bold shrink-0">✗</span>
                                            @endif
                                            <span>{{ $item['text'] ?? '' }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-sm flex items-start gap-2.5 leading-relaxed text-green-400 font-semibold">
                                        <span class="text-green-400 font-bold shrink-0">✓</span>
                                        <span>{{ $program->outcome }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Program Features --}}
            <div class="space-y-8" data-reveal data-delay="200">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($program->features as $feature)
                        <div
                            class="bg-zinc-900/30 border border-white/5 rounded-2xl p-6 hover:border-indigo-500/10 transition-colors duration-200">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold text-xs">
                                    ✓
                                </div>
                                <h3 class="font-bold text-zinc-200 text-base font-heading">{{ $feature->title }}</h3>
                            </div>
                            <p class="text-zinc-400 text-sm leading-relaxed">
                                {{ $feature->description }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA Bottom --}}
            <div class="mt-16 text-center border-t border-white/5 pt-12" data-reveal data-delay="300">
                <h3 class="text-xl font-bold text-zinc-200 font-heading mb-4">
                    Siap Meningkatkan Skala Bisnis Anda Bersama Trinova?
                </h3>
                <p class="text-zinc-500 text-sm max-w-md mx-auto mb-8">
                    Mulailah dengan Audit Bisnis Gratis untuk memetakan kebutuhan spesifik brand Anda.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('audit.index') }}"
                        class="w-full sm:w-auto py-3.5 px-8 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-zinc-900 font-bold text-sm rounded-xl shadow-lg shadow-amber-500/20 transition-all duration-200">
                        Mulai Audit Bisnis Gratis
                    </a>
                    <a href="https://wa.me/{{ config('app.whatsapp', '628xxxxxxxxxx') }}?text=Halo%20Trinova%2C%20saya%20tertarik%20dengan%20{{ urlencode($program->title) }}."
                        target="_blank" rel="noopener"
                        class="w-full sm:w-auto py-3.5 px-8 border border-white/5 hover:border-indigo-500/30 text-zinc-400 hover:text-zinc-200 font-semibold text-sm rounded-xl transition-all">
                        Tanya via WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>