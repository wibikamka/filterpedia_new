<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot()
{
    if (env('APP_URL')) {
        URL::forceRootUrl(env('APP_URL'));
    }
    if (str_starts_with(env('APP_URL'), 'https://')) {
        URL::forceScheme('https');
    }
}
}
