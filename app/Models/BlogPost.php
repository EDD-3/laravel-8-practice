<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content'
    ];

    public function comments () {
        return $this->hasMany(Comment::class);
    }

    //Subscribe to Model Events
    public static function boot() {
        parent::boot();
        
        //Deleting model with relation
        static::deleting(function (BlogPost $blogPost) {
            //Accessing as a field not as a method
            //This will delete all comments associated with this particular blogPost
             $blogPost->comments()->delete();

        });
    }
    
}
