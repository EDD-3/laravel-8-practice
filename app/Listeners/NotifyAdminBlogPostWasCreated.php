<?php

namespace App\Listeners;

use App\Events\BlogPostPosted;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminBlogPostWasCreated
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
    public function handle(BlogPostPosted $event)
    {
        //
        User::thatIsAnAdmin()->get()->map(
            function (User $user) use ($event) {
                ThrottledMail::dispatch(new BlogPostAdded($event->post), $user);
            }
        );

    }
}
