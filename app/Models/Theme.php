<?php

namespace App\Models;

use App\Models\Traits\Parishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory, Parishable;

    protected $fillable = ['grade_id','title','description','sequence'];
    protected $guarded = ['id'];

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
