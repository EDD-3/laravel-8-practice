<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;

class LatestScope implements Scope 
{
    //Using a global scope to modify query builders
    public function apply(Builder $builder, Model $model) {
        
        $builder->orderBy($model::CREATED_AT, 'desc');
    }
}