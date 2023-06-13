<?php

namespace App\Contracts;

//Creating our own contract
interface CounterContract {

    public function increment(string $key, array $tags = null): int;
}