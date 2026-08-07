<header x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 40, { passive: true })"
        :class="scrolled ? 'bg-zinc-950/90 backdrop-blur-xl border-b border-white/5 shadow-xl py-3' : 'py-5'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        role="banner"
        id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between gap-8">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 shrink-0"
               aria-label="Trinova Digital - Beranda">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl flex items-center justify-center font-extrabold text-sm text-white shadow-lg shadow-indigo-500/25">
                    T
                </div>
                <span class="font-extrabold text-lg tracking-tight text-zinc-100 font-heading">
                    Trinova<span class="text-indigo-400">Digital</span>
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1" aria-label="Navigasi utama">
                <a href="{{ route('home') }}#pain"
                   class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-zinc-100 hover:bg-indigo-500/8 rounded-lg transition-all duration-150"
                   id="nav-masalah">Masalah</a>
                <a href="{{ route('home') }}#solution"
                   class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-zinc-100 hover:bg-indigo-500/8 rounded-lg transition-all duration-150"
                   id="nav-solusi">Solusi</a>
                <a href="{{ route('home') }}#programs"
                   class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-zinc-100 hover:bg-indigo-500/8 rounded-lg transition-all duration-150"
                   id="nav-program">Program</a>
                <a href="{{ route('home') }}#portfolio"
                   class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-zinc-100 hover:bg-indigo-500/8 rounded-lg transition-all duration-150"
                   id="nav-portfolio">Portfolio</a>
                <a href="{{ route('home') }}#faq"
                   class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-zinc-100 hover:bg-indigo-500/8 rounded-lg transition-all duration-150"
                   id="nav-faq">FAQ</a>
                <a href="{{ route('blog.index') }}"
                   class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-zinc-100 hover:bg-indigo-500/8 rounded-lg transition-all duration-150 {{ request()->routeIs('blog.*') ? 'text-zinc-100 bg-indigo-500/8' : '' }}"
                   id="nav-blog">Blog</a>
            </nav>
 
            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-3 shrink-0">
                @php
                    $navSetting = \App\Models\LandingSetting::first();
                @endphp
                <a href="{{ route('audit.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-semibold text-sm rounded-full shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-200 hover:-translate-y-0.5"
                   id="navbar-audit-cta">
                    {{ $navSetting->hero_cta ?? 'Analisa Bisnis Gratis' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
 
            {{-- Mobile Hamburger --}}
            <button @click="open = !open"
                    :aria-expanded="open.toString()"
                    class="lg:hidden p-2 text-zinc-400 hover:text-zinc-100 transition-colors"
                    aria-label="Buka menu navigasi"
                    id="hamburgerBtn">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
 
        </div>
 
        {{-- Mobile Menu --}}
        <nav x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden mt-3 flex flex-col gap-1 p-4 bg-zinc-900 border border-white/6 rounded-2xl"
             aria-label="Navigasi mobile"
             id="mobileMenu">
            <a href="{{ route('home') }}#pain"     @click="open=false" class="px-4 py-3 text-sm font-medium text-zinc-400 hover:text-zinc-100 rounded-lg transition-colors" id="mobile-nav-masalah">Masalah</a>
            <a href="{{ route('home') }}#solution" @click="open=false" class="px-4 py-3 text-sm font-medium text-zinc-400 hover:text-zinc-100 rounded-lg transition-colors" id="mobile-nav-solusi">Solusi</a>
            <a href="{{ route('home') }}#programs" @click="open=false" class="px-4 py-3 text-sm font-medium text-zinc-400 hover:text-zinc-100 rounded-lg transition-colors" id="mobile-nav-program">Program</a>
            <a href="{{ route('home') }}#portfolio" @click="open=false" class="px-4 py-3 text-sm font-medium text-zinc-400 hover:text-zinc-100 rounded-lg transition-colors" id="mobile-nav-portfolio">Portfolio</a>
            <a href="{{ route('home') }}#faq"      @click="open=false" class="px-4 py-3 text-sm font-medium text-zinc-400 hover:text-zinc-100 rounded-lg transition-colors" id="mobile-nav-faq">FAQ</a>
            <a href="{{ route('blog.index') }}"    @click="open=false" class="px-4 py-3 text-sm font-medium text-zinc-400 hover:text-zinc-100 rounded-lg transition-colors" id="mobile-nav-blog">Blog</a>
            <a href="{{ route('audit.index') }}"
               class="mt-2 px-4 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold text-sm rounded-xl text-center"
               id="mobile-audit-cta">
                {{ $navSetting->hero_cta ?? 'Analisa Bisnis Gratis' }} →
            </a>
        </nav>

    </div>
</header>
