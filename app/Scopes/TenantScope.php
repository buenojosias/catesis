<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(session()->has('parish_id') && !is_null(session('parish_id'))) {
            $builder->where('parish_id', session('parish_id'));
        }

        if(session()->has('community_id') && !is_null(session('community_id'))) {
            $builder->where('community_id', session('community_id'));
        }
    }
}
