<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{

    protected $model = BlogPost::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(5, true),
            //
        ];
    }

    //Model Factory State
    public function newPost()
    {
        return $this->state(function () {
            return [
                'title' => 'New Title',
                'content' => 'Content of the blog post',
            ];
        });
    }
}
