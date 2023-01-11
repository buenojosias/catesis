<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    use HasFactory;

    protected $fillable = ['group_id','theme_id','date','method'];
    protected $dates = ['date'];

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function theme() {
        return $this->belongsTo(Theme::class);
    }
}