<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CommunityScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(session()->has('community_id') && !is_null(session('community_id'))) {
            $builder->where('community_id', session('community_id'))->orWhere('community_id', null);
        }
    }
}
