<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Cache;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    public function updating(BlogPost $blogPost)
    {
        //Subscribing to an event
        //to delete the data save
        //in cache and update it
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    // //Deleting model with relation
    public function deleting(BlogPost $blogPost)
    {
        //Accessing as a method not as a field.
        //This will delete all comments associated with this particular blogPost.
        $blogPost->comments()->delete();

        //Delete the image saved to storage.
        //  $blogPost->image()->delete();
        //Deleting comments save in the cache.
        // dd("I'm being deleted");
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    public function restoring(BlogPost $blogPost)
    {
        $blogPost->comments()->restore();
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
