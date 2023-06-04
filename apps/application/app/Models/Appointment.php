<?php

namespace App\Models;

use App\Casts\TimeCast;
use App\Traits\Models\BaseTraits;
use App\Traits\Models\NoteTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $tenant_id
 * @property int    $student_id
 * @property int    $instructor_id
 * @property int    $creator_id
 * @property Carbon $date
 * @property Carbon $time_start
 * @property Carbon $time_end
 * @property int    $appointment_type_id
 * @property int    $test_location_id
 * @property Carbon $test_passed
 * @property Carbon $cancelled_date
 * @property string $cancelled_comment
 * @property int    $car_id
 * @property int    $pickup_location_id
 * @property string $dl304a
 * @property string $dl304c
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Appointment extends Model
{
    use BelongsToTenant, BaseTraits, NoteTrait, RatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'student_id',
        'instructor_id',
        'creator_id',
        'date',
        'time_start',
        'time_end',
        'appointment_type_id',
        'test_location_id',
        'test_passed',
        'cancelled_date',
        'cancelled_comment',
        'car_id',
        'pickup_location_id',
        'dl304a',
        'dl304c',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                  => 'integer',
        'student_id'          => 'integer',
        'instructor_id'       => 'integer',
        'creator_id'          => 'integer',
        'test_passed'         => 'datetime',
        'date'                => 'date',
        'time_start'          => TimeCast::class,
        'time_end'            => TimeCast::class,
        'appointment_type_id' => 'integer',
        'test_location_id'    => 'integer',
        'test_passed'         => 'datetime',
        'cancelled_date'      => 'datetime',
        'car_id'              => 'integer',
        'pickup_location_id'  => 'integer',
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', function ($builder) {
            $builder
                ->orderBy('date', 'asc')
                ->orderBy('time_start', 'asc');
        });

        static::creating(function ($item) {
            $item->creator_id = auth()->id();

            if (! $item->car_id) {
                $item->car_id = $item->instructor->car_id;
            }
        });
    }

    public function getNameAttribute()
    {
        return "Appointment for student id {$this->student_id}";
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function appointment_type(): BelongsTo
    {
        return $this->belongsTo(AppointmentType::class);
    }

    /**
     * @return BelongsTo
     */
    public function test_location(): BelongsTo
    {
        return $this->belongsTo(TestLocation::class);
    }

    /**
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @return BelongsTo
     */
    public function pickup_location(): BelongsTo
    {
        return $this->belongsTo(TestLocation::class);
    }
}
