<x-layouts.admin :title="'Kelola Leads — CMS Admin'" :headerTitle="'Manajemen Leads Pengajuan Analisa Bisnis'">

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Summary Bar --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-4 gap-4 mb-8">
        {{-- Total --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-slate-500 transition-colors">Total Pengajuan</span>
            <span class="text-2xl font-extrabold text-slate-800">{{ $totalLeads }}</span>
        </div>
        {{-- Lead Baru --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-amber-500 transition-colors">Lead Baru</span>
            <span class="text-2xl font-extrabold text-amber-500">{{ $totalNew }}</span>
        </div>
        {{-- Sudah Dihubungi --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-sky-500 transition-colors">Sudah Dihubungi</span>
            <span class="text-2xl font-extrabold text-sky-500">{{ $totalContacted }}</span>
        </div>
        {{-- Meeting --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-purple-500 transition-colors">Meeting</span>
            <span class="text-2xl font-extrabold text-purple-500">{{ $totalMeeting }}</span>
        </div>
        {{-- Proposal --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-indigo-500 transition-colors">Proposal</span>
            <span class="text-2xl font-extrabold text-indigo-600">{{ $totalProposal }}</span>
        </div>
        {{-- Negosiasi --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-orange-500 transition-colors">Negosiasi</span>
            <span class="text-2xl font-extrabold text-orange-500">{{ $totalNegotiation }}</span>
        </div>
        {{-- Closing --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-emerald-500 transition-colors">Closing ✅</span>
            <span class="text-2xl font-extrabold text-emerald-600">{{ $totalClosing }}</span>
        </div>
        {{-- Tidak Jadi --}}
        <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 group-hover:text-rose-500 transition-colors">Tidak Jadi</span>
            <span class="text-2xl font-extrabold text-rose-500">{{ $totalLost }}</span>
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
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-zinc-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900">
                    @forelse($leads as $lead)
                    @php
                        $statusColors = [
                            'new' => 'bg-amber-500/10 text-amber-400',
                            'contacted' => 'bg-sky-500/10 text-sky-400',
                            'meeting' => 'bg-purple-500/10 text-purple-400',
                            'proposal' => 'bg-indigo-500/10 text-indigo-400',
                            'negotiation' => 'bg-orange-500/10 text-orange-400',
                            'won' => 'bg-emerald-500/10 text-emerald-400',
                            'lost' => 'bg-rose-500/10 text-rose-400'
                        ];
                        $colorClass = $statusColors[$lead->status] ?? 'bg-zinc-500/10 text-zinc-400';
                    @endphp
                    <tr class="hover:bg-zinc-900/30 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-zinc-200">{{ $lead->name }}</p>
                            <p class="text-zinc-500 mt-0.5">{{ $lead->company ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}" target="_blank"
                               class="text-green-400 hover:text-green-300 font-semibold transition-colors">
                                📞 {{ $lead->phone }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-zinc-300 font-semibold">{{ $lead->monthly_revenue ?? '-' }}</td>
                        <td class="px-6 py-4 text-zinc-400">
                            <span class="block text-xs text-zinc-200">{{ $lead->created_at ? $lead->created_at->format('d M Y') : '-' }}</span>
                            <span class="text-[10px]">{{ $lead->created_at ? $lead->created_at->format('H:i \W\I\B') : '' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold rounded-lg {{ $colorClass }}">
                                {{ $lead->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.leads.show', $lead->id) }}" class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 hover:border-indigo-500/40 text-zinc-300 hover:text-white rounded-lg text-[10px] font-bold transition-all">Detail</a>
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus prospek ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-zinc-900 border border-red-500/10 hover:border-red-500/40 text-red-400 rounded-lg text-[10px] font-bold transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-zinc-500 text-xs border-b-0">Belum ada data pengajuan leads.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($leads, 'links') && $leads->hasPages())
            <div class="px-6 py-4 border-t border-zinc-800">
                {{ $leads->links() }}
            </div>
        @endif
    </div>

</x-layouts.admin>
