<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $street1
 * @property string $street2
 * @property string $street3
 * @property string $city
 * @property int    $state_id
 * @property string $tenant_id
 * @property string $zipcode
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Address extends Model
{
    use BelongsToTenant, BaseTraits;

//    protected $keepRevisionOf = [
//        'street1',
//        'street2',
//        'street3',
//        'city',
//        'state_id',
//        'tenant_id',
//        'zipcode',
//        'confirmed_on_service',
//    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street1',
        'street2',
        'street3',
        'city',
        'state_id',
        'tenant_id',
        'zipcode',

        // Which service this address was confirmed on google maps, smarty strets, which one
        'confirmed_on_service',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'state_id' => 'integer',
    ];

    protected $with = ['state'];

    /**
     * @return MorphTo
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function getStateNameAttribute(): string
    {
        return $this->state->name;
    }
}
