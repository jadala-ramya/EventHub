<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganizerRequestApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;
    public $continueLink;
    public $oneTimePassword;

    public function __construct($requestData, $continueLink, $oneTimePassword = null)
    {
        $this->requestData = $requestData;
        $this->continueLink = $continueLink;
        $this->oneTimePassword = $oneTimePassword;
    }

    public function build()
    {
        return $this->subject('Your Organizer Request Has Been Approved')
                    ->view('emails.organizer-request-approved');
    }
}
