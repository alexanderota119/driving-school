<?php

namespace App\Listeners;

use App\Events\LoginAttemptEvent;

class TrackingLoginAttemptListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginAttemptEvent  $event
     * @return void
     */
    public function handle(LoginAttemptEvent $event)
    {
        // Track successful login attempts
        $event->user->user_login_history()->create([
            'was_successful' => $event->was_successful,
            'meta'           => [
                'ip'     => $event->request->getClientIp(),
                'locale' => $event->request->getLocale(),
            ],
        ]);
    }
}
