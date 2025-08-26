<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellnessInterest extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Optional: relationship to User
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_wellness_interest');
    }
}
