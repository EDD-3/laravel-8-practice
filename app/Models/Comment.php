<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = [
        'user_id',
        'content',
    ];

    //Hiding fields that are return to the api
    protected $hidden = [
        'deleted_at',
        'commentable_type',
        'commentable_id',
        'user_id'

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

        // static::creating(function (Comment $comment) {

        // });
    }
}
