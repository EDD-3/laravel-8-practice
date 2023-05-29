<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //
        //Laravel 8.x.x <
        // Blade::component('components.badge', 'badge');

        //Laravel 8.x.x >
        Blade::aliasComponent('components.badge', 'badge');
    }
}
