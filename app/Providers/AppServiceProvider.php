<?php

namespace App\Providers;

use App\Http\Resources\CommentResource;
use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Counter;
use App\Services\DummyCounter;
use Illuminate\Http\Resources\Json\JsonResource;

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
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT'));
        });

        //Here we can switch the concretion we bind the contract
        $this->app->bind(
            'App\Contracts\CounterContract',
            // DummyCounter::class
            Counter::class
        );

        // $this->app->bind(
        //     'App\Contracts\CounterContract',
        //     DummyCounter::class
        // );

        //Code snippet when we use simple services 
        //and we do not need to use singleton patter

        // $this->app->when(Counter::class)
        // ->needs('$timeout')
        // ->give(env('COUNTER_TIMEOUT'));


        //Removing the data from json serialization
        // CommentResource::withoutWrapping();

        //Disabling wrapping from every class that inherits from Resource
        //Removes data array (not including when we use pagination)
        JsonResource::withoutWrapping();
    }
}
