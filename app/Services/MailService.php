<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

class MailService
{
    /**
     * Send one email. The mailer and from address come from config/mail.php.
     */
    public function send(string $mail, string $body, ?string $subject = null): void
    {
        if (! filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('A valid email address is required.');
        }

        $subject ??= (string) config('mail.defaults.subject');
        $fromAddress = (string) config('mail.from.address');
        $fromName = (string) config('mail.from.name');

        $callback = function ($message) use ($mail, $subject, $fromAddress, $fromName): void {
            $message->to($mail)
                ->subject($subject)
                ->from($fromAddress, $fromName);
        };

        if (config('mail.defaults.html')) {
            Mail::html($body, $callback);

            return;
        }

        Mail::raw($body, $callback);
    }
}
