<?php

namespace App\Mail;

use App\Models\PmbRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PmbNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PmbRegistration $registration) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[PMB Baru] ' . $this->registration->full_name . ' — ' . $this->registration->study_program,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pmb-notification',
        );
    }
}
