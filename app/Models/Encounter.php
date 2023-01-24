<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    use HasFactory;

    protected $fillable = ['group_id','theme_id','date','method'];
    protected $dates = ['date'];

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot(['attendance']);
    }

    public function absences() {
        return $this->belongsToMany(Student::class)->wherePivot('attendance', 'F');
    }

    public function theme() {
        return $this->belongsTo(Theme::class);
    }
}
