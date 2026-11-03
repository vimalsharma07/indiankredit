<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OtpService
{
    public function __construct(private MailService $mail) {}

    public function send(User $user, string $purpose): void
    {
        $code = (string) random_int(100000, 999999);

        Otp::query()
            ->where('user_id', $user->id)
            ->where('purpose', $purpose)
            ->delete();

        Otp::query()->create([
            'user_id' => $user->id,
            'purpose' => $purpose,
            'code' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
        ]);

        [$subject, $body] = $this->message($user, $code, $purpose);

        $this->mail->send($user->email, $body, $subject);
    }

    public function check(User $user, string $purpose, string $code): bool
    {
        $otp = Otp::query()
            ->where('user_id', $user->id)
            ->where('purpose', $purpose)
            ->latest()
            ->first();

        if (! $otp || $otp->expires_at->isPast() || ! Hash::check($code, $otp->code)) {
            return false;
        }

        $otp->delete();

        return true;
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function message(User $user, string $code, string $purpose): array
    {
        $reset = $purpose === Otp::RESET;
        $subject = $reset ? 'Reset your IndianKredit password' : 'Your IndianKredit code';
        $line = $reset
            ? 'Use this code to choose a new password.'
            : 'Use this code to verify your email.';

        $body = '<p>Hello '.e($user->name).',</p>'
            .'<p>'.$line.'</p>'
            .'<p style="font-size:28px;font-weight:700;letter-spacing:6px">'.e($code).'</p>'
            .'<p>The code expires in 10 minutes.</p>';

        return [$subject, $body];
    }
}
