<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    use HasFactory, Parishable;
    protected $guarded = ['id'];
    protected $fillable = ['group_id','theme_id','date','method'];
    protected $dates = ['date'];

    public function absences() {
        return $this->belongsToMany(Student::class)->wherePivot('attendance', 'F');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot(['attendance']);
    }

    public function theme() {
        return $this->belongsTo(Theme::class);
    }
}
