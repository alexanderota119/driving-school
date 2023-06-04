<?php

namespace App\Providers;

use function base_path;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')->group(function ($router) {
                $router->middleware('web')->group(base_path('routes/web.php'));

                // central routes
                $router->middleware('central-web')
                    ->scopeBindings()
                    ->group(function ($router) {
                        foreach ($this->centralDomains() as $domain) {
                            $router
                                ->domain($domain)
                                ->group(base_path('routes/central.php'));

                            $router
                                ->middleware('auth', 'central-domain')
                                ->prefix('admin')
                                ->domain($domain)
                                ->group(base_path('routes/central-authed.php'));

                            $router
                                ->middleware('auth', 'central-domain-admin')
                                ->prefix('admin')
                                ->domain($domain)
                                ->group(base_path('routes/central-admin.php'));
                        }
                    });
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains', []);
    }
}
