<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['phone','whatsapp','email','facebook','instagram'];

    public function parish() {
        return $this->morphTo(Parish::class, 'contactable');
    }

    public function community() {
        return $this->morphTo(Community::class, 'contactable');
    }

    public function students() {
        return $this->morphedByMany(Student::class, 'contactable');
    }

    public function catechists() {
        return $this->morphedByMany(User::class, 'contactable');
    }

    public function kinships() {
        return $this->morphedByMany(Kinship::class, 'contactable');
    }
}
