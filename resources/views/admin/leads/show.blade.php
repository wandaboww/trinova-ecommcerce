<x-layouts.admin :title="'Detail Lead — CMS Admin'" :headerTitle="'Detail Pengajuan Audit Bisnis'">

    <div class="mb-6">
        <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center gap-2 text-xs text-zinc-500 hover:text-zinc-300 font-semibold transition-colors">
            ← Kembali ke Semua Leads
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Lead Detail --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-7 space-y-6">
                <div class="flex items-start justify-between border-b border-zinc-800 pb-5">
                    <div>
                        <h2 class="text-xl font-extrabold text-zinc-100 font-heading">Detail Lead</h2>
                        <p class="text-xs text-zinc-500 mt-1">Data pengajuan audit bisnis gratis dari calon klien</p>
                    </div>
                    <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 text-[10px] font-bold rounded-full uppercase tracking-widest">Baru</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Nama Pemilik Bisnis</span>
                        <span class="text-sm font-semibold text-zinc-200">Rizky Febrian</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Nama Brand / Bisnis</span>
                        <span class="text-sm font-semibold text-zinc-200">Rizky Fashion</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Nomor WhatsApp</span>
                        <a href="https://wa.me/081234567890" target="_blank" class="text-sm font-semibold text-green-400 hover:text-green-300 transition-colors">📞 081234567890</a>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Email</span>
                        <span class="text-sm font-semibold text-zinc-200">rizky@fashion.id</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Omzet Bulanan Saat Ini</span>
                        <span class="text-sm font-semibold text-zinc-200">Rp 10–50 Juta</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Tanggal Pengajuan</span>
                        <span class="text-sm font-semibold text-zinc-200">29 Juli 2026, 10.34 WIB</span>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-1.5">Masalah Bisnis Utama</span>
                        <p class="text-sm text-zinc-300 leading-relaxed bg-zinc-900/40 rounded-xl p-4 border border-zinc-800">
                            Penjualan saya stagnan di Tokopedia sudah 3 bulan terakhir. Saya butuh website sendiri dan strategi baru agar bisa meningkatkan penjualan tanpa hanya bergantung pada marketplace.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Sidebar --}}
        <div class="space-y-5">
            {{-- Quick Actions --}}
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-6 space-y-4">
                <h3 class="text-sm font-bold text-zinc-200 border-b border-zinc-800 pb-3 uppercase tracking-wider">Aksi Cepat</h3>
                <a href="https://wa.me/081234567890?text=Halo+Rizky+dari+Trinova+Digital..."
                   target="_blank"
                   class="w-full py-3 bg-green-600/20 hover:bg-green-600/30 border border-green-500/30 hover:border-green-500/50 text-green-400 font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-2">
                    📞 Hubungi via WhatsApp
                </a>
                <button class="w-full py-3 bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 text-zinc-300 font-bold text-xs rounded-xl transition-all">
                    ✏️ Ubah Status Lead
                </button>
                <button class="w-full py-3 bg-zinc-900 hover:bg-red-500/10 border border-zinc-800 hover:border-red-500/30 text-red-400 font-bold text-xs rounded-xl transition-all">
                    🗑️ Hapus Data Lead
                </button>
            </div>

            {{-- Status Update --}}
            <div class="bg-zinc-950 border border-zinc-900 rounded-2xl p-6 space-y-4">
                <h3 class="text-sm font-bold text-zinc-200 border-b border-zinc-800 pb-3 uppercase tracking-wider">Update Status</h3>
                <form method="POST" action="#" class="space-y-4">
                    @csrf @method('PUT')
                    <select name="status" class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 focus:border-indigo-500/60 rounded-xl text-zinc-100 text-sm focus:outline-none transition-colors">
                        <option value="new">Baru</option>
                        <option value="contacted">Dihubungi</option>
                        <option value="negotiation">Negosiasi</option>
                        <option value="closed">Closing / Deal</option>
                        <option value="rejected">Tidak Jadi</option>
                    </select>
                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl transition-all">
                        💾 Simpan Status
                    </button>
                </form>
            </div>
        </div>

    </div>

</x-layouts.admin>
