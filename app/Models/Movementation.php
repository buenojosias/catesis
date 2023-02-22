<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movementation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parish_id', 'community_id', 'matriculation_id', 'description', 'amount', 'balance_before', 'balance_after', 'date' ];

    protected $dates = ['date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function matriculation() {
        return $this->belongsTo(Matriculation::class);
    }
}
