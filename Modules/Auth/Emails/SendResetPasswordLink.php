<?php

namespace Modules\Auth\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Mime\Email;

class SendResetPasswordLink extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(protected $resetLink, protected $email)
    {
        $this->afterCommit();
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth::emails.reset_password_link',
            with: [
                'resetLink' => $this->resetLink,
                'email' => $this->email
            ]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[FPT Telecom] Xác nhận yêu cầu khôi phục lại mật khẩu',
            using: [
                function (Email $message) {
                    // ...
                },
            ]
        );
    }
}
