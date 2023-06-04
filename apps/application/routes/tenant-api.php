<?php

declare(strict_types=1);

//use App\Http\Controllers\Api\DomainController;
//use App\Http\Controllers\Api\DropdownController;
use App\Http\Controllers\Api\DropdownController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])
    ->prefix('/api/')
    ->group(function (Router $router) {
//        Route::get('domain', [DomainController::class, '__invoke']);

        $router->get('/dropdown/{model}', [DropdownController::class, 'selectOptions']);

        Route::options('{any}');
    });
