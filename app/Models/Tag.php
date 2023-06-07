<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // public function blogPosts () {
    //     return $this->belongsToMany(BlogPost::class)->withTimestamps()->as('tagged');
    // }

    //Many to many polymorphic
    public function blogPosts() {
        return $this->morphedByMany(BlogPost::class, 'taggable');
    }

    //Many to many polymorphic
    public function comments () {
        return $this->morphedByMany(Comment::class, 'taggable');
    }
}
