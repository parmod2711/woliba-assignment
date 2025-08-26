<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellbeingPillar extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Optional: relation to users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_wellbeing_pillar')->withPivot('order_number');
    }
}
