<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
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
        Blade::aliasComponent('components.updated', 'updated');
        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.card', 'card');
        Blade::aliasComponent('components.tags', 'tags');


        //Calling the View Composer
        view()->composer('posts.index', ActivityComposer::class);
    }
}
