<x-layouts.admin :title="'Kelola Landing Page — CMS Admin'" :headerTitle="'Kelola Konten Landing Page'">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.landing.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Hero Section --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest border-b border-zinc-800 pb-4">✨ Hero Section</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Badge / Label Atas Hero</label>
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="show_hero_badge" value="1" class="sr-only peer" {{ ($landingSetting->show_hero_badge ?? true) ? 'checked' : '' }}>
                            <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                            <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                        </label>
                    </div>
                    <input type="text" name="hero_badge" value="{{ $landingSetting->hero_badge ?? 'Partner Transformasi Digital' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Sub-Headline Warna</label>
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="show_hero_subtitle" value="1" class="sr-only peer" {{ ($landingSetting->show_hero_subtitle ?? true) ? 'checked' : '' }}>
                            <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                            <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                        </label>
                    </div>
                    <input type="text" name="hero_sub" value="{{ $landingSetting->hero_subtitle ?? 'Tapi margin terasa jalan di tempat?' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Headline Utama (Baris Pertama)</label>
                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="show_hero_title" value="1" class="sr-only peer" {{ ($landingSetting->show_hero_title ?? true) ? 'checked' : '' }}>
                        <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                        <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                    </label>
                </div>
                <input type="text" name="hero_headline" value="{{ $landingSetting->hero_title ?? 'Order makin ramai...' }}"
                       class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Deskripsi Singkat Hero</label>
                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="show_hero_description" value="1" class="sr-only peer" {{ ($landingSetting->show_hero_description ?? true) ? 'checked' : '' }}>
                        <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                        <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                    </label>
                </div>
                <textarea name="hero_description" rows="3"
                          class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors resize-none">{{ $landingSetting->pain_description ?? 'Marketplace membantu Anda mendapatkan pelanggan. Website membantu Anda memiliki pelanggan. Trinova membantu Anda membangun keduanya.' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Teks Tombol CTA Utama</label>
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="show_hero_cta_primary" value="1" class="sr-only peer" {{ ($landingSetting->show_hero_cta_primary ?? true) ? 'checked' : '' }}>
                            <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                            <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                        </label>
                    </div>
                    <input type="text" name="hero_cta_primary" value="{{ $landingSetting->hero_cta ?? 'Analisa Bisnis Gratis' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Teks Tombol CTA Sekunder</label>
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="show_hero_cta_secondary" value="1" class="sr-only peer" {{ ($landingSetting->show_hero_cta_secondary ?? true) ? 'checked' : '' }}>
                            <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                            <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                        </label>
                    </div>
                    <input type="text" name="hero_cta_secondary" value="{{ $landingSetting->hero_cta_secondary ?? 'Lihat Portofolio Klien' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
            </div>
        </div>

        {{-- Statistics/Metrics --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
            <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
                <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest">📊 Statistik Kredibilitas</h3>
                <label class="relative inline-flex items-center cursor-pointer select-none">
                    <input type="checkbox" name="show_statistics" value="1" class="sr-only peer" {{ ($landingSetting->show_statistics ?? true) ? 'checked' : '' }}>
                    <div class="w-8 h-4 bg-zinc-800 rounded-full peer peer-checked:bg-indigo-600 transition-colors relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-100 after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                    <span class="ml-2 text-[9px] font-bold text-zinc-500 uppercase tracking-wider">Tampilkan</span>
                </label>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Klien Aktif</label>
                    <input type="text" name="stat_clients" value="{{ $landingSetting->stat_clients ?? '150+' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Rata-Rata Kenaikan Omzet</label>
                    <input type="text" name="stat_growth" value="{{ $landingSetting->stat_growth ?? '3.2x' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Kuota Audit Tersisa Bulan Ini</label>
                    <input type="number" name="audit_quota" value="{{ $landingSetting->audit_quota ?? 10 }}" min="0" max="100"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                </div>
            </div>
        </div>

        {{-- WhatsApp CTA --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-5">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest border-b border-zinc-800 pb-4">💬 WhatsApp & Kontak</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Nomor WhatsApp CS (Format: 628xxx)</label>
                    <input type="text" name="whatsapp_number" value="{{ $generalSetting->whatsapp ?? '6281234567890' }}" placeholder="628xxxxxxxxxxxx"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Pesan Default WhatsApp</label>
                    <input type="text" name="whatsapp_message" value="{{ $landingSetting->whatsapp_message ?? 'Halo Trinova Digital, saya ingin konsultasi strategi bisnis.' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
            </div>
        </div>

        {{-- CTA Final Section --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest border-b border-zinc-800 pb-4">🚀 Section CTA Final (Bagian Bawah)</h3>

            <div>
                <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Headline CTA Final</label>
                <input type="text" name="cta_title" value="{{ $landingSetting->cta_title ?? 'Siap Lepas dari Ketergantungan Algoritma & Mulai Membangun Brand Mandiri Anda?' }}"
                       class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Deskripsi / Subheadline CTA Final</label>
                <textarea name="cta_description" rows="3"
                          class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors resize-none">{{ $landingSetting->cta_description ?? 'Dapatkan evaluasi eksklusif 1-on-1 bersama tim analis senior Trinova Digital secara gratis. Cari tahu di mana potensi kebocoran margin keuntungan bisnis Anda hari ini.' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Teks Tombol CTA Final</label>
                    <input type="text" name="cta_button_text" value="{{ $landingSetting->cta_button_text ?? 'Konsultasikan Gratis Bisnis Anda' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Teks Kepercayaan / Social Proof</label>
                    <input type="text" name="cta_trust_text" value="{{ $landingSetting->cta_trust_text ?? 'Bergabung bersama 50+ seller marketplace yang telah sukses bertransformasi digital.' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 transition-all duration-200 hover:-translate-y-0.5">
                💾 Simpan Perubahan Landing Page
            </button>
        </div>

    </form>

</x-layouts.admin>
