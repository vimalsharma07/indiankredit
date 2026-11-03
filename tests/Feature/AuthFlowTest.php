<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Email;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_verifies_email_then_can_skip_profile(): void
    {
        $response = $this->post('/register', [
            'name' => 'Asha Rao',
            'email' => 'asha@example.com',
            'phone' => '9876543210',
            'password' => 'password1',
            'password_confirmation' => 'password1',
        ]);

        $response->assertRedirect('/verify-email');
        $this->assertNull(User::query()->where('email', 'asha@example.com')->first()->email_verified_at);

        $this->post('/verify-email', ['code' => $this->latestCode()])
            ->assertRedirect('/account');

        $this->assertAuthenticated();
        $this->assertNotNull(User::query()->where('email', 'asha@example.com')->first()->email_verified_at);

        $this->post('/account/skip')->assertRedirect('/');
        $this->assertNull(auth()->user()->pan);
    }

    public function test_profile_saves_pan_and_dob(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->post('/account', [
                'pan' => 'abcde1234f',
                'dob' => '1992-04-15',
            ])
            ->assertRedirect('/');

        $user->refresh();
        $this->assertSame('ABCDE1234F', $user->pan);
        $this->assertSame('1992-04-15', $user->dob->toDateString());
    }

    public function test_login_and_password_reset(): void
    {
        $user = User::factory()->create([
            'email' => 'asha@example.com',
            'password' => 'password1',
            'email_verified_at' => now(),
        ]);

        $this->post('/login', [
            'email' => 'asha@example.com',
            'password' => 'password1',
        ])->assertRedirect('/');

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();

        $this->post('/forgot-password', ['email' => 'asha@example.com'])
            ->assertRedirect('/reset-password');

        $this->post('/reset-password', [
            'code' => $this->latestCode(),
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ])->assertRedirect('/login');

        $this->post('/login', [
            'email' => 'asha@example.com',
            'password' => 'newpassword',
        ])->assertRedirect('/');

        $this->assertTrue($user->fresh()->email_verified_at !== null);
    }

    public function test_unknown_reset_email_does_not_confirm_an_account(): void
    {
        $this->post('/forgot-password', ['email' => 'missing@example.com'])
            ->assertRedirect('/reset-password')
            ->assertSessionHas('status');
    }

    private function latestCode(): string
    {
        $message = app('mailer')->getSymfonyTransport()->messages()->last();
        $email = $message->getOriginalMessage();
        $html = $email instanceof Email ? (string) $email->getHtmlBody() : $message->getMessage()->toString();

        preg_match('/(\d{6})/', $html, $matches);

        return $matches[1];
    }
}
