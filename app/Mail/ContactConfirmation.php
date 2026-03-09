<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $lastname,
        public string $firstname,
        public string $email,
        public string $phone,
        public string $client_message,
    ) {
    }

    public function build(): static
    {
        return $this->view('emails.contact-confirmation');
    }
}
