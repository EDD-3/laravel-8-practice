<?php

namespace App\Http\Controllers;

use App\Events\BlogPostPosted;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Services\Counter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Gate;
// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'destroy', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // //
        // DB::connection()->enableQueryLog();
        //Eager loading
        // $posts = BlogPost::with('comments')->get();
        //Lazy loading
        // $posts = BlogPost::all();

        // foreach ($posts as $post) {
        //     foreach ($post->comments as $comment) {
        //         echo $comment->content;
        //     }

        // }
        // dd(DB::getQueryLog());

        // $this->authorize('posts.create');

        //Comments_count
        //Using the local query

        // User::withMostBlogPosts()->take(5)->get()

        return view(
            'posts.index',
            [
                'posts' => BlogPost::latestWithRelations()->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post = new BlogPost();
        $post = BlogPost::create($validated);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->image()->save(
                Image::make(['path' => $path])
            );
        }

        event(new BlogPostPosted($post));

        //We use custom langugage keys in our locale json files in resources/lang
        return redirect()->route('posts.show', ['post' => $post->id])->with('status', __('Blog post was created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $posts = BlogPost::all();
        // abort_if(!isset($posts[$id]), 404);

        //One way of using local query scopes
        // return view('posts.show', [
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id)
        // ]);

        //Saving the post in cache
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
                ->findOrFail($id);
        });

        //Adding a counter on how many users are visiting our website
        //using cache

        //Calling the service container
        //$counter = new Counter(5);
        $counter = resolve(Counter::class);


        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter->increment("blog-post-{$id}", ['blog-post']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize('update', $post);
        // if (Gate::denies('update-post',$post)) {
        //     //Redirects if user is 
        //     //not authorized to edit the post
        //     abort(403, "You can't edit this blog post!");
        // }
        //
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        //
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);
        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($post->image) {
                //this methods deletes the path and the images from storage
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::create(['path' => $path])
                );
            }
        }

        return redirect()->route('posts.show', ['post' => $post->id])->with('status', __('Blog post was updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = BlogPost::findOrFail($id);
        $post->delete();

        $this->authorize('delete', $post);
        // if (Gate::denies('delete-post',$post)) {
        //     //Redirects if user is 
        //     //not authorized to modify the post
        //     abort(403, "You can't delete this blog post!");
        // }


        return redirect()->route('posts.index')->with('status', __('Blog post was delete!'));
    }
}
