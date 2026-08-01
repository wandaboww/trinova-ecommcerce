<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Admin Dashboard — Trinova Digital</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #09090b;
        }
    </style>
</head>
<body class="text-zinc-100 min-h-screen flex flex-col justify-between">

    {{-- Top Navbar --}}
    <header class="border-b border-zinc-800 bg-zinc-950/50 backdrop-blur px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center font-extrabold text-white text-xs">
                    T
                </div>
                <span class="font-bold text-zinc-200">Trinova <span class="text-indigo-400">CMS Admin</span></span>
            </div>
            <a href="/" class="text-xs text-zinc-500 hover:text-zinc-300 font-semibold transition-colors">
                Lihat Website →
            </a>
        </div>
    </header>

    {{-- Main Area --}}
    <main class="max-w-4xl mx-auto px-6 py-16 w-full flex-grow flex flex-col justify-center">
        
        <div class="bg-zinc-950 border border-zinc-900 p-8 sm:p-12 rounded-3xl text-center shadow-2xl relative overflow-hidden">
            
            {{-- Background grid effect --}}
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.005)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.005)_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                
                {{-- Badge --}}
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-[10px] font-bold text-indigo-400 uppercase tracking-widest">
                    CMS Active fallbacks
                </span>

                {{-- Headline --}}
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-heading">
                    CMS Admin Dashboard
                </h1>
                
                <p class="text-zinc-400 text-sm max-w-md mx-auto leading-relaxed">
                    Selamat datang di Panel Kontrol CMS Trinova Digital. Rute admin telah terdaftar sukses di file rute aplikasi.
                </p>

                {{-- Status Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 text-left">
                    
                    {{-- Card 1 --}}
                    <div class="bg-zinc-900/40 border border-zinc-800/60 p-5 rounded-2xl">
                        <span class="text-zinc-500 text-[10px] font-bold uppercase tracking-wider block">Total Program</span>
                        <span class="text-2xl font-extrabold text-zinc-200 mt-1 block">4 Layanan</span>
                    </div>

                    {{-- Card 2 --}}
                    <div class="bg-zinc-900/40 border border-zinc-800/60 p-5 rounded-2xl">
                        <span class="text-zinc-500 text-[10px] font-bold uppercase tracking-wider block">Kategori Blog</span>
                        <span class="text-2xl font-extrabold text-zinc-200 mt-1 block">3 Topik</span>
                    </div>

                    {{-- Card 3 --}}
                    <div class="bg-zinc-900/40 border border-zinc-800/60 p-5 rounded-2xl">
                        <span class="text-zinc-500 text-[10px] font-bold uppercase tracking-wider block">Integrasi Leads</span>
                        <span class="text-2xl font-extrabold text-zinc-200 mt-1 block">Aktif</span>
                    </div>

                </div>

            </div>

        </div>

    </main>

    {{-- Footer --}}
    <footer class="border-t border-zinc-900 py-6 text-center text-xs text-zinc-600">
        &copy; 2026 Trinova Digital. All rights reserved.
    </footer>

</body>
</html>
