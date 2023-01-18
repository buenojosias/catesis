<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['grade_id','year','weekday','time','start_date','end_date','finished'];

    protected $dates = ['start_date','end_date','time'];

    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot(['matriculation_id','status']);
    }

    public function encounters() {
        return $this->hasMany(Encounter::class);
    }
}
