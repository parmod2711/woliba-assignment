<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

use Illuminate\Support\Facades\Mail;

// Route when user will register from invitation link

Route::post('/invite', [RegistrationController::class, 'invite']);
Route::get('/magic-link/user', [RegistrationController::class, 'getUserByMagicLink']);

// Route when user will register from the web

Route::post('/verify-email-request', [RegistrationController::class, 'signupRequest']);
Route::post('/verify-otp', [RegistrationController::class, 'verifyOtp']);
Route::post('/resend-otp', [RegistrationController::class, 'resendOtp']);

// Profile update routes

Route::post('/user/profile', [RegistrationController::class, 'saveProfile']);

Route::get('/wellness-interests', [RegistrationController::class, 'getWellnessInterests']);
Route::post('/wellness-interests', [RegistrationController::class, 'saveWellnessInterests']);

Route::get('/wellbeing-pillars', [RegistrationController::class, 'getWellbeingPillars']);
Route::post('/wellbeing-pillars', [RegistrationController::class, 'saveWellbeingPillars']);
