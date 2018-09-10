<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SocietyOfferLetterForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $email_template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_template)
    {
        $this->email_template = $email_template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.society.forgot_password');
    }
}
