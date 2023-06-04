<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property string $abbr
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TestLocation extends Model
{
    use BelongsToTenant, BaseTraits, RatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'abbr',
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
     * @return MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
