<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class PasswordChangedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $changedAt;
    public $ipAddress;
    public $userAgent;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $changedAt, $ipAddress, $userAgent)
    {
        $this->user = $user;
        $this->changedAt = $changedAt;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password Changed Successfully',
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [new Address('security@bananacatcher.com', 'Banana Catcher Security')],
            tags: ['security', 'password-change'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password-changed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
