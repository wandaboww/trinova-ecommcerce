<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\AuditRequest;
use App\Repositories\LeadRepository;

class LeadService
{
    public function __construct(
        protected LeadRepository $leadRepository
    ) {}

    /**
     * Buat lead baru dari form Analisa Bisnis Gratis
     */
    public function createFromAudit(array $data): Lead
    {
        // Buat Lead
        $lead = $this->leadRepository->create([
            'name'            => $data['name'],
            'company'         => $data['company'] ?? null,
            'phone'           => $data['phone'],
            'email'           => $data['email'] ?? null,
            'business_type'   => $data['business_type'],
            'marketplace'     => $data['marketplace'],
            'monthly_revenue' => $data['monthly_revenue'],
            'team_size'       => $data['team_size'] ?? null,
            'message'         => $data['message'],
            'lead_source'     => 'audit_form',
            'status'          => 'new',
        ]);

        // Buat Audit Request terkait
        AuditRequest::create([
            'lead_id'              => $lead->id,
            'current_marketplace'  => $data['marketplace'],
            'main_problem'         => $data['message'],
            'goal'                 => $data['business_type'],
            'status'               => 'pending',
        ]);

        return $lead;
    }

    /**
     * Update status lead
     */
    public function updateStatus(Lead $lead, string $status): Lead
    {
        return $this->leadRepository->update($lead, ['status' => $status]);
    }

    /**
     * Tambah aktivitas / catatan follow up
     */
    public function addActivity(Lead $lead, int $userId, string $activity, ?string $notes = null): void
    {
        $lead->activities()->create([
            'user_id'       => $userId,
            'activity'      => $activity,
            'notes'         => $notes,
            'activity_date' => now(),
        ]);
    }
}
