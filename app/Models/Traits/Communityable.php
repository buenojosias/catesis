<?php

namespace App\Models\Traits;

use App\Models\Community;
use App\Scopes\CommunityScope;

trait Communityable
{
    protected static function bootCommunityable()
    {
        static::addGlobalScope(new CommunityScope);

        if(session()->has('community_id') && !is_null(session('community_id'))) {
            static::creating(function ($model) {
                $model->community_id = session('community_id');
            });
        }
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
