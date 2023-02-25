<?php

namespace App\Models;

use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    use HasFactory, Parishable, Communityable;

    protected $fillable = [
        'parish_id',
        'community_id',
        'enrollment_code_id',
        'student_id',
        'kinship_id',
        'status',
    ];

    public function enrollmentCode()
    {
        return $this->belongsTo(EnrollmentCode::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function kinship()
    {
        return $this->belongsTo(Kinship::class);
    }


}
