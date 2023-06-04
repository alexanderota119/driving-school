<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use App\Traits\Models\PhoneTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property Carbon $class_time
 * @property bool   $is_test_passed
 * @property int    $student_id
 * @property int    $class_id
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Roster extends Model
{
    use BelongsToTenant, BaseTraits, RatingTrait, PhoneTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'class_time',
        'is_test_passed',
        'student_id',
        'course_id',
        'tenant_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'class_time'     => 'datetime',
        'is_test_passed' => 'boolean',
        'student_id'     => 'integer',
        'course_id'      => 'integer',
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
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
