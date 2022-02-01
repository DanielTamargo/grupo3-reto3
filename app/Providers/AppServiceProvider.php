<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fuente: https://stackoverflow.com/questions/35827062/how-to-force-laravel-project-to-use-https-for-all-routes
        if($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
