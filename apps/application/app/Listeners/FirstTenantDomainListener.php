<?php

namespace App\Listeners;

class FirstTenantDomainListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TenantCreated  $event
     * @return void
     */
    public function handle(\Stancl\Tenancy\Events\TenantCreated $event)
    {
        $event->tenant->domains()->create([
            'domain' => $event->tenant->id.'.'.config('tenancy.included_domain'),
        ]);
    }
}
