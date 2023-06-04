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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TenantRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', [TenantRegisterController::class, 'welcomeMessage']);

Route::get('testing/put', function (Request $request) {
    $request->session()->put(['aaa' => 'working']);
    $test = 'saved';

    return response()->json(compact('test'));
});

Route::get('testing/get', function (Request $request) {
    $test = $request->session()->get('aaa');

    return response()->json(compact('test'));
});

Route::middleware('auth')
    ->get('testing11', function () {
        return response()->json([
            'user'  => auth()->user(),
            'check' => auth()->check(),
        ]);
    })
    ->name('testing11');

Route::get('login/{guard}', [LoginController::class, 'loginGuarded']);
Route::post('login/{guard}', [LoginController::class, 'loginGuardedAttempt']);
Route::get('login', [LoginController::class, 'selectGuard'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Auth::routes(['login' => false]);
