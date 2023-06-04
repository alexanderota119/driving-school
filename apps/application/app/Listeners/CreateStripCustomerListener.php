<?php

namespace App\Listeners;

class CreateStripCustomerListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TenantCreated  $event
     * @return void
     */
    public function handle(\Stancl\Tenancy\Events\TenantCreated $event)
    {
        $tenant = $event->tenant;
        $stripeCustomer = $tenant->createAsStripeCustomer();
    }
}
