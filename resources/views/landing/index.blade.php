<x-layouts.app :seo="[
        'title' => 'Trinova Digital — Partner Transformasi Digital untuk Seller Marketplace',
        'description' => 'Trinova Digital membantu seller Shopee, Tokopedia, dan TikTok Shop membangun aset digital sendiri. Dari marketplace menjadi brand mandiri. Mulai dengan Audit Bisnis Gratis.',
        'canonical' => route('home'),
    ]">

    @push('schema')
        <script type="application/ld+json">
                                                                                                                                            {
                                                                                                                                                "@@context": "https://schema.org",
                                                                                                                                                "@type": "LocalBusiness",
                                                                                                                                                "name": "Trinova Digital",
                                                                                                                                                "description": "Partner transformasi digital untuk seller marketplace dan UMKM Indonesia",
                                                                                                                                                "url": "{{ config('app.url') }}",
                                                                                                                                                "logo": "{{ asset('images/logo.png') }}",
                                                                                                                                                "contactPoint": {
                                                                                                                                                    "@type": "ContactPoint",
                                                                                                                                                    "contactType": "customer service",
                                                                                                                                                    "availableLanguage": "Indonesian"
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            </script>
    @endpush

    {{-- =========================================================
    SECTION 1: HERO
    Tujuan: Menghentikan perhatian dalam < 5 detik=========================================================--}} <section
        id="hero" class="min-h-screen flex items-center pt-20 relative overflow-hidden"
        aria-label="Hero — Pesan utama Trinova Digital">

        {{-- Background Effects --}}
        <div
            class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.15),transparent)]">
        </div>
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-amber-500/8 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute inset-0 bg-[linear-gradient(rgba(99,102,241,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(99,102,241,0.03)_1px,transparent_1px)] bg-[size:64px_64px]">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">

                {{-- Badge --}}
                @if(($setting->show_hero_badge ?? true) && (isset($setting) ? !empty($setting->hero_badge) : true))
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-300 uppercase tracking-widest mb-8"
                        data-reveal>
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                        {{ $setting->hero_badge ?? 'Partner Transformasi Digital' }}
                    </div>
                @endif

                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight tracking-tight mb-6 font-heading"
                    data-reveal data-delay="100">
                    @if($setting->show_hero_title ?? true)
                        {{ $setting->hero_title ?? 'Order makin ramai...' }}
                    @endif
                    @if(($setting->show_hero_title ?? true) && ($setting->show_hero_subtitle ?? true))
                        <br />
                    @endif
                    @if($setting->show_hero_subtitle ?? true)
                        <span
                            class="bg-gradient-to-r from-indigo-400 via-violet-400 to-indigo-300 bg-clip-text text-transparent">
                            {!! $setting->hero_subtitle ?? 'Tapi <span class="text-red-400">margin</span> terasa jalan di tempat?' !!}
                        </span>
                    @endif
                </h1>

                {{-- Subheadline --}}
                @if($setting->show_hero_description ?? true)
                    <p class="text-lg sm:text-xl text-zinc-400 leading-relaxed max-w-2xl mx-auto mb-10" data-reveal
                        data-delay="200">
                        {!! nl2br(e($setting->pain_description ?? "Marketplace membantu Anda mendapatkan pelanggan.\nWebsite membantu Anda memiliki pelanggan.\nTrinova membantu Anda membangun keduanya.")) !!}
                    </p>
                @endif

                {{-- CTA Buttons --}}
                @if(($setting->show_hero_cta_primary ?? true) || ($setting->show_hero_cta_secondary ?? true))
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in" data-reveal data-delay="300">

                        {{-- Primary CTA --}}
                        @if($setting->show_hero_cta_primary ?? true)
                            <a href="{{ route('audit.index') }}"
                                class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-zinc-900 font-bold text-lg rounded-full shadow-2xl shadow-amber-500/20 hover:shadow-amber-500/40 transition-all duration-200 hover:-translate-y-1 w-full sm:w-auto justify-center"
                                id="hero-audit-cta">
                                {{ $setting->hero_cta ?? 'Audit Bisnis Gratis' }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </a>
                        @endif

                        {{-- Secondary CTA --}}
                        @if($setting->show_hero_cta_secondary ?? true)
                            <a href="#portfolio"
                                class="inline-flex items-center gap-2 px-8 py-4 border border-white/10 hover:border-indigo-500/40 text-zinc-400 hover:text-zinc-100 font-semibold rounded-full transition-all duration-200 hover:bg-indigo-500/5 w-full sm:w-auto justify-center"
                                id="hero-portfolio-cta">
                                {{ $setting->hero_cta_secondary ?? 'Lihat Portfolio' }}
                            </a>
                        @endif

                    </div>
                @endif

                {{-- Stats --}}
                @if($setting->show_statistics ?? true)
                    <div class="grid grid-cols-3 gap-8 max-w-md mx-auto mt-10 pt-0 border-t border-white/5" data-reveal
                        data-delay="400">
                        <div class="text-center">
                            <div class="text-2xl font-extrabold text-zinc-100 font-heading">
                                {{ $setting->stat_clients ?? '150+' }}
                            </div>
                            <div class="text-xs text-zinc-500 mt-1">Klien Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-extrabold text-zinc-100 font-heading">
                                100%
                            </div>
                            <div class="text-xs text-zinc-500 mt-1">On-time Delivery</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-extrabold text-zinc-100 font-heading">
                                {{ $setting->stat_growth ?? '3.2x' }}
                            </div>
                            <div class="text-xs text-zinc-500 mt-1">Avg. Kenaikan Omzet</div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        </section>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent" aria-hidden="true"></div>

        {{-- =========================================================
        SECTION 2: PAIN
        ========================================================= --}}
        <section id="pain" class="py-24 relative" aria-label="Masalah yang dihadapi seller marketplace">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                {{-- Section Header --}}
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-500/10 border border-red-500/20 rounded-full text-xs font-semibold text-red-400 uppercase tracking-widest mb-4"
                        data-reveal>
                        Tantangan Terbesar Seller
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading"
                        data-reveal data-delay="100">
                        Realita Pahit Jualan di<br />
                        <span
                            class="bg-gradient-to-r from-red-400 to-amber-500 bg-clip-text text-transparent">Marketplace</span>
                    </h2>
                    <p class="text-zinc-400 text-lg" data-reveal data-delay="200">
                        Apakah Anda merasakan jualan semakin ramai, tetapi uang di rekening justru tidak bertambah
                        karena masalah-masalah ini?
                    </p>
                </div>

                {{-- Pain Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- Pain Card 1: Biaya Admin Mencekik --}}
                    <div class="bg-zinc-900/50 border border-white/5 hover:border-red-500/30 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="100">
                        <div
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Biaya Admin Mencekik</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Setiap transaksi dipotong biaya admin yang terus naik secara sepihak. Margin keuntungan Anda
                            tergerus untuk mendanai ekosistem marketplace.
                        </p>
                    </div>

                    {{-- Pain Card 2: Perang Harga Brutal --}}
                    <div class="bg-zinc-900/50 border border-white/5 hover:border-red-500/30 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="200">
                        <div
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Perang Harga Tanpa Akhir</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Produk Anda disandingkan langsung dengan kompetitor yang banting harga. Tanpa brand yang
                            kuat, Anda terpaksa ikut perang harga demi mendapatkan pembeli.
                        </p>
                    </div>

                    {{-- Pain Card 3: Subsidi Ongkir & Voucher --}}
                    <div class="bg-zinc-900/50 border border-white/5 hover:border-red-500/30 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="300">
                        <div
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Beban Voucher & Ongkir</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Terpaksa memberikan diskon ekstrem dan mengikuti program gratis ongkir agar produk Anda
                            direkomendasikan oleh algoritma pencarian.
                        </p>
                    </div>

                    {{-- Pain Card 4: Pelanggan Bukan Milik Anda --}}
                    <div class="bg-zinc-900/50 border border-white/5 hover:border-red-500/30 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="100">
                        <div
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Pelanggan Bukan Milik Anda</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Pembeli tidak mengingat brand Anda. Mereka hanya ingat "beli barang di marketplace".
                            Informasi data pembeli ditutup rapat oleh platform.
                        </p>
                    </div>

                    {{-- Pain Card 5: Repeat Order Rendah --}}
                    <div class="bg-zinc-900/50 border border-white/5 hover:border-red-500/30 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="200">
                        <div
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Sulit Mendapat Repeat Order</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Karena tidak memegang database pelanggan, Anda tidak bisa melakukan pemasaran ulang
                            (*remarketing*) secara gratis. Setiap hari Anda dipaksa mencari pembeli baru.
                        </p>
                    </div>

                    {{-- Pain Card 6: Ketergantungan Algoritma --}}
                    <div class="bg-zinc-900/50 border border-white/5 hover:border-red-500/30 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="300">
                        <div
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Ketergantungan Mutlak</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Jika algoritma platform berubah atau akun dibatasi secara tiba-tiba, omzet Anda bisa anjlok
                            hingga 0% dalam semalam tanpa ada persiapan.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        {{-- =========================================================
        SECTION 3: PARADIGM SHIFT
        ========================================================= --}}
        <section id="paradigm" class="py-24 relative bg-zinc-900/40 overflow-hidden"
            aria-label="Perubahan cara pandang bisnis digital">

            {{-- Background Glows --}}
            <div
                class="absolute top-1/2 left-0 -translate-y-1/2 w-72 h-72 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="absolute bottom-0 right-10 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                    {{-- Copywriting (Left) --}}
                    <div class="lg:col-span-5 flex flex-col items-start">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-6"
                            data-reveal>
                            Ubah Pola Pikir Anda
                        </span>

                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-6 font-heading"
                            data-reveal data-delay="100">
                            Marketplace untuk <span class="text-indigo-400">Mendapatkan</span> Pelanggan.<br />
                            Website untuk <span class="text-amber-400">Memiliki</span> Pelanggan.
                        </h2>

                        <p class="text-zinc-400 text-base leading-relaxed mb-6" data-reveal data-delay="200">
                            Di marketplace, Anda sebenarnya menumpang di lapak orang lain. Pelanggan yang membeli produk
                            Anda adalah pelanggan milik marketplace. Ketika kebijakan berubah, potongan naik, atau akun
                            dibatasi, Anda bisa kehilangan seluruh bisnis dalam sekejap.
                        </p>

                        <p class="text-zinc-400 text-base leading-relaxed mb-8" data-reveal data-delay="250">
                            Gunakan marketplace sebagai <strong class="text-zinc-200">pintu masuk (akuisisi)</strong>
                            pelanggan baru, arahkan mereka ke ekosistem <strong class="text-indigo-300">Website Mandiri
                                Anda</strong>, bangun database WhatsApp mereka, dan nikmati repeat order dengan profit
                            bersih 100%.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto" data-reveal data-delay="300">
                            <a href="{{ route('audit.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-full transition-all duration-200 shadow-lg shadow-indigo-500/25">
                                Konsultasi Strategi Gratis
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Flow Timeline (Right) --}}
                    <div class="lg:col-span-7 flex justify-center lg:justify-end">
                        <div class="relative max-w-lg w-full bg-zinc-950/80 border border-white/5 p-8 sm:p-10 rounded-3xl"
                            data-reveal data-delay="200">

                            {{-- Vertikal Line --}}
                            <div
                                class="absolute left-14 sm:left-16 top-16 bottom-16 w-0.5 bg-gradient-to-b from-indigo-500 via-indigo-500/50 to-amber-500/20 pointer-events-none">
                            </div>

                            <div class="space-y-8 relative">

                                {{-- Step 1 --}}
                                <div class="flex items-start gap-6 group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center shrink-0 shadow-lg shadow-indigo-500/20 z-10 group-hover:scale-110 transition-transform">
                                        1
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-zinc-100 text-base font-heading">Marketplace</h3>
                                        <p class="text-xs text-zinc-500 mt-0.5">Media akuisisi traffic &amp; pelanggan
                                            baru</p>
                                    </div>
                                </div>

                                {{-- Step 2 --}}
                                <div class="flex items-start gap-6 group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center shrink-0 shadow-lg shadow-indigo-500/20 z-10 group-hover:scale-110 transition-transform">
                                        2
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-zinc-100 text-base font-heading">Pelanggan Baru</h3>
                                        <p class="text-xs text-zinc-500 mt-0.5">Pembelian pertama &amp; kenal dengan
                                            brand Anda</p>
                                    </div>
                                </div>

                                {{-- Step 3 --}}
                                <div class="flex items-start gap-6 group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-indigo-500 border border-indigo-400 text-white font-bold flex items-center justify-center shrink-0 shadow-lg shadow-indigo-400/20 z-10 group-hover:scale-110 transition-transform">
                                        3
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-indigo-400 text-base font-heading">Website Sendiri
                                        </h3>
                                        <p class="text-xs text-zinc-400 mt-0.5">Transaksi kedua diarahkan ke website
                                            Anda sendiri</p>
                                    </div>
                                </div>

                                {{-- Step 4 --}}
                                <div class="flex items-start gap-6 group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-indigo-500 border border-indigo-400 text-white font-bold flex items-center justify-center shrink-0 shadow-lg shadow-indigo-400/20 z-10 group-hover:scale-110 transition-transform">
                                        4
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-indigo-400 text-base font-heading">Database Pelanggan
                                        </h3>
                                        <p class="text-xs text-zinc-400 mt-0.5">Kontak WhatsApp &amp; data belanja
                                            tersimpan aman</p>
                                    </div>
                                </div>

                                {{-- Step 5 --}}
                                <div class="flex items-start gap-6 group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-amber-500 text-zinc-950 font-bold flex items-center justify-center shrink-0 shadow-lg shadow-amber-500/20 z-10 group-hover:scale-110 transition-transform">
                                        5
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-amber-400 text-base font-heading">Repeat Order Gratis
                                        </h3>
                                        <p class="text-xs text-zinc-400 mt-0.5">Penjualan berulang via WhatsApp
                                            Broadcast bebas biaya iklan</p>
                                    </div>
                                </div>

                                {{-- Step 6 --}}
                                <div class="flex items-start gap-6 group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-amber-500 text-zinc-950 font-bold flex items-center justify-center shrink-0 shadow-lg shadow-amber-500/20 z-10 group-hover:scale-110 transition-transform">
                                        6
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-amber-400 text-base font-heading">Aset Digital Mandiri
                                        </h3>
                                        <p class="text-xs text-zinc-400 mt-0.5">Bisnis kuat, mandiri, dan punya nilai
                                            brand tinggi</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- =========================================================
        SECTION 4: SOLUTION
        ========================================================= --}}
        <section id="solution" class="py-24 relative" aria-label="Solusi — Bagaimana website membantu bisnis Anda">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                {{-- Section Header --}}
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4"
                        data-reveal>
                        Solusi Pertumbuhan Bisnis
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading"
                        data-reveal data-delay="100">
                        Membangun Mesin Keuntungan<br />
                        <span class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Milik
                            Anda Sendiri</span>
                    </h2>
                    <p class="text-zinc-400 text-lg" data-reveal data-delay="200">
                        Fokus kami adalah hasil bisnis (outcome), bukan sekadar urusan teknis seperti coding, hosting,
                        atau coding bahasa pemrograman.
                    </p>
                </div>

                {{-- Benefits Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- Benefit 1: Margin Keuntungan --}}
                    <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="100">
                        <div
                            class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a6 6 0 0 1-2.25-4.5V3.75A2.25 2.25 0 0 1 2.25 1.5h15a2.25 2.25 0 0 1 2.25 2.25v10.5a6 6 0 0 1-2.25 4.5m-10.5-6h7.5m-7.5 3h7.5m-7.5 3h3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Margin Profit Utuh 100%</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Setiap rupiah dari transaksi langsung masuk ke rekening bank bisnis Anda. Bebas potongan
                            biaya admin bulanan dari pihak ketiga.
                        </p>
                    </div>

                    {{-- Benefit 2: Data Pelanggan --}}
                    <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="200">
                        <div
                            class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0v3.75" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Kepemilikan Data Pelanggan</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Dapatkan histori belanja, nama, alamat, nomor WhatsApp secara utuh untuk dianalisis dan
                            disimpan sebagai aset berharga jangka panjang.
                        </p>
                    </div>

                    {{-- Benefit 3: Pemasaran Ulang --}}
                    <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="300">
                        <div
                            class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-2.83C2.957 16.59 2 14.39 2 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Pemasaran Ulang Gratis</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Kirim info diskon, katalog baru, atau promo event bulanan langsung ke database pelanggan
                            Anda lewat WhatsApp tanpa harus bayar biaya iklan.
                        </p>
                    </div>

                    {{-- Benefit 4: Kredibilitas Brand --}}
                    <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="100">
                        <div
                            class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Kredibilitas Brand Naik Kelas</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Mempunyai alamat domain sendiri (contoh: brandanda.com) menaikkan wibawa dan positioning
                            brand Anda di mata calon pembeli &amp; investor.
                        </p>
                    </div>

                    {{-- Benefit 5: Bebas Blokir --}}
                    <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="200">
                        <div
                            class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Bebas Resiko Akun Diblokir</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Toko online Anda seutuhnya berada di bawah kendali Anda sendiri. Aman dari resiko penutupan
                            toko secara sepihak atau perubahan algoritma platform.
                        </p>
                    </div>

                    {{-- Benefit 6: SEO Organik --}}
                    <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-2xl p-8 hover:-translate-y-1 transition-all duration-300 group"
                        data-reveal data-delay="300">
                        <div
                            class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-100 mb-3 font-heading">Trafik Google Jangka Panjang</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed">
                            Website Anda dioptimalkan (SEO) agar muncul di halaman pertama pencarian Google. Potong
                            persaingan banting harga dengan kompetitor Anda.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        {{-- =========================================================
        SECTION 5: PROGRAMS
        ========================================================= --}}
        <section id="programs" class="py-24 relative bg-zinc-900/30" aria-label="Program START, GROW, SCALE, EMPIRE">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                {{-- Section Header --}}
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4"
                        data-reveal>
                        Program Akselerasi
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading"
                        data-reveal data-delay="100">
                        Pilih Fase Transformasi<br />
                        <span
                            class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Bisnis
                            Anda</span>
                    </h2>
                    <p class="text-zinc-400 text-lg" data-reveal data-delay="200">
                        Setiap fase bisnis memiliki tantangan berbeda. Pilih program akselerasi yang sesuai dengan skala
                        bisnis Anda saat ini.
                    </p>
                </div>

                @if(count($programs) > 0)
                    {{-- Loop dynamic data --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($programs as $program)
                            <div
                                class="card-program bg-zinc-950/80 border border-white/5 hover:border-indigo-500/20 rounded-3xl p-6 flex flex-col justify-between hover:-translate-y-1 transition-all duration-300 relative group">
                                @if($program->is_best_value)
                                    <div
                                        class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full text-[10px] font-bold tracking-widest uppercase text-white shadow-lg shadow-indigo-500/20">
                                        Recommended
                                    </div>
                                @endif

                                <div>
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-6 font-bold text-lg font-heading">
                                        {{ strtoupper($program->title[0]) }}
                                    </div>
                                    <h3 class="text-xl font-bold text-zinc-100 mb-2 font-heading">{{ $program->title }}</h3>
                                    <p class="text-xs text-indigo-400 font-medium mb-4">Target: {{ $program->target_market }}
                                    </p>
                                    <p class="text-zinc-400 text-sm leading-relaxed mb-6">{{ $program->short_description }}</p>

                                    @if(!empty($program->outcome))
                                        <div class="border-t border-white/5 pt-6">
                                            <p class="text-xs font-bold text-zinc-300 uppercase tracking-wider mb-4">Benefit
                                                Platform:</p>
                                            <ul class="space-y-2.5">
                                                @if(is_array($program->outcome))
                                                    @foreach($program->outcome as $item)
                                                        <li class="text-zinc-300 text-sm flex items-start gap-2.5 leading-relaxed">
                                                            @if(($item['icon'] ?? 'check') === 'check')
                                                                <span class="text-emerald-400 font-extrabold shrink-0">✓</span>
                                                            @else
                                                                <span class="text-red-400 font-extrabold shrink-0">✗</span>
                                                            @endif
                                                            <span>{{ $item['text'] ?? '' }}</span>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="text-zinc-300 text-sm flex items-start gap-2.5 leading-relaxed">
                                                        <span class="text-emerald-400 font-extrabold shrink-0">✓</span>
                                                        <span>{{ $program->outcome }}</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('program.show', $program->slug) }}"
                                    class="mt-8 w-full py-3 text-center bg-zinc-900 group-hover:bg-indigo-600 border border-white/5 group-hover:border-indigo-500 text-zinc-300 group-hover:text-white font-semibold text-sm rounded-xl transition-all duration-200">
                                    Detail Program →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Fallback: Beautiful static view --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        {{-- Program 1: START --}}
                        <div class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/25 rounded-3xl p-6 flex flex-col justify-between hover:-translate-y-1 transition-all duration-300 relative group"
                            data-reveal data-delay="100">
                            <div>
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-6 font-bold text-lg font-heading">
                                    S
                                </div>
                                <h3 class="text-xl font-bold text-zinc-100 mb-2 font-heading">START</h3>
                                <p class="text-xs text-indigo-400 font-medium mb-4">Target: Pemula / Brand Baru</p>
                                <p class="text-zinc-400 text-sm leading-relaxed mb-6">Validasi produk dan buat funnel
                                    penjualan online pertama Anda dengan struktur yang matang.</p>

                                <div class="border-t border-white/5 pt-6">
                                    <p class="text-xs font-bold text-zinc-300 uppercase tracking-wider mb-4">Benefit
                                        Platform:</p>
                                    <p class="text-zinc-300 text-sm font-medium mb-4 flex items-start gap-2">
                                        <span class="text-indigo-400">✨</span> Landing Page Konversi Tinggi &amp; Funnel
                                        WhatsApp Ready.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('program.show', 'start') }}"
                                class="mt-8 w-full py-3 text-center bg-zinc-900 group-hover:bg-indigo-600 border border-white/5 group-hover:border-indigo-500 text-zinc-300 group-hover:text-white font-semibold text-sm rounded-xl transition-all duration-200">
                                Detail Program →
                            </a>
                        </div>

                        {{-- Program 2: GROW --}}
                        <div class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/25 rounded-3xl p-6 flex flex-col justify-between hover:-translate-y-1 transition-all duration-300 relative group"
                            data-reveal data-delay="200">
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-full text-[10px] font-bold tracking-widest uppercase shadow-lg shadow-indigo-500/20 z-10">
                                Recommended
                            </div>
                            <div>
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-6 font-bold text-lg font-heading">
                                    G
                                </div>
                                <h3 class="text-xl font-bold text-zinc-100 mb-2 font-heading">GROW</h3>
                                <p class="text-xs text-indigo-400 font-medium mb-4">Target: Seller Ingin Mandiri</p>
                                <p class="text-zinc-400 text-sm leading-relaxed mb-6">Mulai berpindah dari marketplace ke
                                    website mandiri dengan sistem pembayaran terintegrasi.</p>

                                <div class="border-t border-white/5 pt-6">
                                    <p class="text-xs font-bold text-zinc-300 uppercase tracking-wider mb-4">Benefit
                                        Platform:</p>
                                    <p class="text-zinc-300 text-sm font-medium mb-4 flex items-start gap-2">
                                        <span class="text-indigo-400">✨</span> E-Commerce Lengkap, Payment Gateway, &amp;
                                        WhatsApp Automation.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('program.show', 'grow') }}"
                                class="mt-8 w-full py-3 text-center bg-zinc-900 group-hover:bg-indigo-600 border border-white/5 group-hover:border-indigo-500 text-zinc-300 group-hover:text-white font-semibold text-sm rounded-xl transition-all duration-200">
                                Detail Program →
                            </a>
                        </div>

                        {{-- Program 3: SCALE --}}
                        <div class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/25 rounded-3xl p-6 flex flex-col justify-between hover:-translate-y-1 transition-all duration-300 relative group"
                            data-reveal data-delay="300">
                            <div>
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-6 font-bold text-lg font-heading">
                                    S
                                </div>
                                <h3 class="text-xl font-bold text-zinc-100 mb-2 font-heading">SCALE</h3>
                                <p class="text-xs text-indigo-400 font-medium mb-4">Target: Brand Ingin Tumbuh</p>
                                <p class="text-zinc-400 text-sm leading-relaxed mb-6">Tingkatkan profit bisnis dengan
                                    automasi pemasaran, CRM, SEO, dan kurir otomatis.</p>

                                <div class="border-t border-white/5 pt-6">
                                    <p class="text-xs font-bold text-zinc-300 uppercase tracking-wider mb-4">Benefit
                                        Platform:</p>
                                    <p class="text-zinc-300 text-sm font-medium mb-4 flex items-start gap-2">
                                        <span class="text-indigo-400">✨</span> Sistem CRM, Optimasi SEO Google Rank 1, &amp;
                                        Kurir Pro.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('program.show', 'scale') }}"
                                class="mt-8 w-full py-3 text-center bg-zinc-900 group-hover:bg-indigo-600 border border-white/5 group-hover:border-indigo-500 text-zinc-300 group-hover:text-white font-semibold text-sm rounded-xl transition-all duration-200">
                                Detail Program →
                            </a>
                        </div>

                        {{-- Program 4: EMPIRE --}}
                        <div class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/25 rounded-3xl p-6 flex flex-col justify-between hover:-translate-y-1 transition-all duration-300 relative group"
                            data-reveal data-delay="400">
                            <div>
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-6 font-bold text-lg font-heading">
                                    E
                                </div>
                                <h3 class="text-xl font-bold text-zinc-100 mb-2 font-heading">EMPIRE</h3>
                                <p class="text-xs text-indigo-400 font-medium mb-4">Target: Penguasa Pasar / Enterprise</p>
                                <p class="text-zinc-400 text-sm leading-relaxed mb-6">Membangun ekosistem ERP mandiri untuk
                                    mengelola multi-warehouse dan custom mobile apps.</p>

                                <div class="border-t border-white/5 pt-6">
                                    <p class="text-xs font-bold text-zinc-300 uppercase tracking-wider mb-4">Benefit
                                        Platform:</p>
                                    <p class="text-zinc-300 text-sm font-medium mb-4 flex items-start gap-2">
                                        <span class="text-indigo-400">✨</span> Aplikasi Android &amp; iOS, Sistem ERP
                                        Kustom, &amp; Dedicated Support.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('program.show', 'empire') }}"
                                class="mt-8 w-full py-3 text-center bg-zinc-900 group-hover:bg-indigo-600 border border-white/5 group-hover:border-indigo-500 text-zinc-300 group-hover:text-white font-semibold text-sm rounded-xl transition-all duration-200">
                                Detail Program →
                            </a>
                        </div>

                    </div>
                @endif
            </div>
        </section>

        {{-- =========================================================
        SECTION 6: PORTFOLIO
        ========================================================= --}}
        {{-- =========================================================
        SECTION 6: PORTFOLIO
        ========================================================= --}}
        <section id="portfolio" class="py-24 relative" aria-label="Portfolio — Studi kasus klien Trinova Digital">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                {{-- Section Header --}}
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4"
                        data-reveal>
                        Studi Kasus Klien
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 font-heading"
                        data-reveal data-delay="100">
                        Bukti Nyata Hasil<br />
                        <span
                            class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Pertumbuhan
                            Bisnis</span>
                    </h2>
                    <p class="text-zinc-400 text-lg" data-reveal data-delay="200">
                        Bagaimana kami mendampingi seller bertransformasi dari ketergantungan penuh menjadi pemilik
                        brand mandiri dengan profit maksimal.
                    </p>
                </div>

                @if($portfolios->isNotEmpty())
                    {{-- Loop dynamic data --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        @foreach($portfolios as $portfolio)
                            <div
                                class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-center justify-between mb-6">
                                        <span
                                            class="text-xs font-bold text-indigo-400 uppercase tracking-wider">{{ $portfolio->industry }}</span>
                                        <span
                                            class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-bold rounded-full uppercase">{{ $portfolio->client_name }}</span>
                                    </div>

                                    <h3 class="text-xl font-bold text-zinc-100 mb-4 font-heading">{{ $portfolio->title }}</h3>

                                    <div class="space-y-4 mb-6">
                                        <div>
                                            <h4 class="text-xs font-bold text-red-400 uppercase">Masalah:</h4>
                                            <p class="text-zinc-300 text-sm mt-1">{{ $portfolio->problem }}</p>
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-bold text-indigo-400 uppercase">Solusi Trinova:</h4>
                                            <p class="text-zinc-300 text-sm mt-1">{{ $portfolio->solution }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-white/5 pt-6 mt-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-xs text-zinc-500 font-semibold">Hasil Akhir:</span>
                                        <span
                                            class="text-lg font-extrabold text-green-400 font-heading">{{ $portfolio->result }}</span>
                                    </div>
                                    @if(!empty($portfolio->website_url))
                                        <a href="{{ $portfolio->website_url }}" target="_blank" rel="noopener"
                                            class="inline-flex items-center gap-1 text-xs text-zinc-400 hover:text-indigo-400 transition-colors">
                                            Kunjungi Website
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Fallback: Beautiful static view --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        {{-- Case 1 --}}
                        <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group"
                            data-reveal data-delay="100">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Fashion
                                        Muslim</span>
                                    <span
                                        class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-bold rounded-full uppercase">Hijab
                                        Brand A</span>
                                </div>

                                <h3 class="text-xl font-bold text-zinc-100 mb-4 font-heading">Migrasi dari Marketplace ke
                                    Website Mandiri</h3>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <h4 class="text-xs font-bold text-red-400 uppercase">Masalah:</h4>
                                        <p class="text-zinc-300 text-sm mt-1">Biaya admin shopee memotong 8.5% keuntungan
                                            bersih &amp; perang harga tiada akhir.</p>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-indigo-400 uppercase">Solusi Trinova:</h4>
                                        <p class="text-zinc-300 text-sm mt-1">Membangun website e-commerce brand sendiri
                                            &amp; setup kampanye retensi via WhatsApp broadcast.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-white/5 pt-6 mt-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs text-zinc-500 font-semibold">Hasil Akhir:</span>
                                    <span class="text-lg font-extrabold text-green-400 font-heading">+42% Profit
                                        Bersih</span>
                                </div>
                                <span
                                    class="inline-flex items-center gap-1 text-xs text-zinc-400 hover:text-indigo-400 transition-colors cursor-pointer">
                                    Kunjungi Website
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        {{-- Case 2 --}}
                        <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group"
                            data-reveal data-delay="200">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <span
                                        class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Kitchenware</span>
                                    <span
                                        class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-bold rounded-full uppercase">Brand
                                        Peralatan Dapur B</span>
                                </div>

                                <h3 class="text-xl font-bold text-zinc-100 mb-4 font-heading">Otomatisasi CRM &amp;
                                    Pengumpulan Database</h3>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <h4 class="text-xs font-bold text-red-400 uppercase">Masalah:</h4>
                                        <p class="text-zinc-300 text-sm mt-1">Data pembeli ditutup platform. Tidak bisa
                                            follow up &amp; tingkat repeat order rendah.</p>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-indigo-400 uppercase">Solusi Trinova:</h4>
                                        <p class="text-zinc-300 text-sm mt-1">Website e-commerce kustom terintegrasi
                                            WhatsApp CRM otomatis pasca-transaksi.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-white/5 pt-6 mt-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs text-zinc-500 font-semibold">Hasil Akhir:</span>
                                    <span class="text-lg font-extrabold text-green-400 font-heading">2.4x Repeat Order
                                        Rate</span>
                                </div>
                                <span
                                    class="inline-flex items-center gap-1 text-xs text-zinc-400 hover:text-indigo-400 transition-colors cursor-pointer">
                                    Kunjungi Website
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        {{-- Case 3 --}}
                        <div class="bg-zinc-900/30 border border-white/5 hover:border-indigo-500/20 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group"
                            data-reveal data-delay="300">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Beauty
                                        Care</span>
                                    <span
                                        class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-bold rounded-full uppercase">Skincare
                                        Lokal C</span>
                                </div>

                                <h3 class="text-xl font-bold text-zinc-100 mb-4 font-heading">Optimasi SEO Pencarian Google
                                </h3>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <h4 class="text-xs font-bold text-red-400 uppercase">Masalah:</h4>
                                        <p class="text-zinc-300 text-sm mt-1">Biaya iklan berbayar (ads) melambung tinggi
                                            &amp; akun rentan dibatasi kompetitor.</p>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-indigo-400 uppercase">Solusi Trinova:</h4>
                                        <p class="text-zinc-300 text-sm mt-1">Pengembangan website dengan audit arsitektur
                                            SEO super-cepat &amp; content strategy.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-white/5 pt-6 mt-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs text-zinc-500 font-semibold">Hasil Akhir:</span>
                                    <span class="text-lg font-extrabold text-green-400 font-heading">50K+ Trafik
                                        Organik/Bln</span>
                                </div>
                                <span
                                    class="inline-flex items-center gap-1 text-xs text-zinc-400 hover:text-indigo-400 transition-colors cursor-pointer">
                                    Kunjungi Website
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </section>

        {{-- =========================================================
        SECTION 7: TESTIMONIALS & FAQ (Combined 50:50)
        ========================================================= --}}
        <section id="faq" class="py-24 relative overflow-hidden bg-zinc-900/10"
            aria-label="Testimoni dan FAQ Trinova Digital">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-start">

                    {{-- Column 1: FAQ Accordion (Left) --}}
                    <div class="space-y-8 w-full">
                        <div class="text-center">
                            <span
                                class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4"
                                data-reveal>
                                FAQ
                            </span>
                            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4 font-heading" data-reveal
                                data-delay="100">
                                Pertanyaan <span
                                    class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Umum</span>
                            </h2>
                            <p class="text-zinc-400 text-sm leading-relaxed" data-reveal data-delay="150">
                                Jawaban cepat mengenai estimasi waktu, kebutuhan teknis, dan langkah awal pengerjaan
                                aset digital Anda.
                            </p>
                        </div>

                        @if(count($faqs) > 0)
                            <div class="space-y-3 max-h-[320px] overflow-y-auto pr-2" data-reveal data-delay="200">
                                @foreach($faqs as $faq)
                                    <div x-data="{ open: false }"
                                        class="bg-zinc-900/30 border border-white/5 rounded-2xl overflow-hidden transition-all duration-200"
                                        :class="open ? 'border-indigo-500/30 bg-zinc-900/60' : ''">
                                        <button @click="open = !open"
                                            class="w-full flex items-center justify-between p-5 text-left"
                                            :aria-expanded="open.toString()">
                                            <span
                                                class="font-bold text-zinc-100 text-sm font-heading">{{ $faq->question }}</span>
                                            <span class="text-zinc-400 transition-transform duration-200"
                                                :class="open ? 'rotate-180 text-indigo-400' : ''">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                        </button>
                                        <div x-show="open" x-collapse x-transition:enter="transition-all ease-out duration-200"
                                            class="px-5 pb-5 text-zinc-400 text-xs sm:text-sm leading-relaxed border-t border-white/5 pt-3">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Fallback: Beautiful static accordion powered by Alpine.js --}}
                            <div class="space-y-3 max-h-[320px] overflow-y-auto pr-2" data-reveal data-delay="200">

                                {{-- FAQ Item 1 --}}
                                <div x-data="{ open: false }"
                                    class="bg-zinc-900/30 border border-white/5 rounded-2xl overflow-hidden transition-all duration-200"
                                    :class="open ? 'border-indigo-500/30 bg-zinc-900/60' : ''">
                                    <button @click="open = !open"
                                        class="w-full flex items-center justify-between p-5 text-left"
                                        :aria-expanded="open.toString()">
                                        <span class="font-bold text-zinc-100 text-sm font-heading">Berapa lama pengerjaan
                                            website &amp; sistemnya?</span>
                                        <span class="text-zinc-400 transition-transform duration-200"
                                            :class="open ? 'rotate-180 text-indigo-400' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="open" x-collapse x-transition:enter="transition-all ease-out duration-200"
                                        class="px-5 pb-5 text-zinc-400 text-xs sm:text-sm leading-relaxed border-t border-white/5 pt-3">
                                        Rata-rata pengerjaan berkisar antara 14 s.d. 30 hari kerja tergantung tingkat
                                        kompleksitas program yang Anda pilih (START, GROW, atau SCALE).
                                    </div>
                                </div>

                                {{-- FAQ Item 2 --}}
                                <div x-data="{ open: false }"
                                    class="bg-zinc-900/30 border border-white/5 rounded-2xl overflow-hidden transition-all duration-200"
                                    :class="open ? 'border-indigo-500/30 bg-zinc-900/60' : ''">
                                    <button @click="open = !open"
                                        class="w-full flex items-center justify-between p-5 text-left"
                                        :aria-expanded="open.toString()">
                                        <span class="font-bold text-zinc-100 text-sm font-heading">Apakah harus mengerti
                                            coding untuk mengelola website?</span>
                                        <span class="text-zinc-400 transition-transform duration-200"
                                            :class="open ? 'rotate-180 text-indigo-400' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="open" x-collapse x-transition:enter="transition-all ease-out duration-200"
                                        class="px-5 pb-5 text-zinc-400 text-xs sm:text-sm leading-relaxed border-t border-white/5 pt-3">
                                        Tidak perlu. Kami membangun sistem panel admin (CMS) yang user-friendly sehingga
                                        Anda bisa mengunggah produk, mengelola pesanan, dan mendownload database dengan
                                        mudah.
                                    </div>
                                </div>

                                {{-- FAQ Item 3 --}}
                                <div x-data="{ open: false }"
                                    class="bg-zinc-900/30 border border-white/5 rounded-2xl overflow-hidden transition-all duration-200"
                                    :class="open ? 'border-indigo-500/30 bg-zinc-900/60' : ''">
                                    <button @click="open = !open"
                                        class="w-full flex items-center justify-between p-5 text-left"
                                        :aria-expanded="open.toString()">
                                        <span class="font-bold text-zinc-100 text-sm font-heading">Bagaimana dengan
                                            kebutuhan domain dan hosting?</span>
                                        <span class="text-zinc-400 transition-transform duration-200"
                                            :class="open ? 'rotate-180 text-indigo-400' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="open" x-collapse x-transition:enter="transition-all ease-out duration-200"
                                        class="px-5 pb-5 text-zinc-400 text-xs sm:text-sm leading-relaxed border-t border-white/5 pt-3">
                                        Semua program kami sudah mencakup setup hosting premium berkecepatan tinggi dan
                                        pendaftaran domain (.com / .id) secara gratis untuk tahun pertama.
                                    </div>
                                </div>

                                {{-- FAQ Item 4 --}}
                                <div x-data="{ open: false }"
                                    class="bg-zinc-900/30 border border-white/5 rounded-2xl overflow-hidden transition-all duration-200"
                                    :class="open ? 'border-indigo-500/30 bg-zinc-900/60' : ''">
                                    <button @click="open = !open"
                                        class="w-full flex items-center justify-between p-5 text-left"
                                        :aria-expanded="open.toString()">
                                        <span class="font-bold text-zinc-100 text-sm font-heading">Apakah ada jaminan omzet
                                            bisnis saya akan langsung naik?</span>
                                        <span class="text-zinc-400 transition-transform duration-200"
                                            :class="open ? 'rotate-180 text-indigo-400' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="open" x-collapse x-transition:enter="transition-all ease-out duration-200"
                                        class="px-5 pb-5 text-zinc-400 text-xs sm:text-sm leading-relaxed border-t border-white/5 pt-3">
                                        Kami menjamin fungsi sistem 100%. Kenaikan omzet dipengaruhi product-market fit dan
                                        traffic. Kami membantu memformulasikan strategi promo &amp; penawaran konversi
                                        tinggi di website Anda.
                                    </div>
                                </div>

                                {{-- FAQ Item 5 --}}
                                <div x-data="{ open: false }"
                                    class="bg-zinc-900/30 border border-white/5 rounded-2xl overflow-hidden transition-all duration-200"
                                    :class="open ? 'border-indigo-500/30 bg-zinc-900/60' : ''">
                                    <button @click="open = !open"
                                        class="w-full flex items-center justify-between p-5 text-left"
                                        :aria-expanded="open.toString()">
                                        <span class="font-bold text-zinc-100 text-sm font-heading">Bagaimana langkah awal
                                            untuk memulainya?</span>
                                        <span class="text-zinc-400 transition-transform duration-200"
                                            :class="open ? 'rotate-180 text-indigo-400' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="open" x-collapse x-transition:enter="transition-all ease-out duration-200"
                                        class="px-5 pb-5 text-zinc-400 text-xs sm:text-sm leading-relaxed border-t border-white/5 pt-3">
                                        Cukup klik "Audit Bisnis Gratis", isi data tantangan utama bisnis Anda, dan
                                        jadwalkan konsultasi 1-on-1 bersama tim analis kami secara gratis.
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>

                    {{-- Column 2: Testimonials / Kata Klien Kami (Right) --}}
                    <div class="space-y-8 w-full text-center">
                        <div>
                            <span
                                class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-4"
                                data-reveal>
                                Kata Klien Kami
                            </span>
                            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4 font-heading" data-reveal
                                data-delay="100">
                                Meraih <span
                                    class="bg-gradient-to-r from-indigo-400 to-indigo-300 bg-clip-text text-transparent">Kebebasan
                                    Digital</span>
                            </h2>
                            <p class="text-zinc-400 text-sm leading-relaxed" data-reveal data-delay="150">
                                Cerita nyata para pemilik bisnis yang sukses membangun aset digital mandiri dan lepas
                                dari ketergantungan algoritma marketplace.
                            </p>
                        </div>

                        {{-- Carousel Container --}}
                        <div x-data="{ activeIndex: 0, totalSlides: {{ count($testimonials) > 0 ? count($testimonials) : 3 }} }"
                            class="relative" data-reveal data-delay="200">
                            {{-- Slides Wrapper --}}
                            <div
                                class="relative overflow-hidden rounded-3xl bg-zinc-950/70 border border-white/5 p-8 sm:p-10 min-h-[280px] flex flex-col justify-between">
                                <div class="absolute right-6 top-6 text-zinc-900 text-7xl font-serif select-none pointer-events-none"
                                    aria-hidden="true">
                                    "
                                </div>

                                @if(count($testimonials) > 0)
                                    @foreach($testimonials as $index => $t)
                                        <div x-show="activeIndex === {{ $index }}"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 translate-x-6"
                                            x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6" @if($index > 0)
                                            style="display: none;" @endif>
                                            <div class="flex items-center gap-1 text-amber-400">
                                                @for($i = 0; $i < $t->rating; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                        class="w-4 h-4">
                                                        <path fill-rule="evenodd"
                                                            d="M10.788 2.903a.75.75 0 0 1 1.424 0l2.082 5.006 5.428.113a.75.75 0 0 1 .416 1.357l-4.21 3.555 1.398 5.252a.75.75 0 0 1-1.093.846L12 16.006l-4.823 2.924a.75.75 0 0 1-1.093-.846l1.398-5.252-4.21-3.555a.75.75 0 0 1 .416-1.357l5.428-.113 2.082-5.006Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <blockquote class="text-sm sm:text-base text-zinc-200 leading-relaxed font-medium">
                                                "{{ $t->content }}"
                                            </blockquote>
                                            <div class="flex items-center gap-4 border-t border-white/5 pt-4">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center font-bold text-zinc-300 text-xs font-heading">
                                                    {{ strtoupper(substr($t->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <cite
                                                        class="not-italic font-bold text-zinc-100 text-xs block">{{ $t->name }}</cite>
                                                    <span class="text-[10px] text-zinc-500 mt-0.5">{{ $t->position }}
                                                        {{ $t->company ? '— ' . $t->company : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- Slide 1 --}}
                                    <div x-show="activeIndex === 0" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-x-6"
                                        x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6">
                                        <div class="flex items-center gap-1 text-amber-400">
                                            @for($i = 0; $i < 5; $i++) <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 2.903a.75.75 0 0 1 1.424 0l2.082 5.006 5.428.113a.75.75 0 0 1 .416 1.357l-4.21 3.555 1.398 5.252a.75.75 0 0 1-1.093.846L12 16.006l-4.823 2.924a.75.75 0 0 1-1.093-.846l1.398-5.252-4.21-3.555a.75.75 0 0 1 .416-1.357l5.428-.113 2.082-5.006Z"
                                                    clip-rule="evenodd" />
                                            </svg> @endfor
                                        </div>
                                        <blockquote class="text-sm sm:text-base text-zinc-200 leading-relaxed font-medium">
                                            "Sebelumnya kami pasrah dengan kenaikan biaya admin marketplace yang memotong
                                            margin hingga 10%. Setelah dibikinkan website oleh Trinova, sekarang repeat
                                            order pelanggan langsung lari ke web. Kami menghemat puluhan juta rupiah tiap
                                            bulan!"
                                        </blockquote>
                                        <div class="flex items-center gap-4 border-t border-white/5 pt-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center font-bold text-zinc-300 text-xs font-heading">
                                                AW
                                            </div>
                                            <div>
                                                <cite class="not-italic font-bold text-zinc-100 text-xs block">Andi
                                                    Wijaya</cite>
                                                <span class="text-[10px] text-zinc-500 mt-0.5">Owner — Hijab Brand A</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Slide 2 --}}
                                    <div x-show="activeIndex === 1" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-x-6"
                                        x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6"
                                        style="display: none;">
                                        <div class="flex items-center gap-1 text-amber-400">
                                            @for($i = 0; $i < 5; $i++) <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 2.903a.75.75 0 0 1 1.424 0l2.082 5.006 5.428.113a.75.75 0 0 1 .416 1.357l-4.21 3.555 1.398 5.252a.75.75 0 0 1-1.093.846L12 16.006l-4.823 2.924a.75.75 0 0 1-1.093-.846l1.398-5.252-4.21-3.555a.75.75 0 0 1 .416-1.357l5.428-.113 2.082-5.006Z"
                                                    clip-rule="evenodd" />
                                            </svg> @endfor
                                        </div>
                                        <blockquote class="text-sm sm:text-base text-zinc-200 leading-relaxed font-medium">
                                            "Masalah terbesar kami dulu adalah tidak tahu siapa pembeli kami karena data
                                            diblokir. Berkat solusi CRM dari Trinova, kami punya database 15.000+ pelanggan
                                            WhatsApp. Promo produk baru sekarang tinggal sekali klik tanpa bayar iklan!"
                                        </blockquote>
                                        <div class="flex items-center gap-4 border-t border-white/5 pt-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center font-bold text-zinc-300 text-xs font-heading">
                                                SR
                                            </div>
                                            <div>
                                                <cite class="not-italic font-bold text-zinc-100 text-xs block">Siti
                                                    Rahma</cite>
                                                <span class="text-[10px] text-zinc-500 mt-0.5">Marketing Director — Brand
                                                    Dapur B</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Slide 3 --}}
                                    <div x-show="activeIndex === 2" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-x-6"
                                        x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6"
                                        style="display: none;">
                                        <div class="flex items-center gap-1 text-amber-400">
                                            @for($i = 0; $i < 5; $i++) <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 2.903a.75.75 0 0 1 1.424 0l2.082 5.006 5.428.113a.75.75 0 0 1 .416 1.357l-4.21 3.555 1.398 5.252a.75.75 0 0 1-1.093.846L12 16.006l-4.823 2.924a.75.75 0 0 1-1.093-.846l1.398-5.252-4.21-3.555a.75.75 0 0 1 .416-1.357l5.428-.113 2.082-5.006Z"
                                                    clip-rule="evenodd" />
                                            </svg> @endfor
                                        </div>
                                        <blockquote class="text-sm sm:text-base text-zinc-200 leading-relaxed font-medium">
                                            "Akun toko kami di marketplace sempat dibekukan sepihak. Untung saat itu kami
                                            sudah punya website mandiri dari Trinova. Bisnis tetap jalan, orderan tetap
                                            masuk, dan kami menyadari pentingnya memiliki rumah digital sendiri."
                                        </blockquote>
                                        <div class="flex items-center gap-4 border-t border-white/5 pt-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center font-bold text-zinc-300 text-xs font-heading">
                                                BS
                                            </div>
                                            <div>
                                                <cite class="not-italic font-bold text-zinc-100 text-xs block">Budi
                                                    Santoso</cite>
                                                <span class="text-[10px] text-zinc-500 mt-0.5">Founder — Skincare Lokal
                                                    C</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            {{-- Slider Controls --}}
                            <div class="flex items-center justify-between mt-6">

                                {{-- Indicators --}}
                                <div class="flex gap-2">
                                    <template x-for="i in Array.from({length: totalSlides}, (_, index) => index)">
                                        <button @click="activeIndex = i"
                                            :class="activeIndex === i ? 'w-6 bg-indigo-500' : 'w-2 bg-zinc-800'"
                                            class="h-1.5 rounded-full transition-all duration-300"
                                            :aria-label="'Buka slide ' + (i + 1)">
                                        </button>
                                    </template>
                                </div>

                                {{-- Arrow Buttons --}}
                                <div class="flex gap-2">
                                    <button @click="activeIndex = (activeIndex - 1 + totalSlides) % totalSlides"
                                        class="w-8 h-8 rounded-full border border-white/5 hover:border-indigo-500/30 flex items-center justify-center text-zinc-400 hover:text-white hover:bg-zinc-900 transition-all duration-150"
                                        aria-label="Slide sebelumnya">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>
                                    <button @click="activeIndex = (activeIndex + 1) % totalSlides"
                                        class="w-8 h-8 rounded-full border border-white/5 hover:border-indigo-500/30 flex items-center justify-center text-zinc-400 hover:text-white hover:bg-zinc-900 transition-all duration-150"
                                        aria-label="Slide berikutnya">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </div>

                            </div>

                        </div> {{-- End Carousel Container --}}
                    </div> {{-- End Column 2 --}}
                </div> {{-- End Grid --}}
            </div> {{-- End Container --}}
        </section>

        {{-- =========================================================
        SECTION 9: FINAL CTA
        ========================================================= --}}
        <section id="cta-final" class="py-24 relative overflow-hidden" aria-label="CTA — {{ $setting->cta_title ?? 'Audit Bisnis Gratis' }}">

            {{-- Decorative Background Glows --}}
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/25 via-zinc-950/80 to-indigo-950/25"></div>
            <div
                class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-96 h-96 bg-amber-500/8 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 text-center">
                <div class="bg-zinc-950 border border-white/5 p-8 sm:p-16 rounded-3xl relative overflow-hidden shadow-2xl shadow-indigo-500/5"
                    data-reveal>

                    {{-- Grid Background Overlay --}}
                    <div
                        class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.01)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.01)_1px,transparent_1px)] bg-[size:48px_48px] pointer-events-none">
                    </div>

                    <div class="relative z-10">

                        {{-- Badge --}}
                        <span
                            class="inline-flex items-center gap-2 px-4 py-1.5 bg-amber-500/10 border border-amber-500/20 rounded-full text-xs font-semibold text-amber-400 uppercase tracking-widest mb-6">
                            Slot Terbatas (Hanya {{ $setting->audit_quota ?? 10 }} Brand per Bulan)
                        </span>

                        {{-- Headline --}}
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-6 font-heading">
                            {{ $setting->cta_title ?? 'Siap Lepas dari Ketergantungan Algoritma & Mulai Membangun Brand Mandiri Anda?' }}
                        </h2>

                        {{-- Subheadline --}}
                        <p class="text-zinc-400 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto mb-10">
                            {{ $setting->cta_description ?? 'Dapatkan evaluasi eksklusif 1-on-1 bersama tim analis senior Trinova Digital secara gratis. Cari tahu di mana potensi kebocoran margin keuntungan bisnis Anda hari ini.' }}
                        </p>

                        {{-- Action Button --}}
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="{{ route('audit.index') }}"
                                class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-zinc-900 font-bold text-lg rounded-full shadow-2xl shadow-amber-500/25 transition-all duration-200 hover:-translate-y-1 w-full sm:w-auto justify-center"
                                id="final-cta-btn">
                                {{ $setting->cta_button_text ?? 'Konsultasikan Gratis Bisnis Anda' }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>

                        {{-- Social Proof / Trust Element --}}
                        <p class="text-xs text-zinc-500 mt-6">
                            {{ $setting->cta_trust_text ?? 'Bergabung bersama 50+ seller marketplace yang telah sukses bertransformasi digital.' }}
                        </p>

                    </div>

                </div>
            </div>
        </section>

</x-layouts.app>