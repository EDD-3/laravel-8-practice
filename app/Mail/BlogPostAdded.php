<?php

namespace App\Mail;

use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogPostAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $blogPost;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BlogPost $blogPost)
    {
        //
        $this->blogPost = $blogPost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "A blog post was posted by {$this->blogPost->user->name} with ID: {$this->blogPost->user->id}";


        return $this->subject($subject)->markdown('emails.posts.blog-post-added');
    }
}
