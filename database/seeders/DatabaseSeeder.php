<?php

namespace Database\Seeders;

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
        //factory(App\User::class)->states('john-doe')-create();
        User::factory()->newCustomUser()->create();
        // \App\Models\User::factory(10)->create();

        //Laravel 8.x <
        //factory(App\User::class,10)->create();
        User::factory()->count(20)->create();


    }
}
