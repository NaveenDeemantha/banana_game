<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Verification;
use Carbon\Carbon;

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
        // Generate OTP
        $otp = Verification::generateOTP();

        // Delete any existing verifications for this user
        Verification::where('user_id', $notifiable->id)->delete();

        // Create new verification record
        Verification::create([
            'user_id' => $notifiable->id,
            'email' => $notifiable->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(15), // OTP expires in 15 minutes
            'is_verified' => false,
        ]);

        return (new MailMessage)
            ->subject('Email Verification OTP - Banana Catcher')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo('verification@bananacatcher.com', 'Banana Catcher Verification')
            ->tag('verification')
            ->view(
                ['emails.verify-email', 'emails.verify-email-text'],
                [
                    'otp' => $otp,
                    'notifiable' => $notifiable,
                ]
            );
    }
}
