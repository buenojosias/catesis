<?php

namespace App\Models;

use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, Parishable, Communityable;

    protected $fillable = ['grade_id','name','birthday','status'];
    protected $guarded = ['id'];
    protected $dates = ['birthday'];
    // protected $casts = [ 'birthday' => 'date:Y-m-d' ];

    public function address() {
        return $this->hasOne(StudentAddress::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function contact() {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function encounters() {
        return $this->belongsToMany(Encounter::class)->withPivot(['attendance']);
    }

    public function absences() {
        return $this->belongsToMany(Encounter::class)->wherePivot('attendance', 'F');
    }

    // public function documents() {
    //     return $this->hasMany(Document::class);
    // }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class)->withPivot(['matriculation_id','status']);
    }

    public function kinships() {
        return $this->belongsToMany(Kinship::class)->withPivot(['is_enroller','lives_together','title']);
    }

    public function matriculations() {
        return $this->hasMany(Matriculation::class);
    }

    public function pastorals() {
        return $this->morphToMany(Pastoral::class, 'pastorable');
    }

    public function profile() {
        return $this->hasOne(StudentProfile::class);
    }
}
