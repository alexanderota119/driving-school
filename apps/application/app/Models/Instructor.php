<?php

namespace App\Models;

use App\Enums\UserTypes;
use App\Traits\Models\BaseTraits;
use App\Traits\Models\NotificationTrait;
use App\Traits\Models\PhoneTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property int    $car_id
 * @property int    $school_id
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Instructor extends User
{
    use BelongsToTenant, BaseTraits, RatingTrait, HasApiTokens, HasFactory, NotificationTrait, PhoneTrait;

    protected $table = 'users';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'car_id' => 'integer',
    ];

    protected static function booted()
    {
        static::addGlobalScope('instructors', function ($builder) {
            $builder->instructor();
        });

        static::creating(function ($item) {
            $item->user_type_id = UserTypes::INSTRUCTOR;
        });
    }

    public function timeoffRequests(): HasMany
    {
        return $this
            ->hasMany(TimeOff::class, 'user_id')
            ->orderBy('recur_token')
            ->orderBy('time_start');
    }
}
