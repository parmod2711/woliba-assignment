<?php

namespace Tests\Feature\Auth;

use PHPUnit\Framework\Attributes\Test;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerifyOtpTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_verifies_valid_otp()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'email_verification_otp' => '123456',
            'otp_expires_at' => now()->addMinutes(5),
            'email_verified' => false,
        ]);

        $response = $this->postJson('/api/verify-otp', [
            'email' => $user->email,
            'otp'   => '123456',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Email verified successfully']);

        $this->assertTrue($user->fresh()->email_verified);
    }

    #[Test]
    public function it_rejects_invalid_otp()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'email_verification_otp' => '123456',
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        $response = $this->postJson('/api/verify-otp', [
            'email' => $user->email,
            'otp'   => '654321',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['otp']);
    }
}
