<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DevisSubmitted extends Notification
{
    use Queueable;

    protected $devis;

    public function __construct($devis)
    {
        $this->devis = $devis;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande de devis')
            ->line('Une nouvelle demande de devis a été soumise.')
            ->line('Pays de départ : ' . $this->devis->paysDepart)
            ->line('Ville de départ : ' . $this->devis->villeDepart)
            ->line('Pays d\'arrivée : ' . $this->devis->paysArrivee)
            ->line('Ville d\'arrivée : ' . $this->devis->villeArrivee)
            ->line('Désignation : ' . $this->devis->designation)
            ->action('Voir la demande', url('/admin/devis/' . $this->devis->id)) // Créez une route pour afficher les détails du devis
            ->line('Merci !');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}