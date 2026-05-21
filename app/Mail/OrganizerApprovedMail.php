<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganizerApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $organizerRequest;
    public $verificationCode;

    public function __construct($organizerRequest, $verificationCode)
    {
        $this->organizerRequest = $organizerRequest;
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->subject('Your Organizer Request Has Been Approved! 🎉')
                    ->view('emails.organizer-approved')
                    ->with([
                        'name' => $this->organizerRequest->full_name,
                        'code' => $this->verificationCode,
                        'email' => $this->organizerRequest->contact_email,
                    ]);
    }
}