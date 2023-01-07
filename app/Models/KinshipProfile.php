<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinshipProfile extends Model
{
    use HasFactory;

    protected $fillable = ['kinship_id','profession','marital_status','religion','catechizing','has_baptism','has_eucharist','has_chrism','attends_church','is_tither','musical_instrument'];

    public function kinship() {
        return $this->belongsTo(Kinship::class);
    }
}
