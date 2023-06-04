<?php

use App\Listeners\CreateStripCustomerListener;
use App\Listeners\FirstTenantDomainListener;
use App\Listeners\TenantCreateAdminUserListener;
use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stancl\Tenancy\Events\TenantCreated;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);

    $new_tenant = 'Test Tenant';
    $slug = Str::slug($new_tenant);

    $tenant = Tenant::create([
        'id'   => $slug,
        'name' => $new_tenant,
    ]);
});

test('New Tenants should get domain and right data', function () {
    /** @var Tenant $tenant */
    $should_be_all_users = User::count();

    $tenant = Tenant::with('domains')->find('test-tenant');
    tenancy()->initialize($tenant);

    // seeders create like 7 users
    expect($should_be_all_users)->toBeGreaterThan(3);

    // new  tenants should have 1 user until registration
    expect(User::count())->toEqual(4);
    expect($tenant->domains->first()->domain)->toEqual('test-tenant.eddriving.local');
    expect($tenant->domains->count())->toEqual(1);
});

test('New Tenants events are dispatched', function () {
    Event::fake();

    Event::assertListening(TenantCreated::class, TenantCreateAdminUserListener::class);
    Event::assertListening(TenantCreated::class, CreateStripCustomerListener::class);
    Event::assertListening(TenantCreated::class, FirstTenantDomainListener::class);
});
