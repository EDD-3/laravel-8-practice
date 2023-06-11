<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Requests\StoreComment;
use App\Models\BlogPost;

//Less logic inside the controller the better
//We decoupled
class PostCommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    //Route Model Binding
    public function store(BlogPost $post, StoreComment $request)
    {

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

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

        // $when = now()->addMinutes(1);

        // Mail::to($post->user)->later(
        //     // new CommentPosted($comment),
        //     $when,
        //     new CommentPostedMarkdown($comment)
        // );

        event(new CommentPosted($comment));



        return redirect()->back()
            ->withStatus(__('Comment was created'));
    }
}
