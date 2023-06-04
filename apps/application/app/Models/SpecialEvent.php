<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property Carbon $date_start
 * @property Carbon $end_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SpecialEvent extends Model
{
    use BelongsToTenant, BaseTraits, RatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_start',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'date_start' => 'date',
        'end_date'   => 'date',
    ];
}
