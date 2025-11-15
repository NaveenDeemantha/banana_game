<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Email Address Verification Required - Banana Catcher')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo('verification@bananacatcher.com', 'Banana Catcher Verification')
            ->tag('verification')
            ->view(
                ['emails.verify-email', 'emails.verify-email-text'],
                [
                    'actionUrl' => $verificationUrl,
                    'notifiable' => $notifiable,
                ]
            );
    }
}
