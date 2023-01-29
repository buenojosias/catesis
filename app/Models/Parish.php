<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $fillable = ['name', 'tenancy_type'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function communities() {
        return $this->hasMany(Comunity::class);
    }

    public function coordinators() {
        return $this->hasMany(User::class)->whereHas('roles', function($q) {
            $q->where('name', 'admin');
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
            $q->where('status', 'Ativo')->get();
        });
    }
}
