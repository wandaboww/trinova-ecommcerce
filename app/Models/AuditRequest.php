<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditRequest extends Model
{
    protected $fillable = [
        'lead_id',
        'current_marketplace',
        'monthly_orders',
        'monthly_ads_cost',
        'main_problem',
        'goal',
        'preferred_schedule',
        'status',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
