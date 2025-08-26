<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $casts = [
        'email_verified' => 'boolean',
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
    ];

    protected $fillable = [
        'first_name', 'last_name', 'email', 'company_name',
        'contact_number', 'dob', 'confirmation_flag',
        'registration_complete', 'magic_token', 'token_expires_at',
        'magic_token_used_at', 'password','email_verification_otp','otp_expires_at','email_verified','email_verified_at'
    ];

    protected $hidden = ['password', 'remember_token', 'magic_token'];

    public function wellnessInterests()
    {
        return $this->belongsToMany(\App\Models\WellnessInterest::class, 'user_wellness_interest');
    }

    public function wellbeingPillars()
    {
        return $this->belongsToMany(\App\Models\WellbeingPillar::class, 'user_wellbeing_pillar')
            ->withPivot('order_number');
    }
}
