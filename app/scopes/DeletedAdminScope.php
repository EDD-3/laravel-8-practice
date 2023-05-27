<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeletedAdminScope implements Scope 
{
    //Using a global scope to modify query builders
    public function apply(Builder $builder, Model $model) {
        
        if(Auth::check() && Auth::user()->is_admin) {
            $builder->withTrashed();
            // $builder->withoutGlobalScope('Illuminate\Database\Elonquent\SoftDeletingScope');
        }
    }
}