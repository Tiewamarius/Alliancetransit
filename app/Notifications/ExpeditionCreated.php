<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\expeditions;

class ExpeditionCreated extends Notification
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
                    ->line('Une nouvelle expédition a été créée.')
                    ->line('Numéro de suivi : ' . $this->expedition->numeroSuivi)
                    ->line('Expéditeur : ' . $this->expedition->nom_expediteur)
                    ->line('Statuts : ' . $this->expedition->status)
                    ->line('Designation : ' . $this->expedition->designation)
                    ->action('Voir l\'expédition', url('/admin/expeditions/' . $this->expedition->id))
                    ->line('Merci d\'utiliser notre service !');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}