<x-layouts.app :seo="[
    'title' => 'Kebijakan Privasi | Trinova Digital',
    'description' => 'Kebijakan Privasi Trinova Digital yang menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi pengguna.',
    'canonical' => route('privacy'),
]">

    {{-- Header Section (Simple & Legal Clean) --}}
    <section class="pt-32 pb-12 relative overflow-hidden bg-zinc-950 border-b border-white/5" aria-label="Header Kebijakan Privasi">
        {{-- Subtle Background Glow --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_60%_at_50%_-20%,rgba(99,102,241,0.12),transparent)] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="w-full flex items-center justify-between mb-8 sm:mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-xs font-semibold text-indigo-400 uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    Dokumen Legal Resmi
                </div>
                <div class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-zinc-500 bg-zinc-900/80 px-3.5 py-1.5 rounded-lg border border-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Terakhir diperbarui: <span class="text-zinc-300 font-semibold">8 Agustus 2026</span>
                </div>
            </div>
            <div class="max-w-3xl mx-auto text-center flex flex-col items-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-zinc-100 font-heading mb-4">
                    Kebijakan Privasi
                </h1>
                <p class="text-zinc-400 text-base sm:text-lg leading-relaxed mb-6 text-center">
                    Kami menghargai privasi Anda. Halaman ini menjelaskan bagaimana Trinova Digital mengumpulkan, menggunakan, menyimpan, dan melindungi informasi yang diberikan ketika Anda menggunakan website dan layanan kami.
                </p>
            </div>
        </div>
    </section>

    {{-- Main Document Container --}}
    <section class="py-12 lg:py-16 bg-zinc-950 relative"
             x-data="{
                 activeSection: 'sec-1',
                 mobileTocOpen: false,
                 toc: [
                     { id: 'sec-1', title: '1. Pendahuluan' },
                     { id: 'sec-2', title: '2. Informasi yang Kami Kumpulkan' },
                     { id: 'sec-3', title: '3. Cara Kami Mengumpulkan Informasi' },
                     { id: 'sec-4', title: '4. Tujuan Penggunaan Data Pribadi' },
                     { id: 'sec-5', title: '5. Dasar Pemrosesan Data' },
                     { id: 'sec-6', title: '6. Penyimpanan dan Keamanan Data' },
                     { id: 'sec-7', title: '7. Berbagi Data dengan Pihak Ketiga' },
                     { id: 'sec-8', title: '8. Cookies dan Teknologi Serupa' },
                     { id: 'sec-9', title: '9. Hak Anda atas Data Pribadi' },
                     { id: 'sec-10', title: '10. Jangka Waktu Penyimpanan Data' },
                     { id: 'sec-11', title: '11. Tautan ke Situs Pihak Ketiga' },
                     { id: 'sec-12', title: '12. Privasi Anak' },
                     { id: 'sec-13', title: '13. Perubahan Kebijakan Privasi' },
                     { id: 'sec-14', title: '14. Hubungi Kami' }
                 ],
                 scrollTo(id) {
                     const el = document.getElementById(id);
                     if (el) {
                         const y = el.getBoundingClientRect().top + window.scrollY - 100;
                         window.scrollTo({ top: y, behavior: 'smooth' });
                         this.activeSection = id;
                         this.mobileTocOpen = false;
                     }
                 }
             }"
             x-init="
                 const observer = new IntersectionObserver((entries) => {
                     entries.forEach(entry => {
                         if (entry.isIntersecting) {
                             activeSection = entry.target.id;
                         }
                     });
                 }, { threshold: 0.25, rootMargin: '-80px 0px -40% 0px' });
                 document.querySelectorAll('[data-privacy-section]').forEach(el => observer.observe(el));
             "
             aria-label="Dokumen Kebijakan Privasi">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            {{-- Mobile Collapsible Accordion Table of Contents --}}
            <div class="lg:hidden mb-8 bg-zinc-900/90 border border-white/10 rounded-2xl overflow-hidden shadow-lg">
                <button @click="mobileTocOpen = !mobileTocOpen"
                        type="button"
                        class="w-full px-5 py-4 flex items-center justify-between text-left font-bold text-sm text-zinc-200 bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/50"
                        aria-expanded="mobileTocOpen"
                        aria-controls="mobile-toc-list">
                    <span class="flex items-center gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        Daftar Isi Dokumen
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="text-zinc-400 transition-transform duration-200"
                         :class="mobileTocOpen ? 'rotate-180 text-indigo-400' : ''" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <div id="mobile-toc-list" x-show="mobileTocOpen" x-collapse x-cloak class="border-t border-white/5 px-3 py-3 bg-zinc-950/60">
                    <nav class="flex flex-col space-y-1" aria-label="Daftar Isi Mobile">
                        <template x-for="item in toc" :key="item.id">
                            <a :href="'#' + item.id"
                               @click.preventDefault="scrollTo(item.id)"
                               :class="activeSection === item.id ? 'bg-indigo-500/15 text-indigo-300 font-semibold border-l-2 border-indigo-400 pl-3' : 'text-zinc-400 hover:text-zinc-200 pl-3'"
                               class="py-2 pr-3 text-xs transition-colors rounded-r-lg flex items-center justify-between">
                                <span x-text="item.title"></span>
                                <svg x-show="activeSection === item.id" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </template>
                    </nav>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- Desktop Sidebar (Sticky Table of Contents) --}}
                <aside class="hidden lg:block lg:col-span-4 xl:col-span-3">
                    <div class="sticky top-28 bg-zinc-900/60 border border-white/5 rounded-2xl p-5 backdrop-blur-md">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-400 mb-4 pb-3 border-b border-white/5 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                            Daftar Isi
                        </h2>
                        <nav class="flex flex-col space-y-1 max-h-[calc(100vh-180px)] overflow-y-auto pr-1 text-xs font-medium scrollbar-thin scrollbar-thumb-zinc-800" aria-label="Daftar Isi Desktop">
                            <template x-for="item in toc" :key="item.id">
                                <a :href="'#' + item.id"
                                   @click.preventDefault="scrollTo(item.id)"
                                   :class="activeSection === item.id ? 'bg-indigo-500/15 text-indigo-300 font-semibold border-l-2 border-indigo-400 pl-3' : 'text-zinc-400 hover:text-zinc-200 hover:bg-white/5 pl-3'"
                                   class="py-2 pr-2.5 rounded-r-lg transition-all duration-150 flex items-center justify-between group">
                                    <span x-text="item.title" class="truncate"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         :class="activeSection === item.id ? 'text-indigo-400 opacity-100' : 'opacity-0 group-hover:opacity-60 text-zinc-500'"
                                         class="transition-opacity shrink-0 ml-1" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </template>
                        </nav>
                    </div>
                </aside>

                {{-- Document Main Content Column --}}
                <main class="lg:col-span-8 xl:col-span-9 space-y-10">

                    {{-- 1. Pendahuluan --}}
                    <article id="sec-1" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">1</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Pendahuluan</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Selamat datang di Trinova Digital. Kami sangat menghargai kepercayaan Anda dan berkomitmen untuk melindungi hak privasi serta data pribadi pengguna yang mengakses website dan menggunakan layanan kami.
                            </p>
                            <p>
                                Kebijakan Privasi ini menjelaskan jenis informasi pribadi yang kami kumpulkan melalui website Trinova Digital (termasuk formulir komunikasi dan layanan terkait), bagaimana informasi tersebut diolah, disimpan, dilindungi, serta hak-hak Anda atas informasi pribadi tersebut berdasarkan hukum yang berlaku di Indonesia.
                            </p>
                            <p>
                                Dengan mengakses website kami atau memberikan informasi pribadi Anda melalui saluran komunikasi yang tersedia, Anda menyatakan telah membaca, memahami, dan menyetujui praktik pemrosesan data yang dijelaskan dalam dokumen ini.
                            </p>
                        </div>
                    </article>

                    {{-- 2. Informasi yang Kami Kumpulkan --}}
                    <article id="sec-2" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">2</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Informasi yang Kami Kumpulkan</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Berdasarkan inspeksi fitur dan formulir interaktif di website Trinova Digital, kami hanya mengumpulkan informasi pribadi yang Anda berikan secara sukarela serta data teknis dasar saat Anda menggunakan website:
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
                                {{-- Card Audit Form Data --}}
                                <div class="bg-zinc-950/80 border border-white/5 rounded-xl p-5">
                                    <div class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        Form Analisa Bisnis Gratis
                                    </div>
                                    <ul class="space-y-1.5 text-xs text-zinc-400 list-disc list-inside">
                                        <li>Nama Lengkap</li>
                                        <li>Nama Perusahaan / Bisnis</li>
                                        <li>Nomor WhatsApp / Telepon</li>
                                        <li>Alamat Email (opsional)</li>
                                        <li>Jenis / Kategori Bisnis</li>
                                        <li>Platform Marketplace (Shopee/Tokopedia/dll.)</li>
                                        <li>Estimasi Omzet Bulanan</li>
                                        <li>Ukuran Tim Bisnis</li>
                                        <li>Penjelasan Masalah Utama / Kebutuhan Bisnis</li>
                                    </ul>
                                </div>

                                {{-- Card Contact & Newsletter Data --}}
                                <div class="bg-zinc-950/80 border border-white/5 rounded-xl p-5">
                                    <div class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                        Form Kontak &amp; Langganan
                                    </div>
                                    <ul class="space-y-1.5 text-xs text-zinc-400 list-disc list-inside">
                                        <li>Nama Lengkap</li>
                                        <li>Alamat Email</li>
                                        <li>Nomor WhatsApp / Telepon</li>
                                        <li>Subjek &amp; Pesan Komunikasi</li>
                                        <li>Status Langganan Newsletter Email</li>
                                    </ul>
                                </div>
                            </div>

                            <p>
                                <strong>Data Teknis Otomatis:</strong> Saat Anda menjelajahi website, server kami secara otomatis mencatat informasi teknis standar seperti alamat IP (Internet Protocol), jenis browser, sistem operasi, URL perujuk (referrer), serta timestamp waktu akses demi keamanan dan kestabilan sistem.
                            </p>
                        </div>
                    </article>

                    {{-- 3. Cara Kami Mengumpulkan Informasi --}}
                    <article id="sec-3" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">3</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Cara Kami Mengumpulkan Informasi</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>Kami mengumpulkan data pribadi Anda melalui beberapa cara berikut:</p>
                            <ol class="list-decimal pl-5 space-y-2 text-zinc-300">
                                >Pengisian Formulir Sukarela:</strong> Ketika Anda mengisi formulir "Analisa Bisnis Gratis", formulir kontak, atau berlangganan berita berkala di website Trinova Digital.</li>
                                <li><strong>Komunikasi Langsung:</strong> Ketika Anda secara aktif mengirimkan pesan via email resmi (`halo@trinova.id`) atau mengklik tautan chat WhatsApp resmi kami.</li>
                                <li><strong>Pengumpulan Otomatis:</strong> Data log teknis dikumpulkan secara otomatis oleh server web kami saat sesi kunjungan berlangsung untuk keperluan audit keamanan dan kestabilan trafik.</li>
                            </ol>
                        </div>
                    </article>

                    {{-- 4. Tujuan Penggunaan Data Pribadi --}}
                    <article id="sec-4" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">4</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Tujuan Penggunaan Data Pribadi</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>Data pribadi yang telah dikumpulkan hanya akan digunakan secara spesifik dan transparan untuk tujuan-tujuan berikut:</p>
                            <ul class="list-disc pl-5 space-y-2 text-zinc-300">
                                <li>Menanggapi dan memproses permintaan Analisa Bisnis Gratis yang diajukan oleh Anda.</li>
                                <li>Memahami kebutuhan bisnis Anda untuk memberikan rekomendasi strategi dan program konsultasi yang tepat.</li>
                                <li>Menghubungi Anda kembali via WhatsApp atau email terkait diskusi konsultasi bisnis yang diminta.</li>
                                <li>Membalas pertanyaan atau masukan yang Anda kirimkan melalui formulir kontak.</li>
                                <li>Mengirimkan informasi pembaruan layanan, wawasan bisnis e-commerce, atau newsletter (jika Anda mendaftar).</li>
                                <li>Menjaga keamanan operasional website dari ancaman peretasan, penipuan, atau aktivitas ilegal.</li>
                                <li>Memenuhi kewajiban administratif dan peraturan hukum yang berlaku di Indonesia.</li>
                            </ul>
                        </div>
                    </article>

                    {{-- 5. Dasar Pemrosesan Data --}}
                    <article id="sec-5" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">5</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Dasar Pemrosesan Data</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Pemrosesan data pribadi oleh Trinova Digital dilaksanakan berdasarkan kerangka hukum yang berlaku di Indonesia, khususnya <strong>Undang-Undang Republik Indonesia Nomor 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)</strong>.
                            </p>
                            <p>Dasar hukum pemrosesan data kami meliputi:</p>
                            <ul class="list-disc pl-5 space-y-2 text-zinc-300">
                                <li><strong>Persetujuan (Consent):</strong> Anda memberikan persetujuan secara tersirat atau eksplisit ketika secara sukarela mengisi formulir dan mengirimkan informasi pribadi Anda.</li>
                                <li><strong>Pelaksanaan Permintaan Layanan:</strong> Pemrosesan diperlukan untuk mengambil langkah-langkah atas permintaan Anda sebelum atau dalam rangka pemberian konsultasi/layanan bisnis.</li>
                                <li><strong>Kepentingan yang Sah (Legitimate Interests):</strong> Pemrosesan diperlukan untuk menjaga keandalan, keamanan jaringan, dan pencegahan kecurangan pada infrastruktur web kami.</li>
                            </ul>
                        </div>
                    </article>

                    {{-- 6. Penyimpanan dan Keamanan Data --}}
                    <article id="sec-6" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">6</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Penyimpanan dan Keamanan Data</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Kami menerapkan langkah-langkah teknis dan organisatoris yang wajar untuk melindungi data pribadi Anda dari akses, pengungkapan, perubahan, atau penghancuran yang tidak sah.
                            </p>
                            <div class="bg-zinc-950/60 border border-white/5 rounded-xl p-4 text-xs text-zinc-400 space-y-2">
                                <p class="font-semibold text-zinc-200 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    Upaya Keamanan Kami:
                                </p>
                                <ul class="list-disc pl-4 space-y-1">
                                    <li>Penggunaan koneksi terenkripsi HTTPS (SSL/TLS) di seluruh website.</li>
                                    <li>Penyimpanan database dengan pembatasan hak akses ketat hanya untuk personel berwenang.</li>
                                    <li>Perlindungan terhadap serangan CSRF dan saringan masukan data pada server.</li>
                                </ul>
                            </div>
                            <p class="text-xs text-zinc-400 italic">
                                Catatan Transparansi: Meskipun kami mengambil langkah-langkah keamanan yang wajar, tidak ada sistem pengiriman data melalui internet atau penyimpanan elektronik yang 100% bebas risiko. Namun kami berkomitmen untuk meminimalkan risiko tersebut secara proporsional.
                            </p>
                        </div>
                    </article>

                    {{-- 7. Berbagi Data dengan Pihak Ketiga --}}
                    <article id="sec-7" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">7</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Berbagi Data dengan Pihak Ketiga</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Trinova Digital <strong class="text-zinc-100">tidak pernah menjual, menyewakan, atau memperdagangkan data pribadi Anda</strong> kepada pihak manapun untuk kepentingan pemasaran mereka.
                            </p>
                            <p>
                                Data hanya dapat diakses atau diproses oleh pihak ketiga tepercaya dalam kondisi berikut:
                            </p>
                            <ul class="list-disc pl-5 space-y-2 text-zinc-300">
                                <li><strong>Penyedia Infrastruktur Web &amp; Hosting:</strong> Penyedia layanan server yang membantu meng-host aplikasi dan basis data kami secara aman.</li>
                                <li><strong>Layanan WhatsApp (Meta Platforms):</strong> Saat Anda mengeklik tautan WhatsApp untuk memulai percakapan dengan tim konsultasi kami.</li>
                                <li><strong>Layanan Analitik &amp; Tracking (Jika Diaktifkan):</strong> Google Analytics atau Meta Pixel (apabila dikonfigurasi aktif pada pengaturan sistem) untuk mengukur performa lalu lintas web secara agregat.</li>
                                <li><strong>Kepatuhan Hukum:</strong> Apabila diwajibkan oleh peraturan perundang-undangan, perintah pengadilan, atau permintaan resmi dari lembaga penegak hukum di Republik Indonesia.</li>
                            </ul>
                        </div>
                    </article>

                    {{-- 8. Cookies dan Teknologi Serupa --}}
                    <article id="sec-8" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">8</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Cookies dan Teknologi Serupa</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Website kami menggunakan *cookies* teknis esensial untuk mendukung operasional dasar website:
                            </p>
                            <ul class="list-disc pl-5 space-y-2 text-zinc-300">
                                <li><strong>Cookies Sesi Esensial (Laravel Session / CSRF Token):</strong> Digunakan untuk keamanan sesi penjelajahan dan mencegah serangan pemalsuan permintaan antar-situs (CSRF).</li>
                                <li><strong>Cookies Analitik Pihak Ketiga (Opsional):</strong> Digunakan hanya apabila fitur analitik diaktifkan untuk memahami pola kunjungan pengunjung secara statistik anonim.</li>
                            </ul>
                            <p>
                                Anda dapat mengontrol atau menolak penggunaan cookies melalui pengaturan pada browser Anda. Harap dicatat bahwa mematikan cookies esensial dapat memengaruhi sebagian fungsi pengiriman formulir di website.
                            </p>
                        </div>
                    </article>

                    {{-- 9. Hak Anda atas Data Pribadi --}}
                    <article id="sec-9" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">9</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Hak Anda atas Data Pribadi</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>Sesuai dengan UU Pelindungan Data Pribadi (UU PDP), Anda memiliki hak-hak berikut terkait data pribadi Anda:</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-4">
                                <div class="bg-zinc-950/60 border border-white/5 p-3.5 rounded-xl text-xs">
                                    <span class="font-bold text-indigo-300 block mb-1">1. Hak Akses &amp; Informasi</span>
                                    Meminta informasi mengenai pemrosesan serta salinan data pribadi yang kami simpan.
                                </div>
                                <div class="bg-zinc-950/60 border border-white/5 p-3.5 rounded-xl text-xs">
                                    <span class="font-bold text-indigo-300 block mb-1">2. Hak Pembetulan</span>
                                    Meminta perbaikan atau pembaruan atas data pribadi yang tidak akurat.
                                </div>
                                <div class="bg-zinc-950/60 border border-white/5 p-3.5 rounded-xl text-xs">
                                    <span class="font-bold text-indigo-300 block mb-1">3. Hak Penghapusan (Erasure)</span>
                                    Meminta penghapusan data pribadi Anda sesuai syarat dan ketentuan hukum yang berlaku.
                                </div>
                                <div class="bg-zinc-950/60 border border-white/5 p-3.5 rounded-xl text-xs">
                                    <span class="font-bold text-indigo-300 block mb-1">4. Hak Penarikan Persetujuan</span>
                                    Mencabut persetujuan yang telah Anda berikan sebelumnya untuk komunikasi/pemasaran.
                                </div>
                            </div>
                            <p>
                                Untuk mengajukan permintaan pelaksanaan hak-hak di atas, silakan hubungi kami melalui informasi kontak di bagian akhir dokumen ini.
                            </p>
                        </div>
                    </article>

                    {{-- 10. Jangka Waktu Penyimpanan Data --}}
                    <article id="sec-10" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">10</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Jangka Waktu Penyimpanan Data</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Kami menyimpan data pribadi Anda selama diperlukan untuk memenuhi tujuan pengumpulannya—seperti menyelesaikan konsultasi Analisa Bisnis Gratis, memberikan respon atas komunikasi Anda, serta memenuhi kewajiban hukum atau pembukuan yang sah.
                            </p>
                            <p>
                                Apabila data pribadi tidak lagi diperlukan untuk tujuan operasional maupun kewajiban hukum, atau jika Anda mengajukan permintaan penghapusan yang valid, kami akan menghapus atau menganonimkan data tersebut secara aman.
                            </p>
                        </div>
                    </article>

                    {{-- 11. Tautan ke Situs Pihak Ketiga --}}
                    <article id="sec-11" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">11</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Tautan ke Situs Pihak Ketiga</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Website kami dapat berisi tautan menuju situs web pihak ketiga (seperti media sosial TikTok, Instagram, atau platform marketplace). Kebijakan Privasi ini hanya berlaku untuk website Trinova Digital.
                            </p>
                            <p>
                                Kami tidak memiliki kendali dan tidak bertanggung jawab atas konten, kebijakan privasi, atau praktik keamanan dari situs web pihak ketiga tersebut. Kami menyarankan Anda untuk membaca Kebijakan Privasi masing-masing situs yang Anda kunjungi.
                            </p>
                        </div>
                    </article>

                    {{-- 12. Privasi Anak --}}
                    <article id="sec-12" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">12</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Privasi Anak</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Layanan dan informasi di website Trinova Digital ditujukan untuk pengguna dewasa dan pelaku usaha/UMKM. Kami tidak secara sengaja mengumpulkan atau meminta data pribadi dari anak-anak di bawah usia 18 tahun.
                            </p>
                            <p>
                                Jika Anda adalah orang tua atau wali yang mengetahui bahwa anak Anda telah memberikan data pribadi kepada kami tanpa persetujuan, silakan hubungi kami agar kami dapat segera mengambil langkah-langkah penghapusan data tersebut.
                            </p>
                        </div>
                    </article>

                    {{-- 13. Perubahan Kebijakan Privasi --}}
                    <article id="sec-13" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center font-heading">13</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Perubahan Kebijakan Privasi</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Trinova Digital berhak untuk memperbarui atau mengubah Kebijakan Privasi ini sewaktu-waktu guna mencerminkan perubahan pada layanan kami atau penyesuaian dengan regulasi perundang-undangan.
                            </p>
                            <p>
                                Setiap pembaruan akan dipublikasikan pada halaman ini dengan memperbarui keterangan tanggal "Terakhir diperbarui" di bagian atas dokumen. Kami menyarankan Anda untuk meninjau halaman ini secara berkala untuk tetap mendapatkan informasi terbaru mengenai komitmen privasi kami.
                            </p>
                        </div>
                    </article>

                    {{-- 14. Hubungi Kami --}}
                    <article id="sec-14" data-privacy-section class="scroll-mt-28 bg-zinc-900/40 border border-indigo-500/20 rounded-2xl p-6 sm:p-8 relative">
                        <header class="mb-4 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-500/20 border border-indigo-500/40 text-indigo-300 font-bold text-xs flex items-center justify-center font-heading">14</span>
                            <h2 class="text-xl sm:text-2xl font-bold text-zinc-100 font-heading">Hubungi Kami</h2>
                        </header>
                        <div class="space-y-4 text-zinc-300 text-sm sm:text-base leading-relaxed">
                            <p>
                                Jika Anda memiliki pertanyaan, saran, atau ingin menggunakan hak-hak Anda terkait data pribadi di bawah Kebijakan Privasi ini, silakan hubungi Trinova Digital melalui saluran resmi berikut:
                            </p>
                            
                            @php
                                $genSetting = \App\Models\Setting::getCached();
                                $contactEmail = $genSetting->email ?? 'halo@trinova.id';
                                $contactPhone = $genSetting->whatsapp ?? $genSetting->phone ?? '6281234567890';
                                $waNum = preg_replace('/[^0-9]/', '', $contactPhone);
                                if (str_starts_with($waNum, '0')) {
                                    $waNum = '62' . substr($waNum, 1);
                                }
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6">
                                <a href="mailto:{{ $contactEmail }}" class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/40 p-4 rounded-xl flex flex-col items-start transition-colors group">
                                    <span class="text-xs text-zinc-500 mb-1 flex items-center gap-1.5">
                                        ✉️ Email Resmi
                                    </span>
                                    <span class="text-xs sm:text-sm font-semibold text-zinc-200 group-hover:text-indigo-400 transition-colors">
                                        {{ $contactEmail }}
                                    </span>
                                </a>

                                <a href="https://wa.me/{{ $waNum }}?text={{ urlencode('Halo Trinova Digital, saya ingin bertanya mengenai Kebijakan Privasi.') }}"
                                   target="_blank" rel="noopener"
                                   class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/40 p-4 rounded-xl flex flex-col items-start transition-colors group">
                                    <span class="text-xs text-zinc-500 mb-1 flex items-center gap-1.5">
                                        💬 WhatsApp Official
                                    </span>
                                    <span class="text-xs sm:text-sm font-semibold text-zinc-200 group-hover:text-indigo-400 transition-colors">
                                        +{{ $waNum }}
                                    </span>
                                </a>

                                <a href="{{ route('contact.index') }}" class="bg-zinc-950/80 border border-white/5 hover:border-indigo-500/40 p-4 rounded-xl flex flex-col items-start transition-colors group">
                                    <span class="text-xs text-zinc-500 mb-1 flex items-center gap-1.5">
                                        📝 Formulir Kontak
                                    </span>
                                    <span class="text-xs sm:text-sm font-semibold text-zinc-200 group-hover:text-indigo-400 transition-colors">
                                        Kirim Pesan Langsung &rarr;
                                    </span>
                                </a>
                            </div>
                        </div>
                    </article>

                </main>

            </div>

            {{-- Mobile Terakhir Diperbarui (at the bottom) --}}
            <div class="sm:hidden mt-12 flex justify-center pb-4">
                <div class="inline-flex items-center gap-2 text-xs font-medium text-zinc-500 bg-zinc-900/80 px-3.5 py-1.5 rounded-lg border border-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Terakhir diperbarui: <span class="text-zinc-300 font-semibold">8 Agustus 2026</span>
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>
