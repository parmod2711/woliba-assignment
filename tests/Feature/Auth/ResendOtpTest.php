<?php

namespace Tests\Feature\Auth;

use PHPUnit\Framework\Attributes\Test;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ResendOtpTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_resends_otp_after_3_minutes()
    {
        $user = User::factory()->create([
            'email_verification_otp' => '123456',
            'otp_expires_at' => now()->subMinutes(3), // Expired OTP
        ]);

        $response = $this->postJson('/api/resend-otp', [
            'email' => $user->email,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'A new OTP has been sent to your email.']);

        $this->assertNotEquals('123456', $user->fresh()->email_verification_otp);
    }
}
