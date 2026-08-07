<x-layouts.app :seo="[
    'title'       => 'Pengajuan Berhasil — Trinova Digital',
    'description' => 'Terima kasih telah mengajukan Analisa Bisnis Gratis. Tim analis kami akan segera menghubungi Anda.',
    'canonical'   => route('home'),
]">

<section class="min-h-screen pt-24 pb-16 flex items-center relative overflow-hidden" aria-label="Pengajuan Berhasil">
    
    {{-- Decorative Backgrounds --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.12),transparent)]"></div>
    <div class="absolute top-1/4 left-10 w-80 h-80 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-10 w-80 h-80 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-xl mx-auto px-4 sm:px-6 relative z-10 w-full text-center">
        
        <div class="bg-zinc-950/90 border border-white/5 p-8 sm:p-12 rounded-3xl shadow-2xl shadow-indigo-500/5">
            
            {{-- Checkmark Icon --}}
            <div class="w-16 h-16 bg-green-500/10 border border-green-500/20 text-green-400 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-100 font-heading mb-4">
                Pengajuan Berhasil Dikirim!
            </h1>

            {{-- Message --}}
            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed mb-8">
                Terima kasih telah mengajukan Analisa Bisnis Gratis. Data Anda telah kami terima dengan aman. Tim analis senior Trinova Digital akan mempelajari profil toko Anda dan menghubungi Anda melalui WhatsApp dalam waktu maksimal 24 jam untuk menjadwalkan sesi konsultasi.
            </p>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center">
                
                {{-- Home --}}
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto px-6 py-3 border border-white/5 hover:border-indigo-500/30 text-zinc-400 hover:text-white font-bold text-sm rounded-xl transition-all">
                    Kembali ke Beranda
                </a>

                {{-- WhatsApp instant check --}}
                <a href="https://wa.me/{{ config('app.whatsapp', '628xxxxxxxxxx') }}?text=Halo%20Trinova%20Digital%2C%20saya%20baru%20saja%20mengisi%20form%20audit%20bisnis%20gratis%20dan%20ingin%20melakukan%20konfirmasi." 
                   target="_blank" 
                   rel="noopener"
                   class="w-full sm:w-auto px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition-all">
                    Hubungi WhatsApp Kami
                </a>

            </div>

        </div>

    </div>
</section>
</x-layouts.app>
