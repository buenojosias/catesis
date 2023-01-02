<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['community_id','grade_id','name','birth','status'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}