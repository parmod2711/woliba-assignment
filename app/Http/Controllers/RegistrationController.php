<?php
namespace App\Http\Controllers;

use App\Mail\MagicLinkMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    /**
     * Step 1: Invite user (Admin only)
     */
    public function invite(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'company_name'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $token = Str::random(64);

        $user = User::create([
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'email'            => $request->email,
            'company_name'     => $request->company_name,
            'magic_token'      => $token,
            'token_expires_at' => Carbon::now()->addMinutes(30),
        ]);

        $magicLink = url("/api/magic-link/user?token={$token}");

        // send email
        Mail::to($user->email)->send(new MagicLinkMail($magicLink, $user->first_name));

        //\Log::channel('emaillog')->info("Magic link email sent to {$user->email}: {$magicLink}");

        return response()->json([
            'message' => 'Invitation sent successfully. Check your email for the magic link.',
        ]);
    }

    /**
     * Step 2: Get user details via magic link
     */
    public function getUserByMagicLink(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $user = User::where('magic_token', $request->token)
            ->whereNull('magic_token_used_at')
            ->where('token_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }

        // Mark token as used
        $user->update(['magic_token_used_at' => Carbon::now()]);

        return response()->json([
            'first_name'   => $user->first_name,
            'last_name'    => $user->last_name,
            'email'        => $user->email,
            'company_name' => $user->company_name,
        ]);
    }

    /**
     * Step 1A: Create user (Web only)
     */

    public function signupRequest(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Provide a valid email',
            'email.unique' => 'This email is already registered',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $otp = rand(100000, 999999); // 6-digit OTP
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'email_verification_otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10), // OTP valid 10 mins
        ]);

        // Send OTP to email
         \Mail::to($user->email)->send(new \App\Mail\OtpMail($otp, $user->first_name));
        

        return response()->json([
            'message' => 'OTP sent to your email. Please verify.',
        ]);
    }

    /**
     * 1 B: Verify OTP
     */

    public function verifyOtp(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ], [
            'email.required' => 'Email is required',
            'otp.required' => 'OTP is required',
            'otp.digits' => 'OTP must be 6 digits',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->email_verification_otp !== $request->otp) {
            return response()->json(['errors' => ['otp' => 'Invalid OTP']], 422);
        }

        if ($user->otp_expires_at < now()) {
            return response()->json(['errors' => ['otp' => 'OTP expired']], 422);
        }

        $user->update([
            'email_verified' => true,
            'email_verified_at' => now(),
            'email_verification_otp' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json(['message' => 'Email verified successfully'],200);
    }

     /**
     * 1 C: Resend OTP
     */

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.exists'   => 'No account found with this email.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        // generate new OTP
        $otp = rand(100000, 999999);
        $user->update([
            'email_verification_otp' => $otp,
            'otp_expires_at'         => now()->addMinutes(10),
        ]);

        // send OTP mail
        \Mail::to($user->email)->send(new \App\Mail\OtpMail($otp, $user->first_name));

        // log to emails.log
        //\Log::channel('emaillog')->info("Resent OTP to {$user->email}: {$otp}");

        return response()->json(['message' => 'A new OTP has been sent to your email.']);
    }



    /**
     * Step 3: Save profile (password, dob, contact, confirmation)
     */
    public function saveProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'             => 'required|email|exists:users,email',
            'password'          => 'required|confirmed|min:6',
            'dob'               => 'required|date',
            'contact_number'    => 'required|string',
            'confirmation_flag' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $user->update([
            'password'          => Hash::make($request->password),
            'dob'               => $request->dob,
            'contact_number'    => $request->contact_number,
            'confirmation_flag' => $request->confirmation_flag,
        ]);

        return response()->json(['message' => 'Profile saved successfully']);
    }

    /**
     * Step 4: Get wellness interests
     */
    public function getWellnessInterests()
    {
        $interests = \DB::table('wellness_interests')->get();
        return response()->json($interests);
    }

    /**
     * Step 5: Save user-selected wellness interests
     */
    public function saveWellnessInterests(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'interest_ids' => 'required|array|min:1',
            'interest_ids.*' => 'exists:wellness_interests,id',
            ],
            [
                // Custom error messages
                'email.email' => 'Please provide a valid email address.',
                'email.exists' => 'This email is not registered.',
                'interest_ids.required' => 'You must select at least one wellness interest.',
                'interest_ids.min' => 'You must select at least one wellness interest.',
                'interest_ids.*.exists' => 'One or more selected wellness interests are invalid.', // if it doesn't exits in table
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->wellnessInterests()->sync($request->interest_ids);

        return response()->json(['message' => 'Wellness interests saved successfully']);
    }

    /**
     * Step 6: Get wellbeing pillars
     */
    public function getWellbeingPillars()
    {
        $pillars = \DB::table('wellbeing_pillars')->get();
        return response()->json($pillars);
    }

    /**
     * Step 7: Save exactly 3 wellbeing pillars
     */
    public function saveWellbeingPillars(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'pillar_ids' => 'required|array|size:3',
            'pillar_ids.*' => 'exists:wellbeing_pillars,id',
            ],
            [
                // Custom error messages
                'email.email' => 'Please provide a valid email address.',
                'email.exists' => 'This email is not registered.',
                'pillar_ids.required' => 'You must select at least 3 wellbeing pillars.',
                'pillar_ids.min' => 'You must select at least 3 wellbeing pillars.',
                'pillar_ids.*.exists' => 'One or more selected wellbeing pillars are invalid.', // if it doesn't exits in table
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // store with order
        $pivotData = [];
        foreach ($request->pillar_ids as $index => $id) {
            $pivotData[$id] = ['order' => $index + 1];
        }
        $user->wellbeingPillars()->sync($pivotData);

        $user->update(['registration_complete' => true]);

        return response()->json([
            'message' => 'Wellbeing pillars saved. Registration complete.'
        ]);
    }
}
