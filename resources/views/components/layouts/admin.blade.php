<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CMS Admin — Omset Digital' }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #09090b;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="text-zinc-100 min-h-screen flex"
    x-data="{ sidebarOpen: localStorage.getItem('adminSidebarOpen') === 'false' ? false : true, loaded: false }"
    x-init="$watch('sidebarOpen', val => localStorage.setItem('adminSidebarOpen', val)); setTimeout(() => loaded = true, 50)">

    {{-- Sidebar Navigation --}}
    <aside
        class="w-64 bg-zinc-950 border-r border-zinc-800 flex flex-col justify-between shrink-0 fixed top-0 bottom-0 left-0 z-30"
        :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', loaded ? 'transition-transform duration-300' : '']">

        <div>
            {{-- Header Logo --}}
            <div class="px-6 py-6 border-b border-zinc-800/80 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center font-extrabold text-white text-xs">
                        O
                    </div>
                    <span class="font-extrabold text-zinc-100 text-sm tracking-tight">Omset <span
                            class="text-indigo-400">Admin</span></span>
                </a>
            </div>

            {{-- Navigation Menu --}}
            <nav class="p-4 space-y-1.5" aria-label="CMS Admin Menu">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    📊 Dashboard
                </a>

                {{-- Landing Manager --}}
                <a href="{{ route('admin.landing.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.landing.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    🏠 Kelola Landing
                </a>

                {{-- Program Manager --}}
                <a href="{{ route('admin.program.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.program.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    💼 Kelola Program
                </a>

                {{-- Portfolio Manager --}}
                <a href="{{ route('admin.portfolio.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.portfolio.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    📁 Kelola Portfolio
                </a>

                {{-- Blog Manager --}}
                <a href="{{ route('admin.blog.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.blog.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    📝 Kelola Blog
                </a>

                {{-- FAQ Manager --}}
                <a href="{{ route('admin.faq.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.faq.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    ❓ Kelola FAQ
                </a>

                {{-- Testimonial Manager --}}
                <a href="{{ route('admin.testimonial.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.testimonial.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    ⭐️ Kelola Testimoni
                </a>

                {{-- Leads Manager --}}
                <a href="{{ route('admin.leads.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.leads.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    📩 Kelola Leads (Audit)
                </a>

                {{-- Legal Manager --}}
                <a href="{{ route('admin.legal.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl transition-all duration-150 {{ request()->routeIs('admin.legal.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60' }}">
                    📜 Dokumen Legal
                </a>

            </nav>
        </div>

        {{-- Bottom Profile & Settings --}}
        <div class="p-4 border-t border-zinc-800/80 space-y-1">
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900/60 transition-all">
                ⚙️ Pengaturan Web
            </a>
            <a href="{{ route('logout') }}"
                class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold rounded-xl text-red-400 hover:text-red-300 hover:bg-red-500/5 transition-all">
                ↩ Keluar Dashboard
            </a>
        </div>

    </aside>

    {{-- Content Layout (Right) --}}
    <div class="flex-grow min-h-screen flex flex-col"
        :class="[sidebarOpen ? 'pl-64' : 'pl-0', loaded ? 'transition-all duration-300' : '']">

        {{-- Top Info Header --}}
        <header
            class="h-16 border-b border-zinc-800 bg-zinc-950/40 backdrop-blur px-8 flex items-center justify-between shrink-0 sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="text-zinc-400 hover:text-white focus:outline-none transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1
                    class="font-bold text-zinc-100 text-sm tracking-tight font-heading uppercase tracking-widest text-zinc-400 text-xs">
                    {{ $headerTitle ?? 'CMS Control Panel' }}
                </h1>
            </div>
            <div class="flex items-center gap-4 text-xs font-semibold">
                <span class="px-2.5 py-1 bg-green-500/10 text-green-400 rounded-full">Admin Mode</span>
                <span class="text-zinc-500">v1.0.0</span>
            </div>
        </header>

        {{-- Main Slots Container --}}
        <main class="p-8 flex-grow">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="border-t border-zinc-900 py-6 text-center text-[10px] text-zinc-600 shrink-0 bg-zinc-950/20">
            &copy; 2026 Omset Digital. CMS Dashboard System.
        </footer>

    </div>

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>