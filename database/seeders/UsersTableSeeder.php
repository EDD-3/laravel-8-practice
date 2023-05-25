<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Laravel 8.x <
        //factory(App\User::class)->states('john-doe')-create();
        //Creating John Doe
        $usersCount = max((int)$this->command->ask('How many users would you like', 20),1);

        if(User::where('email', '=', 'john@laravel.test')->doesntExist()) {
            User::factory()->newCustomUser()->create();
        }

        // \App\Models\User::factory(10)->create();

        //Laravel 8.x <
        //factory(App\User::class,10)->create();
        User::factory()->count($usersCount)->create();
    }
}
