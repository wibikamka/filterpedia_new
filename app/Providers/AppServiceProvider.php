<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\NavbarComposer;
use App\Services\ImageService;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
                $this->app->singleton(ImageService::class, function ($app) {
            return new ImageService();
        });
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
        View::composer('components.navbar', NavbarComposer::class);
}
}
