<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\Communityable;
use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Parishable, Communityable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password','active','parish_id','community_id'];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address() {
        return $this->hasOne(UserAddress::class);
    }

    public function characteristics() {
        return $this->belongsToMany(Characteristic::class);
    }

    public function contact() {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function createdPastorals() {
        return $this->hasMany(Pastoral::class);
    }

    public function pastorals() {
        return $this->morphToMany(Pastoral::class, 'pastorable');
    }

    public function profile() {
        return $this->hasOne(UserProfile::class);
    }

    public function trainings() {
        return $this->belongsToMany(Training::class);
    }
}
