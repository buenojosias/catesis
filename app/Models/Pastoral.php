<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastoral extends Model
{
    use HasFactory, Parishable;

    protected $fillable = ['user_id', 'community_id', 'name', 'coordinator', 'encounters'];
    protected $guarded = ['id'];

    public function kinships() {
        return $this->morphedByMany(Kinship::class, 'pastorable');
    }

    public function students() {
        return $this->morphedByMany(Student::class, 'pastorable');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function community() {
        return $this->belongsTo(Community::class);
    }
}
