<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static int increment(string $key, array $tags = null): int
 */

class CounterFacade extends Facade {

    //Returns the service name from the "service container"
    public static function getFacadeAccessor()
    {
        return 'App\Contracts\CounterContract';
    }
}