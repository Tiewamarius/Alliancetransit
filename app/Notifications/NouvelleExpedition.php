<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\expeditions; // Importez votre modèle Expeditions

class NouvelleExpedition extends Notification
{
    use Queueable;

    protected $expedition;

    public function __construct(expeditions $expedition)
    {
        $this->expedition = $expedition;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle expédition enregistrée')
            ->line('Une nouvelle expédition a été enregistrée :')
            ->line('Numéro de suivi : ' . $this->expedition->numeroSuivi)
            ->line('Désignation : ' . $this->expedition->designation)
            ->line('Montant total : ' . $this->expedition->montant_total)
            ->action('Voir l\'expédition', url('/admin/expeditions/' . $this->expedition->id)) // Adaptez l'URL
            ->line('Merci d\'utiliser notre application !');
    }

    public function toArray($notifiable)
    {
        return [
            'expedition_id' => $this->expedition->id,
        ];
    }
}