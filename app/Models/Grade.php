<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['title','description'];

    public function groups() {
        return $this->hasMany(Group::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function active_students() {
        return $this->hasMany(Student::class)->where(function($q) {
            $q->where('status', 'Ativo')
            ->when(auth()->user()->community_id, function($query) {
                return $query->where('community_id', auth()->user()->community_id);
            })
            ->get();
        });
    }

    public function themes() {
        return $this->hasMany(Theme::class);
    }
}
