<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property float  $amount
 * @property int    $student_id
 * @property int    $class_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Payments extends Model
{
    use BelongsToTenant, BaseTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'student_id',
        'course_id',
        'payment_type_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'amount'          => 'decimal:2',
        'student_id'      => 'integer',
        'course_id'       => 'integer',
        'payment_type_id' => 'integer',
    ];

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
    public function payment_type(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
