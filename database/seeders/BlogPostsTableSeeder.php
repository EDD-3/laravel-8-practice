<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogCount = (int)$this->command->ask('How many blog posts would you like', 50);

        $users = User::all();
        //We use 'make; as to not save the posts before assigning a user id to each post individually
        BlogPost::factory()->count($blogCount)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
       });
    }
}
