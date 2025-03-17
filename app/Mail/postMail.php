<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class postMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $demande;

    public function __construct($demande)
    {
        $this->demande = $demande;
    }

    public function build()
    {
        return $this->subject('Nouvelle demande de devis vous est envoyée')
            ->text('mails.contentMail')
            ->with([
                'demande' => $this->demande,
                'lienSite' => 'https://www.alliancetransit.com/admin/login', // Remplacez par l'URL de votre site
            ]);
    }
    
}