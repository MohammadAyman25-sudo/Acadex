<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Responses\RegisterResponse;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse as RegistrationContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            RegistrationContract::class,
            RegisterResponse::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
