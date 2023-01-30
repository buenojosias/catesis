<?php

namespace App\Models;

use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, Parishable, Communityable;

    protected $fillable = ['grade_id','year','weekday','time','start_date','end_date','finished'];
    protected $guarded = ['id'];
    protected $dates = ['start_date','end_date','time'];

    public function active_students() {
        return $this->belongsToMany(Student::class)->wherePivot('status', 'Ativo');
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot(['matriculation_id','status']);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function encounters() {
        return $this->hasMany(Encounter::class);
    }
}
