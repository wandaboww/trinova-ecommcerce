<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function create(array $data): Lead
    {
        return Lead::create($data);
    }

    public function update(Lead $lead, array $data): Lead
    {
        $lead->update($data);
        return $lead->fresh();
    }

    public function paginate(int $perPage = 20, array $filters = [])
    {
        $query = Lead::query()->latest();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('company', 'like', "%{$filters['search']}%")
                  ->orWhere('phone', 'like', "%{$filters['search']}%")
                  ->orWhere('email', 'like', "%{$filters['search']}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function findOrFail(int $id): Lead
    {
        return Lead::with(['activities.user', 'auditRequest'])->findOrFail($id);
    }

    public function delete(Lead $lead): void
    {
        $lead->delete();
    }

    public function countByStatus(): array
    {
        return Lead::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
    }

    public function todayCount(): int
    {
        return Lead::whereDate('created_at', today())->count();
    }

    public function thisMonthCount(): int
    {
        return Lead::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }
}
