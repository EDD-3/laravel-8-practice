<?php

namespace Database\Factories;
use App\Models\Author;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
    
    //Model factory callbacks
    public function configure()
    {
        //afterMakes only makes the model, afterCreating creates and saves the model to the database
        return $this->afterMaking(function (Author $author) {

        })->afterCreating(function (Author $author) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
