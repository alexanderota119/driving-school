<?php

namespace App\Models;

use App\Enums\UserTypes;
use App\Http\SearchPipeline\Name;
use App\Traits\Models\BaseTraits;
use App\Traits\Models\PhoneTrait;
use App\Traits\Models\RatingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int     $id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $middle_name
 * @property string  $email
 * @property string  $password
 * @property string  $tenant_id
 * @property int     $student_type_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Address $address
 * @property School  $school
 */
class Student extends User
{
    use BelongsToTenant, BaseTraits, RatingTrait, HasApiTokens, HasFactory, Notifiable, RatingTrait, PhoneTrait;

    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('student', function ($builder) {
            $builder->student();
        });

        static::creating(function ($item) {
            $item->user_type_id = UserTypes::STUDENT;
        });
    }

    /**
     * @return BelongsTo
     */
    public function studentType(): BelongsTo
    {
        return $this->belongsTo(StudentType::class);
    }

    public function scopeOrName($query, $search)
    {
        return $query
            ->orWhere('first_name', 'like', $search)
            ->orWhere('last_name', 'like', $search)
            ->orWhere('middle_name', 'like', $search);
    }

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
