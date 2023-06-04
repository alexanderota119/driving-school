<?php

namespace App\Providers;

use function abbreviate;
use App\Models\Instructor;
use App\Models\Tenant;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        JsonResource::withoutWrapping();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(Tenant::class);
        Cashier::calculateTaxes();

        Route::bind('any_instructor', function ($id) {
            return Instructor::withoutGlobalScope('active_only')->findOrFail($id);
        });

        \Str::macro('abbr', function (string $string) {
            return abbreviate($string);
        });
//        Carbon::setToStringFormat('d-M-Y H:i');
    }
}
