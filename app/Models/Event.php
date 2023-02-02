<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Parishable;

    protected $fillable = ['user_id','title','description','start_date','start_time','end_date','end_time'];
    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
