<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Nouveau message de contact',
        );
    }

    public function content()
{
    $data = [
        'name' => is_string($this->data['name']) ? $this->data['name'] : '',
        'email' => is_string($this->data['email']) ? $this->data['email'] : '',
        'subject' => is_string($this->data['subject']) ? $this->data['subject'] : '',
        'message' => is_string($this->data['message']) ? $this->data['message'] : '',
    ];

    return new Content(
        view: 'mails.contact',
        with: $data,
    );
}

    // Ajout de la méthode from() pour définir l'expéditeur
    public function from($address, $name = null)
    {
        return $this->withSymfonyMessage(function ($message) use ($address, $name) {
            $message->from($address, $name);
        });
    }
}