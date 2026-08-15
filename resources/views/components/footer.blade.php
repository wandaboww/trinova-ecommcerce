<footer class="bg-zinc-900 border-t border-white/5 pt-16 pb-8" role="contentinfo" id="footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 mb-12">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-4" aria-label="Trinova Digital">
                    <div
                        class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl flex items-center justify-center font-extrabold text-sm text-white">
                        T</div>
                    <span class="font-extrabold text-lg tracking-tight text-zinc-100">Trinova<span
                            class="text-indigo-400">Digital</span></span>
                </a>
                <p class="text-sm text-zinc-500 leading-relaxed max-w-xs mb-6">
                    Partner transformasi digital untuk seller marketplace dan UMKM Indonesia.
                    Dari marketplace, menuju brand mandiri yang Anda miliki sepenuhnya.
                </p>
                <div class="flex gap-3" aria-label="Media sosial Trinova Digital">
                    <a href="https://tiktok.com/@trinova.id"
                        class="w-9 h-9 rounded-lg bg-zinc-800 border border-white/6 flex items-center justify-center text-zinc-500 hover:border-indigo-500 hover:text-indigo-400 transition-all duration-150"
                        target="_blank" rel="noopener" aria-label="TikTok" id="footer-tiktok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.86a8.27 8.27 0 004.84 1.55V7A4.85 4.85 0 0119.59 6.69z" />
                        </svg>
                    </a>
                    <a href="https://instagram.com/trinova.id"
                        class="w-9 h-9 rounded-lg bg-zinc-800 border border-white/6 flex items-center justify-center text-zinc-500 hover:border-indigo-500 hover:text-indigo-400 transition-all duration-150"
                        target="_blank" rel="noopener" aria-label="Instagram" id="footer-instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Layanan --}}
            <div>
                <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Layanan</h3>
                <ul class="flex flex-col gap-3" role="list">
                    <li><a href="{{ route('program.show', 'start') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-program-start">Program START</a></li>
                    <li><a href="{{ route('program.show', 'grow') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-program-grow">Program GROW</a></li>
                    <li><a href="{{ route('program.show', 'scale') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-program-scale">Program SCALE</a></li>
                    <li><a href="{{ route('program.show', 'empire') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-program-empire">Program EMPIRE</a></li>
                    @php
                        $footerSetting = \App\Models\LandingSetting::first();
                    @endphp
                    <li><a href="{{ route('audit.index') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-audit">{{ $footerSetting->hero_cta ?? 'Analisa Bisnis Gratis' }}</a></li>
                </ul>
            </div>

            {{-- Informasi --}}
            <div>
                <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Informasi</h3>
                <ul class="flex flex-col gap-3" role="list">
                    <li><a href="{{ route('home') }}#portfolio"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-portfolio">Portfolio</a></li>
                    <li><a href="{{ route('blog.index') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-blog">Blog</a></li>
                    <li><a href="{{ route('home') }}#faq"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors" id="footer-faq">FAQ</a>
                    </li>
                    <li><a href="{{ route('contact.index') }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors"
                            id="footer-kontak">Kontak</a></li>
                </ul>
            </div>

            {{-- Legal --}}
            <div>
                <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">LEGAL</h3>
                <ul class="flex flex-col gap-3" role="list">
                    <li><a href="{{ route('privacy') }}"
                            class="text-sm {{ request()->routeIs('privacy') ? 'text-indigo-400 font-semibold' : 'text-zinc-500 hover:text-zinc-200' }} transition-colors"
                            id="footer-privacy">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('terms') }}"
                            class="text-sm {{ request()->routeIs('terms') ? 'text-indigo-400 font-semibold' : 'text-zinc-500 hover:text-zinc-200' }} transition-colors"
                            id="footer-terms">Syarat &amp; Ketentuan</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Kontak</h3>
                <ul class="flex flex-col gap-3" role="list">
                    <li>
                        @php
                            $footerGen = \App\Models\Setting::first();
                            $footerLand = \App\Models\LandingSetting::first();
                            $footerRawPhone = $footerGen->whatsapp ?? $footerGen->phone ?? config('app.whatsapp', '6281234567890');
                            $footerWaNum = preg_replace('/[^0-9]/', '', $footerRawPhone);
                            if (str_starts_with($footerWaNum, '0')) {
                                $footerWaNum = '62' . substr($footerWaNum, 1);
                            }
                            $footerWaMsg = $footerLand->whatsapp_message ?? $footerGen->whatsapp_message ?? 'Halo Trinova Digital, saya ingin konsultasi strategi bisnis.';
                        @endphp
                        <a href="https://wa.me/{{ $footerWaNum }}?text={{ urlencode($footerWaMsg) }}"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors" target="_blank"
                            rel="noopener" id="footer-wa-link">
                            💬 WhatsApp
                        </a>
                    </li>
                    <li>
                        <a href="mailto:halo@trinova.id"
                            class="text-sm text-zinc-500 hover:text-zinc-200 transition-colors" id="footer-email-link">
                            ✉️ halo@trinova.id
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="pt-8 border-t border-white/5 flex flex-col items-center justify-center text-center gap-4">
            <p class="text-xs text-zinc-600">
                &copy; {{ date('Y') }} Trinova Digital. Hak cipta dilindungi.
            </p>
        </div>

    </div>
</footer>