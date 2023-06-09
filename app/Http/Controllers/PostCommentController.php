<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    //Route Model Binding
    public function store(BlogPost $post, StoreComment $request) {
        
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id]);

            // $request->session()->flash('status', 'Comment was created!');

            //Sending an email to the proper user of the post when
            //comment gets posted 
            // Mail::to($post->user)->send(
            //     // new CommentPosted($comment),

            //     new CommentPostedMarkdown($comment)
            // );

            //Sending email to queue without implementing 
            //Should Queue interface on the CommentPostedMarkdown
            // Mail::to($post->user)->queue(
            //     // new CommentPosted($comment),

            //     new CommentPostedMarkdown($comment)
            // );

            $when = now()->addMinutes(1);

            Mail::to($post->user)->later(
                // new CommentPosted($comment),
                $when,
                new CommentPostedMarkdown($comment)
            );

            //Dispatchin our custom job
            NotifyUsersPostWasCommented::dispatch($comment);


            return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
