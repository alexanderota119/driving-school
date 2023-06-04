<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property Carbon $appointment_new_emails
 * @property Carbon $appointment_update_emails
 * @property Carbon $appointment_cancel_emails
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class NotificationPreference extends Model
{
    use BelongsToTenant, SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_new_emails',
        'appointment_update_emails',
        'appointment_cancel_emails',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'appointment_new_emails'    => 'datetime',
        'appointment_update_emails' => 'datetime',
        'appointment_cancel_emails' => 'datetime',
    ];

    /**
     * @return MorphTo
     */
    public function notificationpreferenceable(): MorphTo
    {
        return $this->morphTo();
    }
}
