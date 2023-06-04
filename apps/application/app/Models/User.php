<?php

namespace App\Models;

use App\Casts\HashCast;
use App\Enums\UserTypes;
use App\Traits\Models\BaseTraits;
use App\Traits\Models\NotificationTrait;
use App\Traits\Models\PhoneTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $name
 * @property string $last_name
 * @property string $first_name
 * @property string $email
 * @property string $tenant_id
 * @property string $password
 */
class User extends Authenticatable implements \Illuminate\Contracts\Auth\MustVerifyEmail
{
    use HasApiTokens, HasFactory, NotificationTrait,
        BelongsToTenant, HasRolesAndAbilities, BaseTraits,
        RatingTrait, Billable, PhoneTrait;

    protected $keepRevisionOf = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'school_id',
        'car_id',
        'user_type_id',
        'student_type_id',
        'status_id',
        'is_inactive',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'school_id',
        'car_id',
        'user_type_id',
        'status_id',
        'is_inactive',
        'student_type_id',
        'data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data'              => 'json',
        'email_verified_at' => 'datetime',
        'password'          => HashCast::class,
        'car_id'            => 'integer',
        'is_inactive'       => 'boolean',
        'user_type_id'      => UserTypes::class,
        // 'student_type_id'      => StudentTypes::class,
    ];

    protected static function boot()
    {
        parent::boot();

        $activeCallback = function ($item) {
            $is_inactive = $item->is_inactive ?? false;

            if ($item->status) {
                $is_inactive = $item->status->is_inactive;
            } else {
                $inactive_status = Status::modelStatuses(self::class)->where('is_inactive', true)->first();

                if ($inactive_status) {
                    $item->is_inactive = $inactive_status->id;
                }
            }

            $item->is_inactive = $is_inactive;
        };

        self::updating($activeCallback);
        self::creating($activeCallback);

        // Make sure to filter out inactive instructors
        static::addGlobalScope('active_only', function ($builder) {
            $builder->where('is_inactive', false);
        });
    }

    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeCentral($query)
    {
        return $query->where('user_type_id', UserTypes::CENTRAL);
    }

    public function scopeInstructor($query)
    {
        return $query->where('user_type_id', UserTypes::INSTRUCTOR);
    }

    public function scopeStudent($query)
    {
        return $query->where('user_type_id', UserTypes::STUDENT);
    }

    public function scopeGuest($query)
    {
        return $query->where('user_type_id', UserTypes::GUEST);
    }

    /**
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user_login_history(): HasMany
    {
        return $this->hasMany(UserLoginHistory::class);
    }

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function timeoffRequests(): HasMany
    {
        return $this
            ->hasMany(TimeOff::class)
            ->orderBy('recur_token')
            ->orderBy('time_start');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payments::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->where('statusable_type', User::class);
    }
}
