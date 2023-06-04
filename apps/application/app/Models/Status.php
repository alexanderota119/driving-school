<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\NoteTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Status extends Model
{
    use HasFactory, NoteTrait, BelongsToTenant, BaseTraits;

    protected $fillable = [
        'name',
        'value',
        'is_inactive',
        'tenant_id',
    ];

    public static function modelStatuses($model)
    {
        // remember the results for 60 minutes
        return Cache::remember('', 60, fn () => (new Status)->statusesFor($model)->get());
    }

    protected static function boot()
    {
        parent::boot();

        self::updated(function ($item) {
            $tenant_id = tenant('id');

            Cache::forget("{$tenant_id}-{$item->statusable_type}");
        });
    }

    public function statusable()
    {
        return $this->morphTo();
    }

    public function scopeStatusesFor($query, $model)
    {
        return $query->where('statusable_type', $model);
    }
}
