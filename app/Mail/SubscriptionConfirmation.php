<?php


namespace App\Mail;

use Illuminate\Mail\Mailable;

class SubscriptionConfirmation extends Mailable
{
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Subscription Confirmation')
                    ->view('subscription-confirmation');
    }
}