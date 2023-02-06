<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory, Parishable;

    protected $fillable = ['name'];
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->morphOne(ChurchDetail::class, 'detailable');
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function active_students()
    {
        return $this->hasMany(Student::class)->where(function ($q) {
            $q->where('status', 'Ativo')->get();
        });
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function coordinators()
    {
        return $this->hasMany(User::class)->whereHas('roles', function ($q) {
            $q->where('name', 'coordinator');
        });
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
