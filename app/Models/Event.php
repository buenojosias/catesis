<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Parishable;

    protected $fillable = ['user_id','title','description','starts_at','ends_at'];
    protected $guarded = ['id'];
    protected $dates = ['starts_at', 'ends_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
