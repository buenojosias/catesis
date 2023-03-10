<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinship extends Model
{
    use HasFactory, Parishable;

    protected $fillable = ['name','birthday'];
    protected $guarded = ['id'];
    protected $dates = ['birthday'];

    public function contact() {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function pastorals() {
        return $this->morphToMany(Pastoral::class, 'pastorable');
    }

    public function profile() {
        return $this->hasOne(KinshipProfile::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class)->withPivot(['is_enroller','lives_together','title']);
    }
}
