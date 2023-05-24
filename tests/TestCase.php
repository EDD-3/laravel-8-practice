<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    //Created user using the default Laravel factory 
    //to fix test cases for Post feature
    protected function user() {

        //Laravel < 8.00
        //return factory(User::class)->create();
        //Laravel > 8.00
        return User::factory()->create();
    }
}
