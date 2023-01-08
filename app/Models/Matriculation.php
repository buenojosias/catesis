<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriculation extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function kinship() {
        return $this->belongsTo(Kinship::class);
    }

    public function group() {
        return $this->belongTo(Group::class);
    }

    // public function groupStudent() {
    //     return $this->hasOne(GroupStudent::class);
    // }

    // public function payments() {
    //     return $this->hasMany(Payment::class);
    // }
}
