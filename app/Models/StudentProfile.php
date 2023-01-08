<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = ['gender','naturalness','has_baptism','baptism_date','baptism_church','married_parents','health_problems','school'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}