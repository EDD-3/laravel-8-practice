<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Laravel 8.x <
        //factory(App\User::class)->states('john-doe')-create();
        $john = User::factory()->newCustomUser()->create();
        // \App\Models\User::factory(10)->create();

        //Laravel 8.x <
        //factory(App\User::class,10)->create();
        $users = User::factory()->count(20)->create()->concat([$john]);

        //We use 'make; as to not save the posts before assigning a user id to each post individually
        $posts = BlogPost::factory()->count(50)->make()->each(function ($post) use ($users) {
             $post->user_id = $users->random()->id;
             $post->save();
        });

        $comments = Comment::factory()->count(150)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });


    }
}
