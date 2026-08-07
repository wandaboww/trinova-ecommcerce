<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- SEO Meta --}}
    <title>{{ $seo['title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Partner transformasi digital untuk seller marketplace dan UMKM Indonesia.' }}" />
    @if(!empty($seo['canonical']))
        <link rel="canonical" href="{{ $seo['canonical'] }}" />
    @else
        <link rel="canonical" href="{{ url()->current() }}" />
    @endif
    <meta name="robots" content="{{ $seo['robots'] ?? 'index, follow' }}" />

    {{-- Open Graph --}}
    <meta property="og:type"        content="{{ $seo['og_type'] ?? 'website' }}" />
    <meta property="og:url"         content="{{ url()->current() }}" />
    <meta property="og:title"       content="{{ $seo['og_title'] ?? $seo['title'] ?? config('app.name') }}" />
    <meta property="og:description" content="{{ $seo['og_description'] ?? $seo['description'] ?? '' }}" />
    <meta property="og:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}" />
    <meta property="og:locale"      content="id_ID" />
    <meta property="og:site_name"   content="{{ config('app.name') }}" />

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image" />
    <meta name="twitter:title"       content="{{ $seo['title'] ?? config('app.name') }}" />
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}" />
    <meta name="twitter:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}" />

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" />

    {{-- Vite Assets (Tailwind + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Schema.org --}}
    @stack('schema')
</head>

<body class="bg-zinc-950 text-zinc-100 antialiased overflow-x-hidden">

    {{-- Scroll Progress Bar --}}
    <div id="progressBar"
         class="fixed top-0 left-0 h-0.5 bg-gradient-to-r from-indigo-500 to-amber-400 z-50 transition-all duration-100"
         style="width: 0%"
         aria-hidden="true">
    </div>

    {{-- Navbar --}}
    <x-navbar />

    {{-- Main Content --}}
    <main id="main-content" role="main">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- WhatsApp Float --}}
    <x-whatsapp-float />

    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Page Scripts --}}
    @stack('scripts')

    {{-- Inline: Scroll progress + Year --}}
    <script>
        // Scroll progress bar
        window.addEventListener('scroll', function () {
            const scrollTop  = window.scrollY;
            const docHeight  = document.documentElement.scrollHeight - window.innerHeight;
            const pct        = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            const bar        = document.getElementById('progressBar');
            if (bar) bar.style.width = pct + '%';
        }, { passive: true });
    </script>

</body>
</html>
