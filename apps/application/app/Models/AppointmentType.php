<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property float  $duration
 * @property bool   $is_test
 * @property string $test_offset
 * @property string $order
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AppointmentType extends Model
{
    use BelongsToTenant, BaseTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'duration',
        'is_test',
        'test_offset',
        'order',
        'tenant_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'duration' => 'decimal:2',
        'is_test'  => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('order', 'asc');
        });

        static::creating(function ($item) {
            $last_order_by = static::limit(1)->select('order')->first()?->order ?: 0;
            $item->order = $last_order_by + 0 + 1;
        });

        static::saving(function ($item) {
            $item->is_test = (bool) $item->is_test;
        });
    }
}
