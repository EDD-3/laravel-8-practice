<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersAboutComment
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
    public function handle(CommentPosted $event)
    {
        //
        
        //Notifies the post owner that someone has posted a comment
        ThrottledMail::dispatch(new CommentPostedMarkdown($event->comment), 
        $event->comment->commentable->user)
            //Adding priority to jobs
            ->onQueue('low');

        //Dispatchin our custom job
        //Notifies users who have commented on this specific post
        NotifyUsersPostWasCommented::dispatch($event->comment)
            ->onQueue('high');
    }
}
