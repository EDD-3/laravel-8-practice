<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'content',
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

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
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
            Cache::tags(['blog-post'])->forget("mostCommented");
        });
    }
}
