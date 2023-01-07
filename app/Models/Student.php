<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['community_id','grade_id','name','birth','status'];

    protected $dates = ['birth'];

    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function detail() {
        return $this->hasOne(StudentDetail::class);
    }

    public function address() {
        return $this->hasOne(StudentAddress::class);
    }

    // public function documents() {
    //     return $this->hasMany(Document::class);
    // }

    // public function contact() {
    //     return $this->morphOne(Contact::class, 'contactable');
    // }

    // public function kinships() {
    //     return $this->hasMany(Kinship::class);
    // }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    // public function groups() {
    //     return $this->belongsToMany(Group::class);
    // }

    // public function comments() {
    //     return $this->hasMany(Comment::class);
    // }

    // public function pastorals() {
    //     return $this->morphToMany(Pastoral::class, 'pastorable');
    // }
}
