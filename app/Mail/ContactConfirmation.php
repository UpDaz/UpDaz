<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $lastname;
    public $firstname;
    public $email;
    public $phone;
    public $client_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lastname, $firstname, $email, $phone, $client_message)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->phone = $phone;
        $this->client_message = $client_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-confirmation');
    }
}
