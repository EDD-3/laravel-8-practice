<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    //Route Model Binding
    public function store(BlogPost $post, StoreComment $request) {
        
        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id]);

            $request->session()->flash('status', 'Comment was created!');

            return redirect()->back();
    }
}
