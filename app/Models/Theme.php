<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['grade_id','title','description','sequence'];

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
