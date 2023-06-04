<?php

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

use App\Http\Controllers\TenantRegisterController;

Route::inertia('/', 'CentralDomain/LandingPage');

Route::get('/register/basic-info/{plan_name}', [TenantRegisterController::class, 'register']);
Route::post('/register', [TenantRegisterController::class, 'registerSave']);

Route::get('/example-create-tenant/{tenant_name}', function ($tenant_name) {
    $tenant = App\Models\Tenant::create(['id' => $tenant_name]);
    $tenant->domains()->create(['domain' => "{$tenant_name}.localhost"]);

    return response()->json(compact('tenant_name'));
});
