<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadManagerController extends Controller
{
    public function index()
    {
        return view('admin.leads.index');
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        return redirect()->back()->with('success', 'Lead status updated.');
    }

    public function addActivity(Request $request, Lead $lead)
    {
        return redirect()->back()->with('success', 'Activity added.');
    }

    public function destroy(Lead $lead)
    {
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted.');
    }
}
