<?php

namespace App\Models;

use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, Parishable, Communityable;

    protected $fillable = ['user_id','student_id','description'];
    protected $guarded = ['id'];
    protected $dates = ['timestamp'];

    public function commentable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
