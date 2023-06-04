<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\PhoneTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Billable;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, BaseTraits, RatingTrait, Billable, PhoneTrait;

    protected $fillable = [
        'id',
        'data',
        'name',
        'bgcolor',
        'fgcolor',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(related: User::class);
    }
}
