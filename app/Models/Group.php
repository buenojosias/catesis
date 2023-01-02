<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function community() {
        return $this->belongsTo(Community::class);
    }
    
    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    // public function students() {
    //     return $this->belongsToMany(Student::class);
    // }

    // public function encounters() {
    //     return $this->hasMany(Encounter::class);
    // }
}
