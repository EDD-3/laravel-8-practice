<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//Added ShouldQueue interface for asynchronous operation
class CommentPostedMarkdown extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        //
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $subject = "Commented was posted on your {$this->comment->commentable->title}";

        return $this->subject($subject)
        ->markdown('emails.posts.commented-markdown');
    }
}
