<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property Carbon $class_time
 * @property int    $duration duration in minutes
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Course extends Model
{
    use BelongsToTenant, BaseTraits, RatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'class_time',
        'duration',
        'tenant_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'class_time' => 'datetime',
        'duration'   => 'integer',
    ];
}
