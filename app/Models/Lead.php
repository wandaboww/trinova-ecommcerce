<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lead extends Model
{
    protected $fillable = [
        'name', 'company', 'phone', 'email',
        'business_type', 'marketplace', 'monthly_revenue',
        'team_size', 'website', 'message', 'lead_source',
        'status', 'notes',
    ];

    // Enum-like status constants
    const STATUS_NEW        = 'new';
    const STATUS_CONTACTED  = 'contacted';
    const STATUS_MEETING    = 'meeting';
    const STATUS_PROPOSAL   = 'proposal';
    const STATUS_NEGOTIATION= 'negotiation';
    const STATUS_WON        = 'won';
    const STATUS_LOST       = 'lost';

    public static function statuses(): array
    {
        return [
            self::STATUS_NEW         => 'Lead Baru',
            self::STATUS_CONTACTED   => 'Sudah Dihubungi',
            self::STATUS_MEETING     => 'Meeting',
            self::STATUS_PROPOSAL    => 'Proposal',
            self::STATUS_NEGOTIATION => 'Negosiasi',
            self::STATUS_WON         => 'Closing ✅',
            self::STATUS_LOST        => 'Tidak Jadi',
        ];
    }

    public function activities(): HasMany
    {
        return $this->hasMany(LeadActivity::class)->latest();
    }

    public function auditRequest(): HasOne
    {
        return $this->hasOne(AuditRequest::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return static::statuses()[$this->status] ?? $this->status;
    }
}
