<?php

namespace App\Traits;

use App\Models\Tag;

trait Taggable {

        protected static function bootTaggable () {
            static::updating (function ($model) {
                $model->tags()->sync(static::findTagsInContent($model->content));
            });

            static::created (function ($model) {
                $model->tags()->sync(static::findTagsInContent($model->content));
            });
        }
        //Many to many relationship polymorphic relationship
        public function tags () {
            return $this->morphToMany(Tag::class,'taggable')->withTimestamps();
        }

        //Using a static function to find
        //tags inside the content of a content
        private static function findTagsInContent($content) {
            //Using regex
            //Finding keywords anything inside two @ symbols
            preg_match_all('/@([^@]+)@/m', $content, $tags);


            return Tag::whereIn('name', $tags[1] ?? [])->get();
        }
}