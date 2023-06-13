<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Counter;


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
        Schema::defaultStringLength(191);
        Blade::aliasComponent('components.updated', 'updated');
        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.card', 'card');
        Blade::aliasComponent('components.tags', 'tags');
        Blade::aliasComponent('components.errors', 'errors');
        Blade::aliasComponent('components.comment-form','commentForm');
        Blade::aliasComponent('components.comment-list','commentList');

        //Calling the View Composer
        //Making the view composer class available on two views
        view()->composer(['posts.index','posts.show'],ActivityComposer::class);
        // view()->composer('*',ActivityComposer::class);

        //Registering a service
        //IoC

        //This creates a different object everytime the service container gets called
        // $this->app->bind(Counter::class, function ($app) {
        //     return new Counter(5);
        // });

        $this->app->singleton(Counter::class, function ($app) {
            // return new Counter(5);
            return new Counter(env('COUNTER_TIMEOUT'));
        });
    }
}
