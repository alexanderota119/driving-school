<?php

declare(strict_types=1);

namespace App\Providers;

use App\Listeners\CreateStripCustomerListener;
use App\Listeners\FirstTenantDomainListener;
use App\Listeners\TenantCreateAdminUserListener;
use App\Listeners\TenantSeederListener;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Events;
use Stancl\Tenancy\Listeners;
use Stancl\Tenancy\Middleware;

class TenancyServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = '';

    public function register()
    {
        //
    }

    public function boot()
    {
//        // enable cache
//        DomainTenantResolver::$shouldCache = true;
//
//        // seconds, 3600 is the default value
//        DomainTenantResolver::$cacheTTL = 3600;

        $this->bootEvents();
        $this->mapRoutes();

        $this->makeTenancyMiddlewareHighestPriority();
    }

    protected function bootEvents()
    {
        foreach ($this->events() as $event => $listeners) {
            foreach ($listeners as $listener) {
                if ($listener instanceof JobPipeline) {
                    $listener = $listener->toListener();
                }

                Event::listen($event, $listener);
            }
        }
    }

    public function events(): array
    {
        return [
            // Tenant events
            Events\CreatingTenant::class => [],
            Events\TenantCreated::class  => [
                TenantSeederListener::class,
                TenantCreateAdminUserListener::class,
                CreateStripCustomerListener::class,
                FirstTenantDomainListener::class,

                JobPipeline::make([

                    // Your own jobs to prepare the tenant.
                    // Provision API keys, create S3 buckets, anything you want!
                ])->send(function (Events\TenantCreated $event) {
                    return $event->tenant;
                })->shouldBeQueued(false), // `false` by default, but you probably want to make this `true` for production.
            ],
            Events\SavingTenant::class   => [],
            Events\TenantSaved::class    => [],
            Events\UpdatingTenant::class => [],
            Events\TenantUpdated::class  => [],
            Events\DeletingTenant::class => [],
            Events\TenantDeleted::class  => [
                //                JobPipeline::make([
                //                ])->send(function (Events\TenantDeleted $event) {
                //                    return $event->tenant;
                //                })->shouldBeQueued(false), // `false` by default, but you probably want to make this `true` for production.
            ],

            // Domain events
            Events\CreatingDomain::class => [],
            Events\DomainCreated::class  => [],
            Events\SavingDomain::class   => [],
            Events\DomainSaved::class    => [],
            Events\UpdatingDomain::class => [],
            Events\DomainUpdated::class  => [],
            Events\DeletingDomain::class => [],
            Events\DomainDeleted::class  => [],

            // Tenancy events
            Events\InitializingTenancy::class => [],
            Events\TenancyInitialized::class  => [
                Listeners\BootstrapTenancy::class,
            ],

            Events\EndingTenancy::class => [],
            Events\TenancyEnded::class  => [
                Listeners\RevertToCentralContext::class,
            ],

            Events\BootstrappingTenancy::class      => [],
            Events\TenancyBootstrapped::class       => [],
            Events\RevertingToCentralContext::class => [],
            Events\RevertedToCentralContext::class  => [],

            // Resource syncing
            Events\SyncedResourceSaved::class => [
                Listeners\UpdateSyncedResource::class,
            ],
        ];
    }

    protected function mapRoutes()
    {
        if (! file_exists(base_path('routes/tenant.php'))) {
            return;
        }
        Route::namespace(static::$controllerNamespace)
            ->scopeBindings()
            ->middleware([
                'web',
                'tenant-web',
            ])
            ->group(function ($router_tenant) {
                $router_tenant
                    ->middleware('guest')
                    ->group(base_path('routes/tenant.php'));

                $router_tenant
                    ->middleware('tenant-instructors')
                    ->group(base_path('routes/tenant-authed.php'));

                $router_tenant
                    ->middleware(['tenant-instructors', 'tenant-instructors-api'])
                    ->group(base_path('routes/tenant-api.php'));
            });
    }

    protected function makeTenancyMiddlewareHighestPriority()
    {
        $tenancyMiddleware = [
            // Even higher priority than the initialization middleware
            Middleware\PreventAccessFromCentralDomains::class,

            Middleware\InitializeTenancyByDomain::class,
            Middleware\InitializeTenancyBySubdomain::class,
            Middleware\InitializeTenancyByDomainOrSubdomain::class,
            Middleware\InitializeTenancyByPath::class,
            Middleware\InitializeTenancyByRequestData::class,
        ];

        foreach (array_reverse($tenancyMiddleware) as $middleware) {
            $this->app[Kernel::class]->prependToMiddlewarePriority($middleware);
        }
    }
}
