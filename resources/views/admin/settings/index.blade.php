<x-layouts.admin :title="'Pengaturan Website — CMS Admin'" :headerTitle="'Pengaturan Umum Website'">

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Identity & Contact --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest border-b border-zinc-800 pb-4">🏢 Identitas & Kontak Bisnis</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Nama Perusahaan</label>
                    <input type="text" name="company_name" value="{{ $setting->site_name ?? 'Omset Digital' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Email Kontak Utama</label>
                    <input type="email" name="contact_email" value="{{ $setting->email ?? 'halo@omsetdigital.com' }}" placeholder="halo@omsetdigital.com"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Nomor WhatsApp CS (Format: 628xxx)</label>
                    <input type="text" name="whatsapp_number" value="{{ $setting->whatsapp ?? '6281234567890' }}" placeholder="628xxxxxxxxxxxx"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Pesan Default WhatsApp</label>
                    <input type="text" name="whatsapp_message" value="{{ $setting->whatsapp_message ?? 'Halo Omset Digital, saya ingin konsultasi pembuatan toko online.' }}"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                
                {{-- Show/Hide WhatsApp Float Switch --}}
                <div class="md:col-span-2 flex items-center justify-between p-4 bg-zinc-900 border border-green-500/40 rounded-xl">
                    <div>
                        <label for="show_whatsapp_float" class="text-xs font-bold text-zinc-200 cursor-pointer">Icon Whatsapp</label>
                        <p class="text-[10px] text-zinc-500 mt-0.5">Pilih Show/Hide untuk mengontrol munculnya tombol WhatsApp melayang di halaman website.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="show_whatsapp_float" name="show_whatsapp_float" value="1"
                               {{ ($landingSetting->show_whatsapp_float ?? true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-zinc-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Instagram URL</label>
                    <input type="url" name="social_instagram" value="{{ $setting->instagram ?? '' }}" placeholder="https://instagram.com/..."
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">TikTok URL</label>
                    <input type="url" name="social_tiktok" value="{{ $setting->tiktok ?? '' }}" placeholder="https://tiktok.com/@..."
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">YouTube URL</label>
                    <input type="url" name="social_youtube" value="{{ $setting->youtube ?? '' }}" placeholder="https://youtube.com/@..."
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none transition-colors">
                </div>
            </div>
        </div>

        {{-- SEO Settings --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest border-b border-zinc-800 pb-4">🔍 Pengaturan SEO Global</h3>
            <div>
                <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Meta Title (Judul Tab Browser)</label>
                <input type="text" name="meta_title" value="{{ $setting->site_tagline ?? 'Website E-Commerce untuk UMKM | Omset Digital' }}"
                       class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Meta Description (Deskripsi Google)</label>
                <textarea name="meta_description" rows="3"
                          class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none resize-none transition-colors">Bangun website e-commerce dan toko online milik sendiri untuk bisnis Anda. Omset Digital membantu UMKM menjual produk, mengelola pesanan, membangun pelanggan, dan mengembangkan brand.</textarea>
            </div>
        </div>

        {{-- Tracking Scripts --}}
        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
            <h3 class="text-sm font-bold text-zinc-200 uppercase tracking-widest border-b border-zinc-800 pb-4">📊 Tracking & Analitik</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Google Analytics Measurement ID</label>
                    <input type="text" name="ga_id" value="" placeholder="G-XXXXXXXXXX"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none font-mono transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-wider mb-2">Meta Pixel ID (Facebook Ads)</label>
                    <input type="text" name="fb_pixel_id" value="" placeholder="123456789012345"
                           class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm placeholder-zinc-600 focus:outline-none font-mono transition-colors">
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl shadow transition-all duration-200 hover:-translate-y-0.5">
                💾 Simpan Semua Pengaturan
            </button>
        </div>

    </form>

</x-layouts.admin>
