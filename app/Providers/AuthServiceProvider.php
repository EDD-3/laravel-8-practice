<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //You can use models or resources
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user) {
            return $user->is_admin;
        });

        // //Ability 1
        // Gate::define('update-post', function($user, $post) {

        //     return $user->id == $post->user_id;
        // });


        // //Ability 2
        // Gate::define('delete-post', function($user, $post) {

        //     return $user->id == $post->user_id;
        // });

        //This gate gets called before any of the other 
        //gates
        Gate::before(function ($user, $ability) {
            if($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }

        });

        // Laravel 8.x.x <
        // Gate::define('post.update', 'App\Policies\BlogPostPolicy@update');
        // Gate::define('post.delete','App\Policies\BlogPostPolicy@delete');

        // Gate::define('posts.update', [BlogPostPolicy::class, 'update']);
        // Gate::define('posts.delete', [BlogPostPolicy::class, 'delete']);

        //Works in similar nature to Auth::routes()
        //posts.create, posts.view, posts.update, posts.delete
        // Gate::resource('posts', BlogPostPolicy::class);
        


        // Gate::after(function ($user, $ability, $result) {
        //     if($user->is_admin ) {
        //         return true;
        //     }

        // });
    }
}
