<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property string $make
 * @property string $license_plate
 * @property string $model
 * @property string $color
 * @property string $year
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Car extends Model
{
    use BelongsToTenant, BaseTraits, RatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'make',
        'license_plate',
        'model',
        'color',
        'year',
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

    /**
     * @return HasMany
     */
    public function instructors(): HasMany
    {
        return $this->hasMany(Instructor::class);
    }
}
