<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['birthday','naturalness','marital_status','scholarity','catechist_from','catechist_invitation','encounter_preparation'];
    protected $dates = ['birthday'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
