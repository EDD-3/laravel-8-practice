<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    //Reverse one to one polymorphic relationship
    public function imageable () {
        return $this->morphTo();
    }

    public function url () {
        return Storage::url($this->path);
    }
}
