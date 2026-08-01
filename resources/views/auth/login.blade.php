<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Administrator Login — Trinova Digital</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #09090b;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-zinc-100 min-h-screen flex items-center justify-center relative overflow-hidden px-4">

    {{-- Dark Decorative Glows --}}
    <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-md bg-zinc-950/80 border border-zinc-900 rounded-3xl p-8 shadow-2xl relative z-10 backdrop-blur-md">
        
        {{-- Logo/Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex w-12 h-12 bg-indigo-600 rounded-2xl items-center justify-center font-extrabold text-white text-xl shadow-lg shadow-indigo-500/25 mb-4">
                T
            </div>
            <h2 class="text-xl font-bold text-zinc-100 tracking-tight font-heading">
                Trinova <span class="text-indigo-400">Admin</span>
            </h2>
            <p class="text-xs text-zinc-500 mt-2">Masuk untuk mengelola konten dan statistik platform</p>
        </div>

        {{-- Error Alerts --}}
        @if ($errors->any())
            <div class="mb-5 px-4 py-3 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-medium rounded-xl space-y-1">
                @foreach ($errors->all() as $error)
                    <p>⚠️ {{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="cth: admin@trinovadigital.com"
                       class="w-full px-4 py-3 bg-zinc-900/60 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
            </div>

            <div>
                <label for="password" class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••"
                       class="w-full px-4 py-3 bg-zinc-900/60 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 bg-zinc-900 border border-zinc-800 rounded focus:ring-0 text-indigo-600">
                    <span class="text-xs text-zinc-400">Ingat sesi saya</span>
                </label>
                <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Lupa sandi?</a>
            </div>

            <button type="submit"
                    class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 transition-all duration-200 hover:-translate-y-0.5 mt-2 flex items-center justify-center gap-2">
                🔒 Masuk ke Dashboard
            </button>
        </form>

        {{-- Footer --}}
        <div class="text-center mt-8 pt-6 border-t border-zinc-900">
            <a href="{{ route('home') }}" class="text-xs text-zinc-500 hover:text-zinc-300 transition-colors inline-flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12l7.5-7.5M21 12H3" />
                </svg>
                Kembali ke Beranda Utama
            </a>
        </div>

    </div>

</body>
</html>
