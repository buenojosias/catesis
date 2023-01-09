<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinship extends Model
{
    use HasFactory;

    protected $fillable = ['name','birth'];
    protected $dates = ['birth'];

    public function profile() {
        return $this->hasOne(KinshipProfile::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot(['is_enroller','live_together','title']);
    }

    public function title() {
        return $this->belongsTo(KinshipTitle::class);
    }

}
