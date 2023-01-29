<?php

namespace App\Models;

use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriculation extends Model
{
    use HasFactory, Parishable, Communityable;

    protected $fillable = ['user_id','community_id','student_id','kinship_id','year'];
    protected $guarded = ['id'];

    public function group() {
        return $this->belongTo(Group::class);
    }

    public function kinship() {
        return $this->belongsTo(Kinship::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function groupStudent() {
    //     return $this->hasOne(GroupStudent::class);
    // }

    // public function payments() {
    //     return $this->hasMany(Payment::class);
    // }
}
