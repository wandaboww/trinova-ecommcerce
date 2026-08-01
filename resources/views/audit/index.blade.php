<x-layouts.app :seo="[
    'title'       => 'Form Audit Bisnis Gratis — Trinova Digital',
    'description' => 'Isi data bisnis Anda untuk mendapatkan analisa eksklusif 1-on-1 bersama tim analis Trinova secara gratis.',
    'canonical'   => route('audit.index'),
]">

<section class="min-h-screen pt-24 pb-16 flex items-center relative overflow-hidden" aria-label="Form Audit Bisnis Gratis">
    
    {{-- Decorative Backgrounds --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(99,102,241,0.12),transparent)]"></div>
    <div class="absolute top-1/4 left-10 w-80 h-80 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-10 w-80 h-80 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 relative z-10 w-full">
        
        {{-- Card Wrapper --}}
        <div class="bg-zinc-950/90 border border-white/5 p-8 sm:p-12 rounded-3xl shadow-2xl shadow-indigo-500/5"
             x-data="{ 
                step: 1, 
                formData: {
                    name: '',
                    phone: '',
                    email: '',
                    company: '',
                    business_type: '',
                    marketplace: '',
                    monthly_revenue: '',
                    team_size: '',
                    message: ''
                },
                validateStep1() {
                    return this.formData.name.trim() !== '' && this.formData.phone.trim() !== '';
                },
                validateStep2() {
                    return this.formData.business_type !== '' && this.formData.marketplace !== '' && this.formData.monthly_revenue !== '';
                },
                validateStep3() {
                    return this.formData.message.trim() !== '';
                }
             }">

            {{-- Form Header --}}
            <div class="text-center mb-8">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-[10px] font-bold text-amber-400 uppercase tracking-widest mb-4">
                    1-on-1 Consultation
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-100 font-heading">
                    Ajukan Audit Bisnis Gratis
                </h1>
                <p class="text-xs sm:text-sm text-zinc-500 mt-2 max-w-md mx-auto">
                    Bantu kami memahami kondisi bisnis Anda saat ini agar sesi konsultasi berjalan lebih optimal.
                </p>
            </div>

            {{-- Step Indicator --}}
            <div class="flex items-center justify-between mb-10 relative max-w-md mx-auto">
                <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-0.5 bg-zinc-800 pointer-events-none"></div>
                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-indigo-500 transition-all duration-300 pointer-events-none"
                     :style="'width: ' + ((step - 1) * 50) + '%'"></div>

                {{-- Step 1 Indicator --}}
                <button @click="if(step > 1) step = 1" 
                        class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs z-10 transition-all duration-300"
                        :class="step >= 1 ? 'bg-indigo-600 text-white ring-4 ring-indigo-500/20' : 'bg-zinc-800 text-zinc-500'">
                    1
                </button>
                
                {{-- Step 2 Indicator --}}
                <button @click="if(step > 2 && validateStep1()) step = 2" 
                        class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs z-10 transition-all duration-300"
                        :class="step >= 2 ? 'bg-indigo-600 text-white ring-4 ring-indigo-500/20' : 'bg-zinc-800 text-zinc-500'"
                        :disabled="!validateStep1()">
                    2
                </button>
                
                {{-- Step 3 Indicator --}}
                <button class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs z-10 transition-all duration-300"
                        :class="step >= 3 ? 'bg-indigo-600 text-white ring-4 ring-indigo-500/20' : 'bg-zinc-800 text-zinc-500'"
                        :disabled="!validateStep2()">
                    3
                </button>
            </div>

            {{-- Validation Errors (Laravel fallback) --}}
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl mb-6">
                    <ul class="list-disc list-inside text-xs text-red-400 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Form Action --}}
            <form action="{{ route('audit.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- STEP 1: Profil Pengguna & Bisnis --}}
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-200" class="space-y-5">
                    
                    <div>
                        <label for="name" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" x-model="formData.name" required
                               placeholder="Contoh: Andi Wijaya"
                               class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-200 placeholder-zinc-600 focus:outline-none transition-colors">
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" id="phone" x-model="formData.phone" required
                               placeholder="Contoh: 081234567890"
                               class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-200 placeholder-zinc-600 focus:outline-none transition-colors">
                        <span class="text-[10px] text-zinc-500 mt-1 block">Pastikan nomor aktif untuk keperluan konfirmasi jadwal konsultasi.</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Alamat Email (Opsional)</label>
                            <input type="email" name="email" id="email" x-model="formData.email"
                                   placeholder="Contoh: andi@gmail.com"
                                   class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-200 placeholder-zinc-600 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label for="company" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Nama Brand / Bisnis (Opsional)</label>
                            <input type="text" name="company" id="company" x-model="formData.company"
                                   placeholder="Contoh: Hijab Cantik ID"
                                   class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-200 placeholder-zinc-600 focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="button" @click="step = 2" :disabled="!validateStep1()"
                                class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-500 disabled:opacity-50 disabled:pointer-events-none text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition-all duration-200">
                            Lanjut ke Informasi Bisnis
                        </button>
                    </div>

                </div>

                {{-- STEP 2: Skala Bisnis & Platform --}}
                <div x-show="step === 2" x-transition:enter="transition ease-out duration-200" class="space-y-5" style="display: none;">
                    
                    <div>
                        <label for="business_type" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Kategori / Kategori Bisnis Anda <span class="text-red-500">*</span></label>
                        <select name="business_type" id="business_type" x-model="formData.business_type" required
                                class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-300 focus:outline-none transition-colors">
                            <option value="">Pilih Jenis Bisnis</option>
                            <option value="Fashion / Pakaian">Fashion / Pakaian</option>
                            <option value="Kuliner / F&B">Kuliner / F&B</option>
                            <option value="Kosmetik / Skincare">Kosmetik / Skincare</option>
                            <option value="Rumah Tangga / Kitchenware">Rumah Tangga / Kitchenware</option>
                            <option value="Elektronik / Gadget">Elektronik / Gadget</option>
                            <option value="Lainnya">Kategori Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="marketplace" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Platform Marketplace Utama <span class="text-red-500">*</span></label>
                        <select name="marketplace" id="marketplace" x-model="formData.marketplace" required
                                class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-300 focus:outline-none transition-colors">
                            <option value="">Pilih Platform Utama</option>
                            <option value="Shopee">Shopee</option>
                            <option value="Tokopedia">Tokopedia</option>
                            <option value="TikTok Shop">TikTok Shop</option>
                            <option value="Lazada">Lazada</option>
                            <option value="Instagram / WhatsApp Direct">Instagram / WhatsApp Direct</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="monthly_revenue" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Estimasi Omzet Bulanan <span class="text-red-500">*</span></label>
                            <select name="monthly_revenue" id="monthly_revenue" x-model="formData.monthly_revenue" required
                                    class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-300 focus:outline-none transition-colors">
                                <option value="">Pilih Omzet</option>
                                <option value="< Rp 10 Juta">Di bawah Rp 10 Juta</option>
                                <option value="Rp 10 - 50 Juta">Rp 10 Juta - Rp 50 Juta</option>
                                <option value="Rp 50 - 100 Juta">Rp 50 Juta - Rp 100 Juta</option>
                                <option value="Rp 100 - 500 Juta">Rp 100 Juta - Rp 500 Juta</option>
                                <option value="> Rp 500 Juta">Di atas Rp 500 Juta</option>
                            </select>
                        </div>
                        <div>
                            <label for="team_size" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Jumlah Tim / Karyawan (Opsional)</label>
                            <select name="team_size" id="team_size" x-model="formData.team_size"
                                    class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-300 focus:outline-none transition-colors">
                                <option value="">Pilih Jumlah Tim</option>
                                <option value="Solo (1 Orang)">Solo (1 Orang)</option>
                                <option value="2 - 5 Orang">2 - 5 Orang</option>
                                <option value="6 - 15 Orang">6 - 15 Orang</option>
                                <option value="> 15 Orang">Di atas 15 Orang</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="button" @click="step = 1"
                                class="w-1/3 py-3.5 border border-white/5 hover:border-white/10 text-zinc-400 hover:text-white font-bold text-sm rounded-xl transition-all">
                            Kembali
                        </button>
                        <button type="button" @click="step = 3" :disabled="!validateStep2()"
                                class="w-2/3 py-3.5 bg-indigo-600 hover:bg-indigo-500 disabled:opacity-50 disabled:pointer-events-none text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition-all duration-200">
                            Lanjut ke Tantangan
                        </button>
                    </div>

                </div>

                {{-- STEP 3: Masalah Terbesar & Submit --}}
                <div x-show="step === 3" x-transition:enter="transition ease-out duration-200" class="space-y-5" style="display: none;">
                    
                    <div>
                        <label for="message" class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Tantangan atau Masalah Utama Bisnis Anda Saat Ini <span class="text-red-500">*</span></label>
                        <textarea name="message" id="message" x-model="formData.message" required rows="5"
                                  placeholder="Contoh: Omzet naik tapi keuntungan tergerus biaya admin Shopee yang terus naik, tidak punya database pembeli untuk diajak repeat order, atau sering perang harga dengan kompetitor..."
                                  class="w-full bg-zinc-900 border border-white/5 focus:border-indigo-500 rounded-xl px-4 py-3 text-sm text-zinc-200 placeholder-zinc-600 focus:outline-none focus:ring-0 transition-colors"></textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="button" @click="step = 2"
                                class="w-1/3 py-3.5 border border-white/5 hover:border-white/10 text-zinc-400 hover:text-white font-bold text-sm rounded-xl transition-all">
                            Kembali
                        </button>
                        <button type="submit" :disabled="!validateStep3()"
                                class="w-2/3 py-3.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-zinc-900 font-bold text-sm rounded-xl shadow-lg shadow-amber-500/20 disabled:opacity-50 disabled:pointer-events-none transition-all duration-200">
                            Ajukan Audit Bisnis Sekarang
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>
</section>
</x-layouts.app>
