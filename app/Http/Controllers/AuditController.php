<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\AuditRequest;
use App\Http\Requests\StoreAuditRequest;
use App\Services\LeadService;

class AuditController extends Controller
{
    public function __construct(
        protected LeadService $leadService
    ) {}

    public function index()
    {
        return view('audit.index');
    }

    public function store(StoreAuditRequest $request)
    {
        $this->leadService->createFromAudit($request->validated());

        return redirect()->route('audit.success');
    }

    public function success()
    {
        return view('audit.success');
    }
}
