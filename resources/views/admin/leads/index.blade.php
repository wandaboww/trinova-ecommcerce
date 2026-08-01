<x-layouts.admin :title="'Kelola Leads — CMS Admin'" :headerTitle="'Manajemen Leads Pengajuan Audit Bisnis'">

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Summary Bar --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="bg-zinc-950 border border-zinc-900 p-5 rounded-2xl">
            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-2">Total Pengajuan</span>
            <span class="text-2xl font-extrabold text-zinc-100">12</span>
        </div>
        <div class="bg-zinc-950 border border-zinc-900 p-5 rounded-2xl">
            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-2">Belum Dihubungi</span>
            <span class="text-2xl font-extrabold text-yellow-400">5</span>
        </div>
        <div class="bg-zinc-950 border border-zinc-900 p-5 rounded-2xl">
            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-2">Dalam Negosiasi</span>
            <span class="text-2xl font-extrabold text-indigo-400">4</span>
        </div>
        <div class="bg-zinc-950 border border-zinc-900 p-5 rounded-2xl">
            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block mb-2">Closing / Deal</span>
            <span class="text-2xl font-extrabold text-green-400">3</span>
        </div>
    </div>

    {{-- Leads Table --}}
    <div class="bg-zinc-950 border border-zinc-900 rounded-2xl overflow-hidden shadow-lg">
        <div class="px-6 py-4 border-b border-zinc-800 flex items-center justify-between">
            <h3 class="text-sm font-bold text-zinc-200">📋 Daftar Pengajuan Audit Terbaru</h3>
            <span class="text-[10px] text-zinc-500 font-semibold">Diurutkan berdasar waktu pengajuan terbaru</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                    <tr class="border-b border-zinc-800/80 text-left bg-zinc-900/30">
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Nama / Brand</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">WhatsApp</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Omzet/Bulan</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Masalah Utama</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900">
                    @php
                    $leads = [
                        ['name'=>'Rizky Febrian',   'brand'=>'Rizky Fashion',    'wa'=>'081234567890','omzet'=>'Rp 10–50jt',    'problem'=>'Penjualan stagnan di Tokopedia',  'status'=>'Baru'],
                        ['name'=>'Diana Putri',      'brand'=>'Diana Kitchen',    'wa'=>'082299887766','omzet'=>'Rp 1–10jt',     'problem'=>'Belum punya website sendiri',     'status'=>'Baru'],
                        ['name'=>'Farhan Hidayat',   'brand'=>'Farhan Gadget',    'wa'=>'085544332211','omzet'=>'Rp 50–100jt',   'problem'=>'Perlu CRM & Otomasi WA',         'status'=>'Dihubungi'],
                        ['name'=>'Layla Azzahra',    'brand'=>'Layla Herbal',     'wa'=>'089988776655','omzet'=>'Rp 1–10jt',     'problem'=>'Produk belum dikenal publik',     'status'=>'Negosiasi'],
                        ['name'=>'Arif Santosa',     'brand'=>'Arif Furniture',   'wa'=>'081122334455','omzet'=>'Rp 100jt+',     'problem'=>'Perlu ERP & Multi-Gudang',       'status'=>'Closing'],
                        ['name'=>'Nisa Rahmawati',   'brand'=>'Nisa Collection',  'wa'=>'087745612389','omzet'=>'Rp 10–50jt',    'problem'=>'Konversi iklan rendah',          'status'=>'Baru'],
                    ];
                    $statusColor = ['Baru'=>'yellow','Dihubungi'=>'indigo','Negosiasi'=>'orange','Closing'=>'green'];
                    @endphp

                    @foreach($leads as $lead)
                    @php $color = $statusColor[$lead['status']] ?? 'zinc'; @endphp
                    <tr class="hover:bg-zinc-900/30 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-zinc-200">{{ $lead['name'] }}</p>
                            <p class="text-zinc-500 mt-0.5">{{ $lead['brand'] }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <a href="https://wa.me/{{ $lead['wa'] }}" target="_blank"
                               class="text-green-400 hover:text-green-300 font-semibold transition-colors">
                                📞 {{ $lead['wa'] }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-zinc-300 font-semibold">{{ $lead['omzet'] }}</td>
                        <td class="px-6 py-4 text-zinc-400 max-w-[180px]">
                            <span class="line-clamp-2">{{ $lead['problem'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-{{ $color }}-500/10 text-{{ $color }}-400 text-[10px] font-bold rounded-lg">
                                {{ $lead['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="#" class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-zinc-300 hover:text-white rounded-lg text-[10px] font-bold transition-all">Detail</a>
                                <button class="px-3 py-1.5 bg-zinc-900 border border-red-500/10 hover:border-red-500/40 text-red-400 rounded-lg text-[10px] font-bold transition-all">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.admin>
