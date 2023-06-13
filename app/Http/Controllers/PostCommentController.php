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

    //Creating an api route
    public function index(BlogPost $post) {
        //Laravel converts this into JSON

        //Testing 
        //Laravel converts the model into a the collection, 
        //then into json
        // dump(is_array($post->comments));
        // dump(get_class($post->comments));
        // die;

        //Being returned as a collection
        // return $post->comments;

        //Being returned as a query
        // return $post->comments();

        return $post->comments()->with('user')->get();
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
