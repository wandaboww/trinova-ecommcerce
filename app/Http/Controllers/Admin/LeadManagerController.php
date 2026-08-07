<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadManagerController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->paginate(15);
        $totalLeads = Lead::count();
        $totalNew = Lead::where('status', 'new')->count();
        $totalContacted = Lead::where('status', 'contacted')->count();
        $totalMeeting = Lead::where('status', 'meeting')->count();
        $totalProposal = Lead::where('status', 'proposal')->count();
        $totalNegotiation = Lead::where('status', 'negotiation')->count();
        $totalClosing = Lead::where('status', 'won')->count();
        $totalLost = Lead::where('status', 'lost')->count();

        return view('admin.leads.index', compact(
            'leads', 'totalLeads', 'totalNew', 'totalContacted', 'totalMeeting',
            'totalProposal', 'totalNegotiation', 'totalClosing', 'totalLost'
        ));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'monthly_revenue' => 'nullable|string|max:255',
        ]);

        $lead->update($validated);

        return redirect()->route('admin.leads.index')->with('success', 'Data lead berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|string'
        ]);
        
        $lead->update(['status' => $request->status]);

        return redirect()->route('admin.leads.index')->with('success', 'Status lead berhasil diperbarui.');
    }

    public function addActivity(Request $request, Lead $lead)
    {
        return redirect()->back()->with('success', 'Activity added.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Data lead berhasil dihapus.');
    }
}
