<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

//Subscribes can handle many events at once
//Listeners can only handle 1 type of event

class CacheSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleCacheHit(CacheHit $event) {
        Log::info("{$event->key} cache hit");
    }

    public function handleCacheMissed(CacheMissed $event) {
        Log::info("{$event->key} cache miss");
    }

    //Like the handle function in listeners
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            CacheHit::class,
            'App\Listeners\CacheSubscriber@handleCacheHit'

        );

        $events->listen(
            CacheMissed::class,
            'App\Listeners\CacheSubscriber@handleCacheMissed'

        );
    }


}
