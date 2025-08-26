<?php

namespace Tests\Feature\Auth;

use PHPUnit\Framework\Attributes\Test;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class VerifyEmailRequestTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_verifies_email_and_stores_otp()
    {
        $response = $this->postJson('/api/verify-email-request', [
            'first_name' => 'Parmod',
            'last_name'  => 'Kumar',
            'company_name' => 'Demo Company',
            'email'      => 'parmod2711@gmail.com',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message']);

        $this->assertDatabaseHas('users', [
            'email' => 'parmod2711@gmail.com',
        ]);
    }
}
