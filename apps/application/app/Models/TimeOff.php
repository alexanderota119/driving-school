<?php

namespace App\Models;

use App\Traits\Models\NoteTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property Carbon $date_time_off
 * @property Carbon $time_start
 * @property Carbon $time_end
 * @property int    $instructor_id
 * @property string $recur_token
 * @property string $comments
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TimeOff extends Model
{
    use SoftDeletes, HasFactory, NoteTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_time_off',
        'time_start',
        'time_end',
        'user_id',
        'instructor_id',
        'recur_token',
        'comments',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'instructor_id' => 'integer',
        'date_time_off' => 'datetime',
        'time_start'    => 'datetime',
        'time_end'      => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }
}
