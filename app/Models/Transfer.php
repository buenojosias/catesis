<?php

namespace App\Models;

use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use Parishable, Communityable;

    protected $fillable = ['user_id', 'student_id', 'kinship_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function kinship() {
        return $this->belongsTo(Kinship::class);
    }
}
