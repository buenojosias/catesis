<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['birth','marital_status'];
    protected $dates = ['birth'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
