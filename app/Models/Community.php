<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function coordinators() {
        return $this->hasMany(User::class)->whereHas('roles', function($q) {
            $q->where('name', 'coordinator');
        });
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function active_students() {
        return $this->hasMany(Student::class)->where(function($q) {
            $q->where('status', 'ativo')->get();
        });
    }

}
