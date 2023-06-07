<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = [
        'user_id',
        'content',
    ];

    //Polymorphic one to many
    public function commentable() {
        return $this->morphTo();
    }

    // //Many to many polymorphic relation
    // public function tags () {
    //     return $this->morphsToMany(Tag::class,'taggable')->withTimestamps();
    // }


    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(
        //     new LatestScope
        // );

        static::creating(function (Comment $comment) {

            //Subscribing to a model to event
            //to delete 
            //comments to update views and posts
            //saved on cache memory redis instance
            if ($comment->commentable_type === BlogPost::class ) { 
                //We changed the blog_post_id for commentable_id
                Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
                Cache::tags(['blog-post'])->forget("mostCommented");
            }

        });
    }
}
