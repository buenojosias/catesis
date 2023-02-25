<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $fillable = ['name', 'tenancy_type'];

    public function detail()
    {
        return $this->morphOne(ChurchDetail::class, 'detailable');
    }

    public function contact() {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function active_students() {
        return $this->hasMany(Student::class)->where(function($q) {
            $q->where('status', 'Ativo')->get();
        });
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function communities() {
        return $this->hasMany(Community::class);
    }

    public function coordinators() {
        return $this->hasMany(User::class)->whereHas('roles', function($q) {
            $q->where('name', 'admin');
        });
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    public function kinships() {
        return $this->hasMany(Kinship::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function themes() {
        return $this->hasMany(Theme::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function balance() {
        return $this->hasOne(Balance::class);
    }

    public function movementations() {
        return $this->hasMany(Movementation::class);
    }

    public function enrollements()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrollmentCodes()
    {
        return $this->hasMany(EnrollmentCode::class);
    }
}
