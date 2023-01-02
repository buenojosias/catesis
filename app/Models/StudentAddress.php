<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    protected $fillable = ['address','complement','district','city'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
