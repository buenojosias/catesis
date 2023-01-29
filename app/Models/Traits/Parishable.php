<?php

namespace App\Models\Traits;

use App\Models\Parish;
use App\Scopes\ParishScope;

trait Parishable
{
    protected static function bootParishable()
    {
        static::addGlobalScope(new ParishScope);

        if(session()->has('parish_id') && !is_null(session('parish_id'))) {
            static::creating(function ($model) {
                $model->parish_id = session('parish_id');
            });
        }
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }
}
