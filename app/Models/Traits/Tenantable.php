<?php

namespace App\Models\Traits;

use App\Models\Community;
use App\Models\Parish;
use App\Scopes\TenantScope;

trait Tenantable
{
    protected static function bootTenantable()
    {
        static::addGlobalScope(new TenantScope);

        if(session()->has('parish_id') && !is_null(session('parish_id'))) {
            static::creating(function ($model) {
                $model->parish_id = session('parish_id');
            });
        }

        if(session()->has('community_id') && !is_null(session('community_id'))) {
            static::creating(function ($model) {
                $model->community_id = session('community_id');
            });
        }
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
