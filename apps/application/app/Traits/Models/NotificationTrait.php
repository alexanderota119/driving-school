<?php

namespace App\Traits\Models;

use App\Models\NotificationPreference;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;

trait NotificationTrait
{
    use Notifiable;

    /**
     * @return MorphOne
     */
    public function notificationPreference(): MorphOne
    {
        return $this->morphOne(NotificationPreference::class, 'notificationpreferenceable');
    }
}
