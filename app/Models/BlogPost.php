<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogPost extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    //One to many polymorphic relationship
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }
    //One to one
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Polymorphic one to one relationship
    public function image()
    {
        //The method asks the class constan name and the prefix name
        return $this->morphOne(Image::class, 'imageable');
    }
    // //One to many
    // public function comments () {
    //     return $this->hasMany(Comment::class)->latest();
    // }
    //Many to many relationship
    // public function tags () {
    //     return $this->belongsToMany(Tag::class)->withTimestamps();
    // }
    //Defining a local query scope
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
    //Defining a local query scope
    public function scopeMostCommented(Builder $query)
    {
        //Getting comments by most recent
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations(Builder $query)
    {
        return $query->latest()
            ->withCount('comments')
            ->with('user')
            ->with('tags');
    }
    //Subscribe to Model Events
    public static function boot()
    {
        static::addGlobalScope(
            new DeletedAdminScope
        );
        parent::boot();

        // static::addGlobalScope(
        //     new LatestScope
        // );

        //Model events get called first before any observer event
        // static::deleting(function (BlogPost $blogPost) {
        // });

        // static::restoring(function (BlogPost $blogPost) {
        // });

        // static::updating(function (BlogPost $blogPost) {
        // });
    }
}
