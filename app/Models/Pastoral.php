<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastoral extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'community_id', 'name', 'coordinator', 'encounters'];

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function students() {
        return $this->morphedByMany(Student::class, 'pastorable');
    }

    public function kinships() {
        return $this->morphedByMany(Kinship::class, 'pastorable');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
