<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchDetail extends Model
{
    protected $fillable = ['parson', 'address', 'district', 'city'];

    public function parish() {
        return $this->morphTo(Parish::class, 'detailable');
    }

    public function community() {
        return $this->morphTo(Community::class, 'detailable');
    }

}
