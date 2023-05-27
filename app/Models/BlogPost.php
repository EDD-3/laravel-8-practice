<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function comments () {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    //Defingin a local query scope
    public function scopeLatest(Builder $query) {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    //Defining a local query scope
    public function scopeMostCommented(Builder $query) {
        //c
        return $query->withCount('comments')->orderBy('comments_count','desc');
    }

    //Subscribe to Model Events
    public static function boot() {
        static::addGlobalScope(
            new DeletedAdminScope
        );
        parent::boot();

        // static::addGlobalScope(
        //     new LatestScope
        // );


        
        // //Deleting model with relation
        static::deleting(function (BlogPost $blogPost) {
        //     //Accessing as a field not as a method
        //     //This will delete all comments associated with this particular blogPost
             $blogPost->comments()->delete();

        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
    
}
