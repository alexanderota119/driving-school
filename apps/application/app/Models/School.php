<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\PhoneTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class School extends Model
{
    use BelongsToTenant, BaseTraits, RatingTrait, PhoneTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tenant_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
